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
							echo ' <div class="alert alert-outline-danger alert-dismissible animated flipInX"><strong>ERROR:</strong>Please fill in all fields. </div>';
die();
	}

	if ($user -> safeString($userID) || $user -> safeString($code)){
								echo ' <div class="alert alert-outline-danger alert-dismissible animated flipInX"><strong>ERROR:</strong>Unsafe characters were set </div>';
die();
	}
	
		$SQL = $odb -> prepare("SELECT `claimedby` FROM `giftcards` WHERE `code` = :code");
		$SQL -> execute(array(':code' => $code));
		$status = $SQL -> fetchColumn(0);
		if (!($status == 0)){
		echo ' <div class="alert alert-outline-danger alert-dismissible animated flipInX"><strong>Gift code has already been claimed! </div>';
die();
		}

		$SQL2 = $odb -> prepare("SELECT * FROM `giftcards` WHERE `code` = :code");
		$SQL2-> execute(array(':code' => $code));
		$check = $SQL2 -> fetch();
		$checkcode =$check['code'];

		if (!($checkcode == $code)){
					echo ' <div class="alert alert-outline-danger alert-dismissible animated flipInX"><strong>Sorry this Code is not in our system</div>';
die();
		}
	
	// Update Status of GC
	$SQLUpdate = $odb -> prepare("UPDATE `giftcards` SET `claimedBy` = :userID, `dateClaimed` = UNIX_TIMESTAMP() WHERE `code` = :code");
	$SQLUpdate -> execute(array(':userID' => $userID, ':code' => $code));
	
	// Update User Account with new Plan
	$SQL = $odb -> prepare("SELECT `planID` FROM `giftcards` WHERE `code` = :code");
	$SQL -> execute(array(':code' => $code));
	$planID = $SQL -> fetchColumn(0);
	
	$SQL = $odb -> prepare("SELECT * FROM `plans` WHERE `ID` = :id");
	$SQL -> execute(array(':id' => $planID));
	$plan = $SQL -> fetch();
	
	$planName = $plan['name'];
	$unit = $plan['unit'];
	$length = $plan['length'];
	
	$newExpire = strtotime("+{$length} {$unit}");
	$updateSQL = $odb -> prepare("UPDATE `users` SET `membership` = :plan, `expire` = :expire WHERE `ID` = :id");
	$updateSQL -> execute(array(':plan' => (int)$planID, ':expire' => $newExpire, ':id' => (int)$userID));
  
  echo ' <div class="alert alert-outline-danger alert-dismissible animated flipInX"><strong>Gift code has been redeem. Plan ('.$planName.') has been added to your account!</div>';
	
?>