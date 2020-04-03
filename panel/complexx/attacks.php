<?php

    // Bt Complex
  
	ob_start(); 
	require '../complex/configuration.php';
     require '../complex/init.php';

	if (!($user->LoggedIn()) || !($user->notBanned($odb)) || !(isset($_SERVER['HTTP_REFERER']))) {
		die();
	}
	
	$username = $_SESSION['username'];

?>
<div class="table-responsive">	
<table class="table table table-borderless table-vcenter">
	<thead>
   
        <tr>
  
		         <th class="text-center"> ID</th>
            <th class="text-center"> Target</th>
            <th class="text-center"> Method</th>
			<th class="text-center"> Concurrents</th>				
            <th class="text-center">Expires</th>
			<th class="text-center"> Action</th>

        </tr>
    </thead>
    <tbody>
<?php

    $SQLSelect = $odb->query("SELECT * FROM `logs` WHERE user='{$_SESSION['username']}' AND `stopped` = 0 AND `time` + `date` > UNIX_TIMESTAMP()  ORDER BY `id` DESC LIMIT 10");

    while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {

        $ip = $show['ip'];
        $port = $show['port'];
        $time = $show['time'];
        $method = $odb->query("SELECT `fullname` FROM `methods` WHERE `name` = '{$show['method']}' LIMIT 10")->fetchColumn(0);
        $rowID = $show['id'];
        $date = $show['date'];
		$totalservers = $show['totalservers'];
		$vip = $show['vip']; 
		if($vip == 0)
		{
		$vip = "Normal";
		}elseif($vip == 1)
		{
		$vip = "ViP";
		}else
		{
		 $vip = "Error!"; 
		}
		 
        $expires = $date + $time - time();

        if ($expires < 0 || $show['stopped'] != 0) {
            $countdown = '<span"></i> Expired</span>';
        }
		else {
            $countdown = '<div id="a' . $rowID . '"></div>';
            echo "
				<script id='ajax'>
					var count={$expires};
					var counter=setInterval(a{$rowID}, 1000);
					function a{$rowID}(){
						count=count-1;
						if (count <= 0){
							clearInterval(counter);
							attacks();
							return;

						}
					document.getElementById('a{$rowID}').innerHTML=count;
					}
				</script>
			";
        }
		
		
        if ($show['time'] + $show['date'] > time() and $show['stopped'] != 1) {
            $action = '<button type="button" onmousedown="bleep2.play()" onclick="stop(' . $rowID . ')" id="st" class="btn btn-danger waves-effect waves-light m-b-5"><i class="fa fa-power-off"></i> Stop</button>';
        } else {
            $action = '<button type="button" id="rere" onmousedown="bleep4.play()" onclick="renew(' . $rowID . ')" class="btn btn-primary waves-effect  waves-light m-b-5"><i class="fa fa-refresh"></i> Renew</button>';
        }
		
        echo '<tr class="text-center">
	    <td><span class="badge">' . $rowID . '</span></td>
	    <td><span class="badge">' . htmlspecialchars($ip) . ' </span></td>		
		<td><span class="badge">' . $method . '</span> </td>
		
		 <td><span class="badge">' . $totalservers . '</span></td>
		<td style="font-size: 15px;" class="text-center">' . $countdown . '</td>
		<td style="font-size: 13px;" class="text-center">' . $action . '</td>
	
		</tr>
		';

    }
?>
	</tbody>
	
</table>
</div>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
</html>