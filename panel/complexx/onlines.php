<?php
	if (!isset($_SERVER['HTTP_REFERER'])){
		die();
	}
	
	    // By Complex
  
session_start();
	require '../complex/configuration.php';
    require '../complex/init.php';
	
	if($_GET['key'] !== 'QJfwprBKqQZK6Q8cX8brduR8K') {
		die();
	}
	if($_GET['action'] == 'getonlines') {
		echo '<table class="table table-bordered table-striped table-vcenter js-dataTable-full">
									<thead>
									<tr>
									<th class="text-center" style="width: 50px;">#</th>
									<th class="text-center" style="width: 50px;">Username</th>
									<th class="text-center" style="width: 50px;">IP</th>
									<th class="text-center" style="width: 50px;">Last activity</th>
									<th class="text-center" style="width: 10px;"></th>
									</tr>
									</thead>
									<tbody>';
								
									$checkOnlines = $odb->query("SELECT * FROM `users` WHERE UNIX_TIMESTAMP(NOW()) - `activity` < 30");
									while($row = $checkOnlines->fetch(PDO::FETCH_BOTH)){
											echo '<tr>
											<td class="text-center"><bb class="badge" style="background: #00000024;">' . $row['ID'] . '</bb></td>
											<td class="text-center"><span class="text-center badge badge-danger">' . $row['username'] . '</span></td>
											<td class="text-center">' . $row['lastip']. '</td>
											<td class="text-center">' . date('m/d/y - h:i', $row['activity']). '</td>
											<td class="text-center">
											<button type="button" class="btn btn-sm btn-outline-danger" onclick="kickUser(' . $row['ID'] . ')"><i class="fa fa-sign-out"></i> Kick</button>
											<button type="button" class="btn btn-sm btn-outline-warning" onclick="$(\'#privateMessageBtn\').attr(\'onclick\', \'sendPrivateMessage(' . $row['ID'] . ')\')" data-toggle="modal" data-target="#privatePopup"><i class="fa fa-user-secret"></i> Private popup</button>
											<button type="button" class="btn btn-sm btn-outline-success" onclick="$(\'#moneyBtn\').attr(\'onclick\', \'sendMoney(' . $row['ID'] . ')\')"  data-toggle="modal" data-target="#sendMoney"><i class="fa fa-money"></i> Popup balance</button>
											</td>
											</tr>';
									}
									echo '
									</tbody>
									</table>';
	} elseif($_GET['action'] == 'kick') {
		$SQLInsert = $odb -> prepare("INSERT INTO `remotecontrol`(`userid`,`info`) VALUES (:userid,:info)");
		$SQLInsert -> execute(array(':userid' => htmlentities($_GET['userid']),':info' => '{"action":"kick","done":0}'));
		die(success("User has been kicked from the system!"));
	} elseif($_GET['action'] == 'sendprivatemessage') {
		if(empty($_POST['message'])) {
			die(error("Please fill in all fields"));
		} else {
		$SQLInsert = $odb -> prepare("INSERT INTO `remotecontrol`(`userid`,`info`) VALUES (:userid,:info)");
		$SQLInsert -> execute(array(':userid' => htmlentities($_GET['userid']),':info' => '{"action":"private_message","message":"' . $_POST['message'] . '","done":0}'));
		die(success("The message has been sent to the user!"));
		}
	} elseif($_GET['action'] == 'sendmoney') {
		if(empty($_POST['message']) || empty($_POST['money'])) {
			die(error("Please fill in all fields"));
		} else {
			if($_POST['money'] < 1) {
				die(error("Minimum send is $1!"));
			} else {
				$SQLInsert = $odb -> prepare("INSERT INTO `remotecontrol`(`userid`,`info`) VALUES (:userid,:info)");
				$SQLInsert -> execute(array(':userid' => htmlentities($_GET['userid']),':info' => '{"action":"receive_money","money":' . $_POST['money'] . ',"message":"' . $_POST['message'] . '","done":0}'));
				die(success("The money has been sent to the user!"));
			}
		}
	} elseif($_GET['action'] == 'logs') {
		echo '<table class="table table-bordered table-striped table-vcenter js-dataTable-full">
									<thead>
									<tr>
									<th class="text-center">#</th>
									<th class="text-center">Username</th>
									<th class="text-center">Info</th>
									</tr>
									</thead>
									<tbody>';
									
			$checkOnlines = $odb->query("SELECT * FROM `remotecontrol` WHERE `info` NOT LIKE '%transfer_money%' AND `info` NOT LIKE '%discord_resolver%' ORDER BY `id` DESC LIMIT 25");
			while($row = $checkOnlines->fetch(PDO::FETCH_BOTH)){
				$getUsername = $odb->query("SELECT `username` FROM `users` WHERE `ID` = '" . $row['userid'] . "'");
				$username = $getUsername -> fetchColumn(0);
				
				$info = json_decode($row['info'], true);
				if($info["done"] == "1") {
					$info["done"] = '<span class="badge badge-success">Done.</span>';
				} else {
					$info["done"] = '<span class="badge badge-danger">Not yet.</span>';
				}
			
				if($info["action"] == "kick") {
					$info = 'Got <span class="badge badge-primary">Kicked</span>, Request accepted by client: ' . $info["done"];
				} elseif($info["action"] == "private_message") {
					$info = 'Got <span class="badge badge-primary">private message</span>, Request accepted by client: ' . $info["done"];
				} elseif($info["action"] == "receive_money") {
					$info = 'Got <bb class="text-success">$' . $info["money"] . '</bb> by the <span class="badge badge-primary">receive money system</span>, Request accepted by client: ' . $info["done"];
				}
			echo '<tr>
											<td class="text-center"><bb class="badge" style="background: #00000024;">' . $row['userid'] . '</bb></td>
											<td class="text-center"><span class="text-center badge badge-danger">' . $username . '</span></td>
											<td class="text-center">' . $info. '</td>
											</tr>';								
			}
	}
	?>