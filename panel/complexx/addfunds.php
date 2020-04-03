<?php    
	     ob_start();
	
	     require_once '../complex/configuration.php';
	     require_once '../complex/init.php';
    // Fill these in with the information from your CoinPayments.net account.
    $cp_merchant_id = '018cad5f4cc2774e78a89e069e659fcb';
    $cp_ipn_secret = 'hsjchsjdcfd885df4c4djdshdbnxfc5g54fg45';
    $cp_debug_email = 'frexy141522@gmail.com';

    //These would normally be loaded from your database, the most common way is to pass the Order ID through the 'custom' POST field.

    function errorAndDie($error_msg) {
        global $cp_debug_email;
        if (!empty($cp_debug_email)) {
            $report = 'Error: '.$error_msg."\n\n";
            $report .= "POST Data\n\n";
            foreach ($_POST as $k => $v) {
                $report .= "|$k| = |$v|\n";
            }
            mail($cp_debug_email, 'CoinPayments IPN Error', $report);
        }
        die('IPN Error: '.$error_msg);
    }

    if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
        errorAndDie('IPN Mode is not HMAC');
    }

    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
        errorAndDie('No HMAC signature sent.');
    }

    $request = file_get_contents('php://input');
    if ($request === FALSE || empty($request)) {
        errorAndDie('Error reading POST data');
    }

    if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
        errorAndDie('No or incorrect Merchant ID passed');
    }

    $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
    if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
    //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
        errorAndDie('HMAC signature does not match');
    }
    
    // HMAC Signature verified at this point, load some variables.

    $webhookid = $_POST['txn_id'];
    $item_name = $_POST['item_name'];
	$webhookuser = $_POST['buyer_name'];
    $item_number = $_POST['item_number'];
    $amount1 = floatval($_POST['amount1']);
    $amount2 = floatval($_POST['amount2']);
    $currency1 = $_POST['currency1'];
    $currency2 = $_POST['currency2'];
    $status = intval($_POST['status']);
    $status_text = $_POST['status_text'];

    //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point
	
	$SQL2 = $odb->prepare("SELECT * FROM `AddFunds` WHERE `transaction_id` = :btcid");
			$SQL2->execute(array(
			":btcid" => $webhookid
			));
			$rowstats = $SQL2->fetch(); 
			$amount = $rowstats["amount"];
   
    
    // Check amount against order total
    if ($amount1 < $amount) {
        errorAndDie('Amount is less than order total!');
    }
  
    if ($status >= 100 || $status == 2) {
        
//insert user balance--
            //found user actual balance
		    $SQL2 =	$odb->prepare("SELECT * FROM `users` WHERE `username` = :name");
			$SQL2->execute(array(
			":name" => $webhookuser
			));
			$rowbalance = $SQL2->fetch(); 
			$balance = $rowbalance["balance"];
			$total = $balance + $amount;
					$SQLUpdatesec2 = $odb -> prepare("UPDATE `users` SET `balance` = :bal WHERE `username` = :user");
					$SQLUpdatesec2 -> execute(array(':user' => $webhookuser, ':bal' => $total));
	
//update the invoice
				  $SQLUpdate = $odb->prepare("UPDATE `AddFunds` SET `status`= 'Paid' WHERE `transaction_id` = :btc");
            $SQLUpdate->execute(array(
                ":btc" => $webhookid
            ));
		
    } else if ($status < 0) {
        //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
    }  else if ($status == 1) {
		//update the invoice
				  $SQLUpdate = $odb->prepare("UPDATE `AddFunds` SET `status`= 'Waiting for confirmations' WHERE `transaction_id` = :btc");
            $SQLUpdate->execute(array(
                ":btc" => $webhookid
            ));
        
    }else {
        //update the invoice
		    $SQLUpdate = $odb->prepare("UPDATE `AddFunds` SET `status`= 'Awaiting Funds' WHERE `transaction_id` = :btc");
            $SQLUpdate->execute(array(
                ":btc" => $webhookid
            ));
    }
    die('IPN OK');
	?>