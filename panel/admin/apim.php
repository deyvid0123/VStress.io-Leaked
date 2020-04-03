<?php 
session_start();
$page = "API";
include 'header.php';

if (isset($_POST['delete'])){
	
	if($_SESSION['username'] == "netsource"){								
		}elseif($_SESSION['username'] == "Jimmy"){
		}else{
		$error = error('only authorized users can see and edit the methods');
		}
		if (empty($error)){
		$delete = $_POST['delete'];
		$SQL = $odb -> prepare("DELETE FROM `methods` WHERE `id` = :id");
		$SQL -> execute(array(':id' => $delete));
		$notify = success('The method has been deleted');
	}
	}
	
	if (isset($_POST['addmethod'])){
		if (empty($_POST['name']) || empty($_POST['fullname']) || empty($_POST['type']) || empty($_POST['vip']) ){
			$notify = error('Please verify all fields');
		}
		else{
			$name = $_POST['name'];
			$fullname = $_POST['fullname'];
			$type = $_POST['type'];
			$vip = $_POST['vip'];
			$SQLinsert = $odb -> prepare("INSERT INTO `methods` VALUES(NULL, :name, :fullname, :type, :vip)");
			$SQLinsert -> execute(array(':name' => $name, ':fullname' => $fullname, ':type' => $type, ':vip' => $vip));
			$notify = success('Method has been added Boiiii');
		}
	}	
	
	// API/Server 
	if (isset($_POST['deleteapi'])){
		
		if($_SESSION['username'] == "netsource"){								
		}else{
		$error = error('only authorized users can see and edit can the apis');
		}
									
		if (empty($error)){
		$delete = $_POST['deleteapi'];
		$SQL = $odb -> prepare("DELETE FROM `api` WHERE `id` = :id");
		$SQL -> execute(array(':id' => $delete));
		$notify = success('API has been removed');
		}
	
	}
	
	if (isset($_POST['onlineapi'])){
		$status = $_POST['onlineapi'];
		$SQL = $odb -> prepare("UPDATE `api` SET `status`='1' WHERE `id` = :id");
		$SQL -> execute(array(':id' => $status));
		$notify = success('Online Api Success');
	}
	
    if (isset($_POST['offlineapi'])){
		$status = $_POST['offlineapi'];
		$SQL = $odb -> prepare("UPDATE `api` SET `status`='0' WHERE `id` = :id");
		$SQL -> execute(array(':id' => $status));
		$notify = success('Offline Api Success');
	}
	
	if (isset($_POST['deleteserver'])){
		$delete = $_POST['deleteserver'];
		$SQL = $odb -> prepare("DELETE FROM `servers` WHERE `id` = :id");
		$SQL -> execute(array(':id' => $delete));
		$notify = success('Server has been removed');
	}
	
	if (isset($_POST['addapi'])){
		
		if (empty($_POST['api']) || empty($_POST['name']) || empty($_POST['money']) || empty($_POST['methods'])){
			$error = error('Please verify all fields');
		}
		
		$api = $_POST['api'];
		$name = $_POST['name'];
		$slots = $_POST['money'];
		$vip = $_POST['vip'];
		$status = $_POST['status'];
		$methods = implode(" ",$_POST['methods']);
		
		if (!(is_numeric($slots))){
			$error = error('Slots field has to be numeric');
		}
		
$parameters = array("[host]", "[port]", "[time]", "[method]");
		foreach ($parameters as $parameter){
			if (strpos($api,$parameter) == false){
				$error = 'Could not find parameter "'.$parameter.'"';
			}
		}
			
		if (empty($error)){
			$SQLinsert = $odb -> prepare("INSERT INTO `api` VALUES(NULL, :name, :api, :slots, :methods, :vip, :status, :lastUsed, :lastip)");
			$SQLinsert -> execute(array(':api' => $api, ':name' => $name, ':slots' => $slots, ':methods' => $methods, ':vip' => $vip, ':status' => $status, ':lastUsed' => '0', ':lastip' => '1.2.3.4'));
			$notify = success('API has been added');
		}
		else{
			$notify = error($error);
		}
	}	
?>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
<?php if (isset($error)) { echo $error; }elseif(isset($notify)) { echo $notify; } ?>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header">
<h3 style="color: white;" class="card-title"><i class="fa fa-bolt"></i> API</h3>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable no-footer" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">Name</th>
                                            <th>#ID</th>
											<th>API URL</th>
                                            <th>Slots</th>
											<th>Network</th>
                                            <th>Methods</th>
                                            <th>Status</th>
											<th>turn off api</th>
											<th>turn on api</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                   <tr>
<form method="post">
							<?php
								$SQLGetMethods = $odb -> query("SELECT * FROM `api`");
								while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC)){
									 $id = $getInfo['id'];
									 $api = $getInfo['api'];
									 $name = $getInfo['name'];
									 $slots = $getInfo['slots'];
									 $methods = $getInfo['methods'];
									 $status = $getInfo['status'];
									 $vip = $getInfo['vip'];
									
									if($vip == "0")
									{
										$vip = '<button type="button" class="btn btn-outline btn-danger btn-circle"><i class="fa fa-times"></i> </button>';
									}
									elseif($vip == "1")
									{
										$vip = '<button type="button" class="btn btn-outline btn-success btn-circle"><i class="fa fa-check"></i> </button>';
									}
									else
									{
										$vip = '<button type="button" class="btn btn-outline btn-primary btn-circle"><i class="fa fa-bolt"></i> </button>';
									}
									    if($status == "0")
									{
										$status = '<b style="font-size:19pt;color:orange;"><i class="fa fa-exclamation-triangle"></i></b>';
									}
									
							        if($status == "1")
									{
										$status = '<b style="font-size:19pt;color:green;"><i class="fa fa-signal"></i></b>';
									}
									
									if($_SESSION['username'] == "netsource"){
										
								     $apisecurity = ' '.htmlspecialchars($api).' ';
									
									
									
									
									
									
									}else {
								    $apisecurity = ' <span class="badge badge-danger">only Authorized users can see api links</span> ';
									
									}
									 echo '<tr>
									           <td style="font-size: 12px;"><span class="badge">'.($id).'</span></td>
												<td zstyle="font-size: 12px;"><strong><span class="badge">'.htmlspecialchars($name).'</span></strong></td>
												<td style="font-size: 12px;" width="20%">'.$apisecurity.'</td>
												<td style="font-size: 12px;">'.htmlspecialchars($slots).'</td>
												<td style="font-size: 12px;">'.($vip).'</td>
												<td style="font-size: 12px;">'.htmlspecialchars($methods).'</td>z
												<td>'.$status.'</td>
												<td style="font-size: 12px;"><button type="submit" title="Offline Api" name="offlineapi" value="'.htmlspecialchars($id).'" class="btn btn-success"><i class="fa fa-ban"></i></button></td>
												<td style="font-size: 12px;"><button type="submit" title="Online Api" name="onlineapi" value="'.htmlspecialchars($id).'" class="btn btn-primary"><i class="fa fa-bolt"></i></button></td>
												<td style="font-size: 12px;"><button type="submit" title="Delete API" name="deleteapi" value="'.htmlspecialchars($id).'" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td>
											</tr>';
								}
							?>
							</form>
                                 </tr>
            </table></div></div></div></div>
			

		
		<div class="col-md-6" data-select2-id="9">
            <form class="form-horizontal push-10-t" method="post">
                <div class="card" data-select2-id="7">
                    <div class="card-header ">
                        <h3 class="card-title"> Add Api</h3>
                        <div class="card-options">
                            <button type="submit" name="addapi" value="do" class="btn btn-sm btn-light">
                                <i class="fa fa-save mr-5"></i>Save
                            </button>
                        </div>
                    </div>
                    <div class="card-body" data-select2-id="6">
             
                                <div class="form-group">
								<div class="col-sm-12">
									<div class="form-material">
									<label for="name">Api Name</label>z
										<input class="form-control" type="text" id="name" name="name" placeholder="Api Name">
										
									</div>
								</div>
							</div> 
							<div class="form-group">
								<div class="col-sm-12">
									<div class="form-material">
									<label for="api">API LINK</label>
										<input class="form-control" type="text" id="api" name="api" placeholder="http://stfu-skid.com/api.php?key=keyhere&target=[host]&port=[port]&time=[time]&method=[method]">
									</div>
								</div>
							    </div>z
							    <div class="form-group">
								<div class="col-sm-12">
                                <label class="control-label">Slots </label>
                                <input id="money" type="text" value="1" name="money" data-bts-min="1" data-bts-max="150" data-bts-init-val="" data-bts-step="1" data-bts-decimal="0" data-bts-step-interval="100" data-bts-force-step-divisibility="round" data-bts-step-interval-delay="500" data-bts-prefix="" data-bts-postfix="" data-bts-prefix-extra-class="" data-bts-postfix-extra-class="" data-bts-booster="true" data-bts-boostat="10" data-bts-max-boosted-step="false" data-bts-mousewheel="true" data-bts-button-down-class="btn btn-primary btn-trans waves-effect w-md waves-info m-b-5" data-bts-button-up-class="btn btn-success"> 
                                </div> </div>
								<div class="form-group">
								<div class="col-sm-12">
									<div class="form-material">
									<label for="methods">Layer 4 Methods</label>
										<select class="form-control" id="methods" name="methods[]" size="6" multiple>
											<?php
											$SQLGetMethods = $odb -> query("SELECT * FROM `methods` WHERE `type` = 'layer4' ORDER BY `id` ASC");
											while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC)){
												$name = $getInfo['name'];
												echo '<option value="'.$name.'">'.$name.'</option>';
											}
											?>
										</select>
										
									</div>	<div class="form-material">
									<label for="methods">Layer 7 Methods</label>
										<select class="form-control" id="methods" name="methods[]" size="6" multiple>
											<?php
											$SQLGetMethods = $odb -> query("SELECT * FROM `methods` WHERE `type` = 'layer7' ORDER BY `id` ASC");
											while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC)){
												$name = $getInfo['name'];
												echo '<option value="'.$name.'">'.$name.'</option>';
											}
											?>
										</select>
										
									</div>
									
						            <br>
									<div class="form-material">
									<label for="methods">Botnet Methods</label>
										<select class="form-control" id="methods" name="methods[]" size="6" multiple>
											<?php
											$SQLGetMethods = $odb -> query("SELECT * FROM `methods` WHERE `type` = 'botnet' ORDER BY `id` ASC");
											while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC)){
												$name = $getInfo['name'];
												echo '<option value="'.$name.'">'.$name.'</option>';
											}
											?>
										</select>
										
									</div>
									
									<div class="form-material">
									<label for="methods">L7 BYPASS</label>
										<select class="form-control" id="methods" name="methods[]" size="6" multiple>
											<?php
											$SQLGetMethods = $odb -> query("SELECT * FROM `methods` WHERE `type` = 'by7' ORDER BY `id` ASC");
											while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC)){
												$name = $getInfo['name'];
												echo '<option value="'.$name.'">'.$name.'</option>';
											}
											?>
										</select>
										
									</div>
									
									<div class="form-material">
									<label for="methods">L4 BYPASS</label>
										<select class="form-control" id="methods" name="methods[]" size="6" multiple>
											<?php
											$SQLGetMethods = $odb -> query("SELECT * FROM `methods` WHERE `type` = 'by4' ORDER BY `id` ASC");
											while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC)){
												$name = $getInfo['name'];
												echo '<option value="'.$name.'">'.$name.'</option>';
											}
											?>
										</select>
										
									</div>
									
								
									
								</div>
							</div>
							<div class="form-group">
                                            <div class="col-sm-12">
												 <label for="vip">Network</label>
                                                    <select class="form-control" id="vip" name="vip" size="1">
                                                        <option value="0">Normal</option>
									              	    <option value="1">ViP</option>
											            
                                                    </select>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <div class="col-sm-12">
												 <label for="status">Status</label>
                                                    <select class="form-control" id="status" name="status" size="1">
                                                        <option value="1">Online</option>
									              	    <option value="0">Offline</option>
														<option value="2">Maintence</option>
                                                    </select>
                                            </div>
                                        </div>
                    </div>
                </div>
            </form>
        </div>
		<div class="col-lg-6">
<div class="card">
<div class="card-header">
<h3 style="color: white;" class="card-title"><i class="fa fa-bolt"></i> API</h3>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered table-striped table-vcenter js-dataTable-full dataTable no-footer" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">Name</th>
                                            <th class="text-center" style="width: 50px;">Tag</th>
											<center><th  style="width: 20px;">Delete</th></center>
                                        </tr>
                                    </thead>
                                   <tr>
<form method="post">
						<?php
								$SQLGetMethods = $odb -> query("SELECT * FROM `methods`");
								while($getInfo = $SQLGetMethods -> fetch(PDO::FETCH_ASSOC)){
									$id = $getInfo['id'];
									$name = $getInfo['name'];
									$fullname = $getInfo['fullname'];
									$type = $getInfo['type'];
									echo '<tr>
											<td style="font-size: 12px;">'.htmlspecialchars($name).'</td>
											<td style="font-size: 12px;">'.htmlspecialchars($fullname).'</td>
											<td style="font-size: 12px;"><button name="delete" value="'.$id.'" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></td>
										</tr>';
								}
								if(empty($SQLGetMethods)){
									echo error('No methods');
								}
								?>
							</form>
                                 </tr>
            </table></div></div></div></div>
			
			
			
			
			<div class="col-md-6" data-select2-id="9">
            <form class="form-horizontal push-10-t" method="post">
                <div class="card" data-select2-id="7">
                    <div class="card-header">
                        <h3 class="card-title">New Method</h3>
                        <div class="card-options">
                            <button type="submit" name="addmethod" value="do" class="btn btn-light">
                                <i class="fa fa-save mr-5"></i>Save
                            </button>
                        </div>
                    </div>
                    <div class="card-body" data-select2-id="6">
             
                                       <div class="form-group">
								<div class="col-sm-12">
									<div class="form-material">
									<label for="name">Name</label>
										<input class="form-control" type="text" id="name" name="name" placeholder="Hub Name">
										
									</div>
								</div>
							</div> 
							<div class="form-group">
								<div class="col-sm-12">
									<div class="form-material">
									<label for="fname">Tag Name</label>
										<input class="form-control" type="text" id="fname" name="fullname" placeholder="Real Name">
										
									</div>
								</div>
							</div>
							
							
							<div class="form-group">
                                            <div class="col-sm-12">
												 <label for="attacktype">Layer Type</label>
                                                    <select class="form-control" id="attacktype" name="type" size="1">
                                                        <option value="layer4">Layer 4</option>
									              	    <option value="layer7">Layer 7</option>
											           
											            <option value="by7">BYPASS LAYER 7</option> 
														<option value="by4">BYPASS LAYER 4</option> 
														<option value="botnet">BOTNET</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
												 <label for="attacktype">Method is VIP?</label>
                                                    <select class="form-control" id="vip" name="vip" size="1">
                                                         <option value="0">Nah ma boi</option>
                                                        <option value="1">Ofcorse yes</option>
									              	   
											           
                                                    </select>
                                            </div>
                                        </div>
                    </div>
                </div>
            </form>
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
     
