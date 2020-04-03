<?php
   //By netsource.pw
session_start();
$page = "Dashboard";
include 'header.php';
if(isset($_GET['new'])){
	require('complexx/coinpayments.inc.php');
	$cps = new CoinPaymentsAPI();
	$cps->Setup('279790114C11F73713E734CDf39C60aFb3B79e98F18c8140a2De48a13C2e5c5d', '8c5826a7437c1f78dea76bd546dcda0e66e16703c5fb03c3eb56a8f4f2622a3e');
    $user = $_SESSION["username"];
    $bal = $_POST["amount"];
	$req = array(
		'amount' => $bal,
		'currency1' => 'USD',
		'currency2' => 'BTC',
		'buyer_email' => 'generic@netsource.pw
',
		'buyer_name' =>  $user,
		'item_name' => 'Add Funds',
		'address' => '', // leave blank send to follow your settings on the Coin Settings page
		'ipn_url' => 'https://netsource.pw
/client/complexx/addfunds.php',
	);
	// See https://www.coinpayments.net/apidoc-create-transaction for all of the available fields
			
	$result = $cps->CreateTransaction($req);
	if ($result['error'] == 'ok') {
		$le = php_sapi_name() == 'cli' ? "\n" : '<br />';
		//print 'Transaction created with ID: '.$result['result']['txn_id'].$le;
		//print 'Please send '.sprintf('%.08f', $result['result']['amount']).' BTC'.$le;
		//print 'To: '.$result['result']['address'];
		//print 'Status URL: '.$result['result']['status_url'].$le;
		
		$btcid = $result['result']['txn_id'];
		$btcamount = $result['result']['amount'];
		$address = $result['result']['address'];
		$link = $result['result']['status_url'];
		
			//insert in db table
			$SQLCheckRegister = $odb->prepare("INSERT INTO `AddFunds`(`ID`, `username`, `transaction_id`, `amount`, `status`, `transaction_date`) VALUES (NULL, :user, :btcid,:amount,'None',UNIX_TIMESTAMP(NOW()))");
        $SQLCheckRegister->execute(array(
            ":user" => $_SESSION["username"],
			":btcid" => $btcid,	
			":amount" => $bal
        ));
        
        ?>


	
    <div class="container-fluid">

<div class="row">
    <div class="col-12">
		  
		  				<div class="alert alert-outline-info alert-dismissible"animated flipInX>
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-info"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong></strong>You Must Send exact amount you requested!</span>
			</div></div>
			<br>
			</div>

	<div class="col-lg-12"><center>
	<div class="card">
	<div class="card-header" class="card-title"> Awaiting Your payment <i class="fad fa-circle-notch fa-spin"></i></div>

		<div class="card-body"> 
		<span style="font-size: 15px">Please send: </span>
		<input class="form-control" type="text" value="<?php echo $btcamount ?> BTC" readonly="" style="color:black;">
		<span style="font-size: 15px">To: </span>
		<input class="form-control" type="text" value="<?php echo $address ?>" readonly="" style="color:black;">
			<span style="font-size: 15px">Status </span>
		<input class="form-control" type="text" value="<?php echo $link ?>" readonly="" style="color:black;">
		<span style="font-size: 15px">info: dont need keep on this page wating for the confirmations</span>
		<br>
			<i class="fad fa-spinner fa-spin fa-3x"></i>	
 </div>
		</div>
		</center></div>
		


    </div>
    <?php
    	} else {
	//	print 'Error: '.$result['error']."\n";
		$error = $result['error'];
		  echo ' 
		  <div class="col-12">
		  
		  				<div class="alert alert-outline-danger alert-dismissible"animated flipInX>
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong></strong>'. $error .'</span>
			</div></div>
			<br>
			</div>
		  
		  <br><b><br>
   <br><b><br>
    <br><b><br>
    <br><b><br>
	<br>
	<br><b><br>
	<br><br><b><br>
	<br><br><b><br>
	<br>';
	}
	}
?>

<!-- END Main Container -->
        </div>
  
  <br><b><br>
   <br><b><br>
    <br><b><br>
    <br><b><br>
	<br>
<?php include('footer.php'); ?>