<?php 

session_start();
$page = "Dashboard";
include 'header.php';


		$onedayago = time() - 86400;

		$twodaysago = time() - 172800;
		$twodaysago_after = $twodaysago + 86400;

		$threedaysago = time() - 259200;
		$threedaysago_after = $threedaysago + 86400;

		$fourdaysago = time() - 345600;
		$fourdaysago_after = $fourdaysago + 86400;

		$fivedaysago = time() - 432000;
		$fivedaysago_after = $fivedaysago + 86400;

		$sixdaysago = time() - 518400;
		$sixdaysago_after = $sixdaysago + 86400;

		$sevendaysago = time() - 604800;
		$sevendaysago_after = $sevendaysago + 86400;
		
		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` > :date");
		$SQL -> execute(array(":date" => $onedayago));
		$count_one = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $twodaysago, ":after" => $twodaysago_after));
		$count_two = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $threedaysago, ":after" => $threedaysago_after));
		$count_three = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $fourdaysago, ":after" => $fourdaysago_after));
		$count_four = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $fivedaysago, ":after" => $fivedaysago_after));
		$count_five = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $sixdaysago, ":after" => $sixdaysago_after));
		$count_six = $SQL->fetchColumn(0);

		$SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
		$SQL -> execute(array(":before" => $sevendaysago, ":after" => $sevendaysago_after));
		$count_seven = $SQL->fetchColumn(0);
		
		$date_one = date('d/m/Y', $onedayago);
		$date_two = date('d/m/Y', $twodaysago);
		$date_three = date('d/m/Y', $threedaysago);
		$date_four = date('d/m/Y', $fourdaysago);
		$date_five = date('d/m/Y', $fivedaysago);
		$date_six = date('d/m/Y', $sixdaysago);
		$date_seven = date('d/m/Y', $sevendaysago);

			$plansql = $odb -> prepare("SELECT `users`.`expire`, `plans`.`name`, `plans`.`concurrents`, `plans`.`mbt` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id");
			$plansql -> execute(array(":id" => $_SESSION['ID']));
			$row = $plansql -> fetch(); 
			$date = date("m-d-Y, h:i:s a", $row['expire']);
			if (!$user->hasMembership($odb)){
				$row['mbt'] = 0;
				$row['concurrents'] = 0;
				$row['name'] = 'No membership';
				$date = '0-0-0';
			}
			
			$SQL = $odb -> prepare("SELECT * FROM `users` WHERE `username` = :usuario");
                    $SQL -> execute(array(":usuario" => $_SESSION['username']));
                    $balancebyripx = $SQL -> fetch();
                    $balance = $balancebyripx['balance'];
			
		
		?>
		
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->

	<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php echo $TotalAttacks+120000; ?> <span class="float-right"><i class="zmdi zmdi-power"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Test <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php echo $TotalPools; ?> <span class="float-right"><i class="fa fa-server"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total servers <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php echo $RunningAttacks; ?> <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Running Tests <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php echo $TotalUsers+6000; ?> <span class="float-right"><i class="fa fa-users"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Users <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                </div>
            </div>
        </div>
    </div>
 </div><br>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h3 style="color: white;" class="card-title"><i class="fa fa-users"></i> Active Tickets</h3>
</div>
<div class="card-body">
<div class="table-responsive">

	 <table class="table table-striped table-borderless table-vcenter">
                                  <thead>
                                      <tr>
                                         <th>Username</th>
                                            <th>Subject</th>
                                            <th>Priority</th>
                                            <th>Department</th>
                                            <th>Last Update</th>
                                             <th>View</th>
                                      </tr>
                                  </thead>   
                                  <tbody>
<?php 
            $SQLGetTickets = $odb -> prepare("SELECT * FROM `tickets` WHERE `status` = :status ORDER BY `id` DESC");
            $SQLGetTickets -> execute(array(':status' => 'Waiting for admin response'));
            while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
            {
                $id = $getInfo['id'];
                $username = $getInfo['username'];
                $subject = $getInfo['subject'];
                $priority = $getInfo['priority'];
                $department = $getInfo['department'];
                                $status = $getInfo['status'];

                $time = date('Y-m-d h:i:s', $getInfo['time']);

          if ($priority == "Low") {
          $priority1 = '<span class="label label-info">Low</span>';
          } elseif ($priority == "Medium") {
          $priority1 = '<span class="label label-warning">Medium</span>';
          } elseif ($priority == "High") {
          $priority1 = '<span class="label label-danger">High</span>';
          
          }


                echo '<tr><td><span class="badge">'.$username.'</span></td><td><span class="badge">'.htmlspecialchars($subject).'</span></td><td><span class="badge ">'.$priority1.'</span></td><td><span class="badge ">'.$department.'</span></td><td><span class="badge">'.$time.'</span></td> <td width="50px"><a href="ticket.php?Ticket&id='.$id.'"><button type="submit" class="btn btn-primary">View</button></a></td></tr>';
            }
            ?>
                
                
                                   </tbody>
                             </table>

</div>
</div>
</div>
</div>



<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h3 style="color: white;" class="card-title"><i class="fa fa-users"></i> Last Payments(paypal)</h3>
</div>
<div class="card-body">

<div class="table-responsive">
	 <table class="table table-striped table-bordered table-vcenter">
                                  <thead>
                                      <tr>
                                         <th>User id</th>
                                            <th>Amount</th>
                                            <th>Transaction ID</th>
                                            <th>Date</th>
                                            
                                      </tr>
                                  </thead>   
                                  <tbody>
<?php 
            $SQLGetPayment = $odb -> prepare("SELECT * FROM `AddFunds`  ORDER BY `id` DESC");
            $SQLGetPayment -> execute();
            while ($getInfo = $SQLGetPayment -> fetch(PDO::FETCH_ASSOC))
            {
                $id = $getInfo['id'];
                $username = $getInfo['User_ID'];
                $amount = $getInfo['amount'];
                $trans = $getInfo['transaction_id'];
                
                                

                $date = date('Y-m-d h:i:s', $getInfo['transaction_date']);

        


                echo '<tr><td><span class="badge" >'.$username.'</span></td><td><span class="badge">'.htmlspecialchars($amount).'</span></td><td><span class="badge">'.$trans.'</span></td><td><span class="badge">'.$date.'</span></td> </tr>';
            }
            ?>
                
                
                                   </tbody>
                             </table>

</div>
</div>
</div>
</div>




		
					           <?php 
		if (isset($_POST['clearBtn1']))
		{
			$SQL = $odb -> query("TRUNCATE `loginlogss`");
				echo '<p><strong>SUCCESS: </strong>Login Logs have been cleared</p>';		
}
		?>
		
						           <?php 
		if (isset($_POST['clearBtn2']))
		{
			$SQL = $odb -> query("TRUNCATE `logins_failed`");
				echo '<p><strong>SUCCESS: </strong>Login Logs have been cleared</p>';		
}
		?>
		
								           <?php 
		if (isset($_POST['clearBtn3']))
		{
			$SQL = $odb -> query("TRUNCATE `logs`");
				echo '<p><strong>SUCCESS: </strong>Login Logs have been cleared</p>';		
}
		?>
		
		
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h3 style="color: white;" class="card-title"><i class="fa fa-users"></i> Delee Logs</h3>
</div>
<div class="card-body">
	
		        <form action="" method="POST" class="form-horizontal">
							<center><h4>Delete</h2></center>
<center>
		  <input type="submit" value="Delete Login Logs" onclick="disable" name="clearBtn1" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete?')">
		  <input type="submit" value="Delete attack Logs" name="clearBtn3" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete?')" >
	<input type="submit" value="Delete login fails Logs" name="clearBtn2" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete?')" >
		  </center>
</form>
	
	</div>
</div>
</div>
			</div>
	  </div>


<!-- END Main Container -->
        </div>
    </main>
	
<script>
	SendPop = setTimeout(function(){
		document.getElementById('modal-popout').click();
		clearTimeout(SendPop);
	}, 2500);
</script>
<script>
	SendPop = setTimeout(function(){
		document.getElementById('modal-popGift').click();
		clearTimeout(SendPop);
	}, 5000);
</script>

</div>
 <!-- END Page Container -->
<?php include('footer.php'); ?>
      <script type="text/javascript">
 !function($) {
	"use strict";

	var VectorMap = function() {
	};

	VectorMap.prototype.init = function() {
		//various examples
				  $('#world-mapx').vectorMap(
{
    map: 'world_mill_en',
    backgroundColor: 'transparent',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    zoomOnScroll: false,
    color: '#353C48',
    regionStyle : {
        initial : {
          fill : '#1583ea'
        }
      },
    markerStyle: {
      initial: {
                    r: 9,
                    'fill': '#fff',
                    'fill-opacity':1,
                    'stroke': '#000',
                    'stroke-width' : 5,
                    'stroke-opacity': 0.4
                },
                },
    enableZoom: true,
    hoverColor: '#009efb',
    markers : [
 <?php
            $SQLSelect = $odb->query("SELECT `ip` FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 ORDER BY `id` DESC");
            while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
                $ipAttack = $show['ip'];


                if (!filter_var($ipAttack, FILTER_VALIDATE_IP) === false) {

                $geolocation = ip2geolocation($ipAttack);
                $geolocation->latitude;
                $geolocation->longitude;
                $geolocation->longitude;
                $ipOctets = explode('.', $ipAttack);
                $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }
                else
                {
                    // remove http://
                    $url = preg_replace('#^https?://#', '', $ipAttack);
                    $url = preg_replace('#^http?://#', '', $ipAttack);

                    $ipnew = gethostbyname($url);
                    $geolocation = ip2geolocation($ipnew);
                    $geolocation->latitude;
                    $geolocation->longitude;
                    $geolocation->longitude;

                    $ipOctets = explode('.', $ipnew);
                    $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }




                echo  "{latLng: [".$geolocation->latitude.", ".$geolocation->longitude."], name: '".$ipnew."'},\n";
            }

          ?>

            {latLng: [, ], name: ''}
            ]
		});


		$('#uk').vectorMap({
			map : 'uk_mill_en',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});

		$('#usa').vectorMap({
			map : 'us_aea_en',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});


		$('#australia').vectorMap({
			map : 'au_mill',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});
		
		
		$('#canada').vectorMap({
			map : 'ca_lcc',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});
		

	},
	//init
	$.VectorMap = new VectorMap, $.VectorMap.Constructor =
	VectorMap
}(window.jQuery),

//initializing
function($) {
	"use strict";
	$.VectorMap.init()
}(window.jQuery);
</script> 
