<?php 
session_start();
$page = "Add Balance";
include 'header.php';


		
	
	if (isset($_POST["add"])) {
		
		$access = base64_encode("56ZUNtTui7sdzeUumVyV8KkagxEyLB34N8XtCtQxZnHZ:RMO3k7LmQuyrAzSnzz0WaDEarRqLkFi4");
		$bal = $_POST["amount"];
		$user = $_SESSION["username"];
		$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://merchant.atomicpay.io/api/v1/invoices",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"redirect\":\"https://netsource.pw/home.php\",\"order_id\":\"$user\",\"order_price\":\"$bal\",\"order_currency\":\"EUR\",
  \"order_description\":\"Add Balance\",\"transaction_speed\":\"medium\",\"notification_email\":\"support@netsource.pw\",\"notification_url\":\"https://netsource.pw/complexx/PaymentsReceiver1337.php\",
  \"redirect_url\":\"https://netsource.pw/home.php\"}",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic $access",
    "Content-Type: application/json",
    "cache-control: no-cache"
  ),
));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	$response2 = json_decode($response, true);
	$btcurl = $response2['invoice_url'];
	$btcid = $response2['invoice_id'];
	curl_close($curl);
	
	//insert in db table
			$SQLCheckRegister = $odb->prepare("INSERT INTO `AddFunds`(`ID`, `username`, `transaction_id`, `amount`, `status`, `transaction_date`) VALUES (NULL, :user, :btcid,:amount,'Pending',UNIX_TIMESTAMP(NOW()))");
        $SQLCheckRegister->execute(array(
            ":user" => $_SESSION["username"],
			":btcid" => $btcid,	
			":amount" => $bal
        ));
		
		//redirect o pay link
			  header("Location: $btcurl");
			
    }
	
		
	

		?>
	

    <div class="container-fluid">
<script src="https://shoppy.gg/api/embed.js"></script>
   <?php if (isset($error)) { echo $error; }elseif(isset($success)) { echo $success; } ?>
<div class="row">
<div class="col-12">
		  
		  				<div class="alert alert-outline-info alert-dismissible"animated flipInX>
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-info"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>Important:</strong> Wait 2 confirmations for your balance</span>
			</div></div>
			<br>
			</div>
	<div class="col-lg-5">
	<div class="card animated lightSpeedIn">
<div class="card-body">
<h3 class="card-title"> Add Credit (BTC ONLY!)</h3>

		
	<form method="POST" action="new.php?new">
	<div class="form-group">
                <input placeholder="Enter Amount €" name="amount"  class="form-control">
				</div>
              <div class="form-group m-b-0">
                <div class="col-xs-12 ">
                 <button  type="submit" id="add" name="add" class="btn btn-primary waves-effect waves-light btn-block">Buy</button>
                </div>
              </div>
		
		
		
		
			
     </form>

		</div>
		</div>
		</div>
				<div class="col-md-7">
  <div class="card animated lightSpeedIn">

<div class="card-body">
<div class="table-responsive">
                                <table class="table">
                                <thead>
                                   <tr>
                                   <th  style="font-size: 12px;">Amount</th>
                                   <th  style="font-size: 12px;">Trans ID</th>
                                   <th  style="font-size: 12px;">Status</th>
								   <th  style="font-size: 12px;">Date</th>
                                   
                                   </tr>
                                   </thead>
                                <tbody>
                                    <?php
									
                                        $SQLGetMessages = $odb -> prepare("SELECT * FROM `AddFunds` WHERE `username` = :id ORDER BY transaction_date LIMIT 8");
                                        $SQLGetMessages -> execute(array(':id' => $_SESSION['username']));
                                        while ($show = $SQLGetMessages -> fetch(PDO::FETCH_ASSOC)){
                                        $user = $usernamee;
                                        $amount = $show['amount'];
                                        $trans = $show['transaction_id'];
                                        $date =  $show['transaction_date'];  
										$statusPayment =  $show['status'];
										
										
	 
                                         echo '<tr>
                            
                                         <td><span >'.$amount.'$</span></td>
                                         <td><span > '.$trans.'</span></td>
										 <td>'.$statusPayment.'</td>
                                         <td>'.date("d-m-Y, h:i:s", $date).'</td>
                                         </tr>
                                         ';

                                        }
                                    ?>
                                </tbody>
                            </table>
							
							
							
							
							
							

</div>
</div>
</div>
</div>
		
		 </div>


   

<!-- END Main Container -->
        </div>
        <br><br><br>
<br>
<br>
<br>
<br>
<br>
	<br>
<br>
<br><br>



</div>
 <!-- END Page Container -->
<?php include('footer.php'); ?>
 
