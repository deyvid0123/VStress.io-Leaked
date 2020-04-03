<?php

	ob_start(); 
	require_once '../complex/configuration.php';
	require_once '../complex/init.php'; 

	if (!empty($maintaince)) {
		die($maintaince);
	}

	if (!($user->LoggedIn()) || !($user->notBanned($odb)) || !(isset($_SERVER['HTTP_REFERER']))) {
		die();
	}

	$userID = $_GET['user'];
	$code = $_GET['code'];
	
	if (empty($code) || empty($userID)){
							
								echo ' 
					
					
										<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Please verify the parameters!.</span>
			</div></div>
				';
die();
	}

	if ($user -> safeString($userID) || $user -> safeString($code)){
								
													echo ' 
					
					
										<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Security Fail - Unsafe characters set</span>
			</div></div>
				';
die();
	}
	
		$SQL = $odb -> prepare("SELECT `claimedby` FROM `gifts` WHERE `code` = :code");
		$SQL -> execute(array(':code' => $code));
		$status = $SQL -> fetchColumn(0);
		if (!($status == 0)){
				
													echo ' 
					
					
										<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Gift code has already been claimed! </span>
			</div></div>
				';
die();
		}
	
		$SQL2 = $odb -> prepare("SELECT * FROM `gifts` WHERE `code` = :code");
		$SQL2-> execute(array(':code' => $code));
		$check = $SQL2 -> fetch();
		$checkcode =$check['code'];

		if (!($checkcode == $code)){
							
								echo ' 
					
					
										<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong>Sorry code not found</span>
			</div></div>
				';
die();
		}
	
	// Update Status of GC
	$SQLUpdate = $odb -> prepare("UPDATE `gifts` SET `claimedBy` = :userID, `dateClaimed` = UNIX_TIMESTAMP() WHERE `code` = :code");
	$SQLUpdate -> execute(array(':userID' => $userID, ':code' => $code));
	
	// Update User Account with new Plan
	$SQL = $odb -> prepare("SELECT `bal` FROM `gifts` WHERE `code` = :code");
	$SQL -> execute(array(':code' => $code));
	$bal = $SQL -> fetchColumn(0);
	
	$SQL = $odb -> prepare("SELECT * FROM `users` WHERE `ID` = :id");
	$SQL -> execute(array(':id' => $userID));
	$plan	= $SQL -> fetch();
	$balance2 = $plan['balance'];
	
	$totalamount= $bal+$balance2;

	$updateSQL = $odb -> prepare("UPDATE `users` SET `balance` = :total  WHERE `ID` = :id");
	$updateSQL -> execute(array(':total' => (int)$totalamount, ':id' => (int)$userID));
	
  				echo ' 
					
					
										<div class="alert alert-outline-success alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-check"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>Success!</strong> $'.$planName.'$ has been added to your account!</span>
			</div></div>
				';
	
	
?>