<?php
session_start();
$page = "Control";

include 'header.php';

$getUserInfo = $odb->query("SELECT * FROM `users` WHERE `ID` = '" . htmlentities($_GET['id']) . "'");
$userInfo = $getUserInfo->fetch(PDO::FETCH_BOTH);
?>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
       <div class="row">
	<!--   
	   <div class="col-md-6">
    <div class="collapse navbar-collapse remove-padding active show boxshadow">
        <div class="block-header block-header-default bg-gd-darkblue">
            <div class="block-title">
              <i class="fa fa-envelope"></i> Send message to all online users</div>
        </div>
		
        <div class="block-content" style="background-color: #1e2125ad">
				<div class="form-group">
                  <label for="example-nf-email">Message</label>
                  <textarea type="text" class="form-control" id="publicMessage" value="" name="publicMessage" style="background-color: #1e2125; border: 1px solid #2d3135;" rows="3"></textarea>
               </div>
			   
		</div>
    </div>
</div> -->

	  <div class="col-md-12 mt-20">
    <div class="collapse navbar-collapse remove-padding active show boxshadow">
        <div class="card-header block-header-default bg-gd-bluedark">
            <div class="card-title">
              <i class="fa fa-eye"></i> Manage online users
            </div>
			<small>
				<button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#Logs"><i class="fa fa-history"></i> Logs</button>
			</small>
        </div>
		<script type="text/javascript">
  var auto_refresh = setInterval(
  function ()
  {
    $('#onlineUsers').load('../complexx/onlines.php?key=QJfwprBKqQZK6Q8cX8brduR8K&action=getonlines').fadeIn("slow");
	$('#logs').load('../complexx/onlines.php?key=QJfwprBKqQZK6Q8cX8brduR8K&action=logs').fadeIn("slow");
  }, 15000);
</script>
        <div class="card-body" id="onlineUsers"></div>
    </div>
</div>

<div class="modal fade" id="Logs" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-dialog-popout modal-lg" role="document">
      <div class="modal-content">
         <div class="card">
            <div class="card-header">
              Users logs
              
            </div>
            <div class="card-body">
					<div id="logs"></div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="privatePopup" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-dialog-popout" role="document">
      <div class="modal-content">
         <div class="card">
            <div class="card-header">
             Send private message
            </div>
            <div class="card-body">
               <div id="ResponeHost"></div>
               <div class="form-group">
                  <label for="example-nf-email">Message</label>
                  <textarea type="text" class="form-control" id="privateMessage" value="" name="privateMessage" style="background-color: #1e2125; border: 1px solid #2d3135;" rows="5"></textarea>
               </div>
               <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-alt-warning" id="privateMessageBtn" onclick="sendMessage(1)"><i class="fa fa-plus"></i> Send message</button>
               </div>
               <br>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="sendMoney" tabindex="-1" role="dialog" aria-labelledby="modal-popout" style="display: none;" aria-hidden="true">
   <div class="modal-dialog modal-dialog-popout" role="document">
      <div class="modal-content">
         <div class="card">
            <div class="card-header">
              Send money to user
            </div>
            <div class="card-body">
               <div id="ResponeHost"></div>
               
<div class="form-group">
                  <label for="example-nf-email">Balance</label>
                  <input type="number" class="form-control" id="money" value="0" name="money" style="background-color: #1e2125; border: 1px solid #2d3135;">
               </div><div class="form-group">
                  <label for="example-nf-email">Message</label>
                  <textarea type="text" class="form-control" id="messageMoney" value="" name="messageMoney" style="background-color: #1e2125; border: 1px solid #2d3135;" rows="5"></textarea>
               </div>
               <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-outline-success" id="moneyBtn" onclick="sendMoney(0)"><i class="fa fa-plus"></i> Send money</button>
               </div>
               <br>
            </div>
         </div>
      </div>
   </div>
</div>


</div>
	   
    </div>
</main>

  <script>
                function kickUser(id) {
                    swal({
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-lg btn-alt-success m-5",
                        cancelButtonClass: "btn btn-lg btn-alt-danger m-5",
                        inputClass: "form-control",
                        title: "Are you sure?",
                        text: "Are you sure you want to kick this next user?",
                        type: "error",
                        showCancelButton: !0,
                        confirmButtonColor: "#d26a5c",
                        confirmButtonText: "Yes, kick!",
                        html: !1,
                        preConfirm: function() {
                            return new Promise(function(n) {
                                setTimeout(function() {
                                    n()
                                }, 50)
                            })
                        }
                    }).then(function(n) {
                        setTimeout(function() {
							if (window.XMLHttpRequest) {
								xmlhttp = new XMLHttpRequest();
							}
							else {
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp.onreadystatechange = function(){
								if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
									var Respone = xmlhttp.responseText
									if(Respone.indexOf("SUCCESS") >= 0) {
										swal("Success!", xmlhttp.responseText, "success")
									} else {
										swal("Error!", xmlhttp.responseText, "error")
									}
									}
								}
							
							xmlhttp.open("GET",'../complexx/onlines.php?key=QJfwprBKqQZK6Q8cX8brduR8K&action=kick&userid=' + id,true);
							xmlhttp.send();
                        }, 500)
                        
                    }, function(n) {})

                }
				
			function sendPrivateMessage(id) {
				var message = $("#privateMessage").val();
                    swal({
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-lg btn-alt-success m-5",
                        cancelButtonClass: "btn btn-lg btn-alt-danger m-5",
                        inputClass: "form-control",
                        title: "Are you sure?",
                        text: "Are you sure you want to send this private message to the next user?",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonColor: "#d26a5c",
                        confirmButtonText: "Yes, Send!",
                        html: !1,
                        preConfirm: function() {
                            return new Promise(function(n) {
                                setTimeout(function() {
                                    n()
                                }, 50)
                            })
                        }
                    }).then(function(n) {
                        setTimeout(function() {
							if (window.XMLHttpRequest) {
								xmlhttp = new XMLHttpRequest();
							}
							else {
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp.onreadystatechange = function(){
								if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
									var Respone = xmlhttp.responseText
									if(Respone.indexOf("SUCCESS") >= 0) {
										swal("Success!", xmlhttp.responseText, "success")
									} else {
										swal("Error!", xmlhttp.responseText, "error")
									}
									}
								}
							
							xmlhttp.open("POST",'../complexx/onlines.php?key=QJfwprBKqQZK6Q8cX8brduR8K&action=sendprivatemessage&userid=' + id,true);
							xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xmlhttp.send("message=" + message);
                        }, 500)
                        
                    }, function(n) {})

                }
				
				function sendMoney(id) {
				var message = $("#messageMoney").val();
				var money = $("#money").val();
                    swal({
                        buttonsStyling: !1,
                        confirmButtonClass: "btn btn-lg btn-alt-success m-5",
                        cancelButtonClass: "btn btn-lg btn-alt-danger m-5",
                        inputClass: "form-control",
                        title: "Are you sure?",
                        text: "Are you sure you want to add $" + money + " to the selected user?",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonColor: "#d26a5c",
                        confirmButtonText: "Yes, Add!",
                        html: !1,
                        preConfirm: function() {
                            return new Promise(function(n) {
                                setTimeout(function() {
                                    n()
                                }, 50)
                            })
                        }
                    }).then(function(n) {
                        setTimeout(function() {
							if (window.XMLHttpRequest) {
								xmlhttp = new XMLHttpRequest();
							}
							else {
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp.onreadystatechange = function(){
								if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
									var Respone = xmlhttp.responseText
									if(Respone.indexOf("SUCCESS") >= 0) {
										swal("Success!", xmlhttp.responseText, "success")
									} else {
										swal("Error!", xmlhttp.responseText, "error")
									}
									}
								}
							
							xmlhttp.open("POST",'../complexx/onlines.php?key=QJfwprBKqQZK6Q8cX8brduR8K&action=sendmoney&userid=' + id,true);
							xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xmlhttp.send("money=" + money + "&message=" + message);
                        }, 500)
                        
                    }, function(n) {})

                }
				
			 $('#onlineUsers').load('../complexx/onlines.php?key=QJfwprBKqQZK6Q8cX8brduR8K&action=getonlines').fadeIn("slow");
			 $('#logs').load('assets/system/onlines.php?key=QJfwprBKqQZK6Q8cX8brduR8K&action=logs').fadeIn("slow");
            </script>
			
    
    </div>
	<?php include('footer.php'); ?>
    </body>

    </html>