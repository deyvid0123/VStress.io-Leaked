<?php
	$page = "Api System";
	require_once 'header.php'; 
?>


<?php
	if(isset($_POST['gen_key'])){
		if(isset($_SESSION['username'])){
			genKey($_SESSION['username'], $odb);
			header('Location: api.php');
		}
	}
	if(isset($_POST['disable_key'])){
		if(isset($_SESSION['username'])){
			disableKey($_SESSION['username'], $odb);
			header('Location: api.php');
		}
	}

	function genKey($username, $odb){
		$newkey = generateRandomString(16);
		$stmt2 = $odb->query("UPDATE users SET apikey='$newkey' WHERE username='$username'");
	}
	function disableKey($username, $odb){
		$stmt2 = $odb->query("UPDATE users SET apikey='0' WHERE username='$username'");
	}
	function generateRandomString($length = 10){
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for($i=0;$i<$length;$i++){
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	$stmt = $odb->prepare("SELECT apikey FROM users WHERE username=:login");
	$stmt->bindParam("login", $_SESSION['username'], PDO::PARAM_STR);
	$stmt->execute();
	$key = $stmt->fetchColumn(0);
?>

  <!-- Page Content -->
		
    <div class="container-fluid">
      <!-- .row -->

      <!--/.row -->
      <!-- .row -->
	  <div class="widget-content">

</div> 
          <div class="white-box">
		  	<h3 class="box-title">Api URL</h3>
		  	<form method="POST">
		  		<?php if($key == '0'){?>
	            <input class="form-control" type="text" value="API is unavailable or api-key is disabled! Click 'Generate new api-key'." readonly="" style="color:black;">
	            <?php }else{?>
				<?php if($user->api($odb)){?>
				<?php if($user->isVip($odb)){?>
	            <input class="form-control" type="text" value="https://vstress.io/client/api/api.php?key=<?php echo $key;?>&host=[ip]&port=[port]&time=[Seconds]&method=[Method/stop]&vip=[1=on/0=off]" readonly="" style="color:black;">
	            <?php }else{?>
				<input class="form-control" type="text" value="https://vstress.io/client/api/api.php?key=<?php echo $key;?>&host=[ip]&port=[port]&time=[Seconds]&method=[Method/stop]&vip=0" readonly="" style="color:black;">
				<?php }?>
				<?php }else{?>
				<input class="form-control" type="text" value="You need api access for use this!" readonly="" style="color:black;">
				<?php }?>
				<?php }?>
	            <br><button type="submit" class="btn btn-primary" name="gen_key">Generate new api-key</button> <button type="submit" class="btn btn-danger" name="disable_key">Disable api-key</button>
	        </form>
          </div>
		  <br><br>
		  <div id="faq6" role="tablist" aria-multiselectable="true">
		  <div class="card ">
		<div class="card-header" role="tab" id="faq6_h1">
			<a class="font-w600 text-body-color-dark" data-toggle="collapse" data-parent="#faq6" href="#faq6_q1" aria-expanded="true" aria-controls="faq6_q1"><i class="fa fa-arrow-down"></i> Available methods?</a>
		</div>
		<div id="faq6_q1" class="collapse" role="tabpanel" aria-labelledby="faq6_h1">
			<div class="card-body">
							
							<p>For use vip methods you need vip access!</p>
							<?php if($user->api($odb)){?>
				<code style="color:black;">
				<br>
				<p color= "red">Layer 4<br></p>
				<p>

New Methods add Soon!!<br>
		
				</p>
				
				<p>Layer 7<br></p>
				<p>
				
<br>	
		</p>			
				
				</code>
				<?php }else{?>
				<code style="color:black;">
				<br>
				You need api access to use this!<br>
					
				<?php }?>
				</code>
				
			</div>
		</div>
	</div>
	</div>
		  
<div id="faq1" role="tablist" aria-multiselectable="true">
	<div class="card">
		<div class="card-header" role="tab" id="faq1_h1">
			<a class="font-w600 text-body-color-dark" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1"><i class="fa fa-arrow-down"></i> For what is an API?</a>
		</div>
		<div id="faq1_q1" class="collapse" role="tabpanel" aria-labelledby="faq1_h1">
			<div class="card-body border-t">
				<p>You can use for your website, stresser or what you want</p>
			</div>
		</div>
	</div>
	</div>
	<div id="faq2" role="tablist" aria-multiselectable="true">
	<div class="card">
		<div class="card-header" role="tab" id="faq2_h1">
			<a class="font-w600 text-body-color-dark" data-toggle="collapse" data-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq23_q1"><i class="fa fa-arrow-down"></i> How to use the API </a>
		</div>
		<div id="faq2_q1" class="collapse" role="tabpanel" aria-labelledby="faq2_h1">
			<div class="card-body border-t">
			<?php if($user->api($odb)){?>
				<p>Send</p>
				<p>
				<code style="color:black;">
				Examples:<br>
				https://vstress.io/api/api.php?key=[KEY]&host=[IPv4]&port=[PORT]&time=[SECONDS]&method=[METHOD/STOP]&totalservers=[SERVERS]&vip=[1 or 0]<br>
				https://vstress.io/api/api.php?key=[KEY]&host=0.0.0.0&port=80&time=30&method=NTP&totalservers=1&vip=0<br>
				</code>
				</p>
				<p>Stop</p>
				<p>
				<code style="color:black;">
				Examples:<br>
				https://vstress.io//api/api.php?key=[KEY]&host=[IPv4]&port=[PORT]&time=[SECONDS]&method=stop<br>
				https://vstress.io//api/api.php?key=[KEY]&host=0.0.0.0&port=80&time=30&method=stop&totalservers=1&vip=0<br>
				</code>
				
				<p>Example Using php Curl</p>
				<code style="color:black;">
				<br>
				  			    $apiurl = 'https://vstress.io/client/api/apiaexample.php?key=xxxxxxxxxxxxxx&host='. $host .'&port='. $port .'&time='. $time .'&method='. $method .'&totalservers='. $totalservers .'&vip=0';<br>
			<br>
                                            $ch = curl_init();<br>
                                            curl_setopt($ch, CURLOPT_URL, $apiurl);<br>
                                            curl_setopt($ch, CURLOPT_HEADER, false);<br>
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);<br>
                                            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);<br>
                                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);<br>
                                            $data = curl_exec($ch);<br>
                                            curl_close($ch);<br>
					echo $data;<br>
				</code>
				</p>
				<p>Note!</p>
				<p>
				<code style="color:black;">
				Replace [KEY] with an API-key which you can generate upper.<br>
				You can use vip=1 only if you are VIP.<br>
				if you have some troubles to implement the api, contact admins
				</code>
				</p>
				<?php }else{?>
				<code style="color:black;">
				You need api acess to use this!
				
				
				</code>
				<?php }?>
				
			</div>
		</div>
	</div>
</div>
<br><br><br>
<br>
<br>
<br>
<br>



<?php

	require_once 'footer.php';
	
?>
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