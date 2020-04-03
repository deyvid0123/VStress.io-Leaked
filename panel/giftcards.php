<?php

	/// Require the header that already contains the sidebar and top of the website and head body tags By complex
	$page = "GiftCards";
	require_once 'header.php'; 

	
	/// Querys for the stats below

?>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Info box -->
                <!-- ============================================================== -->
      <div class="row">  
										    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              
                                   <h3 style="color: white;" class="card-title">Membership Codes</h3>
                                    <div class="ml-auto">
                                        
                                    </div>
                                </div>
							<div class="card-content">
                     	<form class="form-horizontal" method="post" onsubmit="return false;"><div id="div"></div>
              <div class="form-group">
                <label for="GiftCode" class="col-sm-3 control-label">GiftCode</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="code" id="code" placeholder="XXXXXX">
                </div>
				<br>
				 <div class="form-group m-b-0">
                <div class="col-sm-offset-12 col-sm-12">
                  <button  id="launch" onclick="redeemCode()" class="btn btn-light waves-effect waves-light m-1">Redeem Code</button>
                </div>
              </div>
              </div>
           
            </form>
</div>             
			 </div>
                        </div>
						
						
									
						
                    </div>	
					
			
			<script>
function redeemCode() {
	            launch.disabled = true;
				var code = $('#code').val();
Swal.fire({
		buttonsStyling: !1,
                confirmButtonClass: "btn btn-success waves-effect waves-light m-1",
                cancelButtonClass: "btn btn-danger waves-effect waves-light m-1",
                inputClass: "form-control",
                    title: "Are you sure?",
                    text: "Are you sure you want to check giftcard:  " + code + "?",
                    type: "warning",
				
                    showCancelButton: !0,
                    confirmButtonColor: "#d26a5c",
                    confirmButtonText: "Yes",
                    html: !1,
                    preConfirm: function() {
                        return new Promise(function(n) {
                            setTimeout(function() {
                                n()
                            }, 50)
                        })
                    }
                }).then(function(n) {
			//document.getElementById("icon").style.display="inline"; 
				var xmlhttp;
				if (window.XMLHttpRequest) {
					xmlhttp=new XMLHttpRequest();
				}
				else {
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function() {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						launch.disabled = false;
					//document.getElementById("icon").style.display="none";
					     document.getElementById("div").innerHTML=xmlhttp.responseText;
						if (xmlhttp.responseText.search("SUCCESS") != -1) {
							inbox();
						}
					}
				}
				xmlhttp.open("GET","complexx/redeem.php?user=<?php echo $_SESSION['ID']; ?>" + "&code=" + code,true);
				xmlhttp.send();
				}, function(n) {})
			}
			</script>
			
						<script>
function redeemCode2() {
	            launch.disabled = true;
				var code = $('#code').val();
swal.fire({
		buttonsStyling: !1,
                confirmButtonClass: "btn btn-lg btn-alt-success m-5",
                cancelButtonClass: "btn btn-lg btn-alt-danger m-5",
                inputClass: "form-control",
                    title: "Are you sure?",
                    text: "Are you sure you want to check giftcard:  " + code + "?",
                    type: "warning",
				
                    showCancelButton: !0,
                    confirmButtonColor: "#d26a5c",
                    confirmButtonText: "Yes",
                    html: !1,
                    preConfirm: function() {
                        return new Promise(function(n) {
                            setTimeout(function() {
                                n()
                            }, 50)
                        })
                    }
                }).then(function(n) {
			//document.getElementById("icon").style.display="inline"; 
				var xmlhttp;
				if (window.XMLHttpRequest) {
					xmlhttp=new XMLHttpRequest();
				}
				else {
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function() {
					if (xmlhttp.readyState==4 && xmlhttp.status==200) {
						launch.disabled = false;
					//document.getElementById("icon").style.display="none";
					     document.getElementById("div").innerHTML=xmlhttp.responseText;
						if (xmlhttp.responseText.search("SUCCESS") != -1) {
							inbox();
						}
					}
				}
				xmlhttp.open("GET","complexx/redeem2.php?user=<?php echo $_SESSION['ID']; ?>" + "&code=" + code,true);
				xmlhttp.send();
				}, function(n) {})
			}
			</script>

	
                    </div>    
		
                        </div>
						 </main>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
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