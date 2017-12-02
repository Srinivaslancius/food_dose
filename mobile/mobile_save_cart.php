<?php 
include "../admin/includes/config.php";
include "../admin/includes/functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){
	//Save Ratings in database
	if (isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id']) && isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']) && isset($_REQUEST['product_price']) && !empty($_REQUEST['product_price']) && isset($_REQUEST['product_name']) && !empty($_REQUEST['product_weight']) && !empty($_REQUEST['product_quantity'])) {

		$product_id = $_REQUEST['product_id'];
		$product_price = $_REQUEST['product_price'];
		$product_quantity = $_REQUEST['product_quantity'];
		$product_total_price = $_REQUEST['product_quantity']*$_REQUEST['product_price'];
		$product_name = $_REQUEST['product_name'];
		$user_id = $_REQUEST['user_id'];
		$weight_type = $_REQUEST['product_weight'];
		$date = date("Y-m-d h:i:s");

		$sql1= "SELECT * from cart where product_id='$product_id' AND user_id='$user_id' AND product_price='$product_price' ";
		$res = $conn->query($sql1);
		$row = $res->fetch_assoc();
		if ($res->num_rows > 0) {
			
			$cart_id = $row['id'];
			$updateq = "UPDATE cart SET product_quantity = '$product_quantity',product_total_price = '$product_total_price' WHERE product_id='$product_id' AND user_id='$user_id' AND id='$cart_id' ";
			$result = $conn->query($updateq);

			$getRes = "SELECT * from cart WHERE user_id='$user_id' ";
	        $getCartData = $conn->query($getRes);
	        $getPriceDet = $getCartData->fetch_assoc();

			$response["cart_count"] = $getCartData->num_rows;
			$response["qty"] = $row['product_quantity'];
			$response["total_price"] += $getPriceDet['product_total_price'];			
			$response["success"] = 0;   
			$response["message"] = "Update Successfully";         
	        
		} else {

			$product_quantity_first = 1;
			$sql = "INSERT INTO cart (`product_id`,`product_name`, `product_price`,  `product_quantity`,  `product_total_price`, `user_id`,`weight_type`, `created_at`) VALUES ('$product_id','$product_name', '$product_price', '$product_quantity_first', '$product_total_price', '$user_id','$weight_type', '$date')";

			if ($conn->query($sql) === TRUE) {
	            // check the conditions for query success or not
	            /*$getRes = "SELECT * from cart WHERE user_id='$user_id' ";
	            $getCartData = $conn->query($getRes);
	            while($getPriceDet = $getCartData->fetch_assoc()) {
	            	$lists["id"] =  $getPriceDet['id'];
	            	$lists["product_name"] =  $getPriceDet['product_name'];
	            	$lists["product_quantity"] =  $getPriceDet['product_quantity'];
	            	$lists["weight_type"] =  $getPriceDet['weight_type'];
	            	$lists["product_total_price"] =  $getPriceDet['product_total_price'];
	            	array_push($response["lists"], $lists);

	            }*/
	            $response["success"] = 0;            
	            $response["message"] = "Save Successfully";            
	        } else {
	            // fail query insert problem
	            $response["success"] = 2;
	            $response["message"] = "Oops! An error occurred.";                      
	        }
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