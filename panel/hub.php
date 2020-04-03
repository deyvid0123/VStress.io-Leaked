<?php 

session_start();
$page = "Layer 4";
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
	
		
?>

    <div class="container-fluid">
              
							<div class="row mt-3 animated flash">
							     <?php
                     
                     $SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` BETWEEN :before AND :after");
                     $SQL -> execute(array(":before" => $sevendaysago, ":after" => time()));
                     $count_seven = $SQL->fetchColumn(0);
                     
                     ?>
			  <div class="col-12 col-lg-6 col-xl-3">
         <div class="card">
           <div class="card-body">
              <h5 class="text mb-0"><?php echo $TotalAttacks+120; ?> <span class="float-right"><i class="fad fa-sync fa-spin"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar gradient-purpink" style="width:100%"></div>
                </div>
              <p class="mb-0 text small-font">Total attacks<span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div> 
       </div>
			<?php
                     $SQL = $odb -> query("SELECT COUNT(*) FROM `logs` WHERE `user` = '" . $_SESSION['username'] . "'");
                     $total_my_attacks = intval($SQL->fetchColumn(0));
                     
                     $SQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `date` > :date AND `user` = :username"); 
                     $SQL -> execute(array(":date" => $onedayago, ":username" => $_SESSION['username'])); 
                     $my_attacks_today = $SQL->fetchColumn(0);	
                     ?>
		 <div class="col-12 col-lg-6 col-xl-3">
         <div class="card">
           <div class="card-body">
              <h5 class="text mb-0"><?php echo $total_my_attacks; ?> <span class="float-right"><i class="fad fa-sync fa-spin"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar gradient-blooker" style="width:100%"></div>
                </div>
              <p class="mb-0 text small-font">My Total Attacks <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div> 
       </div>
			
		 <div class="col-12 col-lg-6 col-xl-3">
         <div class="card">
           <div class="card-body">
              <h5 class="text mb-0"><?php echo $my_attacks_today; ?> <span class="float-right"><i class="fad fa-sync fa-spin"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar gradient-ibiza" style="width:100%"></div>
                </div>
              <p class="mb-0 text small-font">My attacks today <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div> 
       </div>
         <?php
                     $SQL = $odb -> query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 AND `user` = '" . $_SESSION['username'] . "'");
                     $my_running_attacks = intval($SQL->fetchColumn(0));
                     ?>
			
		 <div class="col-12 col-lg-6 col-xl-3">
         <div class="card">
           <div class="card-body">
              <h5 class="text mb-0"><?php echo $my_running_attacks; ?> <span class="float-right"><i class="fad fa-sync fa-spin"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar gradient-scooter" style="width:100%"></div>
                </div>
              <p class="mb-0 text small-font">My Running Attacks <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div> 
       </div>
           
         
           
        </div>
  
							
							 <?php 
							if (!$user->hasMembership($odb))
								{
							?>
							
									<div class="alert alert-outline-info alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-info"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>WRNING!</strong> You don't have an active membership!</span>
			</div></div>
											
        
            <?php } ?>
		
		<div id="attackalert" style="display:none"></div>
		<div class="row">
		 <div class="col-lg-4">
       <div class="card animated tada">
         <div class="card-header">Layer 4
            
           </div>
		    
         <div class="card-body">
		
		      <button type="button" class="btn btn-light btn-block waves-effect waves-light" data-toggle="modal" data-target="#l4">Start</button>
                       
            
         </div>
		 
		
     </div>
	 </div>
	 
	  <div class="col-lg-4">
       <div class="card animated tada">
         <div class="card-header">Layer 7
            
           </div>
		    
         <div class="card-body">
		
		      <button type="button" class="btn btn-light btn-block waves-effect waves-light" data-toggle="modal" data-target="#l7">Start</button>
                       
            
         </div>
		 
		
     </div>
	 </div>
	 <div class="col-lg-4">
       <div class="card animated tada">
         <div class="card-header">Layer 7(Rage)
            
           </div>
		    
         <div class="card-body">
		
		      <button type="button" class="btn btn-light btn-block waves-effect waves-light" data-toggle="modal" data-target="#rage">Start</button>
                       
            
         </div>
		 
		
     </div>
	 </div>
			  
			
	 </div>
		
        <div class="row">
		
		
		
		
		
           
			
			
			
             <div class="modal flash" id="l4">
                  <div class="modal-dialog">
                    <div class="modal-content animated flipInX">
                      <div class="modal-header">
                        <h5 class="modal-title">Layer 4 attack </h5><i class="fa fa-spinner fa-spin text-danger" id="attackloader" style="display:none"></i><div id="attackalert" style="display:none"></div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
					
                      </div>
                      <div class="modal-body">
                      <form class="form-horizontal" method="post" onsubmit="return false;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="host"><i class="fa fa-terminal"></i> Host</label>
                                            <input type="text" class="form-control" id="host" name="host" placeholder="0.0.0.0">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="port"><i class="zmdi zmdi-portable-wifi"></i> Port</label>
                                            <input type="text" class="form-control" id="port" name="port" placeholder="80">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="time"><i class="fa fa-clock"></i> Time</label>
                                            <input type="text" class="form-control" id="time" name="time" placeholder="60">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="time"><i class="fad fa-ghost"></i>Concurrents</label>
                                            <input type="text" class="form-control" id="totalservers" name="totalservers" placeholder="" value="1">Your Max is:
                                                   <?php 
								
							$SQL = $odb->prepare("SELECT `aserv` FROM `users` WHERE `users`.`ID` = :id");
			$SQL ->execute(array(':id' => $_SESSION['ID']));
			$aserv = $SQL -> fetchColumn(0);
			
								$SQLGetTime = $odb->prepare("SELECT `plans`.`totalservers` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`ID` = :id");
				    $SQLGetTime->execute(array(
				        ':id' => $_SESSION['ID']
				    ));
				    $totalservers = $SQLGetTime->fetchColumn(0); echo $totalservers+$aserv; 
					?>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
								
							
							

  <div class="col-lg-12">
                            <div class="form-group">
                                
                                    <div>
                                        <label for="method"><i class="zmdi zmdi-view-dashboard"></i> Method</label>
                                        <select class="form-control" id="method" name="method">
                                           	<optgroup label="Layer 4" style="color:#00bbff;">
											 <?php
                                       $SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'layer4' ORDER BY `id` ASC");
                                       
                                       while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
                                        $name = $getInfo['name'];
                                        $fullname = $getInfo['fullname'];
                                       
                                        $getUserInfoSQL = $odb->query("SELECT `membership` FROM `users` WHERE `username` = '" . $_SESSION['username'] . "'");
                                        $getUserInfo = $getUserInfoSQL->fetch(PDO::FETCH_ASSOC);
                                       
                                        $SQLInfo = $odb->query("SELECT COUNT(*) FROM `plans` WHERE `vip` = '1' AND `ID` = '" . $getUserInfo['membership'] . "'");
                                        $getInfoPlan = $SQLInfo ->fetch(PDO::FETCH_ASSOC);
                                        
                                       if($getInfo['vip'] == '1' && $getInfoPlan['COUNT(*)'] == "0") { 
                                       echo '<option class="text-black" disabled value="' . $name . '">' . htmlentities($fullname) . ' - [VIP]</option>';
                                       } else {
								    	
                                      echo '<option value="'. $name .'">' . $fullname . '</option>';
                                       }
                                       }
                                       ?>
														</optgroup>
															
														 
														      
														
														</optgroup>
												    
										<optgroup label="L4 BYPASS " style="color:red;">
														 <?php
                                       $SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'by4' ORDER BY `id` ASC");
                                       
                                       while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
                                        $name = $getInfo['name'];
                                        $fullname = $getInfo['fullname'];
                                       
                                        $getUserInfoSQL = $odb->query("SELECT `membership` FROM `users` WHERE `username` = '" . $_SESSION['username'] . "'");
                                        $getUserInfo = $getUserInfoSQL->fetch(PDO::FETCH_ASSOC);
                                       
                                        $SQLInfo = $odb->query("SELECT COUNT(*) FROM `plans` WHERE `vip` = '1' AND `ID` = '" . $getUserInfo['membership'] . "'");
                                        $getInfoPlan = $SQLInfo ->fetch(PDO::FETCH_ASSOC);
                                        
                                       if($getInfo['vip'] == '1' && $getInfoPlan['COUNT(*)'] == "0") { 
                                       echo '<option class="text-black" disabled label="' . htmlentities($fullname) . ' [VIP]">' . htmlentities($fullname) . ' - [VIP]</option>';
                                       } else {
								    	
                                       echo '<option value="' . $name . '">' . $fullname . '</option>';
                                       }
                                       }
                                       ?>
														</optgroup>
										     
                                        </select>
                                    </div>
                                </div>
                            </div>
  </div>
  
  <center>
  <div class="col-xs-12">
                            <div class="form-group m-b-0">
									<button class="btn btn-primary btn-sm btn-block waves-effect waves-light m-1" onclick="attack()" id="hit" type="button"> <i class="fa fa-bolt"></i> Send </button>
									
                                </div>
                            </div> </center>
							
                        </form>
					  

					  </div>
                      
                    </div>
                  </div>
                </div>
				
				<div class="modal flash" id="l7">
                  <div class="modal-dialog">
                    <div class="modal-content animated flipInX">
                      <div class="modal-header">
                        <h5 class="modal-title">Layer 7 attack </h5><i class="fa fa-spinner fa-spin text-danger" id="attackloader" style="display:none"></i>
                        
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
						
                      </div>
                      <div class="modal-body">
                     <form class="form-horizontal" method="post" onsubmit="return false;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="host"><i class="fad fa-terminal"></i> Host</label>
                                            <input type="text" class="form-control" id="host2" name="host2" placeholder="http://example.com">
                                            
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="time"><i class="fad fa-clock"></i> Time</label>
                                            <input type="text" class="form-control" id="time2" name="time2" placeholder="60">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="time"><i class="fad fa-ghost"></i> Concurrents</label>
                                            <input type="text" class="form-control" id="totalservers2" name="totalservers2" placeholder="" value="1">Your Max is:
                                                                       <?php 
								
							$SQL = $odb->prepare("SELECT `aserv` FROM `users` WHERE `users`.`ID` = :id");
			$SQL ->execute(array(':id' => $_SESSION['ID']));
			$aserv = $SQL -> fetchColumn(0);
			
								$SQLGetTime = $odb->prepare("SELECT `plans`.`totalservers` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`ID` = :id");
				    $SQLGetTime->execute(array(
				        ':id' => $_SESSION['ID']
				    ));
				    $totalservers = $SQLGetTime->fetchColumn(0); echo $totalservers+$aserv; 
					?>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
								
                            
                            

  
  
  
     
  <div class="col-lg-12">
                            <div class="form-group">
                                
                                    <div>
                                        <label for="method"><i class="zmdi zmdi-view-dashboard"></i> Method</label>
                                        <select class="form-control" id="method2" name="method2">
                                           	<optgroup label="Layer 7" style="color:#00bbff;">
													 <?php
                                       $SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'layer7' ORDER BY `id` ASC");
                                       
                                       while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
                                        $name = $getInfo['name'];
                                        $fullname = $getInfo['fullname'];
                                       
                                        $getUserInfoSQL = $odb->query("SELECT `membership` FROM `users` WHERE `username` = '" . $_SESSION['username'] . "'");
                                        $getUserInfo = $getUserInfoSQL->fetch(PDO::FETCH_ASSOC);
                                       
                                        $SQLInfo = $odb->query("SELECT COUNT(*) FROM `plans` WHERE `vip` = '1' AND `ID` = '" . $getUserInfo['membership'] . "'");
                                        $getInfoPlan = $SQLInfo ->fetch(PDO::FETCH_ASSOC);
                                        
                                       if($getInfo['vip'] == '1' && $getInfoPlan['COUNT(*)'] == "0") { 
                                       echo '<option class="text-black" disabled value="' . htmlentities($name)  . '">' . htmlentities($fullname) . ' - [VIP]</option>';
                                       } else {
								    	
                                       echo '<option value="' . htmlentities($name) . '">' . htmlentities($fullname) . '</option>';
                                       }
                                       }
                                       ?>
														</optgroup>
															
														 
														    
														
														
														      <optgroup label="BYPASS L7" style="color:red;">
													 <?php
                                       $SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'by7' ORDER BY `id` ASC");
                                       
                                       while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
                                        $name = $getInfo['name'];
                                        $fullname = $getInfo['fullname'];
                                       
                                        $getUserInfoSQL = $odb->query("SELECT `membership` FROM `users` WHERE `username` = '" . $_SESSION['username'] . "'");
                                        $getUserInfo = $getUserInfoSQL->fetch(PDO::FETCH_ASSOC);
                                       
                                        $SQLInfo = $odb->query("SELECT COUNT(*) FROM `plans` WHERE `vip` = '1' AND `ID` = '" . $getUserInfo['membership'] . "'");
                                        $getInfoPlan = $SQLInfo ->fetch(PDO::FETCH_ASSOC);
                                        
                                       if($getInfo['vip'] == '1' && $getInfoPlan['COUNT(*)'] == "0") { 
                                       echo '<option class="text-black" disabled value="' . htmlentities($name)  . '">' . htmlentities($fullname) . ' - [VIP]</option>';
                                       } else {
								    	
                                       echo '<option value="' . $name . '">' . htmlentities($fullname) . '</option>';
                                       }
                                       }
                                       ?>
														</optgroup>
                                        </select>
                                    </div>
                                </div>
  </div> 
  </div>
  <center>
  <div class="col-xs-12">
                            <div class="form-group m-b-0">
                                
									<button class="btn btn-primary btn-sm btn-block waves-effect waves-light m-1" onclick="attack2()" id="hit" type="button"> <i class="fa fa-bolt"></i> Send </button>
									
                                </div>
                            </div> </center>
							
                        </form>
					  

					  </div>
                     
                    </div>
                  </div>
                </div>
		
		<div class="modal flash" id="rage">
                  <div class="modal-dialog">
                    <div class="modal-content animated flash">
                      <div class="modal-header">
                        <h5 class="modal-title">Layer 7 attack </h5><i class="fa fa-spinner fa-spin text-danger" id="attackloader" style="display:none"></i>
                        
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
						
                      </div>
                      <div class="modal-body">
                     <form class="form-horizontal" method="post" onsubmit="return false;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="host">Host</label>
                                            <input type="text" class="form-control" id="host3" name="host3" placeholder="http://example.com">
                                            
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="time"> Time</label>
                                            <input type="text" class="form-control" id="time3" name="time3" placeholder="60">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
								     <div class="col-lg-6">
      						    <div class="form-group">
       
          <div>
            <label for="method"> Method</label>
                              <select class="form-control"  id="method3" name="method3">
          <option value="GET">GET</option>
          <option value="POST">POST</option>
								  
          </select>
          </div>
      </div>
  </div>
   <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="time"> Post Data(Post Only)</label>
                                            <input type="text" class="form-control" id="post" name="post" placeholder="username=123&password=123">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
  
  
  						     <div class="col-lg-6">
      						    <div class="form-group">
       
          <div>
            <label for="method"> Mode</label>
                              <select class="form-control"  id="mode" name="mode">
          <option value="BYPASS">BYPASS</option>
          <option value="BURST">BURST</option>
								  
          </select>
          </div>
      </div>
  </div>
					     <div class="col-lg-6">
      						    <div class="form-group">
       
          <div>
            <label for="method"> Rate Limit</label>
                              <select class="form-control"  id="rate" name="rate">
          <option value="false">false</option>
          <option value="true">true</option>
								  
          </select>
          </div>
      </div>
  </div>						
                            
                            

							
                  

  
  
  

 
  </div>
  <center>
  <div class="col-xs-12">
                            <div class="form-group m-b-0">
                                
									<button class="btn btn-primary btn-sm btn-block waves-effect waves-light m-1" onclick="attack3()" id="hit" type="button"> <i class="fa fa-bolt"></i> Send </button>
									
                                </div>
                            </div> </center>
							
                        </form>
					  

					  </div>
                     
                    </div>
                  </div>
                </div>
				
				
				
            
      </div>
      </div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
           
			
            <div class="col-lg-12">
                <div class="card animated tada">
                    <div class="card-header">
                        <h3 class="card-title"><i class="si si-list"></i> Active Attacks <i style="display: none;" id="manage" class="zmdi zmdi-settings zmdi-hc-spin"></i></h3>
                        
                    </div>
                    <div class="card-content">
                        <div id="attacksdiv" style="display:block;"></div>
                    </div>
                </div>
				</div>
	  
            
              <script>
                attacks();

                function attacks() {
                    document.getElementById("attacksdiv").style.display = "none";
                    document.getElementById("manage").style.display = "inline";
                    var xmlhttp;
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("attacksdiv").innerHTML = xmlhttp.responseText;
                            document.getElementById("manage").style.display = "none";
                            document.getElementById("attacksdiv").style.display = "inline-block";
                            document.getElementById("attacksdiv").style.width = "100%";
                            eval(document.getElementById("ajax").innerHTML);
                        }
                    }
                    xmlhttp.open("GET", "complexx/attacks.php", true);
                    xmlhttp.send();
                }

                function attack() { 
                    var snd = new Audio("attacksent.mp3");
                    var host = $('#host').val();
                    var time = $('#time').val();
                    var port = $('#port').val();
                    var method = $('#method').val();
                    var totalservers = $('#totalservers').val();
					let vip = $('#vip:checked').val();
					 if (vip === undefined) {
					vip = '0';
												}
                    document.getElementById("attackalert").style.display = "none";
                    //ocument.getElementById("attackloader").style.display="inline";
                    var xmlhttp;
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("attackalert").innerHTML = xmlhttp.responseText;
                            //document.getElementById("attackloader").style.display="none";
                            document.getElementById("attackalert").style.display = "inline";
                            if (xmlhttp.responseText.search("SUCCESS") != -1) {

									 Swal.fire({
										 position: "top-end",
									 title:'Attack Sent Successfully', 
									 type: 'info',
									 toast: true,
									  showConfirmButton: false,
									  timer: 4500
									 
									 });
                                snd.play();
                                attacks();
                                window.setInterval(attacks(), 2000);
                            } else {

								 Swal.fire({
									 position: "top-end",
									 title:'Something is wrong..', 
									 type: 'info',
									 toast: true,
									  showConfirmButton: false,
									  timer: 4500
									 
									 });
                            }
                        }
                    }
                    xmlhttp.open("GET", "complexx/hub.php?type=start" + "&host=" + host + "&port=" + port + "&time=" + time + "&method=" + method + "&totalservers=" + totalservers , true);
                    xmlhttp.send();
                    attacks();
                }

                function renew(id) {
                    document.getElementById("attackalert").style.display = "none";
                    document.getElementById("attackloader").style.display = "inline";
                    var xmlhttp;
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("attackalert").innerHTML = xmlhttp.responseText;
                            document.getElementById("attackloader").style.display = "none";
                            document.getElementById("attackalert").style.display = "inline";
                            if (xmlhttp.responseText.search("Attack sent successfully") != -1) {
                                attacks();
                            }
                        }
                    }
                    xmlhttp.open("GET", "complexx/hub.php?type=renew" + "&id=" + id, true);
                    xmlhttp.send();
                    attacks();
                }

                function stop(id) {
                    document.getElementById("attackalert").style.display = "none";
                    document.getElementById("attackloader").style.display = "inline";
                    var xmlhttp;
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("attackalert").innerHTML = xmlhttp.responseText;
                            document.getElementById("attackloader").style.display = "none";
                            document.getElementById("attackalert").style.display = "inline";
                            if (xmlhttp.responseText.search("SUCCESS") != -1) {
								
								 Swal.fire({
									 position: "top-end",
									 title:'Attack Stoped', 
									 type: 'info',
									 toast: true,
									  showConfirmButton: false,
									  timer: 4500
									 
									 });

                                attacks();
                            }
                        }
                    }
                    xmlhttp.open("GET", "complexx/hub.php?type=stop" + "&id=" + id, true);
                    xmlhttp.send();
                }

            </script>
			
			<script>
                attacks();

                function attacks() {
                    document.getElementById("attacksdiv").style.display = "none";
                    document.getElementById("manage").style.display = "inline";
                    var xmlhttp;
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("attacksdiv").innerHTML = xmlhttp.responseText;
                            document.getElementById("manage").style.display = "none";
                            document.getElementById("attacksdiv").style.display = "inline-block";
                            document.getElementById("attacksdiv").style.width = "100%";
                            eval(document.getElementById("ajax").innerHTML);
                        }
                    }
                    xmlhttp.open("GET", "complexx/attacks.php", true);
                    xmlhttp.send();
                }

                function attack2() {
                    var snd = new Audio("attacksent.mp3");
                    var host = $('#host2').val();
                    var time = $('#time2').val();
                    var port = $('#port2').val();
                    var method = $('#method2').val();
                    var totalservers = $('#totalservers2').val();
					let vip = $('#vip2:checked').val();
					 if (vip === undefined) {
					vip = '0';
												}
                    document.getElementById("attackalert").style.display = "none";
                    //ocument.getElementById("attackloader").style.display="inline";
                    var xmlhttp;
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("attackalert").innerHTML = xmlhttp.responseText;
                            //document.getElementById("attackloader").style.display="none";
                            document.getElementById("attackalert").style.display = "inline";
                            if (xmlhttp.responseText.search("SUCCESS") != -1) {

									 Swal.fire({
										 position: "top-end",
									 title:'Attack Sent Successfully', 
									 type: 'info',
									 toast: true,
									  showConfirmButton: false,
									  timer: 4500
									 
									 });
                                snd.play();
                                attacks();
                                window.setInterval(attacks(), 2000);
                            } else {

								 Swal.fire({
									 position: "top-end",
									 title:'Something is wrong..', 
									 type: 'info',
									 toast: true,
									  showConfirmButton: false,
									  timer: 4500
									 
									 });
                            }
                        }
                    }
                    xmlhttp.open("GET", "complexx/layer7.php?type=start" + "&host=" + host + "&port=" + 80 + "&time=" + time + "&method=" + method + "&totalservers=" + totalservers , true);
                    xmlhttp.send();
                    attacks();
                }

              

                

            </script>
 
        </div>
    </div>
</main>
</div>
<!-- END Page Container -->
<?php include('footer.php'); ?>
