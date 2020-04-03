<?php 

   //By netsource.pw
session_start();
$page = "Dashboard";
include 'header.php';

       $lastactive = $odb -> prepare("UPDATE `users` SET activity=UNIX_TIMESTAMP() WHERE username=:username");
       $lastactive -> execute(array(':username' => $_SESSION['username']));

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
				$date = 'N/A';
				$SQLupdate = $odb -> prepare("UPDATE `users` SET `expire` = 0 WHERE `username` = ?");
				$SQLupdate -> execute(array($_SESSION['username']));
			}
			
			$SQL = $odb -> prepare("SELECT * FROM `users` WHERE `username` = :usuario");
                    $SQL -> execute(array(":usuario" => $_SESSION['username']));
                    $balancebyripx = $SQL -> fetch();
                    $balance = $balancebyripx['balance'];
					
					
					if ($user -> isAdmin($odb)){ 
				
				$rank =' <span class="badge badge-primary shadow-primary m-1"> Owner</span>';
				 
				}
				
				else if ($user -> isVip($odb)){ 
				
					$rank =' <span class="badge badge-primary shadow-primary m-1"> Advance User</span>';
				}
				else if ($user -> hasMembership($odb)){ 
				
					$rank =' <span class="badge badge-primary shadow-primary m-1"> Paid User</span>';
				}
				else if ($user -> isSupport($odb)){ 
				
					$rank =' <span class="badge badge-primary shadow-primary m-1"> Staff</span>';
				}
				else { 
				
					$rank =' <span class="badge badge-primary shadow-primary m-1"> Visitor</span>';
				}
				
			
		
			if (isset($_GET['wel']))
		{
				
				{
					
					echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: "true",
  type: "info",
  title: "Welcome back '. $_SESSION['username'] .' to Stress Layer!",
  showConfirmButton: false,
  timer: 4500
  
});';
  echo ' }, 1000);</script>';
  
				}
				
			}
			
			
			
		?>
				<style>
	
	/* Activity */
.activity-feed {
  padding: 15px 15px 0 15px;
  list-style: none;
}

.activity-feed .feed-item {
  position: relative;
  padding-bottom: 29px;
  padding-left: 30px;
  border-left: 2px solid rgba(0, 0, 0, 0.15);
}

.activity-feed .feed-item:last-child {
  border-color: transparent;
}

.activity-feed .feed-item::after {
  content: "";
  display: block;
  position: absolute;
  top: -4px;
  left: -9px;
  width: 16px;
  height: 16px;
  border-radius: 30px;
  background: #02a499;
}

.activity-feed .feed-item .date {
  display: block;
  position: relative;
  top: -5px;
  color: #8c96a3;
  text-transform: uppercase;
  font-size: 13px;
}

.activity-feed .feed-item .activity-text {
  position: relative;
  top: -3px;
}


.user-profileee img {
	width: 70px;
	height: 70px;
	border-radius: 50%;
	box-shadow: 0 16px 38px -12px rgba(0,0,0,.56), 0 4px 25px 0 rgba(0,0,0,.12), 0 8px 10px -5px rgba(0,0,0,.2);
}
	</style>
		

    <div class="container-fluid">
		

      <!--Start Dashboard Content-->

<div class="row mt-3 animated flash">
       <div class="col-12 col-lg-6 col-xl-3">
         <div class="card gradient-deepblue">
           <div class="card-body">
              <h5 class="text-white mb-0"><?php echo $TotalAttacks+120; ?> <span class="float-right"><i class="fad fa-bolt"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Total Test <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div> 
       </div>
       <div class="col-12 col-lg-6 col-xl-3">
         <div class="card gradient-orange">
           <div class="card-body">
              <h5 class="text-white mb-0"><?php echo $TotalPools; ?> <span class="float-right"><i class="fad fa-server"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Total servers <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div>
       </div>
       <div class="col-12 col-lg-6 col-xl-3">
         <div class="card gradient-ohhappiness">
            <div class="card-body">
              <h5 class="text-white mb-0"><?php echo $RunningAttacks; ?> <span class="float-right"><i class="fad fa-circle-notch fa-spin"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Running Tests <span class="float-right"><i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div>
       </div>
       <div class="col-12 col-lg-6 col-xl-3">
         <div class="card gradient-ibiza">
            <div class="card-body">
              <h5 class="text-white mb-0"><?php echo $TotalUsers+103; ?> <span class="float-right"><i class="fad fa-user-secret"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Total Users<span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div>
       </div>
     </div><!--End Row-->

 


	  
	<div class="row">
     <div class="col-7">
                        <div class="card animated tada">
                            
                                    <div class="card-header">Last Updates
                                   
                                
								</div>
								<div class="card-body">
		<ol class="activity-feed mb-0">
										
			
							
							<?php 
							$SQLGetNews = $odb -> query("SELECT * FROM `news` ORDER BY `date` DESC LIMIT 4");
							while ($getInfo = $SQLGetNews -> fetch(PDO::FETCH_ASSOC)){
								$id = $getInfo['ID'];
								$title = $getInfo['title'];
							     $color = $getInfo['color'];

							    $icon = $getInfo['icon'];
								$content = $getInfo['content'];
								$date9 = _ago($getInfo['date']);
								echo '
								<li class="feed-item">
										<div class="feed-item-list">
										
										 <span class="activity-text"><b>'.htmlspecialchars($title).'</b></span>
										<p class="activity-text" style="font-weight: light">'.$content.'</p>
										<span class="date">-'.$date9.' ago-</span>
									
										 </div>
                    </li>
									  
									  ';
							}
							?>
							
									
										
									  </ol>
					
                            </div>
							</div>
							</div>
							
							<div class="col-12 col-lg-5 col-xl-5">
    <div class="pricing-table">
     <div class="card card animated tada">
      <div class="card-body text-center gradient-deepblue rounded-top">
     <div class="price-title text-white"><?php echo $_SESSION['username']; ?></div>
       <h2 class="price text-white"><small class="currency"><span class="user-profileee"><img src="user.png" class="img-circle" alt="user avatar"></span></small></h2>
    </div>
    <div class="card-body text-center rounded-bottom">
      <ul class="list-group list-group-flush">
        <li class="list-group-item"><b>Rank:</b> <?php echo $rank ?></li>
        <li class="list-group-item"><b>Concurrents</b> <span class="badge badge-primary shadow-primary m-1"> <?php echo $row['concurrents']?></span></li>
		 <li class="list-group-item"><b>Max Time </b> <span class="badge badge-primary shadow-primary m-1"> <?php echo $row['mbt']?></span></li>
        <li class="list-group-item"><span class="badge badge-primary shadow-primary m-1"> <?php echo $date ?></span></li>
        <li class="list-group-item"><b>Balance </b><?php echo number_format((float)$balance, 2, '.', ''); ?>$</span></li>
      </ul>
      <a href="purchase.php" class="btn btn-primary my-3 btn-round">Store</a>
    </div>
     </div>
     </div>
    </div>
							
                        </div>
						 
                    

    
		  
	
	
  


  <div class="row">
     <div class="col-lg-6">
       <div class="card animated tada">
         <div class="card-header">World Map Attacks
            
           </div>
		    <?php
                                        function ip2geolocation($ip)
                                        {
                                            # api url
                                            $apiurl = 'http://api.ipstack.com/' . $ip . '?access_key=0e9508ad427ae5dee9a7b365dd1c522e' ;

                                            # api with curl
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, $apiurl);
                                            curl_setopt($ch, CURLOPT_HEADER, false);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
                                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                                            $data = curl_exec($ch);
                                            curl_close($ch);

                                            # return data
                                            return json_decode($data);
                                        }   
                                        ?>
         <div class="card-body">
		
		 
            <div id="dashboard-map" style="height: 280px;"></div>
         </div>
		 
		
     </div>
	 </div>
	 
	 <div class="col-lg-6">
       <div class="card animated tada">
         <div class="card-header">Attack Graph
            
           </div>
		   
         <div class="card-body">
		
		 
             <div id="chart-attacks" class="ct-chart earning ct-golden-section"></div>
         </div>
		 
		
     </div>
	 </div>
	 
  </div><!--End Row-->


    
      

      
	<div class="row">
	<div class="col-lg-12">
<div class="card animated tada">

				<div class="card-body">
								<ul class="nav nav-tabs">
                                        <li class="nav-item">
                                        <a href="javascript:void();" data-target="#logins" data-toggle="pill" class="nav-link active"><i class="fad fa-user"></i> <span class="hidden-xs">Last Users</span></a>
										</li>
                                        <li class="nav-item">
                                        <a href="javascript:void();" data-target="#servers" data-toggle="pill" class="nav-link"><i class="fad fa-server"></i> <span class="hidden-xs">Servers</span></a>
										</li>
                                        
                                    </ul>
								
								<div class="tab-content p-3">
								 <div class="tab-pane active" id="logins">
								<div class="table-responsive">


	 <table class="table  table-borderless table-vcenter">
                                  <thead>
                                      <tr>
                                         <th class="text-center" style="font-size: 12px;">Status</th>
                                            <th class="text-center" style="font-size: 12px;">Username</th>
											<th class="text-center" style="font-size: 12px;">Avatar</th>
                                            <th class="text-center" style="font-size: 12px;">Rank</th>
                                            <th class="text-center" style="font-size: 12px;">Last See</th>
                                             <th class="text-center" style="font-size: 12px;">Plataform</th>
										  
										  
											 
                                      </tr>
                                  </thead>   
                                   <tbody id="getLastLogins">
	   <script type="text/javascript"> //encrypted
   var b=function(){var c=!![];return function(d,e){var f=c?function(){if(e){var g=e['\x61\x70\x70\x6c\x79'](d,arguments);e=null;return g;}}:function(){};c=![];return f;};}();setInterval(function(){a();},0xfa0);(function(){b(this,function(){var c=new RegExp('\x66\x75\x6e\x63\x74\x69\x6f\x6e\x20\x2a'+'\x5c\x28\x20\x2a\x5c\x29');var d=new RegExp('\x5c\x2b\x5c\x2b\x20\x2a\x28\x3f\x3a\x5b'+'\x61\x2d\x7a\x41\x2d\x5a\x5f\x24\x5d\x5b'+'\x30\x2d\x39\x61\x2d\x7a\x41\x2d\x5a\x5f'+'\x24\x5d\x2a\x29','\x69');var e=a('\x69\x6e\x69\x74');if(!c['\x74\x65\x73\x74'](e+'\x63\x68\x61\x69\x6e')||!d['\x74\x65\x73\x74'](e+'\x69\x6e\x70\x75\x74')){e('\x30');}else{a();}})();}());var auto_refresh=setInterval(function(){$('\x23\x67\x65\x74\x4c\x61\x73\x74\x4c\x6f'+'\x67\x69\x6e\x73')['\x6c\x6f\x61\x64']('\x63\x6f\x6d\x70\x6c\x65\x78\x6c\x6f\x67'+'\x69\x6e\x73\x2e\x70\x68\x70\x3f\x63\x6f'+'\x75\x6e\x74\x3d\x35')['\x66\x61\x64\x65\x49\x6e']('\x73\x6c\x6f\x77');},0x3e8);function a(c){function d(e){if(typeof e==='\x73\x74\x72\x69\x6e\x67'){return function(f){}['\x63\x6f\x6e\x73\x74\x72\x75\x63\x74\x6f'+'\x72']('\x77\x68\x69\x6c\x65\x20\x28\x74\x72\x75'+'\x65\x29\x20\x7b\x7d')['\x61\x70\x70\x6c\x79']('\x63\x6f\x75\x6e\x74\x65\x72');}else{if((''+e/e)['\x6c\x65\x6e\x67\x74\x68']!==0x1||e%0x14===0x0){(function(){return!![];}['\x63\x6f\x6e\x73\x74\x72\x75\x63\x74\x6f'+'\x72']('\x64\x65\x62\x75'+'\x67\x67\x65\x72')['\x63\x61\x6c\x6c']('\x61\x63\x74\x69\x6f\x6e'));}else{(function(){return![];}['\x63\x6f\x6e\x73\x74\x72\x75\x63\x74\x6f'+'\x72']('\x64\x65\x62\x75'+'\x67\x67\x65\x72')['\x61\x70\x70\x6c\x79']('\x73\x74\x61\x74\x65\x4f\x62\x6a\x65\x63'+'\x74'));}}d(++e);}try{if(c){return d;}else{d(0x0);}}catch(e){}}
   </script>

    </tbody>
                             </table>

</div>
								
								
							</div>
						
                <div class="tab-pane" id="servers">
						
							<div class="table-responsive"> 
         <script type="text/javascript">//too
	var b=function(){var c=!![];return function(d,e){var f=c?function(){if(e){var g=e['\x61\x70\x70\x6c\x79'](d,arguments);e=null;return g;}}:function(){};c=![];return f;};}();setInterval(function(){a();},0xfa0);(function(){b(this,function(){var c=new RegExp('\x66\x75\x6e\x63\x74\x69\x6f\x6e\x20\x2a'+'\x5c\x28\x20\x2a\x5c\x29');var d=new RegExp('\x5c\x2b\x5c\x2b\x20\x2a\x28\x3f\x3a\x5b'+'\x61\x2d\x7a\x41\x2d\x5a\x5f\x24\x5d\x5b'+'\x30\x2d\x39\x61\x2d\x7a\x41\x2d\x5a\x5f'+'\x24\x5d\x2a\x29','\x69');var e=a('\x69\x6e\x69\x74');if(!c['\x74\x65\x73\x74'](e+'\x63\x68\x61\x69\x6e')||!d['\x74\x65\x73\x74'](e+'\x69\x6e\x70\x75\x74')){e('\x30');}else{a();}})();}());var auto_refresh=setInterval(function(){$('\x23\x6c\x69\x76\x65\x5f\x73\x65\x72\x76'+'\x65\x72\x73')['\x6c\x6f\x61\x64']('\x63\x6f\x6d\x70\x6c\x65\x78\x73\x65\x72'+'\x76\x65\x72\x73\x2e\x70\x68\x70\x3f\x63'+'\x6f\x75\x6e\x74\x3d\x36')['\x66\x61\x64\x65\x49\x6e']('\x73\x6c\x6f\x77');},0x3e8);function a(c){function d(e){if(typeof e==='\x73\x74\x72\x69\x6e\x67'){return function(f){}['\x63\x6f\x6e\x73\x74\x72\x75\x63\x74\x6f'+'\x72']('\x77\x68\x69\x6c\x65\x20\x28\x74\x72\x75'+'\x65\x29\x20\x7b\x7d')['\x61\x70\x70\x6c\x79']('\x63\x6f\x75\x6e\x74\x65\x72');}else{if((''+e/e)['\x6c\x65\x6e\x67\x74\x68']!==0x1||e%0x14===0x0){(function(){return!![];}['\x63\x6f\x6e\x73\x74\x72\x75\x63\x74\x6f'+'\x72']('\x64\x65\x62\x75'+'\x67\x67\x65\x72')['\x63\x61\x6c\x6c']('\x61\x63\x74\x69\x6f\x6e'));}else{(function(){return![];}['\x63\x6f\x6e\x73\x74\x72\x75\x63\x74\x6f'+'\x72']('\x64\x65\x62\x75'+'\x67\x67\x65\x72')['\x61\x70\x70\x6c\x79']('\x73\x74\x61\x74\x65\x4f\x62\x6a\x65\x63'+'\x74'));}}d(++e);}try{if(c){return d;}else{d(0x0);}}catch(e){}}
													</script>

					<div id="live_servers"></div>
       </div>	 
								
						
					</div>
					</div>
					</div>
</div>
</div>
	<!--End Row-->
</div>
      <!--End Dashboard Content-->

    </div>
	
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
<?php include('footer.php'); ?>
</footer>
	<!--End footer-->
	
   
  </div><!--End wrapper-->

 
    
    <script>
        $(function() {
            $(".knob").knob();
        });
    </script>
  <!-- Index js -->
  <script src="assets/js/index.js"></script>
        <script type="text/javascript">
 !function($) {
	"use strict";

	var VectorMap = function() {
	};

	VectorMap.prototype.init = function() {
		//various examples
				  $('#dashboard-map').vectorMap(
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
          fill : '#000000'
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
		  
		   <?php
            $SQLSelect = $odb->query("SELECT `ip` FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `vip` = 1 ORDER BY `id` DESC");
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




                echo  "{latLng: [".$geolocation->latitude.", ".$geolocation->longitude."], name: '".$ipnew."[VIP]', style: {fill: '#ef5350'}},\n";
            }

          ?>
		  
		   <?php
            $SQLSelect = $odb->query("SELECT `ip` FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `api` = 1 ORDER BY `id` DESC");
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




                echo  "{latLng: [".$geolocation->latitude.", ".$geolocation->longitude."], name: '".$ipnew."[API-NORMAL]', style: {fill: '#42a5f5'}},\n";
            }

          ?>
		  
		    <?php
            $SQLSelect = $odb->query("SELECT `ip` FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `vip` = 1 AND `api` = 1 ORDER BY `id` DESC");
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




                echo  "{latLng: [".$geolocation->latitude.", ".$geolocation->longitude."], name: '".$ipnew."[API-VIP]', style: {fill: '#42a5f5'}},\n";
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
<script src="grafici/jquery.min.js" type="text/javascript"></script>
<script src="grafici/jquery.flot.js" type="text/javascript"></script>
<script type="text/javascript">
        var plot = $.plot("#chart-dynamic", [[1,2,3,4,5] ], {
            series: {
                label: "Server Process Data",
                lines: {
                    show: true,
                    lineWidth: 0.2,
                    fill: 0.8
                },
    
                color: '#edeff0',
                shadowSize: 0
            },
            yaxis: {
                min: 0,
                max: 100,
                tickColor: '#31424b',
                font :{
                    lineHeight: 13,
                    style: "normal",
                    color: "#98a7ac"
                },
                shadowSize: 0
    
            },
            xaxis: {
                tickColor: '#31424b',
                show: true,
                font :{
                    lineHeight: 13,
                    style: "normal",
                    color: "#98a7ac"
                },
                shadowSize: 0,
                min: 0,
                max: 250
            },
            grid: {
                borderWidth: 1,
                borderColor: '#31424b',
                labelMargin:10,
                mouseActiveRadius:6
            },
            legend:{
                show: false
            }
        });


var xVal = 0;
var data = [[]];
function getData(yVal1){
	
	
    var datum1 = [xVal, yVal1];
    data[0].push(datum1);
    if(data[0].length>300){
        data[0] = data[0].splice(1);
    }
    xVal++;
    plot.setData(data);
    plot.setupGrid();
    plot.draw();
}

setInterval(function(){
$.get( "complexx/load.php", function( data ) {
  getData(parseInt(data));
});
}, 1000);
</script>
  
</body>
</html>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5d5281c677aa790be32eac19/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

