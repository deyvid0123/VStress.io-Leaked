<?php

	if (!isset($_SERVER['HTTP_REFERER'])){
		die;
	}
	
	ob_start();
	require_once '../../complex/configuration.php';
	require_once '../../complex/init.php';

	if (!empty($maintaince)){
		die();
	}
	
	if (!($user -> LoggedIn()) || !($user -> notBanned($odb))){
		die();
	}

	$updatecontent = anti_injection(htmlspecialchars($_GET['message']));
	$id = anti_injection(htmlspecialchars($_GET['id']));
	
	if(is_numeric($id) == false) {
		header('Location: ../../inbox.php');
		exit;
	}

	if (empty($updatecontent) || empty($id)){
		echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> You need to enter a reply</span>
			</div></div>';
die();
	}
	
	if ($user -> safeString($updatecontent) || $user -> safeString($id)){
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
        $error = "ComplexIsTheBest";
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
	
	$i = 0;
	$SQLGetMessages = $odb -> query("SELECT * FROM `messages` WHERE `ticketid` = '$id' ORDER BY `messageid` DESC LIMIT 1");
	
	while ($getInfo = $SQLGetMessages -> fetch(PDO::FETCH_ASSOC)){
		if ($getInfo['sender'] == 'Client'){
			$i++;
		}
	}
	
	if ($i >= 1){
					echo ' 
									<div class="alert alert-outline-info alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-info"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>INFO!</strong> Please wait for an admin to respond until you send a new message</span>
			</div></div>';
die();
	}
	
	$SQLinsert = $odb -> prepare("INSERT INTO `messages` VALUES(NULL, :ticketid, :content, :sender, UNIX_TIMESTAMP())");
	$SQLinsert -> execute(array(':sender' => 'Client', ':content' => $updatecontent, ':ticketid' => $id));
	
	$SQLUpdate = $odb -> prepare("UPDATE `tickets` SET `status` = :status WHERE `id` = :id");
	$SQLUpdate -> execute(array(':status' => 'Waiting for admin response', ':id' => $id));
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