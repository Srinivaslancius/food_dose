<?php 
include "../admin/includes/config.php";
include "../admin/includes/functions.php";

//if($_SERVER['REQUEST_METHOD']=='POST'){

	if (isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id']) && isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']) && isset($_REQUEST['product_quantity']) && !empty($_REQUEST['product_quantity']) && isset($_REQUEST['product_price']) && !empty($_REQUEST['product_price'])) {
		// echo "<pre>"; print_r($_POST); die;	
		$address = $_REQUEST['address'];
		$user_name = $_REQUEST['name'];
		$mobile = $_REQUEST['mobile'];
		$user_id = $_REQUEST['user_id'];	
		$order_total = $_REQUEST["order_total"];
		$order_date = date("Y-m-d h:i:s");
		$string1 = str_shuffle('abcdefghijklmnopqrstuvwxyz');
		$random1 = substr($string1,0,3);
		$string2 = str_shuffle('1234567890');
		$random2 = substr($string2,0,3);
		$contstr = "P2P";
		$order_id = $contstr.$random1.$random2;
		
		$prods = array();
	    $prods = explode(',', $_REQUEST["product_id"]);
	    
	    $qnty = array();
	    $qnty = explode(',', $_REQUEST["product_quantity"]);
	    
	    $prices = array();
	    $prices = explode(',', $_REQUEST["product_price"]);
	    
	    $pname = array();
	    $pname= explode(',', $_REQUEST["product_name"]);

		$productsCount = count($prods);
		for($i=0;$i<$productsCount;$i++) {
			$sql = "INSERT INTO orders (`first_name`, `mobile`, `address1`,`product_id`,`product_name`,`product_price`,`order_total`,`order_date`,`product_quantity`,`payment_status`,`order_status`,`order_id`,`user_id`) VALUES ('$user_name','$mobile','$address','" . $prods[$i] . "','" . $pname[$i] . "','" . $prices[$i] . "','$order_total','$order_date','" . $qnty[$i] . "','1','1','$order_id',$user_id)";
		    if ($conn->query($sql) === TRUE) {
	            // check the conditions for query success or not
	            $response["success"] = 0;            
	            $response["message"] = "Save Successfully";   
	            $response["order_id"] = $order_id;      
	        } else {
	            // fail query insert problem
	            $response["success"] = 2;
	            $response["message"] = "Oops! An error occurred.";                      
	        }
		}	

	}   else {
		//If post params empty return below error
		$response["success"] = 3;
	    $response["message"] = "Required field(s) is missing";	    
	}

/*} else {
	//Request invalid
	$response["success"] = 4;
	$response["message"] = "Invalid request";
}*/

echo json_encode($response);

?>