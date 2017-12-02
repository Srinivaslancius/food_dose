<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['pid'];
if (!isset($_POST['submit']))  {
            echo "";
} else  {
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $sub_category_id = $_POST['sub_category_id'];
    $availability_id = $_POST['availability_id'];
    $fileToUpload = $_FILES["fileToUpload"]["name"];
    $status = $_POST['status'];
    $created_at = date("Y-m-d h:i:s");
    $created_by = $_SESSION['admin_user_id'];

      if($_FILES["fileToUpload"]["name"]!='') {
              $fileToUpload = $_FILES["fileToUpload"]["name"];
              $target_dir = "../uploads/product_images/";
              $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $getImgUnlink = getImageUnlink('product_image','products','id',$id,$target_dir);
                //Send parameters for img val,tablename,clause,id,imgpath for image ubnlink from folder
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      
             $sql1 = "UPDATE products SET product_name = '$product_name',category_id ='$category_id',sub_category_id='$sub_category_id',product_image='$fileToUpload', availability_id ='$availability_id', status = '$status' WHERE id = '$id'"; 
            if ($conn->query($sql1) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
              }
              $result1=$conn->query($sql1);
                      //Delete weight and prices
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
      }  else {
                $sql2 = "UPDATE products SET product_name = '$product_name',category_id ='$category_id',sub_category_id='$sub_category_id', availability_id ='$availability_id', status = '$status' WHERE id = '$id'"; 
                if ($conn->query($sql2) === TRUE) {
                  echo "Record updated successfully";
                } else {
                echo "Error updating record: " . $conn->error;
               }
              $result1=$conn->query($sql2);
        }          //Delete weight and prices
            $del = "DELETE FROM product_weight_prices WHERE product_id = '$id' ";
            $result = $conn->query($del);

            $product_weights = $_REQUEST['weight_type_id'];
            foreach($product_weights as $key=>$value){

            $product_weights1 = $_REQUEST['weight_type_id'][$key];
            $product_price = $_REQUEST['product_price'][$key];  
            $discount_price = $_REQUEST['discount_price'][$key];
            $sql = "INSERT INTO product_weight_prices ( `product_id`,`weight_type_id`,`product_price`,`discount_price`) VALUES ('$id','$product_weights1','$product_price','$discount_price')";
            $result = $conn->query($sql);
            }
             if($result==1){
                echo "<script type='text/javascript'>window.location='products.php?msg=success'</script>";
            } else {
                echo "<script type='text/javascript'>window.location='products.php?msg=fail'</script>";
            }
            
          }
?>

      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Products</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getProductsData = getDataFromTables('products','0','id',$id,$activeStatus=NULL,$activeTop=NULL);
                $getProducts = $getProductsData->fetch_assoc();
                $getCategories = getDataFromTables('categories','0',$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);
                ?>
                
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Category</label>
                    <select id="form-control-3" name="category_id" class="custom-select" data-error="This field is required." required >
                      <option value="">Select Category</option>
                      <?php while($row = $getCategories->fetch_assoc()) {  ?>
                        <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $getProducts['category_id']) { echo "selected=selected"; }?> ><?php echo $row['category_name']; ?></option>
                    <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getSubCategories =  getDataFromTables('sub_categories',$status=NULL,$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL); ?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Select Product Type</label>
                    <select id="sub_category_id" name="sub_category_id" class="custom-select" data-error="This field is required." required >
                       <option value="">Select Product Type</option>
                      <?php while($row = $getSubCategories->fetch_assoc()) {  ?>
                      <option <?php if($row['id'] == $getProducts['sub_category_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['sub_category_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Product Name</label>
                    <input type="text" class="form-control" id="form-control-2" name="product_name" data-error="Please enter product name." required value="<?php echo $getProducts['product_name']; ?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $id = $_GET['pid'];
                    $getQry = "SELECT * FROM product_weight_prices where product_id = '$id' ORDER BY id desc";
                    $result2 = $conn->query($getQry);
                ?>
                     
                    <?php while($row2 = $result2->fetch_assoc()) { ?>
                      <div class="row">
                        <div class="input-field form-group col-md-4">
                            <label for="form-control-3" class="control-label">Choose Weight</label>
                            <?php $result = getDataFromTables('product_weights',$status=NULL,$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL); ?>                                                
                            <select name="weight_type_id[]" required id="form-control-3" class="custom-select" data-error="This field is required." required>
                                <?php while($row = $result->fetch_assoc()) { ?>
                                <?php $getTermName = getDataFromTables('product_weights',$status=NULL,$clause=NULL,$row2['weight_type_id'],$activeStatus=NULL,$activeTop=NULL); ?>
                                    <option value="<?php echo $row['id']; ?>" <?php if($row['id'] == $row2['weight_type_id']) { echo "Selected"; } ?>><?php echo $row['weight_type']; ?></option>
                                <?php } ?>
                            </select>  
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="form-control-2" class="control-label">Product Price</label>                         
                          <input type="text" class="form-control" id="form-control-2" name="product_price[]" required onkeypress="return isNumberKey(event)" data-error="Please enter product product price." placeholder="Actual Price" required value="<?php echo $row2['product_price']; ?>">
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="form-control-2" class="control-label">Offer Price</label>                         
                          <input type="text" class="form-control" id="form-control-2" name="discount_price[]" required onkeypress="return isNumberKey(event)" data-error="Please enter offer price." placeholder="Offer Price" required value="<?php echo $row2['discount_price']; ?>">
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                    <?php } ?>
                    <div class="input-field">
                         <a href="javascript:void(0);"  ><span style="color:#000;font-size:14px;">Choose More:&nbsp;<img src="add-icon.png" onkeypress="return isNumberKey(event)" onclick="addInput('dynamicInput');" /></span></a>
                      </div>
                    <div id="dynamicInput" class="input-field col s12"></div>
                  
                 <div class="form-group">
                    <label for="form-control-4" class="control-label">Image</label>
                    <img src="<?php echo $base_url . 'uploads/product_images/'.$getProducts['product_image'] ?>"  id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                        Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" >
                      </label>
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Avalability</label>
                    <select id="form-control-3" name="availability_id" class="custom-select" data-error="This field is required." required>
                      <option value="" disabled selected>Avalability</option>
                      <option value="0" <?php if($getProducts['availability_id'] == 0) { echo "Selected=Selected"; }?>>In Stock</option>
                      <option value="1" <?php if($getProducts['availability_id'] == 1) { echo "Selected=Selected"; }?>>Out Of Stock</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getDataFromTables('user_status',$status=NULL,$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="status" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getProducts['status']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <button type="submit" name="submit" value="Submit"  class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
      <?php include_once 'admin_includes/footer.php'; ?>
      <script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
      <script src="js/multi_image_upload.js"></script>
      <link rel="stylesheet" type="text/css" href="css/multi_image_upload.css">
      <script>          
          /*CKEDITOR.replace( 'product_info' );
          CKEDITOR.replace( 'benefits' );
          CKEDITOR.replace( 'how_to_use' ); */          
      </script>
<?php
    $sql1 = "SELECT * FROM product_weights where status = '0'";
    $result1 = $conn->query($sql1);                                    
?>

<?php while($row = $result1->fetch_assoc()) { 
   $choices1[] = $row['id'];
   $choices_names[] = $row['weight_type'];
} ?>


<script type="text/javascript">

function addInput(divName) {
    var choices = <?php echo json_encode($choices1); ?>; 
    var choices_names = <?php echo json_encode($choices_names); ?>;      
    var newDiv = document.createElement('div');
    newDiv.className = 'new_appen_class';
    var selectHTML = "";    
    selectHTML="<div class='input-field form-group col-md-4'><select required name='weight_type_id[]' id='form-control-3' class='custom-select' style='display:block !important'><option value=''>Select Weighy Type</option>";
    var newTextBox = "<div class='form-group col-md-3'><input type='text' onkeypress='return isNumberKey(event)' onclick='addInput('dynamicInput');' required name='product_price[]' class='form-control' id='form-control-2' placeholder='Product Price'></div>";
    
    var newTextBox1 = "<div class='form-group col-md-3'><input type='text' onkeypress='return isNumberKey(event)' onclick='addInput('dynamicInput');' required name='discount_price[]' class='form-control' id='form-control-2' placeholder='Offer Price'></div>";
    removeBox="<div class='input-field  form-group col-md-2'><a class='remove_button' ><img src='remove-icon.png'/></a></div><div class='clearfix'></div>";
    for(i = 0; i < choices.length; i = i + 1) {
        selectHTML += "<option value='" + choices[i] + "'>" + choices_names[i] + "</option>";
    }
    selectHTML += "</select></div>";
    newDiv.innerHTML = selectHTML+ " &nbsp;" +newTextBox +" "+newTextBox1+" "+removeBox;

    document.getElementById(divName).appendChild(newDiv);
}

$(document).ready(function() {
    $(dynamicInput).on("click",".remove_button", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent().parent().remove();
    })
    
});
</script>

<script type="text/javascript">
//Script allowed only numeric value
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
