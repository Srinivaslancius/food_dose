<?php 
include "../manage_webmaster/admin_includes/config.php";
include "../manage_webmaster/admin_includes/common_functions.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
	//Save Ratings in database
	if (isset($_REQUEST['opassword']) && !empty($_REQUEST['opassword']) && isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']) && isset($_REQUEST['npassword']) && !empty($_REQUEST['npassword']) ) {

		$user_id = $_REQUEST["user_id"];
	    $opassword = $_REQUEST["opassword"];
	    $npassword = encryptPassword($_REQUEST["npassword"]);
	    //Get user password
	    $row = getIndividualDetails($_REQUEST['user_id'],'users','id');

	    if($row['user_password'] ==  $opassword) {
	    	//echo "succes"; die;
	    	$result = "UPDATE `users` SET `user_password`='$npassword' WHERE `id`='$user_id'";
			if ($conn->query($result) === TRUE) {
	            // check the conditions for query success or not
	            $response["success"] = 0;            
	            $response["message"] = "Password updated successfully!.";            
	        } else {     	
	            // fail query insert problem
	            $response["success"] = 1;
	            $response["message"] = "Oops! An error occurred.";                      
	        }

	    } else {
	    	$response["success"] = 2;
	        $response["message"] = "Please enter correct old password.";  
	    }

	} else {
		//If post params empty return below error
		$response["success"] = 3;
	    $response["message"] = "Required field(s) is missing";	    
	}
	
} else {

	$response["success"] = 4;
	$response["message"] = "Invalid request";
}
echo json_encode($response);

?>