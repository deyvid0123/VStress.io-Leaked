<?php

	ob_start();	
	require_once '../complex/configuration.php';
	require_once '../complex/init.php';

	if (!($user->LoggedIn()) || !($user->notBanned($odb))) {
		die();
	}
	
	 $runningrip = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
	 $slotsx = $odb->query("SELECT COUNT(*) FROM `api` WHERE `slots`")->fetchColumn(0);
	 $load    = round($runningrip / $slotsx * 100, 2);	
	 
	 echo $load;

	
?>