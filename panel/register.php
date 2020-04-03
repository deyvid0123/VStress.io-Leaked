<?php 
         ob_start();
	     require_once 'complex/configuration.php';
	     require_once 'complex/init.php';
		 
         if ($user -> LoggedIn()){
		 header('Location: home.php');
		 exit;
	     }
		 
               //Set IP (are you using cloudflare?)
	if ($cloudflare_set == 1){
		$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	else{
		$ip = $_SERVER["REMOTE_ADDR"];
	}
		 
unset($_SESSION['captcha']);
$_SESSION['captcha'] = rand(1, 100);
$x1 = rand(2,15);
$x2 = rand(1,20);
$x = SHA1(($x1 + $x2).$_SESSION['captcha']);
 
			//VPN Detection  			

/* $apiurl = 'https://www.ipqualityscore.com/api/json/ip/yx3K0H8IoNTqtGO7oGfNr4ntbp53fnkP/'. $ip;
			
           # api with curl
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, $apiurl);
                                            curl_setopt($ch, CURLOPT_HEADER, false);
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
                                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                                            $data = curl_exec($ch);
                                            curl_close($ch);
   
  $getInfo = json_decode($data, true); 
  $resul = $getInfo['vpn'];
  $true = 'true'; */

		//VPN Detection end

//DDoS Protection start
/*if(!empty($_COOKIE['ddos_key']))
    {
            end();
    }
    else 
        {

    header('Location: verify.php');

    } */
//End

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
   <meta name="description" content="vStress.io - We here at vStress.io which has been up and running since 2020, pride in it to be the leading legal IP stresser on the market available. We provide desirable features like triple layer (layers 3,4 and 7) protection and all work is finalized from a custom source. We provide our services by the means of Private, Custom or Modded methods. Payment for our users is not a hassle due to the fact that we use Private Payment Bots with enhanced security.">
  <meta name="author" content="Complex"/>
   <meta name="keywords" content="ddos, ddos tool, IP Stresser, Booter, Stresser, Online Booter, best booter, stresserclub, vStress.io, cheap booter, ip booter, strongest streser, ddos online, best stresser, free stresser, free booter, club source, stresser club source, vStress.io source, stresserclub source, high booter, high stresser, ovh down, skype resolver, Check hosting power, Botnet, Layer3, Layer4, Layer7, Ampfilection, Raw, Spoofed spoofing">
    <title>Netsource.pw | Register</title>
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
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  
</head>
<script>
    var answer="<?php echo $x; ?>";
</script>
<body style="
	  background: url(assets/images/textures/back.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
	">



<!-- Start wrapper-->
 <div id="wrapper">
<div class="card card-authentication1 mx-auto my-4">
<div class="card-body">
<div class="card-content p-2">
<div class="text-center">
	

<img src="assets/images/favicon.png" alt="logo icon" height="70" class="animated flipInX">
</div>
<div class="card-title text-uppercase text-center py-3">Sign Up<img id="registerimage" style="display:none" /></div>
<form class="form-horizontal form-material" id="regsiterform">
<div id="alert" style="display:none"></div>
<div class="form-group">
<div class="form-material floating">

<input type="text" id="username" class="form-control" placeholder="Username">
</div>
</div>
<div class="form-group">
<div class="form-material floating">

<input type="text" id="email" class="form-control" placeholder="Email">
</div>
</div>
<div class="form-group">
<div class="form-material floating">

 <input type="password" id="password" class="form-control" placeholder="Password">
</div>
</div>
<div class="form-group">
<div class="form-material floating">

 <input type="password" id="rpassword" class="form-control" placeholder="Verify Password">
</div>
</div>

<div class="form-group">

<div class="form-material floating">
 <input type="text" class="form-control" id="question" placeholder="<?php echo ' '.$x1.'+'.$x2.'?'; ?>">
          
</div>

</div>

<div class="form-group">
<div class="icheck-material-primary">
<input type="checkbox" id="terms" value="yes" checked="" />
<label for="terms">I Agree With <a data-toggle="modal" data-target="#myModal" role="button" style="text-decoration:none; color:white;">TOS</a></label>
</div>
</div>

</form>


<div id="hidebtn" >
<button class="btn btn-primary btn-block" id="register" onclick="register()">
<i class="si si-login mr-10"></i> Create account
</button>
</div>
	<div class="col-12 mb-10">
<div id="loader" style="display:none">
<button class="btn btn-primary btn-block" id="login2" onclick="register2()">
<i class="si si-login mr-10"></i> please wait...<i class="fa fa-spinner fa-spin "></i>
</button>
</div>
</div>
</div>
</div>
<div class="card-footer text-center py-3">
<p class="text-warning mb-0">Already have an account? <a href="login.php"> Sign In here</a></p>
</div>
</div>

	
</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
  <script>
function register()
{
var username=$('#username').val();
var email=$('#email').val();
var password=$('#password').val();
var rpassword=$('#rpassword').val();
var question=$('#question').val();

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
  if (xmlhttp.responseText.search("Registered Successfully!!") != -1)
  {
	  				swal({
  position: 'top-end',
  toast: true,
  type: 'success',
  title: 'Registered successfully!',
  showConfirmButton: false,
  timer: 2500
  
});

    }
    }
  }
xmlhttp.open("POST","complexx/login.php?type=register",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("username=" + username + "&email=" + email + "&password=" + password + "&rpassword=" + rpassword + "&question=" + question + "&answer=" + answer);
}
</script>
<script src="assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="assets/node_modules/sweetalert2/dist/sweetalert2.min.css">
   <script src="assets/toastr/toastr.min.js"></script>
		 
  
</body>
</html>
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
