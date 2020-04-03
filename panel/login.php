<?php 
         ob_start();
	     require_once 'complex/configuration.php';
	     require_once 'complex/init.php';
		 
         if ($user -> LoggedIn()){
		 header('Location: home.php');
		 exit;
	     }


/*if(!empty($_COOKIE['ddos_key']))
    {
            end();
    }
    else 
        {

    header('Location: verify.php');

    }*/
	
	unset($_SESSION['captcha']);
$_SESSION['captcha'] = rand(1, 100);
$x1 = rand(2,10);
$x2 = rand(1,5);
$x = SHA1(($x1 + $x2).$_SESSION['captcha']);

?>

<?php
       
         if (isset($_GET['session'])){
if($_GET['session'] == "rip"){

    echo '
	<div class="alert alert-icon-warning alert-dismissible mb-0" role="alert">
		   <button type="button" class="close" data-dismiss="alert">&times;</button>
			<div class="alert-icon icon-part-warning">
			 <i class="fa fa-exclamation-triangle"></i>
			</div>
			<div class="alert-message">
			  <span><strong>Warning:</strong> Session Token Expired!</span>
			</div>
		  </div>
	';

                }
            }

			
            ?>
			 <?php
			
			// activate the account
//if ($type && preg_match('/activate/i', $type) && !empty($_REQUEST['actcode'])) {
        if (!empty($_REQUEST['actcode'])) {
            $activation = $odb->prepare("SELECT ID, activation FROM users WHERE activation_code = :actcode");
            $activation->execute(array(':actcode' => $_REQUEST['actcode']));
            $result    = $activation->fetch(PDO::FETCH_ASSOC);
            $uid       = $result['ID'];
            $act_value = $result['activation'];
            if (empty($uid)) {
        // the details needs to be logged
                die(error('We encounter an error. Please try again later.'));
            } else if ($act_value == 0) {
                $updatesql = $odb->prepare("UPDATE users SET activation = ? WHERE ID = ? AND activation_code = ?");
                $updatesql->execute(array(1, $uid, $_REQUEST['actcode']));
                $mesg = 'Your account hase been activated!!. Please continue to login';
				echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: true,
  type: "success",
  title: "Success, Account activated!",
  showConfirmButton: false,
  timer: 4500
})';
  echo ' }, 1000);</script>';
        
            } else {
				echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  position: "top-end",
  toast: true,
  type: "info",
  title: "Your account hase been activated!! already",
  showConfirmButton: false,
  timer: 4500
})';
  echo ' }, 1000);</script>';
               
            }

        }
		
			if(empty($_COOKIE['theme']))
    {
		$SQLC = $odb->prepare("SELECT `theme` FROM `settings` LIMIT 1");
					$SQLC -> execute();
                    $themee = $SQLC -> fetchColumn(0);
            $theme = $themee;
    }
else
{
            $theme = $_COOKIE['theme'];;
    }	
	
	

        ?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content="netsource.pw - We here at netsource.pw which has been up and running since 2020, pride in it to be the leading legal IP stresser on the market available. We provide desirable features like triple layer (layers 3,4 and 7) protection and all work is finalized from a custom source. We provide our services by the means of Private, Custom or Modded methods. Payment for our users is not a hassle due to the fact that we use Private Payment Bots with enhanced security.">
  <meta name="author" content="Complex"/>
   <meta name="keywords" content="ddos, ddos tool, IP Stresser, Booter, Stresser, Online Booter, best booter, stresserclub, netsource.pw, cheap booter, ip booter, strongest streser, ddos online, best stresser, free stresser, free booter, club source, stresser club source, netsource.pw source, stresserclub source, high booter, high stresser, ovh down, skype resolver, Check hosting power, Botnet, Layer3, Layer4, Layer7, Ampfilection, Raw, Spoofed spoofing">
         
  <title>netsource.pw - Login</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body style="
	  background: url(assets/images/textures/back.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
	">
<script>
    var answer="<?php echo $x; ?>";
</script>

<!-- Start wrapper-->
 <div id="wrapper">

 <div class="height-100v d-flex align-items-center justify-content-center">
	<div class="card card-authentication1 mb-0">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 	<img src="assets/images/favicon.png" alt="logo icon" height="70" class="animated flipInX">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Sign In</div>
		    <div id="alert" style="display:none"></div>
			  <div class="form-group">
			  <label for="exampleInputUsername" class="sr-only">Username</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="username" class="form-control input-shadow" placeholder="Enter your Username">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			  <label for="exampleInputPassword" class="sr-only">Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="password" class="form-control input-shadow"  placeholder="Enter Your Password">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			  <label for="exampleInputPassword" class="sr-only">Captcha</label>
			   <div class="position-relative has-icon-right">
				 <input type="text" class="form-control" id="question" placeholder="<?php echo ' '.$x1.'+'.$x2.'?'; ?>">
				  <div class="form-control-position">
					  <i class="fa fa-question"></i>
				  </div>
			   </div>
			  </div>
			<div class="form-row">
			 <div class="form-group col-6">
			   <div class="icheck-material-primary">
                <input type="checkbox" value="on" id="hideme" />
                <label for="hideme">Hide My name</label>
			  </div>
			 </div>
			 <div class="form-group col-6 text-right">
			  <a href="#">Reset Password</a>
			 </div>
			</div>
			<div id="hidebtn" >
			 <button type="button" class="btn btn-primary btn-block" id="login" onclick="login()">Sign In</button>
			</div>
			<div  id="loader" style="display:none" >
			 <button type="button" class="btn btn-primary btn-block" id="login" onclick="login()">Please Wait <i class="fa fa-spinner fa-spin"></i></button>
			</div>
			
			 
			
		   </div>
		  </div>
		  <div class="card-footer text-center py-3">
		    <p class="text-dark mb-0">Do not have an account? <a href="register.php"> Sign Up here</a></p>
		  </div>
	     </div>
	 </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css"/>
	
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  <script>


function login()
{
swal({
  position: 'top-end',
  toast: true,
  type: 'info',
  title: 'Cheking Login Parameters..',
  showConfirmButton: false,
  timer: 2500
  
});
var user=$('#username').val();
var password=$('#password').val();
 let hideme = $('#hideme:checked').val();
 var question=$('#question').val();

            if (hideme === undefined) {
                hideme = 'off';
            }
document.getElementById("alert").style.display="none";
document.getElementById("loader").style.display="inline";
document.getElementById("hidebtn").style.display="none";
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
    document.getElementById("alert").innerHTML=xmlhttp.responseText;
	document.getElementById("loader").style.display="none";
	document.getElementById("alert").style.display="inline";
  document.getElementById("hidebtn").style.display="inline";
	if (xmlhttp.responseText.search("Login Successful") !== -1)
	{
				swal({
  position: 'top-end',
  toast: true,
  type: 'success',
  title: 'Signed in successfully!',
  showConfirmButton: false,
  timer: 2500
  
});

	setInterval(function(){window.location="home.php"},3000);
    }
    }
  }
xmlhttp.open("POST","complexx/login.php?type=login",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("user=" + user + "&password=" + password + "&hideme=" + hideme + "&question=" + question + "&answer=" + answer);
}
</script>
<script src="assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="assets/node_modules/sweetalert2/dist/sweetalert2.min.css">
   <script src="assets/toastr/toastr.min.js"></script>
</body>
</html>
