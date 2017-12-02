<?php
include "../admin/includes/config.php";
include "../admin/includes/functions.php";

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

  if(!empty($_REQUEST['mobile']) && !empty($_REQUEST['mobile']) )  {

    $mobile = $_REQUEST['mobile'];    

    $sql = "SELECT * FROM users WHERE user_mobile = '$mobile'";
    $result = $conn->query($sql);   

      if($result->num_rows > 0) {
          	$row = $result->fetch_assoc();
          	$response["password"] = 'Your password is : '.decryptPassword($row['user_password']); 
            $response['success']=0;
            $response['message']='Success';        

        } else {
          $response['success']=1;
          $response['message']='Your Mobile Number Not Valid ,Pelase Enter Valid Number.';          
        }

    } else {
      $response['success']=2;
      $response['message']='Parameters missing';     
    }
    
} else {
    $response['success']=3;
    $response['message']='Invalid request';   
}
  echo json_encode($response);
?>