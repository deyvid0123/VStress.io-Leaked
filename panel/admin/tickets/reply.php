<?php

	ob_start();
	require_once '../../complex/configuration.php';
	require_once '../../complex/init.php';
		 
	if (!($user -> LoggedIn()) || !($user -> notBanned($odb)) || empty($_GET['message']) || empty($_GET['id']) || !isset($_SERVER['HTTP_REFERER'])){
		die(error('There was an error with your session'));
	}

	$updatecontent = $_GET['message'];
	$id = $_GET['id'];
	
	if ($user -> safeString($updatecontent)){
			echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Unsafe characters were set</span>
			</div></div>';
die();
	}
	
	$SQLClosed = $odb -> query("SELECT `status` FROM `tickets` WHERE `id` = '$id'");
	if($SQLClosed->fetchColumn(0) == "Closed"){
					echo ' 
									<div class="alert alert-outline-info alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-info"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>INFO!</strong> The ticket has been closed</span>
			</div></div>';
die();
	}
	
	$SQLGetMessages = $odb -> query("SELECT * FROM `messages` WHERE `ticketid` = '$id' ORDER BY `messageid` DESC LIMIT 1");
	
	$SQLinsert = $odb -> prepare("INSERT INTO `messages` VALUES(NULL, :ticketid, :content, :sender, UNIX_TIMESTAMP())");
	$SQLinsert -> execute(array(':sender' => 'Admin', ':content' => $updatecontent, ':ticketid' => $id));
	
	$SQLUpdate = $odb -> prepare("UPDATE `tickets` SET `status` = :status WHERE `id` = :id");
	$SQLUpdate -> execute(array(':status' => 'Waiting for user response', ':id' => $id));
	
	$SQLGetTickets = $odb -> query("SELECT `username` FROM `tickets` WHERE `id` = '$id'");
	$username = $SQLGetTickets -> fetchColumn(0);

	$SQLinsert = $odb -> prepare("INSERT INTO `notifications` VALUES(NULL, ?, ?, ?, UNIX_TIMESTAMP())");
			$SQLinsert -> execute(array('You have an unread ticket', $username, 0));
	
	
						echo ' 
									<div class="alert alert-outline-success alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-check"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>SUCCESS!</strong> Message has been sent</span>
			</div></div>';
die();
	
?>