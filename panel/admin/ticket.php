<?php 

   // By Complex
session_start();
$page = "Ticket";
include 'header.php';


	if(is_numeric($_GET['id']) == false) {
		header('Location: home.php');
		exit;
	}
	
	$SQLCount = $odb -> query("SELECT COUNT(*) FROM `tickets` WHERE `id` = '{$_GET['id']}'");
	if($SQLCount->fetchColumn(0) == 0){
		header('Location: home.php');
		exit;
	}
	
	$SQLGetTickets = $odb -> query("SELECT * FROM `tickets` WHERE `id` = {$_GET['id']}");
	while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC)){
		$username = $getInfo['username'];
    $subject = $getInfo['subject'];
    $status = $getInfo['status'];
    $department = $getInfo['department'];
     $priority = $getInfo['priority'];
     $original = $getInfo['content'];
		$date = date("m-d-Y, h:i:s a" ,$getInfo['time']);
	}
	
	

?>
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
       <div class="row">  
						<div class="col-lg-12" id="div"></div>
						
						
						
						
						
						
						
						
						
						<div class="col-lg-6">

                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title"><i class="fa fa-comments"></i> <span class="badge" style="background: linear-gradient(135deg, #262f38 0, #42a5f5 100%)!important;">Subject: <?php echo htmlentities($subject); ?>  </span>
						<span class="badge badge-danger"><strong> Department:</strong> <?php echo htmlentities($department); ?></span>
						<span class="badge badge-warning"><strong> Priority:</strong> <?php echo htmlentities($priority); ?></span>
						<span class="badge badge-success"><strong> Status:</strong> <?php echo htmlspecialchars($status); ?></span>
						<span class="badge badge-primary"><strong> User:</strong> <?php echo htmlentities($username); ?></span>
      </h3>

                    </div>
                     <div class="card-body">
					<blockquote class="blockquote-reverse">
										<h5><?php echo htmlentities($original); ?></h5>
										<footer><?php echo $username . ' [ ' . $date . ' ]'; ?></footer>
									</blockquote>
													<script type="text/javascript">
													var auto_refresh = setInterval(
													function ()
													{
													$('#live_servers').load('tickets/view.php?id=<?php echo $_GET['id']; ?>').fadeIn("slow");
													}, 1000);
													</script>

					<div id="live_servers"></div>

					</div>

                </div>

            </div>
					
			<div class="col-lg-6">
                <div class="card">
                 <div class="card-body">    
                    
                    <div class="card">

                    <div class="card-header ">
                      <h3 class="card-title"><i class="fa fa-mail-reply"></i> Post a reply
                        <i style="display: none;" id="image" class="fa fa-cog fa-spin"></i>
                         </h3>
                        </div>
                                <div class="card-body">
									<form class="form-horizontal push-10-t push-10" action="base_forms_premade.html" method="post" onsubmit="return false;">
										<div class="form-group">
											<div class="col-xs-12">
												<div class="form-material floating">
													<textarea class="form-control" id="reply" rows="8"></textarea>
													<label for="reply">Your reply</label>
												</div>
											</div>
										</div>                         
                                        <div class="form-group">
                                            <div class="col-xs-12 text-center">                                             
												<button class="btn btn-sm btn-success" onclick="doReply()">
													<i class="fa fa-plus push-5-r"></i> Reply to ticket
												</button>
												<button class="btn btn-sm btn-danger" onclick="doClose()">
													<i class="fa fa-ban push-5-r"></i> Close ticket
												</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>  

                            
						
                            </div>
                        </div>
                    </div>
                    </div>     
    </div>
<script>		
			view();
			
			function view(){
				var xmlhttp;
				if (window.XMLHttpRequest) {
					xmlhttp=new XMLHttpRequest();
				}
				else {
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function() {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						document.getElementById("response").innerHTML=xmlhttp.responseText;
					}
				}
				xmlhttp.open("GET","tickets/view.php?id=<?php echo $_GET['id']; ?>",true);
				xmlhttp.send();
			}
			
			function doClose(){
				document.getElementById("image").style.display="inline"; 
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
						document.getElementById("image").style.display="none";
					}
				}
				xmlhttp.open("GET","tickets/close.php?id=<?php echo $_GET['id']; ?>",true);
				xmlhttp.send();
			}
				
			function doReply() {
				var reply=$('#reply').val();
				document.getElementById("image").style.display="inline"; 
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
						document.getElementById("image").style.display="none";
						if (xmlhttp.responseText.search("SUCCESS") != -1) {
							view();
						}
					}
				}
				xmlhttp.open("GET","tickets/reply.php?id=<?php echo $_GET['id']; ?>" + "&message=" + reply,true);
				xmlhttp.send();
			}
			
			</script>
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

