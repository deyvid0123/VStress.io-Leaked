<?php
	
	ob_start();
	require_once '../../complex/configuration.php';
	require_once '../../complex/init.php';
	
	if (!($user -> LoggedIn()) || !($user -> notBanned($odb)) || !isset($_SERVER['HTTP_REFERER'])){
		die(error('Error :v ask RiPxSystems'));
	}

		   
	$SQLGetMessages = $odb -> prepare("SELECT * FROM `messages` WHERE `ticketid` = :ticketid ORDER BY `messageid` ASC");
	$SQLGetMessages -> execute(array(':ticketid' => $_GET['id']));
	while ($show = $SQLGetMessages -> fetch(PDO::FETCH_ASSOC)){
		$class = "";
		if($show['sender'] == "Admin"){
			$class = 'class="blockquote-reverse"';
			$username = 'Administrator';
		}
		if ($user -> safeString($show['content'])){
							echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> Unsafe characters were set</span>
			</div></div>';
die();
		}
		echo '
			<blockquote '. $class .'>
				<h5>'. htmlentities($show['content']).'</h5>
				<footer><span class="badge badge-primary"> '. $show['sender'] .' </span> [ '. date('d-m-Y h:i:s a', $show['date']) .' ]</footer>
			</blockquote>
		';
	}
	
?>