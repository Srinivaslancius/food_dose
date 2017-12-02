<?php

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

      $response['base_url']='';
      $response['success']=0;
      $response['message']='Success';

} else {
    $response['success']=3;
    $response['message']='Invalid request';   
}

  echo json_encode($response);
?>