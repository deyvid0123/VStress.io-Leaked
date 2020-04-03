<?php
	if (!isset($_SERVER['HTTP_REFERER'])){
		die();
	}
	
	session_start();
	 require_once '../complex/configuration.php';
	 require_once '../complex/functions.php';
	
	if (!empty($maintaince)){
		die();
	}
                             
									$checkOnlines = $odb->query("SELECT * FROM `users`");
									$onlineMembers = '0';
									while($row = $checkOnlines->fetch(PDO::FETCH_BOTH)){
										$diffOnline = time() - $row['activity'];
										$countOnline = $odb->prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username  AND {$diffOnline} < 30");
										$countOnline->execute(array(':username' => $row['username']));
										$onlineCount = $countOnline->fetchColumn(0);
										if($onlineCount == "1")  { 
										$onlineMembers = $onlineMembers + 1;
										}
									}
			
										echo $onlineMembers;
	?>