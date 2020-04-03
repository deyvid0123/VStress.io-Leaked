

<?php 
  ob_start();
	
	    include 'header.php';
		require_once 'complexx/block_io.php';
		 

if(isset($_GET['start'])){
$balancer = $_GET['balance'];
//$username = $_SESSION['username'];
$apiKey = "dec5-ce46-fd3f-ca6f";
$version = 2;
$pin = "anthony141522";
$block_io = new BlockIo($apiKey, $pin, $version);
$result = $block_io->get_new_address(array());
$address = $result->data->address;

$apiurl = 'https://blockchain.info/tobtc?currency=USD&value=' . $balancer ;

 $ch = curl_init();
                                           curl_setopt($ch, CURLOPT_URL, $apiurl);
                                          curl_setopt($ch, CURLOPT_HEADER, false);
                                          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
                                          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                                          $data = curl_exec($ch);
                                           curl_close($ch);
										   

$btcamount = $data;


}
?>

	<div class="clearfix"></div>
  <div class="content-wrapper">
    <div class="container-fluid">

<div class="row">

	<div class="col-lg-8"><center>
	<div class="card">
<div class="card-body">
<h3 style="color: white;" class="card-title"> Waiting</h3>
</div>
		<div class="card-body">
<span style="font-size: 15px">Please send <?php echo $btcamount ?><b></b> bitcoins <br><br><br>to <?php echo $address ?><br><b><br></b></span>
 </div>
		</div>
		</center></div>
		


    </div>

<!-- END Main Container -->
        </div>
    </main>
	

</div>
<?php include('footer.php'); ?>