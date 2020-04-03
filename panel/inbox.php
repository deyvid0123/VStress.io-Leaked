<?php 

session_start();
$page = "Inbox";
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
	<div id="newticketalert" style="display:none"></div>
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Inbox</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">vStress</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mail Inbox</li>
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
                <a href="compose.php" class="btn btn-white btn-block">New Ticket</a>
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
            <div class="row">
                <div class="col-lg-8">
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group mr-1">
                            
                            <button type="button" class="btn btn-light waves-effect waves-light" onclick="updateTickets()"><i class="fa fa-refresh"></i></button>
                            
                        </div>
                       
                        
                        
                        

                    </div>

                </div>

               


            </div> <!-- End row -->
            
            <div class="card mt-3 shadow-none">
                <div class="card-body">
                    <div class="table-responsive">
					
                        <table class="table table-hover">
						 <table class="table table-borderless table-striped table-vcenter remove-margin">
									          <thead>
                                        <tr><th>Subject</th>
                                            <th>Department</th>
											<th>Priority</th>
                                            
											<th>Status</th>
                                            <th>System</th>
                                            <th>Date</th>
                                        
                                           
                                        </tr>
                                    </thead>
                            <tbody id="ticketsdiv"> </tbody>
                        </table>
                    </div>
                    
                    <hr>
                  
                
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
<br><br><br>
<br>
<br>
<br>
<br>
 <!-- END Page Container -->
<?php include('footer.php'); ?>
	
</body>
</html>
