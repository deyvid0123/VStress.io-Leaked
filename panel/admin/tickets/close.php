<?php
	
	ob_start();
	require_once '../../complex/configuration.php';
	require_once '../../complex/init.php';
	
        	if (!($user -> LoggedIn()) || !($user -> notBanned($odb)) || !isset($_SERVER['HTTP_REFERER'])){
		die(error('Error Say It to  Complex'));
	}
		
		 
	$id = $_GET['id'];
	
	$SQLFind = $odb -> prepare("SELECT `status` FROM `tickets` WHERE `id` = :id");
	$SQLFind -> execute(array(':id' => $id));
	
	if($SQLFind->fetchColumn(0) == "Closed"){
			echo ' 
									<div class="alert alert-outline-info alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-info"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>INFO! </strong> Ticket is already closed</span>
			</div></div>';
die();
	}
	
	$SQLupdate = $odb -> prepare("UPDATE `tickets` SET `status` = :status WHERE `id` = :id");
	$SQLupdate -> execute(array(':status' => 'Closed', ':id' => $id));
	echo ' 
									<div class="alert alert-outline-success alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-check"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>SUcCESS! </strong> Ticket has been closed successfuly</span>
			</div></div>';
die();
	
?>