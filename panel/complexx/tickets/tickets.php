<?php
	if (!isset($_SERVER['HTTP_REFERER'])){
		die;
	}
	
	ob_start();
	require_once '../../complex/configuration.php';
	require_once '../../complex/init.php';

	if (!empty($maintaince)){
		die();
	}

	if (!($user -> LoggedIn()) || !($user -> notBanned($odb))){
		die();
	}
    $id = anti_injection($_GET['id']);
	
	if(is_numeric($id) == false) {
		header('Location: inbox.php');
		exit;
	}

	if (empty($id)){
		echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong> You need to enter a reply</span>
			</div></div>';
die();
	}
	
	if ($user -> safeString($id)){
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
        $error = "ComplexIsThebest";
	}
    if(empty($error)){
	$SQLGetMessages = $odb -> prepare("SELECT * FROM `messages` WHERE `ticketid` = :ticketid ORDER BY `messageid` ASC");
	$SQLGetMessages -> execute(array(':ticketid' => $id));

	while ($show = $SQLGetMessages -> fetch(PDO::FETCH_ASSOC)){
		$class = "";
		if($show['sender'] == "Admin"){

			$class = 'class="blockquote-reverse"';

			$username = 'Administrator';

		}
		echo '

			<blockquote '. $class .'>

				<h5>'. $show['content'] .'</h5>

				<footer>'. $show['sender'] .' [ '. date('d-m-Y h:i:s a', $show['date']) .' ]</footer>

			</blockquote>

		';

	}
	}

	

?>