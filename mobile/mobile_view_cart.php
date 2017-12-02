<?php 
include "../manage_webmaster/admin_includes/config.php";
include "../manage_webmaster/admin_includes/common_functions.php";
//Set Array for list
$lists = array();
$response = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {

        $result = getAllDataWhere('cart','user_id',$_REQUEST['user_id']);
        
        if ($result->num_rows > 0) {
                $response["lists"] = array();
                while($getPriceDet = $result->fetch_assoc()) {
                    //Chedck the condioton for emptty or not        
                    $lists = array();
                    $lists["cart_id"] = $getPriceDet["id"];
                    $lists["product_name"] = $getPriceDet["product_name"];
                    $lists["product_price"] = $getPriceDet["product_price"];
                    $lists["product_id"] = $getPriceDet["product_id"];
                    $lists["weight_type"] = $getPriceDet["weight_type"];
                    //Get Images
                    $getImgDetails = getAllDataWhere('product_images','product_id',$getPriceDet['product_id']);
                    $getImgDet = $getImgDetails->fetch_assoc();
                    $lists["image"] = $base_url."uploads/product_images/".$getImgDet["product_image"];
                    array_push($response["lists"], $lists);      
                }
                $response["success"] = 0;
                $response["message"] = "Success";               
        } else {
            $response["success"] = 1;
            $response["message"] = "No Records found";     
        }

    } else {
        $response["success"] = 2;
        $response["message"] = "Required field(s) is missing";    
    }
    
} else {
    $response["success"] = 3;
    $response["message"] = "Invalid request";
}
echo json_encode($response);

?>