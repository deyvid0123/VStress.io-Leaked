<?php 

   // By Complex
session_start();
$page = "News";
include 'header.php';


	if (isset($_POST['deletenews']) && is_numeric($_POST['deletenews'])){
		$delete = $_POST['deletenews'];
		$SQL = $odb -> query("DELETE FROM `news` WHERE `ID` = '$delete'");
		$notify = success('News has been removed');
	}

	if (isset($_POST['addnews'])){
		
		if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['icon'])){
			$notify = error('Please verify all fields');
		}
		elseif($user->safeString($_POST['content']) || $user->safeString($_POST['title']) || $user->safeString($_POST['icon']) || $user->safeString($_POST['color'])){
			$notify = error('Unsafe characters set');
		}
		else{
			$SQLinsert = $odb -> prepare("INSERT INTO `news` VALUES(NULL, :color, :icon, :title, :content, UNIX_TIMESTAMP())");
			$SQLinsert -> execute(array(':color' => $_POST['color'], ':icon' => $_POST['icon'], ':title' => $_POST['title'], ':content' => $_POST['content']));
			$notify = success('News has been added');
		}
	}
	
?>
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
                
  <?php if (isset($error)) { echo $error; }elseif(isset($notify)) { echo $notify; } ?>
<div class="row">
<div class="col-lg-6">
<div class="card">
<div class="card-header bg-gd-primary">
<h3 style="color: white;" class="card-title"><i class="fa fa-bullhorn"></i> Latest News</h3>
</div>
<div class="card-body">
				<form class="form-horizontal push-10-t" method="post">
							<div class="form-group">
								<div class="col-sm-12">
									<div class="form-material">
										<input class="form-control" type="text" id="title" name="title">
										<label for="title">Title</label>
									</div>
								</div>
							</div> 
							<div class="form-group">
								<div class="col-sm-12">
									<div class="form-material">
										<textarea class="form-control" type="text" id="content" rows="5" name="content"></textarea>
										<label for="content">Content</label>
									</div>
								</div>
							</div>

						


	                                      <div class="form-group">
                                            <div class="col-sm-12">
												 <label for="icon">icon</label>
                                                    <select class="form-control" id="icon" name="icon" size="1">
                                            <option value="fa fa-check">Tick</option>
											<option value="fa fa-rocket">Rocket</option>
											<option value="fa fa-bolt">Bolt</option>
											<option value="fa fa-server">Servers</option>
											<option value="fa fa-space-shuttle">Space</option>
											<option value="fa fa-fighter-jet">Fighter Jet</option>
											<option value="fa fa-paypal">PayPal</option>
											<option value="fa fa-btc">Btc</option>
											<option value="fa fa-close">Cross</option>
                                                    </select>
                                            </div>
                                        </div>
										
							<div class="form-group">
                                            <div class="col-sm-12">
												 <label for="color">Color</label>
                                                    <select class="form-control" id="color" name="color" size="1">
                                                      <option value="gradient-redmist">Rojo</option>
											<option value="gradient-steelgray">Gris</option>
											<option value="gradient-deepblue">Azul</option>
											<option value="gradient-yoda">Morado</option>
											<option value="gradient-ibiza">Warning</option>
                                                    </select>
                                            </div>
                                        </div>
										
				
							<div class="form-group">
								<div class="col-sm-9">
									<button name="addnews" value="do" class="btn btn-sm btn-primary" type="submit">Submit</button>
								</div>
							</div>
						</form>
</div>
</div>
</div>


    <div class="col-md-6">
    <div class="card">
<div class="card-header">
                <h3 class="card-title"><i class="fa fa-history"></i>Actual News</h3>

            </div>
            <div class="card-body">
			<div class="table-responsive">
    	                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable no-footer">
						<thead>
							<tr>
							    <th style="font-size: 13px;">Icon + Color</th>
								<th style="font-size: 13px;">Color</th>
								<th style="font-size: 13px;">Icon</th>
								<th style="font-size: 13px;">Title</th>
								<th style="font-size: 13px;">Date</th>
								<th class="text-center" style="font-size: 13px;">Delete</th>
							</tr>
						</thead>
						<tbody>
							<form method="post">
							<?php 
							$SQLGetNews = $odb -> query("SELECT * FROM `news` ORDER BY `date` DESC");
							while ($getInfo = $SQLGetNews -> fetch(PDO::FETCH_ASSOC)){
								$id = $getInfo['ID'];
								$color = $getInfo['color'];
								$icon = $getInfo['icon'];
								$color = $getInfo['color'];
							    $icon = $getInfo['icon'];
								$title = $getInfo['title'];
								$date = date("m-d-Y, h:i:s a" ,$getInfo['date']);
								echo '<tr>
								        <tr>
	                                    <td><i style=" top: 8px; left: 10px; color: #fff; text-align: center;border-radius: 10px" class="btn '. $icon .' '. $color .' "></i></td>
										<td style="font-size: 13px;">'.htmlspecialchars($color).'</td>
										<td style="font-size: 13px;">'.htmlspecialchars($icon).'</td>
										<td style="font-size: 13px;">'.htmlspecialchars($title).'</td>
										<td style="font-size: 13px;">'.$date.'</td>
										<td class="text-center"><button name="deletenews" value="'.$id.'"class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></td>
									  </tr>';
							}
							?>
							</form>
						</tbody>                                       
                    </table>
            </div>
			</div>
			
        </div>
    </div>

</div>
    </div>

</div>
</div>

</div>
</div>

<!-- END Main Container -->
        </div>
    </main>
	
<script>
	SendPop = setTimeout(function(){
		document.getElementById('modal-popout').click();
		clearTimeout(SendPop);
	}, 2500);
</script>
<script>
	SendPop = setTimeout(function(){
		document.getElementById('modal-popGift').click();
		clearTimeout(SendPop);
	}, 5000);
</script>

</div>
 <!-- END Page Container -->
<?php include('footer.php'); ?>
      <script type="text/javascript">
 !function($) {
	"use strict";

	var VectorMap = function() {
	};

	VectorMap.prototype.init = function() {
		//various examples
				  $('#world-mapx').vectorMap(
{
    map: 'world_mill_en',
    backgroundColor: 'transparent',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    zoomOnScroll: false,
    color: '#353C48',
    regionStyle : {
        initial : {
          fill : '#1583ea'
        }
      },
    markerStyle: {
      initial: {
                    r: 9,
                    'fill': '#fff',
                    'fill-opacity':1,
                    'stroke': '#000',
                    'stroke-width' : 5,
                    'stroke-opacity': 0.4
                },
                },
    enableZoom: true,
    hoverColor: '#009efb',
    markers : [
 <?php
            $SQLSelect = $odb->query("SELECT `ip` FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 ORDER BY `id` DESC");
            while ($show = $SQLSelect->fetch(PDO::FETCH_ASSOC)) {
                $ipAttack = $show['ip'];


                if (!filter_var($ipAttack, FILTER_VALIDATE_IP) === false) {

                $geolocation = ip2geolocation($ipAttack);
                $geolocation->latitude;
                $geolocation->longitude;
                $geolocation->longitude;
                $ipOctets = explode('.', $ipAttack);
                $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }
                else
                {
                    // remove http://
                    $url = preg_replace('#^https?://#', '', $ipAttack);
                    $url = preg_replace('#^http?://#', '', $ipAttack);

                    $ipnew = gethostbyname($url);
                    $geolocation = ip2geolocation($ipnew);
                    $geolocation->latitude;
                    $geolocation->longitude;
                    $geolocation->longitude;

                    $ipOctets = explode('.', $ipnew);
                    $ipnew = $ipOctets[0] . '.' . $ipOctets[1] . '.' . preg_replace('/./', '*', $ipOctets[2]) . '.' . preg_replace('/./', '*', $ipOctets[3]);

                }




                echo  "{latLng: [".$geolocation->latitude.", ".$geolocation->longitude."], name: '".$ipnew."'},\n";
            }

          ?>

            {latLng: [, ], name: ''}
            ]
		});


		$('#uk').vectorMap({
			map : 'uk_mill_en',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});

		$('#usa').vectorMap({
			map : 'us_aea_en',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});


		$('#australia').vectorMap({
			map : 'au_mill',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});
		
		
		$('#canada').vectorMap({
			map : 'ca_lcc',
			backgroundColor : 'transparent',
			regionStyle : {
				initial : {
					fill : '#71b6f9'
				}
			}
		});
		

	},
	//init
	$.VectorMap = new VectorMap, $.VectorMap.Constructor =
	VectorMap
}(window.jQuery),

//initializing
function($) {
	"use strict";
	$.VectorMap.init()
}(window.jQuery);
</script> 
