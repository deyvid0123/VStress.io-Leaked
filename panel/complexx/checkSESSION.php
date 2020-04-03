<?php
if (!isset($_SERVER['HTTP_REFERER'])){
	die();
}
	
    // By Complex
  
	 session_start();
	require '../complex/configuration.php';
    require '../complex/init.php';


		$getControlPanel = $odb->query("SELECT * FROM `remotecontrol` WHERE `userid` = '" . $_SESSION['ID'] . "' AND `info` NOT LIKE '%\"done\":1%'");
		while($row = $getControlPanel->fetch(PDO::FETCH_BOTH)){
			$info = json_decode($row['info'],true);
			$info["done"] = 1;
			
			if($info["action"] == "kick") {
				$info = json_encode($info, true);
				$updateSQL = $odb->prepare("UPDATE `remotecontrol` SET `info` = :info WHERE `id` = :id");
				$updateSQL->execute(array(':info' => $info, ':id' => $row['id']));
			
				foreach ($_SESSION as $k => $v) {
					$_SESSION[$k] = null;
					unset($_SESSION[$k]);
				}
				session_destroy();
				session_unset();
				die("KICKED_DONE");
			} elseif($info["action"] == "private_message") {
				$die = "PRIVATEMESSAGE_" . $info["message"];
				
				$info = json_encode($info, true);
				$updateSQL = $odb->prepare("UPDATE `remotecontrol` SET `info` = :info WHERE `id` = :id");
				$updateSQL->execute(array(':info' => $info, ':id' => $row['id']));
				
				die($die);
			} elseif($info["action"] == "receive_money") {
				$die = "RECEIVEMONEY_" . $info["money"] . "_" . $info["message"];
				
				$getUserAccbalance = $odb->query("SELECT `balance` FROM `users` WHERE `ID` = '" . $_SESSION['ID'] . "'");
				$accbalance = $getUserAccbalance -> fetchColumn(0);
				
				$accbalance += $info["money"];
				$updateSQL = $odb->prepare("UPDATE `users` SET `balance` = :balance WHERE `ID` = :id");
				$updateSQL->execute(array(':balance' => $accbalance, ':id' => $_SESSION['ID']));
				
				$info = json_encode($info, true);
				$updateSQL = $odb->prepare("UPDATE `remotecontrol` SET `info` = :info WHERE `id` = :id");
				$updateSQL->execute(array(':info' => $info, ':id' => $row['id']));
				
				die($die);
			}
		}
		
	$getControlPanel = $odb->query("SELECT * FROM `remotecontrol` WHERE `info` LIKE '%\"to\":\"" . $_SESSION['username'] . "\"%' AND `info` NOT LIKE '%\"done\":1%'");
	while($row = $getControlPanel->fetch(PDO::FETCH_BOTH)){	
	$info = json_decode($row['info'], true);
	if($info["time"] < time()) {
		$info["done"] = 1;
		
		$transferid = $info["transfer_id"];
		$message = htmlentities($info["message"]);
		$money = $info["money"];
		if(strpos($info["message"], "(D)") !== false) { $message = str_replace("(D)", "😁", $message); }
		if(strpos($info["message"], "(P)") !== false) { $message = str_replace("(P)", "😄", $message); }
		if(strpos($info["message"], "(L)") !== false) { $message = str_replace("(L)", "😍", $message); }
		if(strpos($info["message"], "(K)") !== false) { $message = str_replace("(K)", "😘", $message); }
		if(strpos($info["message"], "(M)") !== false) { $message = str_replace("(M)", "🤑", $message); }
		if(strpos($info["message"], "(W)") !== false) { $message = str_replace("(W)", "🤑", $message); }
		
		if(strpos($info["message"], "(newLine)") !== false) { $message = str_replace("(newLine)", "</br>", $message); }	
		$popup = '<div class="modal fade show" id="transferMoney' . $info["transfer_id"] . '" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: block;">
			<div class="modal-dialog modal-dialog-popout animated infinite pulse" role="document">
				  <div class="modal-content" style="
				box-shadow: 0px 2px #7ba94d;
			">
					 <div class="block block-themed block-transparent mb-0">
						<div class="block-header bg-primary-dark" style="
						   background: linear-gradient(135deg,#9ccc65 0,#5f8c38 100%)!important;
						   box-shadow: 0 -5px 25px -5px #9ccc65, 0 1px 5px 0 #141617, 0 0 0 0 #14171a;
						   ">
						   <h3 class="block-title text-center"><i class="fa fa-money"></i> You have received money from ' . $info["from"] . ' <i class="fa fa-money"></i></h3>
						</div>
						<div class="block-content text-center" style="background-color: #1e2125;text-shadow: 0px 3px 7px #000000;border-left: 1px #96c661 solid;border-right: 1px #618e3a solid;"><span style="border-bottom: thin dotted #99c963">You just got <bb class="text-success">$' . $info["money"] . '</bb> from user ' . $info["from"] . '</span><br>
						<span>' . $message . '</span></br>
						<span>hope you use them wisely, enjoy :)</span><br><br>
							
							<div class="col-md-12 text-center">
							  <button type="submit" class="btn btn-outline-success" style="margin-bottom: -2px; border-radius: 5px 5px 0px 0px" onclick="document.getElementById(\'transferMoney' . $info["transfer_id"] . '\').style.display = \'none\';"><i class="fa fa-check"></i> Ok, I got it!</button>
						   </div>				
						</div>
					 </div>
				  </div>
			   </div>
		</div>';
		$info = json_encode($info, true);
		$updateSQL = $odb->prepare("UPDATE `remotecontrol` SET `info` = :info WHERE `info` LIKE '%\"transfer_id\":\"" . $transferid . "\"%'");
		$updateSQL->execute(array(':info' => $info));

		$SQLUpdate = $odb -> prepare("UPDATE `users` SET `acc-balance` = `balance` + :moneysend WHERE `username` = :username");
		$SQLUpdate -> execute(array(':moneysend' => $money, ':username' => $_SESSION['username']));
		
		die($popup);
		}
	}

		if (!isset($_SESSION['username']) || !isset($_SESSION['ID']))
		{
			die('SESSION_STATUS_OFF');
		} else {
			$username = htmlentities($_SESSION['username']);
			
			$update = $odb->prepare("UPDATE `users` SET `activity` = :time WHERE `username` = :username");
			$update->execute(array(':time' => time(), ':username' => $username));

			die('SESSION_STATUS_ON');
		}

?>