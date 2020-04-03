<?php
if (($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) {exit("NOT ALLOWED");}

	if (!isset($_SERVER['HTTP_REFERER'])){
		die;
	}
	
	ob_start();
	require_once '../complex/configuration.php';
	require_once '../complex/init.php';


	if (!($user -> LoggedIn()) || !($user -> notBanned($odb))){
		die();
	}
   
	$username = $_GET['username'];

	if(empty($username)){
		die();
	}
	
	if ($user -> safeString($username)){
        $error = error('What are you trying?');  
    }

	$makeread = $odb -> prepare("UPDATE `notifications` SET `read` = 1 WHERE username=:username");
    $makeread -> execute(array(':username' => $_SESSION['username']));

?>