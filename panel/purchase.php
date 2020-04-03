<?php 

   //By Complex
	
session_start();
$page = "Purchase";
include 'header.php';
    $runningrip = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
	$slotsx = $odb->query("SELECT COUNT(*) FROM `api` WHERE `slots`")->fetchColumn(0);
	$load    = round($runningrip / $slotsx * 100, 2);	
	


		
?>

    <div class="container-fluid">
	

   
   <div class="row animated flipInX">
  


			  <?php
												$SQLGetPlans = $odb -> query("SELECT * FROM `plans` WHERE `private` = 0 ORDER BY `ID` ASC");
												while ($getInfo = $SQLGetPlans -> fetch(PDO::FETCH_ASSOC))
												{
									$id = $getInfo['ID'];
									$name = $getInfo['name'];
									$price = $getInfo['price'];
									$length = $getInfo['length'];
									$unit = $getInfo['unit'];
									$concurrents = $getInfo['concurrents'];
									$mbt = $getInfo['mbt'];
									$network = $getInfo['vip'];
									$api = $getInfo['api'];
									$totalservers = $getInfo['totalservers'];
															
									if($network == "0")
									{
										$network = '<b class="text-primary"><i class="fa fa-feed text-warning"></i> Normal</b>';
										$colorx = 'bg-body-light';
										$l4= '<strong>Layer 4 </strong><span class="text-success font-w700"></i>  &#10004; </span>';
										$l7= '<strong>Layer 7 </strong><span class="text-success font-w700"></i> &#10004; </span>';
										$b4= '<strong>Bypass Layer 4 </strong><span class="text-danger font-w700"></i>  &#10006; </span>';
										$b7= '<strong>Bypass Layer 7 </strong><span class="text-danger font-w700"></i>  &#10006;</span>';
										
										
										
									}elseif($network == "1")
									{
										$network = '<span class="text-danger font-w700"></i> VIP <i class="si si-fire text-warning"></i></span>';
										$colorx = '';
										$l4= '<strong>Layer 4 </strong><span class="text-success font-w700"></i>  &#10004; </span>';
										$l7= '<strong>Layer 7 </strong><span class="text-success font-w700"></i> &#10004; </span>';
										$b4= '<strong>Bypass Layer 4 </strong><span class="text-success font-w700"></i>  &#10004; </span>';
										$b7= '<strong>Bypass Layer 7 </strong><span class="text-success font-w700"></i>  &#10004;</span>';
									}
									if($api == "0")
									{
										$api = '<span class="text-success font-w700"></i> No <i class="fa fa-bolt text-secondary"></i></span>';
									}elseif($api == "1")
									{
										$api = '<span class="text-primary font-w700"></i> Yes <i class="si si-fire text-success"></i></span>';
									}
									
					
										
echo '<div class="col-md-6 col-xl-3">
            <a class="card block-rounded text-center" href="invoice.php?id='. $id .'">
                <div class="card-header">
                    <h3 class="card-title">'.htmlspecialchars($name).'</h3>
                </div>
                <div class="card-content '.$colorx.'">
                    <div class="h1 font-w700 mb-10 text-white">€'.htmlentities($price).'</div>
                    <div class="h5 text-muted text-white-op">'.htmlentities($length).' '.htmlspecialchars($unit).'</div>
                </div>
                <div class="card-body">
                    <p><strong>Concurrents: </strong> <span>'.$concurrents.'</span></p>
                    <p><strong>Seconds: </strong> <span >'.htmlentities($mbt).'</span></p>
                    <p><strong>Network: </strong> '.$network.' </p>
                    <p><strong>ApiAccess: </strong> '.$api.'</p>
					<p><strong> </strong> '.$l4.' </p>
					<p><strong> </strong> '.$l7.' </p>
					<p><strong> </strong> '.$b4.' </p>
					<p><strong> </strong> '.$b7.' </p>
					<p><strong>TotalServers: </strong> <span >'.$totalservers.'</span></p>
                </div>
				
               <div class="card-body card-content-full">
                    <span class="btn btn-success btn-sm btn-block waves-effect waves-light m-1">
                        <i class="fa fa-arrow-up mr-5"></i> Order Now
                    </span>
                </div>
            </a>
        </div>';
                                                    
												
												?>
						         <div class="modal fade" id="modal-fadein<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="mewtoclet" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-slidedown" role="document">
        <div class="modal-content">
        <div class="card">
        <div class="card-header">
        <h3 class="card-title"><i class="fa fa-server"></i>  Plan Name: (<?php echo $name; ?>)</h3>
        <div class="card-options">
        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
        <i class="si si-close"></i>
        </button>
        </div>
        </div>
       <div class="card-body">
                  <div class="card-body">
     <div class="card-body">
	  <form method="post">
											<?php /// HERE NEEDS TO BE TERMS OF SERVICE FROM ADMIN PANEL! ?>
											
											<ul class="list-icons">
											  <li><i class="fa fa-chevron-right text-danger"></i> PLAN NAME : <a class="text-center font-w700 h5 text-info"><i class="fa fa-bolt"></i> <?php echo $name; ?></a></li>
											  <li><i class="fa fa-chevron-right text-danger"></i> PLAN PRICE : <a class="text-center text-success h5 font-w700"><?php echo $price; ?></a></td></li>
											   <li><i class="fa fa-chevron-right text-danger"></i> PRICE (Bitcoin) : <?php echo $priceOfYourItemBTC = file_get_contents("https://blockchain.info/tobtc?currency=USD&value=".$price); ?></li>
											  <li><i class="fa fa-chevron-right text-danger"></i> CONCURRENTS : <a class="text-center font-w700 text-info"><?php echo $concurrents; ?></a></li>
											  <li><i class="fa fa-chevron-right text-danger"></i> NETWORK : <?php echo $vip; ?></li>
										
												
												<div class="col-lg-12 m-t-30">
											  </div>
											</ul>
											
										
									  </div>							
									  <div class="modal-footer">

									  </div>
									  </form>

					</div>
            </div>
  			</div>

  						</div>
              <div class="modal-footer" style="background-color: #1E2125;" >
			  	  	<a href="buy_balance.php?id=<?php echo htmlspecialchars($id); ?>"><button name="balance" value="<?php echo $id; ?>" class="btn btn-outline btn-info"><i class="fa fa-dollar"></i> Balance</a>
	<a href="order.php?id=<?php echo htmlspecialchars($id); ?>"><button name="balance" value="<?php echo $id; ?>" class="btn btn-outline btn-warning"><i class="fa fa-bitcoin"></i> Bitcoin
	<a href="paypl.php?id=<?php echo htmlspecialchars($id); ?>"><button name="balance" value="<?php echo $id; ?>" class="btn btn-outline btn-info"><i class="fa fa-paypal"></i>PayPal


            </div>

  					</div>

  				</div>
								<?php
									} 
								?>
                      
                        <!-- end row -->


                    </div> 
        </div>
    </main>
</div>
 <!-- END Page Container -->
<?php include('footer.php'); ?>
      