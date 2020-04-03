 <?php

    
    $pvgehdjvpcjk = "page";
    
    session_start();
    ${$pvgehdjvpcjk} = "Invoice";
    require_once "header.php";
    $qxfmilfxckq = "network";
    if (isset($_GET["id"])) {
        $id      = (int) $_GET["id"];
        $plansql = $odb->prepare("SELECT * FROM `plans` WHERE `ID` = :id");
        $plansql->execute(array(
            ":id" => $id
        ));
        $row = $plansql->fetch();
        if ($row === NULL) {
            die("Plan not found");
        }
    } else {
        header("Location: purchase.php");
        die("Invalid TIcket ID");
    }
    $GetInfo  = $odb->query("SELECT * FROM `users` WHERE `username`= '" . $_SESSION["username"] . "'");
    $userInfo = $GetInfo->fetch(PDO::FETCH_ASSOC);
    $SQL      = $odb->prepare("SELECT COUNT(*),`planID` FROM `payments` WHERE `invoiceID` = :invid AND `status` != '2'");
    $SQL->execute(array(
        ":invid" => htmlentities($_GET["invoice"])
    ));
    $rowPlani = $SQL->fetch(PDO::FETCH_ASSOC);
    if (empty($_GET["invoice"]) || $rowPlani["COUNT(*)"] == "0") {
        $gwfytj           = "fpqtnrr";
        $epneywwl         = "cypwrka";
        $cypwrka          = "GetPlanInfo";
        $rand             = rand(1111111, 9999999);
        ${$gwfytj}        = "planInfo";
        $SQLCheckRegister = $odb->prepare("INSERT INTO `payments`(`ID`, `IP`, `planID`, `invoiceID`, `status`, `username`, `date`) VALUES (NULL, :IP, :planID,:invoiceID,'0',:username,UNIX_TIMESTAMP(NOW()))");
        $SQLCheckRegister->execute(array(
            ":IP" => $user->realIP(),
            ":planID" => htmlentities($_GET["id"]),
            ":invoiceID" => $rand,
            ":username" => $_SESSION["username"]
        ));
		//insert into notification
		$SQLinsert = $odb -> prepare("INSERT INTO `notifications` VALUES(NULL, ?, ?, ?, UNIX_TIMESTAMP())");
			$SQLinsert -> execute(array('You have an unpaid invoice', $_SESSION["username"], 0));
			
        ${${$epneywwl}} = $odb->query("SELECT *,COUNT(*) FROM `plans` WHERE `id`= '" . htmlentities($_GET["id"]) . "'");
        $planInfo       = $GetPlanInfo->fetch(PDO::FETCH_ASSOC);
        echo "<meta http-equiv=\"refresh\" content=\"\x30\x3b\x75\x72\x6c\x3d\x69\x6e\x76\x6f\x69\x63\x65\x2e\x70\x68\x70?\x69\x64\x3d" . htmlentities($_GET["id"]) . "&invoice=" . $rand . "\">";
        if (${$fpqtnrr}["COUNT(*)"] == "0") {
            die("<script>window.location = \"purchase.php\"</script>");
        }
    } else {
        $rand        = htmlentities($_GET["invoice"]);
        $GetPlanInfo = $odb->query("SELECT *,COUNT(*) FROM `plans` WHERE `id`= '" . htmlentities($rowPlani["planID"]) . "'");
        $planInfo    = $GetPlanInfo->fetch(PDO::FETCH_ASSOC);
    }
    $network = $planInfo["vip"];
    if (${$qxfmilfxckq} == 0) {
        $network = "Normal User";
    } else {
        $network = "ViP User";
    }
    $api = $planInfo["api"];
    if ($api == 0) {
        $api = "No";
    } else {
        $api = "Yes";
    }
    $SQL = $odb->prepare("SELECT * FROM `users` WHERE `username` = :usuario");
    $SQL->execute(array(
        ":usuario" => $_SESSION["username"]
    ));
    $balancex = $SQL->fetch();
    $balance  = $balancex["balance"];
    if (isset($_POST["buy"])) {
        if (number_format((float) $balance, 2, ".", "") >= number_format((float) $row["price"], 2, ".", "")) {
            $getPlanInfo = $odb->prepare("SELECT `unit`,`length`,`name` FROM `plans` WHERE `ID` = :plan");
            $getPlanInfo->execute(array(
                ":plan" => $id
            ));
            $kbdsbtqdjg       = "bhjhxmqnxn";
            $plan             = $getPlanInfo->fetch(PDO::FETCH_ASSOC);
            $unit             = $plan["unit"];
            $bhjhxmqnxn       = "length";
            ${${$kbdsbtqdjg}} = $plan["length"];
            $name             = $plan["name"];
            $newExpire        = strtotime("+{$length} {$unit}");
            $updateSQL        = $odb->prepare("UPDATE `users` SET `expire` = :expire, `membership` = :plan WHERE `id` = :id");
            $updateSQL->execute(array(
                ":expire" => $newExpire,
                ":plan" => $id,
                ":id" => $_SESSION["ID"]
            ));
            $balance   = number_format((float) $balance, 2, ".", "") - number_format((float) $row["price"], 2, ".", "");
            $updateSQL = $odb->prepare("UPDATE `users` SET `balance` = :balance WHERE `id` = :id");
            $updateSQL->execute(array(
                ":balance" => $balance,
                ":id" => $_SESSION["ID"]
            ));
            $SQLUpdate = $odb->prepare("UPDATE `payments` SET `status`= '2' WHERE `username` = :username AND `invoiceID` = :invid");
            $SQLUpdate->execute(array(
                ":username" => $_SESSION["username"],
                ":invid" => htmlentities($_GET["invoice"])
            ));
			
			$SQLinsert = $odb -> prepare("INSERT INTO `notifications` VALUES(NULL, ?, ?, ?, UNIX_TIMESTAMP())");
			$SQLinsert -> execute(array('Thanks For buy', $_SESSION["username"], 0));
            echo "<script type=\"text/javascript\">";
            echo "setTimeout(function () { swal(\"success!\",\x22Y\x6f\x75\x20\x68\x61\x76\x65\x20\x6e\x6f\x77\x20\x74\x68e\x20\x70\x6c\x61\x6e\x2e\x22,\x22\x73\x75\x63\x63\x65\x73\x73\x22)\x3b";
            echo "}, 1000);</script>";
        } else {
            echo "<script type=\"text/javascript\">";
            echo "setTimeout(function () { swal(\"Error!\",\"You need more money to buy this plan.\",\"error\");";
            echo "}, 1000);</script>";
        }
    }
    if (isset($_POST["btc"])) {
        header("Location: order.php?id=" . htmlentities($_GET["id"]) . "");
        die();
    }
    if (isset($_POST["pp"])) {
        header("Location: paypalrip.php");
        die();
    }
	
		if (isset($_POST["cancel"])) {
		
		$SQLUpdate = $odb->prepare("UPDATE `payments` SET `status`= '1' WHERE `username` = :username AND `invoiceID` = :invid");
            $SQLUpdate->execute(array(
                ":username" => $_SESSION["username"],
                ":invid" => htmlentities($_GET["invoice"])
            ));
		echo "<script type=\"text/javascript\">";
            echo "setTimeout(function () { swal(\"Success!\",\"Invoice Canceled!.\",\"success\");";
            echo "}, 1000);</script>";
				echo '<meta http-equiv="refresh" content="3;url=payments.php">';
        
        
    }


?>


 <div class="container-fluid">
     
      <div class="card">
          <div class="card-body">
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <h3>
                      Invoice
                      <small>#<?= $rand; ?></small>
                    </h3>
                  </section>

                  <!-- Main content -->
                  <section class="invoice">
                    <!-- title row -->
                    <div class="row mt-3">
                      <div class="col-lg-6">
                        <h4><i class="fa fa-globe"></i> Netsource.pw - Jetstresserv1</h4>
                      </div>
					  
					 
                    </div>
					
                    <hr>
                    <div class="row invoice-info">
                      <div class="col-sm-4 invoice-col">
                        From
                        <address>
                         <strong>vStress.io</strong><br>
                          
                        </address>
                      </div><!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                        To
                        <address>
                          <strong><?= $_SESSION['username']; ?></strong><br>
                          
                        </address>
                      </div><!-- /.col -->
                      <div class="col-sm-4 invoice-col">
                        <b>Invoice #<?= $rand; ?></b><br>
                        <br>
                        <b>Account:</b> <?= $_SESSION['username']; ?>
                      </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                      <div class="col-12 table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Qty</th>
                              <th>Product</th>
                              <th>Description</th>
                              <th>Subtotal</th>
                            </tr>
                          </thead>
                          <tbody>
                           
                            <tr>
                              <td>1</td>
                              <td><?= $planInfo['name']; ?></td>
                             
                              <td>Max boot time:<bb class="text-primary"> <?php echo $planInfo['mbt']; ?></bb>, 
Concurrents:<bb class="text-primary"> <?php echo $planInfo['concurrents']; ?> </bb>,
User level:<bb class="text-danger"> <?php echo $network; ?> </bb>,
Length:<bb class="text-warning"> <?php echo $planInfo['length']; ?> <?php echo $planInfo['unit']; ?></bb>,
Api Access:<bb class="text-info"> <?php echo $api; ?> </bb>,
Servers per Attack:<bb class="text-info"> <?php echo $planInfo['totalservers']; ?> </bb></td>
                              <td>$<?= $planInfo['price']; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                      
                      
                      <div class="col-lg-6">
                        <p class="lead"><?= date("m/d/y", htmlentities($row['date'])); ?></p>
                        <div class="table-responsive">
                          <table class="table">
                            <tbody>
							<tr>
                              <th style="width:50%">Subtotal:</th>
                              <td>$<?= $planInfo['price']; ?></td>
                            </tr>
                            <tr>
                              <th>Tax:</th>
                              <td>$0.00</td>
                            </tr>
                           
                            <tr>
                              <th>Total:</th>
                              <td>$<?= $planInfo['price']; ?></td>
                            </tr>
                          </tbody>
						  </table>
                        </div>
                      </div>
					   <!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <hr>
                    <div class="row no-print">
                      <div class="col-lg-3">
                        <a href="javascript:window.print();" target="_blank" class="btn btn-dark m-1"><i class="fa fa-print"></i> Print</a>
						</div>
						<div class="col-lg-9">
						
                          <form method="POST">



<button name="buy" class="btn btn-success waves-effect waves-light m-1"><i class="fa fa-credit-card"></i> Pay</button>
<button name="cancel" class="btn btn-danger waves-effect waves-light m-1"></i> Cancel</button>



   </form>
						
                      </div>
                    </div>
                  </section><!-- /.content -->
          </div>
      </div>
<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
    </div>

	<?php include('footer.php'); ?>
    <!-- End container-fluid-->