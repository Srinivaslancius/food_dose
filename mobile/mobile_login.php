<?php
error_reporting(0);
include "../admin/includes/config.php";
include "../admin/includes/functions.php";

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

      if(!empty($_REQUEST['mobile']) && !empty($_REQUEST['mobile']) && !empty($_REQUEST['password']) && !empty($_REQUEST['password']))  {

        $mobile = $_REQUEST['mobile'];
        $password = encryptPassword($_REQUEST['password']);

        $sql = "SELECT * FROM users WHERE user_mobile = '$mobile' AND user_password = '$password' AND status=0 ";
        $result = $conn->query($sql);   

          if($result->num_rows > 0) {
            //$response["lists"] = array();
              while($row = $result->fetch_assoc()) {             
                $response['id']=$row['id'];
                $response['name']=$row['user_name'];
                $response['mobile']=$row['user_mobile'];
                $response['email']=$row['user_email'];
                $response['address']=$row['street_name'] . ", " . $row['street_no'] . ", " . $row['flat_name'] . ", " . $row['flat_no'] . ", " . $row['location'] . ", " . $row['landmark'];                
              }
              $response['success']=0;
              $response['message']='Success';                      
            } else {
              $response['success']=1;
              $response['message']='Your Mobile or Password is In Valid ,Pelase Enter Valid Details.';          
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