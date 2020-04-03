<?php 

 
session_start();
$page = "Faq";
include 'header.php';
    $runningrip = $odb->query("SELECT COUNT(*) FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0")->fetchColumn(0);
	$slotsx = $odb->query("SELECT COUNT(*) FROM `api` WHERE `slots`")->fetchColumn(0);
	$load    = round($runningrip / $slotsx * 100, 2);
		
?>


    <div class="container-fluid">
	
<div class="card">
<div class="card-header">
<h3 class="card-title">
<strong>1.</strong> Introduction
</h3>
<div class="card-options">

</div>
</div>
<div class="card-body">
<div id="faq1" role="tablist" aria-multiselectable="true">
<div class="card ">
<div class="card-header" role="tab" id="faq1_h1">
<a class="font-w600 text-body-color-dark" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">1.1 Welcome to vStress</a>
</div>
<div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1">
<div class="card-body">
<p>In vStress you can do stress tests on your own sites, Attack your enemies websites, Routers, Any network connection, Just for a low prices.
vStress has a special features like a Intellegence console system, Safety is important to us, Your data are completley encrypted!</p>
</div>
</div>
</div>
<div class="card">
<div class="card-header" role="tab" id="faq1_h3">
<a class="font-w600 text-body-color-dark" data-toggle="collapse" data-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">1.3 What are our values?</a>
</div>
<div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3">
<div class="card-body">
<p>Our values can be found at the Store page, If your'e looking for the available payment methods, You can find it right down below...</p>
</div>
</div>
</div>
<div class="card">
<div class="card-header" role="tab" id="faq1_h4">
<a class="font-w600 text-body-color-dark" data-toggle="collapse" data-parent="#faq1" href="#faq1_q4" aria-expanded="true" aria-controls="faq1_q4">1.4 What are our future plans?</a>
</div>
<div id="faq1_q4" class="collapse" role="tabpanel" aria-labelledby="faq1_h4">
<div class="card-body ">
<p>Better Methods Bypass, News Servers...</p>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-header ">
<h3 class="card-title">
<strong>2.</strong> Functionality
</h3>
<div class="card-options">

</div>
</div>
<div class="card-body">
<div id="faq2" role="tablist" aria-multiselectable="true">
<div class="card">
<div class="card-header" role="tab" id="faq2_h1">
<a class="font-w600 text-body-color-dark collapsed" data-toggle="collapse" data-parent="#faq2" href="#faq2_q1" aria-expanded="false" aria-controls="faq2_q1">What are the special features?</a>
</div>
<div id="faq2_q1" class="collapse" role="tabpanel" aria-labelledby="faq2_h1" style="">
<div class="block-content border-t">
<p>In normal stresser sites you may find the basics stuff like : Tools, Panel, Pretty home page, And the rest of thos..., But here vStress offers you <b>Special</b> features:</p>
<ul class="fa-ul list-li-push-sm">
<li>
<i class="fa fa-check fa-li"></i> Console Control
</li>
<li>
<i class="fa fa-check fa-li"></i> APi Access
</li>
<li>
<i class="fa fa-check fa-li"></i> High-Level user Management
</li>
<li>
<i class="fa fa-check fa-li"></i> High-Level Security
</li>
<li>
<i class="fa fa-check fa-li"></i> Transfer Money!
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-header">
<h3 class="card-title">
<strong>3.</strong> Payments
</h3>
<div class="card-options">

</div>
</div>
<div class="card-body">
<div id="faq3" role="tablist" aria-multiselectable="true">
<div class="card">
<div class="card-header" role="tab" id="faq3_h1">
<a class="font-w600 text-body-color-dark" href="purchase.php">What are the available plans?</a>
</div>
</div>
</div>
<div class="card">
<div class="card-header" role="tab" id="faq3_h2">
<a class="font-w600 text-body-color-dark collapsed" data-toggle="collapse" data-parent="#faq3" href="#faq3_q2" aria-expanded="false" aria-controls="faq3_q2">What are the available withdrawal options?</a>
</div>
<div id="faq3_q2" class="collapse" role="tabpanel" aria-labelledby="faq3_h2" style="">
<div class="card-body">
<div class="row">
<div class="col-md-6">
<a class="card" href="addbalance.php">
<div class="card-body ">
<i class="fa fa-paypal fa-2x"></i>
</div>
<div class="card-body">
<div class="font-w600 mb-5">Paypal</div>
<div class="font-size-sm text-muted">+10$</div>
</div>
</a>
</div>
<div class="col-md-6">
<a class="card" href="addbalance.php">
<div class="card-body">
<i class="fa fa-btc fa-2x"></i>
</div>
<div class="card-body">
<div class="font-w600 mb-5">Bitcoin</div>
<div class="font-size-sm text-muted">+10 $</div>
</div>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

 <!-- END Page Container -->
<?php include('footer.php'); ?>
