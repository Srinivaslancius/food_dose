<?php
include "../manage_webmaster/admin_includes/config.php";
include "../manage_webmaster/admin_includes/common_functions.php";

$response = array();

if (isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id']) && isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id']) && isset($_REQUEST['product_price']) && !empty($_REQUEST['product_price']) && isset($_REQUEST['product_weight']) && !empty($_REQUEST['product_weight']) && isset($_REQUEST['product_quantity']) && !empty($_REQUEST['product_quantity']) ) {
	
	$user_id = $_REQUEST['user_id'];	
	$date = date("Y-m-d h:i:s");
    
    $prods = array();
    $prods = explode(',', $_REQUEST['product_id']);
    
    $qnty = array();
    $qnty = explode(',', $_REQUEST['product_quantity']);

    $price = array();
    $price = explode(',', $_REQUEST['product_price']);

    $weight = array();
    $weight = explode(',', $_REQUEST['product_weight']);
    
    if(count($prods) > 0)   {

        $response["lists"] = array();
        for($i=0; $i<count($prods); $i++)   {

            $pid = $prods[$i];            
            $sql1 = "SELECT * FROM products where id = '$pid'";
            $result = $conn->query($sql1);
            $row = $result->fetch_assoc();
            if($result->num_rows > 0) {

	           	$id = $row["id"];
	            $lists = array();
	            $lists["id"] = $id;
	            $lists["product_name"] = $row['product_name'];  
	            $lists["quantity"] = $qnty[$i]; 	
	            $lists["price"] = $price[$i];             	           
	            $lists["weight"] = $weight[$i]; 
	            $lists["items"] = count($prods);
	            $getImgDetails = getAllDataWhere('product_images','product_id',$pid);
	            $getImgDet = array();
	    	    while($getImgDet = $getImgDetails->fetch_assoc()) {
	    		  $lists["image"]  .= $base_url."uploads/product_images/".$getImgDet["product_image"].",";		    			    		
	    		}
	    		//Save data into cart
	    		$product_id = $prods[$i];
	    		$product_name = $row['product_name'];
				$product_price = $price[$i];
				$product_quantity = $qnty[$i];
				$product_total_price = $price[$i]*$qnty[$i];
				$weight_type = $weight[$i];

	            $sql = "INSERT INTO cart (`product_id`,`product_name`, `product_price`,  `product_quantity`,  `product_total_price`, `user_id`,`weight_type`, `created_at`) VALUES ('$product_id','$product_name', '$product_price', '$product_quantity', '$product_total_price', '$user_id','$weight_type', '$date')";
	          	$conn->query($sql);
	            array_push($response["lists"], $lists);
            }

        }
        $response["success"] = 0;
        $response["message"] = "Cart Save Successfully";
    }   else {
        $response["success"] = 1;
        $response["message"] = "No Items Found";        
    }        
} else {
    $response["success"] = 2;
    $response["message"] = "Required field(s) is missing";
}

echo json_encode($response);
?>