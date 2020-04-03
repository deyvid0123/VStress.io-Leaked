<?php
 // By netsource.pw
session_start();
$page = "Compose";
include 'header.php';



$status = "Waiting for user response";
$SQLGetTickets = $odb -> prepare("SELECT COUNT(*) FROM `tickets` WHERE `username` = :username AND `status` = :status");
        $SQLGetTickets -> execute(array(':username' => $_SESSION['username'], ':status' => $status));
        $active = $SQLGetTickets -> fetchColumn(0);
		
		$status = "Waiting for admin response";
$SQLGetTickets = $odb -> prepare("SELECT COUNT(*) FROM `tickets` WHERE `username` = :username AND `status` = :status");
        $SQLGetTickets -> execute(array(':username' => $_SESSION['username'], ':status' => $status));
        $sended = $SQLGetTickets -> fetchColumn(0);
		
				$status = "Waiting for admin response";
$SQLGetTickets = $odb -> prepare("SELECT COUNT(*) FROM `tickets` WHERE `username` = :username");
        $SQLGetTickets -> execute(array(':username' => $_SESSION['username']));
        $total = $SQLGetTickets -> fetchColumn(0);
			?>

    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Mail Compose</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">vStress</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Compose</li>
         </ol>
	   </div>
	  
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
           <div class="card-body">

        <div class="row">
        
            <!-- Left sidebar -->
            <div class="col-lg-3 col-md-4">
                <a href="inbox.php" class="btn btn-white btn-block">Return to inbox</a>
                <div class="card mt-3 shadow-none">
                        <div class="list-group shadow-none">
                          <a href="javascript:void();" class="list-group-item bg-light-dark"><i class="fa fa-inbox mr-2"></i>Answered<b>(<?php echo $active ?>)</b> <b></b></a>
                         
                          <a href="javascript:void();" class="list-group-item"><i class="fa fa-paper-plane-o mr-2"></i>Sended<b>(<?php echo $sended ?>)</b></a>
                          <a href="javascript:void();" class="list-group-item"><i class="fa fa-trash-o mr-2"></i>Total tickets <b>(<?php echo $total ?>)</b></a>
                         
                         
                        </div>
                </div>

                
            </div>
            <!-- End Left sidebar -->
                    
        <!-- Right Sidebar -->
        <div class="col-lg-9 col-md-8">
            
            <div class="card mt-3 shadow-none">
                <div class="card-body">
				<div id="newticketalert" style="display:none"></div>
                    <form>
                        <div class="form-group">
                            <input class="form-control" type="text" id="subject">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                
                              	
                                <div class="col-md-6">
                                    <div>
                                        <label for="department"><i class="si si-energy text-danger"></i> department</label>
                                        <select class="form-control" id="department" name="department">
                                                <option value="1">Choose a Department</option>
                                                <option value="Billing">Billing</option>
                                                <option value="General">General</option>
                                                <option value="Tech">Tech</option>
                                                <option value="Other">Other</option> 
                                        </select>
                                    </div>
                                </div>
                            
                            
                              
                                <div class="col-md-6">
                                    <div>
                                        <label for="priority"><i class="si si-energy text-danger"></i> priority</label>
                                        <select class="form-control" id="priority" name="priority">
                                               <option value="2">Choose a Priority</option>
                                               <option value="Low">Low</option>
                                               <option value="Medium">Medium</option>
                                               <option value="High">High</option>
                                        </select>
                                   
                                </div>
                            </div>
                            </div>
                        </div>
                       
                        <div class="form-group">
						
                            <textarea class="form-control" id="message" name="message" placeholder="Enter your message.." style="height: 200px"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-light btn-block waves-effect waves-light m-1" onclick="submitTicket()"><i class="fa fa-floppy-o mr-1"></i> Send</button>
                           
                        </div>
                    </form>
                </div> <!-- card body -->
             </div> <!-- card -->
           </div> <!-- end Col-9 -->
         </div><!-- End row -->
      </div>
    </div>
  </div>
 </div><!-- End row -->

    </div>
    <!-- End container-fluid-->
    
   </div><!--End content-wrapper-->
  
  
  
  
  <script>
function updateTickets()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("ticketsdiv").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","complexx/support.php?type=update",true);
xmlhttp.send();
}

window.setInterval(function(){updateTickets();}, 30000);
updateTickets();


function submitTicket()
{
var subject=$('#subject').val();
var message=$('#message').val();
var department=$('#department').val();
var ppp=$('#priority').val();

document.getElementById("newticketalert").style.display="none";
//document.getElementById("newticketloader").style.display="inline";
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("newticketalert").innerHTML=xmlhttp.responseText;
	//document.getElementById("newticketloader").style.display="none";
	document.getElementById("newticketalert").style.display="inline";
	if (xmlhttp.responseText.search("Ticket has been created.") != -1)
	{
	updateTickets();
    }
    }
  }
xmlhttp.open("POST","complexx/support.php?type=submit",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("message=" + message + "&subject=" + subject + "&department=" + department + "&ppp=" + ppp);
}
</script>
 <!-- END Page Container -->
<?php include('footer.php'); ?>
      
	
</body>
</html>
