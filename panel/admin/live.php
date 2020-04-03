<?php

	/// Require the header that already contains the sidebar and top of the website and head body tags
	$page = "Live Attacks";
	session_start();
	include 'header.php'; 

	
	if (!($user -> LoggedIn()) || !($user -> notBanned($odb))){
		header('location: ../relogin.php');
		die();
	}
	
	if(!$user->isAdmin($odb)){
		header('location: ../logout.php');
		exit;
	}
	

?>
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
                
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
		 <div class="row">  
						<div class="col-lg-12" id="div" style="display:none"></div>
						
						
									     <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">STRESSER LIVE ATTACKS</h4>
                                    	   <div class="card">
                                <div class="card-header">
									<h3 class="card-title">
										MANAGE STRESSER ATTACKS
										<i style="display: none;" id="manage" class="fa fa-cog fa-spin"></i>
									</h3>
								</div>
                               <div class="block-content">
					
													<script type="text/javascript">
													var auto_refresh = setInterval(
													function ()
													{
													$('#live_servers').load('../complexx/admin/view.php').fadeIn("slow");
													}, 4000);
													</script>

					<div id="live_servers"></div>

					</div>

                            </div>
						
                            </div>
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
			}
			else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("attacksdiv").innerHTML = xmlhttp.responseText;
					document.getElementById("manage").style.display = "none";
					document.getElementById("attacksdiv").style.display = "inline-block";
					document.getElementById("attacksdiv").style.width = "100%";
					eval(document.getElementById("ajax").innerHTML);
				}
			}
			xmlhttp.open("GET","../complexx/admin/view.php",true);
			xmlhttp.send();
		}
		
		function stop(id) {
			document.getElementById("manage").style.display="inline"; 
			document.getElementById("div").style.display="none"; 
			var xmlhttp;
			if (window.XMLHttpRequest) {
				xmlhttp=new XMLHttpRequest();
			}
			else {
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
					document.getElementById("div").innerHTML=xmlhttp.responseText;
					document.getElementById("div").style.display="inline";
					document.getElementById("manage").style.display="none";
					if (xmlhttp.responseText.search("success") != -1) {
						attacks();
						window.setInterval(ping(host),10000);
					}
				}
			}
			xmlhttp.open("GET","../complexx/admin/stop.php?id=" + id, true);
			xmlhttp.send();
		}
		
		</script>
		
<?php include('footer.php'); ?>

