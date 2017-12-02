<?php
include "../admin/includes/config.php";
include "../admin/includes/functions.php";
$response = array();

if (isset($_REQUEST['product_id']) && !empty($_REQUEST['product_id'])) {

    $product_id = $_REQUEST['product_id'];    
    $qty = $_REQUEST['quantity'];
    
    $prods = array();
    $prods = explode(',', $product_id);
    
    $qnty = array();
    $qnty = explode(',', $qty);

    $price = array();
    $price = explode(',', $price);

    $weight = array();
    $weight = explode(',', $weight);
    
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
	            $lists["items"] = count($prods);
	            
	            //$getPriceDetails = getAllDataWhere('product_weight_prices','product_id',$row['id']);
	            $pid=$row['id'];
	            $sqlp= "SELECT price,weight_type_id FROM product_weight_prices WHERE product_id ='$pid' LIMIT 1 "; 
	            $result1 = $conn->query($sqlp);
    		    $getPriceDet = array();
			    while($pricedis = $result1 ->fetch_assoc()) {
			    	$lists["price"] =  $pricedis['price'];
                    $getWeights = getIndividualDetails($pricedis['weight_type_id'],'product_weights','id');                    
                    $lists["weight_type"] =  $getWeights['weight_type'];		    		
			    }			    	
	            $getImgDetails = getAllDataWhere('product_images','product_id',$row['id']);
    		    $getImgDet = array();
	    	    while($getImgDet = $getImgDetails->fetch_assoc()) {
	    		  $lists["image"]  .= $base_url."uploads/product_images/".$getImgDet["product_image"].",";		    			    		
	    		}
	            array_push($response["lists"], $lists);
            }

        }
        $response["success"] = 0;        
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