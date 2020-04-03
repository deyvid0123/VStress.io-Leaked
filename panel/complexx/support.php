<?php 
require '../complex/configuration.php';
require '../complex/init.php';
$type = $_GET['type'];

     if ($type == "submit"){
    session_start();
      $subject = $_POST['subject'];
      $content = $_POST['message'];
      $department = $_POST['department'];
      $priority = $_POST['ppp'];
      $errors = array();
     if($department == "1" || $priority == "2")
                    {
                      echo '
					  <div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong>Please choose a department and a priority</span>
			</div></div>';
                    }else{

                
            
      if (empty($subject) || empty($content) || empty($department) || empty($priority))
      {
        $errors[] = '
		
		<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong>Pleaes Fill In All Fields</span>
			</div></div>';
      }
	  if ($user -> safeString($subject) || $user -> safeString($content) || $user -> safeString($department) || $user -> safeString($priority)){
          $error = error('What are you trying?');  
      }
	  if (strlen($subject) > 30) {
$errors[] = '

<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong>Your Subject is too long.</span>
			</div></div>';
}
if (strlen($content) > 300) {
$errors[] = '<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong>Your Message is too long.</span>
			</div></div>';
}
      $SQLCount = $odb -> prepare("SELECT COUNT(*) FROM `tickets` WHERE `username` = :username AND `status` = 'Waiting for admin response'");
$SQLCount -> execute(array(':username' => $_SESSION['username']));
if ($SQLCount -> fetchColumn(0) > 2)
{
 $errors[] = '
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong>You have To many tickets Open</span>
			</div></div>';
}


    $validMethods = array("Billing", "General", "Tech", "Other");
            
            $MethodIsValid = 0;
            foreach($validMethods as $i)
            {
                if($i == $department)
                {
                    $MethodIsValid = 1;
                    break;
                }
            }
    $pvalidmethods = array("Low", "Medium", "High");

             $Pisvalid = 0;
            foreach($pvalidmethods as $i)
            {
                if($i == $priority)
                {
                    $Pisvalid = 1;
                    break;
                }
            }
            if($MethodIsValid == 1 && $Pisvalid == 1)
            {
      if (empty($errors))
      {        
        $subjectnon = preg_replace('@[^0-9a-z\.\-\:\_\,]+@i', '', $subject);
        $subjectnon = strtolower ( $subjectnon );

        $SQLinsert = $odb -> prepare("INSERT INTO `tickets` VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, UNIX_TIMESTAMP())");
        $SQLinsert -> execute(array($subjectnon, $content, $priority, $department, 'Waiting for admin response', $_SESSION['username'], 'user', 0));
		echo ' 
									<div class="alert alert-outline-success alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-check"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>SUCCESS!</strong>Ticket has been created.</span>
			</div></div>';
      }
      else
      {
        echo "";
        foreach($errors as $error)
        {
          echo ''.$error.'';
        }
        echo '';
      }
    }
    else
                {

echo ' 
									<div class="alert alert-outline-danger alert-dismissible">
			 <button type="button" class="close" data-dismiss="alert">&times;</button>
			
			<div class="alert-icon">
			 <i class="fa fa-times"></i>
			</div>
			
			<div class="alert-message">
			  <span><strong>ERROR!</strong>Invalid department or priority</span>
			</div></div>';
                }
  }
}


if ($_GET['type'] == 'update'){
session_start();
$SQLGetTickets = $odb -> prepare("SELECT * FROM `tickets` WHERE `username` = :username ORDER BY `id` DESC");
        $SQLGetTickets -> execute(array(':username' => $_SESSION['username']));
        while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
        {
            $id = $getInfo['id'];
            $user = $_SESSION['username'];
            $subject = $getInfo['subject'];
            $status = $getInfo['status'];
	    	$department = $getInfo['department'];
			$priority = $getInfo['priority'];
            $date = $getInfo['time'];
            if ($status == '<span class="text-danger">Closed</span>') {
            $status1 = "danger";
            } elseif ($status == '<span class="text-primary">Waiting for admin response</span>') {
            $status1 = "info";
            } elseif ($status == '<span class="text-warning">Waiting for user response</span>') {
            $status1 = "warning";
            }
            echo '<tr>
                                                 <td>
                                                    <h5>
                                                        <a href="ticket.php?id='.$id.'" class="text-primary"><strong>-->'.htmlspecialchars($subject).'<--</strong></a>
                                                    </h5>
													</td>
                                               <td class="d-none d-sm-table-cell font-w600 text-warning" style="width: 140px;">'.$department.'</td>
											   <td class="d-none d-sm-table-cell font-w600 text-primary" style="width: 140px;">'.$priority.'</td>
                                              
													<td>
													'.$status.'
                                                 
                                                </td>
												
                                                <td class="hidden-xs text-center" style="width: 30px;">
                                                    <i class="fa fa-ticket fa-2x text-muted"></i>
                                                </td>
                                                <td class="hidden-xs text-right text-muted" style="width: 120px;"><em>'.date('jS F Y h:i:s A (T)', $date).'</em></td>
                                            </tr>';
                                                                                             }

}
     ?>