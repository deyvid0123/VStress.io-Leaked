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
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h3 style="color: white;" class="card-title"> Hub Attack</h3> <i class="zmdi zmdi-settings zmdi-hc-spin" id="attackloader" style="display:none"></i>
                        
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" onsubmit="return false;">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <div class="form-material floating">
										<label for="host"><i class="fa fa-terminal"></i> Host</label>
                                            <input type="text" class="form-control" id="host" name="host" placeholder="0.0.0.0">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
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
										<label for="time"><i class="fa fa-clock-o"></i> Time</label>
                                            <input type="text" class="form-control" id="time" name="time" placeholder="60">
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
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
															
														 
														      <optgroup label="VIP (ONLY VIP USERS) " style="color:#e54e55;">
														<?php
															$SQLGetLogs = $odb->query("SELECT * FROM `methods` WHERE `type` = 'vips' ORDER BY `id` ASC");
															while ($getInfo = $SQLGetLogs->fetch(PDO::FETCH_ASSOC)) {
																$name     = $getInfo['name'];
																$fullname = $getInfo['fullname'];
																echo '<option value="' . $name . '">'. $fullname . '</option>';
															}
														?>
														</optgroup>
														
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
										  <optgroup label="BOTNET (ONLY VIP USERS) " style="color:magenta;">
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
                            <div class="form-group">
                                <label class="control-label"><i class="fa fa-server"></i> Threads </label>
                                
                                <input type="text" class="form-control" id="totalservers" name="totalservers" placeholder="1">
								<?php 
								
							$SQL = $odb->prepare("SELECT `aserv` FROM `users` WHERE `users`.`ID` = :id");
			$SQL ->execute(array(':id' => $_SESSION['ID']));
			$aserv = $SQL -> fetchColumn(0);
			
								$SQLGetTime = $odb->prepare("SELECT `plans`.`totalservers` FROM `plans` LEFT JOIN `users` ON `users`.`membership` = `plans`.`ID` WHERE `users`.`ID` = :id");
				    $SQLGetTime->execute(array(
				        ':id' => $_SESSION['ID']
				    ));
				    $totalservers = $SQLGetTime->fetchColumn(0);
					?>
			 Your Limit:	<?php 	echo $totalservers+$aserv; ?>
                            </div>
							    <div class="form-group">
      <div class="col-xs-12">
          <div>
            <label for="method"><i class="fa fa-rss"></i> Network</label>
                              <select class="form-control" id="vip" name="vip">
          <option value="0">Regular</option>
          <option value="1">Premium</option>
          </select>
          </div>
      </div>
  </div>
  
  
                            <div class="form-group m-b-0">
                                <div class="col-sm-offset-3 col-sm-12">
									<button class="btn btn-success btn-sm btn-block waves-effect waves-light m-1" onclick="attack()" id="hit" type="button"> <i class="fa fa-bolt"></i> Send </button>
									
                                </div>
                            </div>
							
                        </form>
						
                        </ul>
                    </div>
                </div>
            </div>
			
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="si si-list"></i> Manage Attacks <i style="display: none;" id="manage" class="zmdi zmdi-settings zmdi-hc-spin"></i></h3>
                        <div class="card-options">
                            <button onclick="attacks()" class="btn btn-light"><i class="fa fa-refresh"></i> Refresh</button>
                        </div>
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
                    xmlhttp.open("GET", "complexx/hub.php?type=start" + "&host=" + host + "&port=" + port + "&time=" + time + "&method=" + method + "&totalservers=" + totalservers + "&vip=" + vip, true);
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
        </div>
    </div>
</main>
</div>
<!-- END Page Container -->
<?php include('footer.php'); ?>
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
