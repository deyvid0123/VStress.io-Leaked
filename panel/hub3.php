<?php 

session_start();
$page = "Layer 4";
include 'header.php';
    $runningrip = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
	$slotsx = $odb->query("SELECT COUNT(*) FROM `api` WHERE `slots`")->fetchColumn(0);
	$load    = round($runningrip / $slotsx * 100, 2);	
	
		
?>
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
               <?php 
							if (!$user->hasMembership($odb))
								{
							?>
							<div class="row mt-3">
			<div class="col-12 col-lg-6 col-xl-3">
         <div class="card">
           <div class="card-body">
              <h5 class="text mb-0"><?php echo $total ?> <span class="float-right"><i class="zmdi zmdi-power"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text small-font">Your Total test <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div> 
       </div>
			
			<div class="col-12 col-lg-6 col-xl-3">
         <div class="card">
           <div class="card-body">
              <h5 class="text mb-0"><?php echo $count_seven ?> <span class="float-right"><i class="fa fa-server"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text small-font">Week Attacks <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div> 
       </div>
			
			<div class="col-12 col-lg-6 col-xl-3">
         <div class="card">
           <div class="card-body">
              <h5 class="text mb-0"><?php echo $totalr ?> <span class="float-right"><i class="zmdi zmdi-rotate-right zmdi-hc-spin"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text small-font">Running Attacks <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div> 
       </div>
			
			<div class="col-12 col-lg-6 col-xl-3">
         <div class="card">
           <div class="card-body">
              <h5 class="text mb-0"><?php echo $totals ?> <span class="float-right"><i class="zmdi zmdi-stop"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text small-font">Stopped Atttaks <span class="float-right"> <i class="zmdi zmdi-long-arrow-up"></i></span></p>
            </div>
         </div> 
       </div>
           
         
           
        </div>
  
							
							
							
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
       <div class="card">
         <div class="card-header">Layer 4
            
           </div>
		    
         <div class="card-body">
		
		      <button type="button" class="btn btn-light btn-block waves-effect waves-light" data-toggle="modal" data-target="#l4">Start</button>
                       
            
         </div>
		 
		
     </div>
	 </div>
	 
	  <div class="col-lg-4">
       <div class="card">
         <div class="card-header">Layer 7
            
           </div>
		    
         <div class="card-body">
		
		      <button type="button" class="btn btn-light btn-block waves-effect waves-light" data-toggle="modal" data-target="#l7">Start</button>
                       
            
         </div>
		 
		
     </div>
	 </div>
	   <div class="card">
         <div class="card-header">Advance HUB(Break-JS)
            
           </div>
		    
         <div class="card-body">
		
		      <button type="button" class="btn btn-light btn-block waves-effect waves-light" data-toggle="modal" data-target="#l8">Start</button>
                       
            
         </div>
		 
		
     </div>
	 </div>
	 </div>
		
        <div class="row">
		
		
		
		
		
           
			
			
			
             <div class="modal flash" id="l4">
                  <div class="modal-dialog">
                    <div class="modal-content animated flash">
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
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="time"><i class="fa fa-clock-o"></i> Time</label>
                                            <input type="text" class="form-control" id="time" name="time" placeholder="60">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
								
							
							
                           <div class="col-lg-6">
							    <div class="form-group">
      
          <div>
            <label for="method"><i class="fa fa-rss"></i> Network</label>
                              <select class="form-control" id="vip" name="vip">
          <option value="0">Regular</option>
          <option value="1">Premium</option>
          </select>
          </div>
      </div>
  </div>
  <div class="col-lg-12">
                            <div class="form-group">
                                
                                    <div>
                                        <label for="method"><i class="zmdi zmdi-view-dashboard"></i> Method</label>
                                        <select class="form-control" id="method" name="method">
                                           	<optgroup label="Regular" style="color:#00bbff;">
														<?php
															$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'layer4' ORDER BY `id` ASC");
															while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
																$name     = $getInfo['name'];
																$fullname = $getInfo['fullname'];
																echo '<option value="' . $name . '">' . $fullname . '</option>';
															}
														?>
														</optgroup>
															
														 
														      
														
														</optgroup>
										  <optgroup label="VIP (ONLY VIP USERS) " style="color:green;">
														<?php
															$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'vips' ORDER BY `id` ASC");
															while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
																$name     = $getInfo['name'];
																$fullname = $getInfo['fullname'];
																echo '<option value="' . $name . '">'. $fullname . '</option>';
															}
														?>
														</optgroup>				    
										<optgroup label="Premium (ONLY VIP USERS) " style="color:red;">
														<?php
															$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'by4' ORDER BY `id` ASC");
															while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
																$name     = $getInfo['name'];
																$fullname = $getInfo['fullname'];
																echo '<option value="' . $name . '">'. $fullname . '</option>';
															}
														?>
														</optgroup>
										     <optgroup label="STRESSLAYER BYPASS" style="color:yellow;">
														<?php
															$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'botnet' ORDER BY `id` ASC");
															while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
																$name     = $getInfo['name'];
																$fullname = $getInfo['fullname'];
																echo '<option value="' . $name . '">'. $fullname . '</option>';
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
									<button class="btn btn-secondary btn-sm btn-block waves-effect waves-light m-1" onclick="attack()" id="hit" type="button"> <i class="fa fa-bolt"></i> Send </button>
									
                                </div>
                            </div> </center>
							
                        </form>
					  

					  </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        
                      </div>
                    </div>
                  </div>
                </div>
				
				<div class="modal flash" id="l7">
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
										<label for="host"><i class="fa fa-terminal"></i> Host</label>
                                            <input type="text" class="form-control" id="host2" name="host2" placeholder="http://example.com">
                                            
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="time"><i class="fa fa-clock-o"></i> Time</label>
                                            <input type="text" class="form-control" id="time2" name="time2" placeholder="60">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
								
                            
                            

							
                            <div class="col-lg-12">
							    <div class="form-group">
      
          <div>
            <label for="method"><i class="fa fa-rss"></i> Network</label>
                              <select class="form-control" id="vip2" name="vip2">
          <option value="0">Regular</option>
          <option value="1">Premium</option>
          </select>
          </div>
      </div>
  </div>

  
  
  
     
  <div class="col-lg-12">
                            <div class="form-group">
                                
                                    <div>
                                        <label for="method"><i class="zmdi zmdi-view-dashboard"></i> Method</label>
                                        <select class="form-control" id="method2" name="method2">
                                           	<optgroup label="Regular L7" style="color:#00bbff;">
														<?php
															$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'layer7' ORDER BY `id` ASC");
															while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
																$name     = $getInfo['name'];
																$fullname = $getInfo['fullname'];
																echo '<option value="' . $name . '">' . $fullname . '</option>';
															}
														?>
														</optgroup>
															
														 
														    
														
														
														      <optgroup label="BYPASS L7" style="color:red;">
														<?php
															$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'by7' ORDER BY `id` ASC");
															while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
																$name     = $getInfo['name'];
																$fullname = $getInfo['fullname'];
																echo '<option value="' . $name . '">'. $fullname . '</option>';
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
                                
									<button class="btn btn-secondary btn-sm btn-block waves-effect waves-light m-1" onclick="attack2()" id="hit" type="button"> <i class="fa fa-bolt"></i> Send </button>
									
                                </div>
                            </div> </center>
							
                        </form>
					  

					  </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        
                      </div>
                    </div>
                  </div>
                </div>
				
				
				<div class="modal flash" id="l8">
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
										<label for="host"><i class="fa fa-terminal"></i> Host</label>
                                            <input type="text" class="form-control" id="host3" name="host3" placeholder="http://example.com">
                                            
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="time"><i class="fa fa-clock-o"></i> Time</label>
                                            <input type="text" class="form-control" id="time3" name="time3" placeholder="60">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
								     <div class="col-lg-6">
      						    <div class="form-group">
       
          <div>
            <label for="method"><i class="zmdi zmdi-globe"></i> Method</label>
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
										<label for="time"><i class="fa fa-clock-o"></i> Post Data(Post Only)</label>
                                            <input type="text" class="form-control" id="post" name="post" placeholder="username=123&password=123">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
  
  
  						     <div class="col-lg-6">
      						    <div class="form-group">
       
          <div>
            <label for="method"><i class="zmdi zmdi-globe"></i> Mode</label>
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
            <label for="method"><i class="zmdi zmdi-globe"></i> Rate Limit</label>
                              <select class="form-control"  id="rate" name="rate">
          <option value="false">false</option>
          <option value="true">true</option>
								  
          </select>
          </div>
      </div>
  </div>						
                            
                            

							
                  

  
  
  
     <div class="col-lg-6">
      						    <div class="form-group">
       
          <div>
            <label for="method"><i class="zmdi zmdi-globe"></i> ORIGIN</label>
                              <select class="form-control"  id="origin" name="origin">
          <option value="ALL">RANDOM</option>
          <option value="China">China</option>
		  <option value="HongKong">HongKong</option>
		  <option value="Korea">Korea</option>
		 <option value="Russia">Russia</option>
								  <option value="UK">UK</option>
								  <option value="US">US</option>
								  <option value="Vietnam">Vietnam</option>
								  <option value="India">India</option>
								  <option value="Indonesia">Indonesia</option>
								  
								  <option value="Turkey">Turkey</option>
								  <option value="Japan">Japan</option>
								  <option value="Spain">Spain</option>
								   <option value="Germany">Germany</option>
								  
          </select>
          </div>
      </div>
  </div>
 
  </div>
  <center>
  <div class="col-xs-12">
                            <div class="form-group m-b-0">
                                
									<button class="btn btn-secondary btn-sm btn-block waves-effect waves-light m-1" onclick="attack3()" id="hit" type="button"> <i class="fa fa-bolt"></i> Send </button>
									
                                </div>
                            </div> </center>
							
                        </form>
					  

					  </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        
                      </div>
                    </div>
                  </div>
                </div>
				
				
				
            
      </div>
      </div>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
           
			
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="si si-list"></i> Active Attacks <i style="display: none;" id="manage" class="zmdi zmdi-settings zmdi-hc-spin"></i></h3>
                        
                    </div>
                    <div class="card-content">
                        <div id="attacksdiv" style="display:block;"></div>
                    </div>
                </div>
				</div>
	  
	  <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
							<div class="c-header">
                               <center>  <h4 class="card-title">Real time Network Load</h4></center> 
							   </div>
                                <div>
                                    <center><iframe id="graficostats_1" scrolling="no" src="complexx/netload.php" style="width: 100%; border:none; height: 270px; overflow:hidden;"></iframe></center>
                                </div>
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
                    var host = $('#host').val();
                    var time = $('#time').val();
                    var port = $('#port').val();
                    var method = $('#method').val();
                    var totalservers = $('#totalservers').val();
					var vip=$('#vip').val();
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
                    xmlhttp.open("GET", "complexx/hub.php?type=start" + "&host=" + host + "&port=" + port + "&time=" + time + "&method=" + method + "&totalservers=" + 1 + "&vip=" + vip, true);
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
                    var host = $('#host2').val();
                    var time = $('#time2').val();
                    var port = $('#port2').val();
                    var method = $('#method2').val();
                    var totalservers = $('#totalservers2').val();
					var vip=$('#vip2').val();
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
                    xmlhttp.open("GET", "complexx/layer7.php?type=start" + "&host=" + host + "&port=" + 80 + "&time=" + time + "&method=" + method + "&totalservers=" + 1 + "&vip=" + vip, true);
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
                    xmlhttp.open("GET", "complexx/layer7.php?type=renew" + "&id=" + id, true);
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
                    xmlhttp.open("GET", "complexx/layer7.php?type=stop" + "&id=" + id, true);
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

                function attack3() {
                    var host = $('#host3').val();
                    var time = $('#time3').val();
                    var mode = $('#mode').val();
                    var method = $('#method3').val();
					var post = $('#post').val();
					var origin = $('#origin').val();
					var rate = $('#rate').val();
                   
					
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
                    xmlhttp.open("GET", "complexx/break.php?type=start" + "&host=" + host + "&time=" + time + "&method=" + method + "&postdata=" + post + "&mode=" + mode + "&ratelimit=" + rate + "&origin=" + origin, true);
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
                    xmlhttp.open("GET", "complexx/break.php?type=stop" + "&id=" + id, true);
                    xmlhttp.send();
                }

            </script>
			
        </div>
    </div>
</main>
</div>
<!-- END Page Container -->
<?php include('footer.php'); ?>
