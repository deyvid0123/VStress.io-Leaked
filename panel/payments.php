<?php 

    // By Complex
	
session_start();
$page = "Payments";
include 'header.php';
    $runningrip = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
	$slotsx = $odb->query("SELECT COUNT(*) FROM `api` WHERE `slots`")->fetchColumn(0);
	$load    = round($runningrip / $slotsx * 100, 2);	
	
		
?>


    <div class="container-fluid">
  
  
  <div class="row animated flash">
         <div class="col-12 col-lg-6 col-xl-3">
           <div class="card">
             <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body">
                      <span class="text">Pending</span>
					  <?php				
			$SQL = $odb -> prepare("SELECT COUNT(*) FROM `payments` WHERE `username` = :username AND `status` = '0'");
			$SQL -> execute(array(':username' => $_SESSION['username']));
			$count = $SQL -> fetchColumn(0);
			?>
                       
                      <h3 class="text"><?= $count; ?></h3>
                    </div>
                    <div class="w-icon">
                      <i class="icon-wallet text"></i>
                    </div>
                  </div>
                  <div id="widget-chart-4"></div>
                </div>
           </div>
         </div>
		 <div class="col-12 col-lg-6 col-xl-3">
           <div class="card">
             <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body">
                      <span class="text">Canceled</span>
				<?php				
			$SQL = $odb -> prepare("SELECT COUNT(*) FROM `payments` WHERE `username` = :username AND `status` = '1'");
			$SQL -> execute(array(':username' => $_SESSION['username']));
			$count = $SQL -> fetchColumn(0);
			?>
                        
                       
                      <h3 class="text"><?= $count; ?></h3>
                    </div>
                    <div class="w-icon">
                      <i class="zmdi zmdi-swap-vertical-circle text"></i>
                    </div>
                  </div>
                  <div id="widget-chart-4"></div>
                </div>
           </div>
         </div>
		 
		  <div class="col-12 col-lg-6 col-xl-3">
           <div class="card">
             <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body">
                      <span class="text">Completed</span>
				<?php				
			$SQL = $odb -> prepare("SELECT COUNT(*) FROM `payments` WHERE `username` = :username AND `status` = '2'");
			$SQL -> execute(array(':username' => $_SESSION['username']));
			$count = $SQL -> fetchColumn(0);
			?>
                        
                       
                      <h3 class="text"><?= $count; ?></h3>
                    </div>
                    <div class="w-icon">
                      <i class="icon-basket-loaded text"></i>
                    </div>
                  </div>
                  <div id="widget-chart-4"></div>
                </div>
           </div>
         </div>
		 
		  <div class="col-12 col-lg-6 col-xl-3">
           <div class="card">
             <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body">
                      <span class="text">ALL</span>
			 <?php				
			$SQL = $odb -> prepare("SELECT COUNT(*) FROM `payments` WHERE `username` = :username");
			$SQL -> execute(array(':username' => $_SESSION['username']));
			$count = $SQL -> fetchColumn(0);
			?>      
                       
                      <h3 class="text"><?= $count; ?></h3>
                    </div>
                    <div class="w-icon">
                      <i class="icon-basket-loaded text"></i>
                    </div>
                  </div>
                  <div id="widget-chart-4"></div>
                </div>
           </div>
         </div>
  
  
  
       
  
      
        
    </div>
	 <div class="card animated tada">
                
                
				
	
        <div class="table-responsive">

            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th style="width: 100px;">ID</th>
						  <th>Username</th>
                        <th>Status</th>
                        <th class="d-none d-sm-table-cell">Submitted</th>
                        
                        <th class="d-none d-sm-table-cell">Plan</th>
                        <th class="d-none d-sm-table-cell">Value</th>
                    </tr>
                </thead>
                <tbody>
                   
                   <?php
$newssql = $odb -> query("SELECT * FROM `payments` WHERE `username` = '" . $_SESSION['username'] . "'ORDER BY `id` DESC LIMIT 50");
while($row = $newssql ->fetch(PDO::FETCH_ASSOC)){
	if($row['status'] == '0') {
		$statusPayment = '<span class="badge badge-warning">Pending</span>';
	} elseif($row['status'] == '1') {
		$statusPayment = '<span class="badge badge-danger">Canceled</span>';
	} elseif($row['status'] == '2') {
		$statusPayment = '<span class="badge badge-success">Completed!</span>';
	}
	
	$Planinfo = $odb -> query("SELECT `name`,`price` FROM `plans` WHERE `id` = '" . $row['planID'] . "'");
$rowPlan = $Planinfo ->fetch(PDO::FETCH_ASSOC);
    ?>
	 <tr>
	 <?php	

	if($row['status'] == '0') {
		$statusPaymentt = '<a class="font-w600" href="invoice.php?id='. $row["planID"] . '&invoice= '. $row["invoiceID"] . '"><span class="badge badge-warning">#'. htmlentities($row["invoiceID"]) . ' - PENDING</span></a>';
	} elseif($row['status'] == '1') {
		$statusPaymentt = '<a href="#"><span class="badge badge-danger">#'. htmlentities($row["invoiceID"]) .' - CANCELLED</span></a>';
	} elseif($row['status'] == '2') {
		$statusPaymentt = '<a href="#"><span class="badge badge-success">#'. htmlentities($row["invoiceID"]) .' - COMPLETED</span></a>';
	}	 
			

			
		
			?>
												
	
                        <td>
						<?php echo	$statusPaymentt ?>
                        </td>
						<td class="d-none d-sm-table-cell">
                            <a ><span><?= $row['username']; ?></span></a>
                        </td>
                        <td>
                           <?= $statusPayment; ?>
                        </td>
                        <td class="d-none d-sm-table-cell">
						<span class="text-warning"><?= date("m/d/y - h:i:s", htmlentities($row['date'])); ?></span>
						</td>
                       
                        <td class="d-none d-sm-table-cell">
                            <?= $rowPlan['name']; ?>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <span class="text-success">$<?= $rowPlan['price']; ?></span>
                        </td>
                    </tr>
	<?php
}
?>
				   
                </tbody>
            </table>
            </div>
        </div>
		<br>

        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

 <!-- END Page Container -->
<?php include('footer.php'); ?>
    