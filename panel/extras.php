<?php
session_start();
$page = "Addons";
include 'header.php';
?>
<?php
		if (isset($_POST['plusenvoi']))
		{
				$pts = 25;
				$SQL = $odb -> prepare("SELECT `balance` FROM `users` WHERE `ID` = :id");
				$SQL -> execute(array(':id' => $_SESSION['ID']));
				$result = $SQL -> fetchColumn(0);
				if ($result > $pts -1)
				{
					$SQLUpdate = $odb -> prepare("UPDATE `users` SET `balance` = balance -:pts, `aconcu` = aconcu +1 WHERE `username` = :user");
					$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':pts' => $pts));
					echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "success",
  title: "Concurrent addded to your account!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
				}
				else
				{
										echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "info",
  title: "You need more money!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
				}
			}
		
?>

<?php
		if (isset($_POST['plussec']))
		{
				$pts = 10;
				$SQL = $odb -> prepare("SELECT `balance` FROM `users` WHERE `ID` = :id");
				$SQL -> execute(array(':id' => $_SESSION['ID']));
				$result = $SQL -> fetchColumn(0);
				if ($result > $pts -1)
				{
					$SQLUpdate = $odb -> prepare("UPDATE `users` SET `balance` = balance -:pts, `atime` = atime +600 WHERE `username` = :user");
					$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':pts' => $pts));
					echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "success",
  title: "Seconds added to your account!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
				}
				else
				{
										echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "info",
  title: "You need more money!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
				}
			}
		
?>

<?php
		if (isset($_POST['plusvip']))
		{
				$pts = 20;
				$SQL = $odb -> prepare("SELECT `balance` FROM `users` WHERE `ID` = :id");
				$SQL -> execute(array(':id' => $_SESSION['ID']));
				$result = $SQL -> fetchColumn(0);
				if ($result > $pts -1)
				{
					$SQLUpdate = $odb -> prepare("UPDATE `users` SET `balance` = balance -:pts, `avip` = 1 WHERE `username` = :user");
					$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':pts' => $pts));
					echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "success",
  title: "You are VIP Now!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
				}
				else
				{
										echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "info",
  title: "You need more money!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
				}
			}
		
?>
<?php
		if (isset($_POST['plusserv']))
		{
				$pts = 30;
				$SQL = $odb -> prepare("SELECT `balance` FROM `users` WHERE `ID` = :id");
				$SQL -> execute(array(':id' => $_SESSION['ID']));
				$result = $SQL -> fetchColumn(0);
				if ($result > $pts -1)
				{
					$SQLUpdate = $odb -> prepare("UPDATE `users` SET `balance` = balance -:pts, `aserv` = aserv +1 WHERE `username` = :user");
					$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':pts' => $pts));
					echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "success",
  title: "Extra Server added to your accounnt!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
				}
				else
				{
										echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "info",
  title: "You need more money!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
				}
			}
		
?>

<?php
		if (isset($_POST['plusbypass']))
		{
				$pts = 50;
				$SQL = $odb -> prepare("SELECT `balance` FROM `users` WHERE `ID` = :id");
				$SQL -> execute(array(':id' => $_SESSION['ID']));
				$result = $SQL -> fetchColumn(0);
				if ($result > $pts -1)
				{
					$SQLUpdate = $odb -> prepare("UPDATE `users` SET `balance` = balance -:pts, `byhub` = 1 WHERE `username` = :user");
					$SQLUpdate -> execute(array(':user' => $_SESSION['username'], ':pts' => $pts));
					echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "success",
  title: "Now you have access to BypassHub!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
				}
				else
				{
										echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "info",
  title: "You need more money!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
				}
			}
		
?>

    <div class="container-fluid">


<br>
<?php
$SQLAddOn = $odb -> prepare("SELECT addon_concurrent_charge, addon_mbt_charge FROM `siteconfig` limit 1");
$SQLAddOn->execute();
$addon_charge = $SQLAddOn->fetch(PDO::FETCH_ASSOC);
?>


                            
                                    <div class="card-title">Addons</div>
									<div class="alert alert-icon-info alert-dismissible" role="alert">
		   <button type="button" class="close" data-dismiss="alert">&times;</button>
			<div class="alert-icon icon-part-info">
			 <i class="fa fa-bell"></i>
			</div>
			<div class="alert-message">
			  <span><strong>Info!</strong> Your Actual Balance is: <?php echo $balance; ?>$</span>
			</div>
		  </div>
	<div class="row">
	 <div class="col-6">
	<form method="POST">	
   
        <div class="card animated flipInX">
            <div class="card-body">
                <div class="p-3 pb-0">
                    <div class="float-right">
                        <i class="mdi mdi-account-multiple text-primary widget-icon"></i>
                    </div>
                    <h5 class="font-weight-normal mt-0">
                        Buy an extra Concurrent cost $25
                    </h5>
                    <button type="submit" name="plusenvoi" class="btn btn-light waves-effect btn-block waves-light m-1" >
                                                                    <i class="fa fa-bolt"></i> Buy
                                                                </button>
                </div>
            </div>
        </div>
		</form>
    </div>
		
 <div class="col-6">
 <form method="POST">	
     
        <div class="card animated flipInX">
            <div class="card-body">
                <div class="p-3 pb-0">
                    <div class="float-right">
                        <i class="mdi mdi-account-multiple text-primary widget-icon"></i>
                    </div>
                    <h5 class=" font-weight-normal mt-0">
                        Buy 600 extra seconds cost $10
                    </h5>
                    <button type="submit" name="plussec" class="btn btn-light waves-effect btn-block waves-light m-1" >
                                                                    <i class="fa fa-bolt"></i> Buy
                                                                </button>
                </div>
            </div>
        </div>
		</form>
    </div>
		
		</div>
		<div class="row">
		<div class="col-6">
    <form method="POST">	
     
        <div class="card animated flipInX">
            <div class="card-body">
                <div class="p-3 pb-0">
                    <div class="float-right">
                        <i class="mdi mdi-account-multiple text-primary widget-icon"></i>
                    </div>
                    <h5 class=" font-weight-normal mt-0">
                        Buy Addon VIP cost $20
                    </h5>
                    <button type="submit" name="plusvip" class="btn btn-light waves-effect btn-block waves-light m-1" >
                                                                    <i class="fa fa-bolt"></i> Buy
                                                                </button>
                </div>
            </div>
        </div>
		</form>
    </div>
    	<div class="col-6">
    <form method="POST">	
     
        <div class="card animated flipInX">
            <div class="card-body">
                <div class="p-3 pb-0">
                    <div class="float-right">
                        <i class="mdi mdi-account-multiple text-primary widget-icon"></i>
                    </div>
                    <h5 class=" font-weight-normal mt-0">
                        Buy Extra Server cost $30
                    </h5>
                    <button type="submit" name="plusserv" class="btn btn-light waves-effect btn-block waves-light m-1" >
                                                                    <i class="fa fa-bolt"></i> Buy
                                                                </button>
                </div>
            </div>
        </div>
		</form>
    </div>
		
	 
	</div>
		
		<div class="row">	

	</div>
	
	
		
	

<br><br><br><br><br><br>
  </div>
	
    </main>

<?php include('footer.php'); ?>

