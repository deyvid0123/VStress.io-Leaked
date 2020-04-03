<?php
	     ob_start();
	
	     require_once '../complex/configuration.php';
	     require_once '../complex/init.php';

$body = file_get_contents("php://input");
$webhook = json_decode($body, true);

$webhookid = $webhook['invoice_id'];
$webhookuser = $webhook['order_id'];
$webhookstatus = $webhook['status'];

if($webhookstatus == "confirmed")

{
			$SQL2 = $odb->prepare("SELECT * FROM `AddFunds` WHERE `transaction_id` = :btcid");
			$SQL2->execute(array(
			":btcid" => $webhookid
			));
			$rowstats = $SQL2->fetch(); 
			$amount = $rowstats["amount"];

			//insert user balance--
					$SQLUpdatesec2 = $odb -> prepare("UPDATE `users` SET `balance` = :bal WHERE `username` = :user");
					$SQLUpdatesec2 -> execute(array(':user' => $webhookuser, ':bal' => $amount));
	
				//update the invoice
				  $SQLUpdate = $odb->prepare("UPDATE `AddFunds` SET `status`= 'Paid' WHERE `transaction_id` = :btc");
            $SQLUpdate->execute(array(
                ":btc" => $webhookid
            ));
			
	//here all have to be added--
	}
?>