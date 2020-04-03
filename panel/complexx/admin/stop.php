<?php
 

	session_start();
	require '../../complex/configuration.php';
    require '../../complex/init.php';

	$stop      = intval($_GET['id']);
	$SQLSelect = $odb->query("SELECT * FROM `logs` WHERE `id` = '$stop'");

	 while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
        $host   = $show['ip'];
        $port   = $show['port'];
        $time   = $show['time'];
        $method = $show['method'];
        $handler = $show['handler'];
    }
	$SQL      = $odb->query("UPDATE `logs` SET `stopped` = 1 WHERE `id` = '$stop'");
	$handlers = explode(",", $handler);
	foreach ($handlers as $handler)
	{
        $SQLSelectAPI = $odb->query("SELECT `api` FROM `api` WHERE `name` = '$handler' ORDER BY `id` DESC");
        while ($show = $SQLSelectAPI->fetch(PDO::FETCH_ASSOC)) {
            $arrayFind    = array(
                '[host]',
                '[port]',
                '[time]'
            );
            $arrayReplace = array(
                $host,
                $port,
                $time
            );
            $APILink      = $show['api'];
            $APILink      = str_replace($arrayFind, $arrayReplace, $APILink);
            $stopcommand  = "&method=STOP";
            $stopapi      = $APILink . $stopcommand;
            $ch           = curl_init();
            curl_setopt($ch, CURLOPT_URL, $stopapi);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_exec($ch);
            curl_close($ch);
        }
  
	}
	echo ' <div class="alert alert-outline-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-check"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>SUCCESS!</strong> Attack <font class="text-danger">'.$host.'</font> Has Been Stopped!</span>
			</div></div>';
	
?>