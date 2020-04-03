<?php

       require '../complex/configuration.php';
       require '../complex/init.php';
       require_once '../tlf/Mobile_Detect.php';

                     $detect = new Mobile_Detect;
 
                     if($detect->isiOS()){
                        $platform = 'Iphone';
                     } elseif ($detect->isAndroidOS()){
                        $platform = 'Android';
                     } else {
                         $platform = 'PC';
                     }
					 
					 if($detect->isIE()){
                        $browsers = 'IE';
                     } elseif ($detect->isFirefox()){
                        $browsers = 'Firefox';
                     } elseif ($detect->isOpera()){
                        $browsers = 'Opera';
                     } else {
                        $browsers = 'Crime';
                     }
					 
               //Set IP (are you using cloudflare?)
	if ($cloudflare_set == 1){
		$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	else{
		$ip = $_SERVER["REMOTE_ADDR"];
	}
		  
		  $ipp = SHA1(md5($ip));
		  
		  if(!(filter_var($ip, FILTER_VALIDATE_IP))){
			echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Error in your ip! </span>
			</div></div>';
die();
         }

$type = $_GET['type'];


// activate the account
//if ($type && preg_match('/activate/i', $type) && !empty($_REQUEST['actcode'])) {
if (!empty($_REQUEST['actcode'])) {
    $activation = $odb->prepare("SELECT ID FROM users WHERE activation_code = :actcode");
    $activation->execute(array(':actcode' => $_REQUEST['actcode']));
    $uid = $activation->fetchColumn(0);
    if (empty($uid)) {
        // the details needs to be logged
        die(error('We encounter an error. Please try again later.'));
    } else {
        $updatesql = $odb->prepare("UPDATE users SET activation = ? WHERE ID = ? AND activation_code = ?");
        $updatesql->execute(array(1, $uid, $_REQUEST['actcode']));

        die(success('Your account hase been activated!!. Please continue to login <meta http-equiv="refresh" content="0; url=../home.php?page=Login" />'));
    }
}

if ($type == 'login') {
        session_start();
		if (!($_POST['answer'] == SHA1($_POST['question'] . $_SESSION['captcha']))) {
	
		echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Wrong captcha </span>
			</div></div>';
die();
    }
		
        $username = $_POST['user'];
        $password = $_POST['password'];
		$hideme = $_POST['hideme'];
        $shapassword = hash('sha512',$password);
        $errors = array();


		if ($user -> safeString($username) || $user -> safeString($password) || $user -> safeString($shapassword)){
								echo ' <div class="alert alert-outline-danger alert-dismissible animated flipInX"><strong>ERROR:</strong>Unsafe characters were set </div>';
die();
	}
        if (empty($username) || empty($password))
        {
			
echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Please fill in all fields. </span>
			</div></div>';
die();

        }
        if (!ctype_alnum($username) || strlen($username) < 4 || strlen($username) > 15)
        {
			
echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Username Must Be  Alphanumberic And 4-15 characters in length. </span>
			</div></div>';
die();
          
        }
        

        $checkprior = $odb->prepare("SELECT COUNT(*) FROM logins_failed WHERE ip = ? AND `date` > ?");
        $checkprior->execute(array($ipp, time() - 900));
        if($checkprior->fetchColumn() > 5){
            $ripx = "Complex Is The Best";
			
echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> You have attempted to login an excessive amount of times, Try again in 15min. </span>
			</div></div>';
die();
        }

		
		  
	   $checkveri = $odb -> prepare("SELECT `activation` FROM `users` WHERE `username` = :username");
		$checkveri -> execute(array(':username' => $username));
		$veruLogin = $checkveri -> fetchColumn(0);
		if (!($veruLogin == 1))
        {
		

echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Active your account to access to to the site! </span>
			</div></div>';
die();
        }
		
		
        if (empty($errors))
        {
            if(empty($ripx)){

            $SQLCheckLogin = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username AND `password` = :password");
            $SQLCheckLogin -> execute(array(':username' => $username, ':password' => SHA1(md5($password))));
            $countLogin = $SQLCheckLogin -> fetchColumn(0);
            if ($countLogin == 1)
            {
                $SQLGetInfo = $odb -> prepare("SELECT `username`, `ID`, `status` FROM `users` WHERE `username` = :username AND `password` = :password");
                $SQLGetInfo -> execute(array(':username' => $username, ':password' => SHA1(md5($password))));
                $userInfo = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);
                if ($userInfo['status'] == "0")
                {
                    $_SESSION['username'] = $userInfo['username'];
                    $_SESSION['ID'] = $userInfo['ID'];


      $SQL = $odb -> prepare("UPDATE `users` SET `Active` = :rank WHERE `username` = :id");
      $SQL -> execute(array(':rank' => "1", ':id' => $username));

$updatesql = $odb->prepare("UPDATE users SET lastip = ? WHERE username = ?");
$updatesql->execute(array($ipp, $username));

$updatesql = $odb->prepare("UPDATE users SET lastlogin = UNIX_TIMESTAMP() WHERE username = ?");
$updatesql->execute(array( $username));

$updatesql = $odb->prepare("UPDATE users SET active = ? WHERE username = ?");
$updatesql->execute(array(1, $username));
$ipcountry = @json_decode(@file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip))->{'geoplugin_countryName'};
    if (empty($ipcountry)) {
        $ipcountry = 'Cannot Be Found';
    }

 $ipcountry = @json_decode(@file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip))->{'geoplugin_countryName'};
    if (empty($ipcountry)) {
        $ipcountry = 'Cannot Be Found';
    }

    $city = @json_decode(@file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip))->{'geoplugin_city'};
    if (empty($city)) {
        $city = 'Cannot Be Found';
    }
    $hostname = gethostbyaddr($ip);
$ipp = SHA1(md5($ip));

$update = $odb->prepare("UPDATE users SET lastact = ? WHERE username = ?");
$update->execute(array(time(), $username));

         $SQLGetLoginInfo = $odb -> prepare("SELECT * FROM `login_history` ORDER BY `id` DESC;");
		 $SQLGetLoginInfo -> execute(array(':username' => $username));
		 $historyInfo = $SQLGetLoginInfo -> fetch(PDO::FETCH_ASSOC);	
	     $GetData = $odb -> prepare("SELECT * FROM `login_history` WHERE `username` = :username ORDER BY `id` DESC;");
	     $GetData -> execute(array(':username' => $username));
		 $hisInfo = $GetData -> fetch(PDO::FETCH_ASSOC);
				
		  $historyInfo['id'] = $historyInfo['id'] - 5;
          if($hisInfo['id'] < $historyInfo['id']) {
			$SQL = $odb -> prepare("INSERT INTO `login_history`(`id`, `username`, `password`, `ip`, `date`, `status`, `platform`, `method`, `country`, `hide`) VALUES (NULL,:username,:password,:ip,UNIX_TIMESTAMP(NOW()),'success',:platform,'System_Login',:country,:hideme)");
			$SQL -> execute(array(":username" => $username, ":password" => 'XX', ":ip" => $ipp, ":platform" => $platform, ":country" => $browsers, ":hideme" => $hideme));
           }
		
                        $SQL = $odb -> prepare('INSERT INTO `loginlogss` VALUES(NULL, ?, ?, UNIX_TIMESTAMP(), ?, ?, ?, ?, ?)');
                        $SQL -> execute(array($username, $ipp, "Successful", $ipcountry, $city, $hostname, $_SERVER['HTTP_USER_AGENT']));
						
echo ' 
									<div class="alert alert-outline-success alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-check"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>Login Successful</strong> </span>
			</div><meta http-equiv="refresh" content="2;URL=home.php"></div>';
die();
 


                }
                else
                {
$ban = $odb -> query("SELECT `reason` FROM `bans` WHERE `username` = '$username'") -> fetchColumn(0);

echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> You are banned. Reason: '.htmlspecialchars($ban). ' </span>
			</div></div>';
die();
                    
                }
            }
            else
            {
                
$userfailed = preg_replace('@[^0-9a-z\.\-\:\_\,]+@i', '', $username);
$userfailed = strtolower ( $userfailed );


 $ipcountry = @json_decode(@file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip))->{'geoplugin_countryName'};
    if (empty($ipcountry)) {
        $ipcountry = 'Cannot Be Found';
    }

 $ipcountry = @json_decode(@file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip))->{'geoplugin_countryName'};
    if (empty($ipcountry)) {
        $ipcountry = 'Cannot Be Found';
    }

    $city = @json_decode(@file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip))->{'geoplugin_city'};
    if (empty($city)) {
        $city = 'Cannot Be Found';
    }
    $hostname = gethostbyaddr($ip);
    $ipp = SHA1(md5($ip));
                        $SQL = $odb -> prepare('INSERT INTO `loginlogss` VALUES(NULL, ?, ?, UNIX_TIMESTAMP(), ?, ?, ?, ?)');
                        $SQL -> execute(array($username, $ipp, "Failed", $ipcountry, $city, $hostname));


                        $SQL = $odb -> prepare('INSERT INTO `logins_failed` VALUES(NULL, ?, ?, UNIX_TIMESTAMP())');
                        $SQL -> execute(array($userfailed, $ipp));
                        $t = $odb->prepare("SELECT COUNT(*) FROM logins_failed WHERE ip = ? AND `date` > ?");
                        $t->execute(array($ipp, time() - 300));
                        $checking = $t->fetchColumn();

 if ($checking == 4) {
	 
          $checkingg = ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> This is your last try! </span>
			</div></div>';
          } else {
          $checkingg = ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Login Failed '.$checking.'/5 </span>
			</div></div>';
          
          
		 
          }

                echo ''.$checkingg.'';
                die;
                    
                            
            }
        }
        }
        else
        {
            echo '>';
            foreach($errors as $error)
            {
                echo '-'.$error.'<br />';
            }
            echo '</center></div>';
        }
    }



if ($type == 'register') {
    session_start();
if (!($_POST['answer'] == SHA1($_POST['question'] . $_SESSION['captcha']))) {

		echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Wrong captcha </span>
			</div></div>';
die();
    }
  

    $username = $_POST['username'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];
    $email = $_POST['email'];


if($rpassword != $password){
	
			echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Passwords Do No Match </span>
			</div></div>';
die();
}
 if (empty($username) || empty($password) || empty($rpassword) || empty($email))
    {
	
	 
	 			echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Fill In All Fields </span>
			</div></div>';
die();
    }
    else
    {
    $checkUsername = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username");
    $checkUsername -> execute(array(':username' => $username));
    $countUsername = $checkUsername -> fetchColumn(0);
    $checkEmail = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `email` = :email");
        $checkEmail -> execute(array(':email' => $email));
        $countEmail = $checkEmail -> fetchColumn(0);
        if ($countEmail > 0)
        {
			
				 			echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Email Already In Use </span>
			</div></div>';
die();
        }
        else
    {
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       
		
						 			echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Email is not a valid </span>
			</div></div>';
die();
    }
       else
    {
        if (!ctype_alnum($username) || strlen($username) < 4 || strlen($username) > 15)
        {

		
								 			echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Please choose a username between 4-15 characters. </span>
			</div></div>';
die();
        }
        else
        {
            if (!($countUsername == 0))
            {
												 			echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR:</strong> Username Taken. </span>
			</div></div>';
die();
            }
            else
            {
				$actcode    = SHA1(md5($username));
				$ipp = SHA1(md5($ip));
			$insertUser = $odb -> prepare("INSERT INTO `users` VALUES(NULL, :username, :password, :email, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, :actcode, 1, 0)");
			$insertUser -> execute(array(':username' => $username, ':password' => SHA1(md5($password)), ':email' => $email, ':actcode' => $actcode));
			
			 $SQLinsert = $odb -> prepare("INSERT INTO `notifications` VALUES(NULL, ?, ?, ?, UNIX_TIMESTAMP())");
			$SQLinsert -> execute(array('Thanks for joining vStress.io', $username, 0));
				
				// get the new user id
                    $getuid = $odb->prepare("SELECT ID FROM users WHERE username = :username");
                    $getuid->execute(array(':username' => $username));
                    $uid = $getuid->fetchColumn(0);

                    // provide the free credits
                    $bonus = $odb->prepare('INSERT INTO balance SET User_ID = ?, concurrent=1, mbt=200');
                    $bonus->execute(array($uid));
					
				
				
					
					/*// send activation email to the registered user
                    $to      = $email;
                    $subject = 'Welcome to StressLayer! Activate your account.';
                    
                    $message = "\r\n" . 'Thank you for subscribing with us!' . "\r\n";
                    $message .= "\r\n" . 'Please click the below link to activate your account. and access to the best stress testing site!' . "\r\n";
                    $message .= "\r\n" . 'https://stresslayer.co/v2/Secured/login.php?type=activate&actcode=' . $actcode . "\r\n";
                    $message .= "\r\n" . 'Team' . "\r\n";
                    $message .= "\r\n" . 'StressLayer.co' . "\r\n";
					$message .= "\r\n" . 'Dont answer this message!' . "\r\n";
                    //echo $message;

                    // To send HTML mail, the Content-type header must be set
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] .= 'Content-type: text/html; charset=iso-8859-1';

                    // Additional headers
                    $headers[] .= 'To: ' . $email;
                    $headers[] .= 'From: StressLayer<support@stresslayer.co>';

                    /*$headers = array(
                    'From' => 'admin@booter.cloud',
                    'Reply-To' => 'admin@booter.cloud',
                    'X-Mailer' => 'PHP/' . phpversion()
                    );*/

                    //mail($to, $subject, $message, $headers);
                   // mail($to, $subject, $message, implode("\r\n", $headers));
				   
				   $apiurl = 'http://key.dranksecurity.xyz/activation/active.php?active&username='. $username .'&email='. $email;
			
           # api with curl
                                    //        $ch = curl_init();
                                      //      curl_setopt($ch, CURLOPT_URL, $apiurl);
                                        //    curl_setopt($ch, CURLOPT_HEADER, false);
                                          //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                        //    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
                                         //   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                                         //   $data = curl_exec($ch);
                                         //   curl_close($ch);


					
					
				
$ipcountry = @json_decode(@file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip))->{'geoplugin_city'};
    if (empty($ipcountry)) {
        $ipcountry = 'XX';
    }
$SQL = $odb -> prepare('INSERT INTO `registerlogs` VALUES(NULL, ?, ?, UNIX_TIMESTAMP(), ?)');
$SQL -> execute(array($username, $ipp, $ipcountry));

												 			echo ' 
									<div class="alert alert-outline-success alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-check"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>Registered Successfully!!</strong> </span>
			</div><meta http-equiv="refresh" content="3;url=login.php"></div>';
die();
}
}
}
}
}
}
?>