<?php include_once 'admin_includes/main_header.php'; ?>

<?php  
if (!isset($_POST['submit']))  {
            echo "";
} else  {
    //Save data into database
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $sub_category_id = $_POST['sub_category_id'];
    $availability_id = $_POST['availability_id'];
    $fileToUpload = $_FILES["fileToUpload"]["name"];
    $status = $_POST['status'];
    $created_at = date("Y-m-d h:i:s");
    $created_by = $_SESSION['admin_user_id'];

    if($fileToUpload!='') {

    $target_dir = "../uploads/product_images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $sql1 = "INSERT INTO products (`product_name`,`category_id`,`sub_category_id`,`availability_id`,`product_image`,`status`,`created_by`,`created_at`) VALUES ('$product_name','$category_id','$sub_category_id','$availability_id','$fileToUpload','$status','$created_by','$created_at')";
     $result1 = $conn->query($sql1);
     $last_id = $conn->insert_id;

    $product_weights = $_REQUEST['weight_type_id'];
    foreach($product_weights as $key=>$value){

        $product_weights1 = $_REQUEST['weight_type_id'][$key];
        $product_price = $_REQUEST['product_price'][$key];
        $discount_price = $_REQUEST['discount_price'][$key]; 
        $sql = "INSERT INTO product_weight_prices ( `product_id`,`weight_type_id`,`product_price`,`discount_price`) VALUES ('$last_id','$product_weights1','$product_price','$discount_price')";
        $result = $conn->query($sql);
    }
      if( $result == 1){
          echo "<script type='text/javascript'>window.location='products.php?msg=success'</script>";
      } else {
          echo "<script type='text/javascript'>window.location='products.php?msg=fail'</script>";
      }
                    //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
          echo "Sorry, there was an error uploading your file.";
      }
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
              <?php $getCategories = getDataFromTables('categories','0',$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);?>
              <?php $getWeights = getDataFromTables('product_weights','0',$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);?>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="post" enctype="multipart/form-data">
                  
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your Category</label>
                    <select id="form-control-3" name="category_id" class="custom-select" data-error="This field is required." required >
                      <option value="">Select Category</option>
                      <?php while($row = $getCategories->fetch_assoc()) {  ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

<?php $sub_categories= getDataFromTables('sub_categories','0',$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Select Product Type</label>
                    <select id="sub_category_id" name="sub_category_id" class="custom-select" data-error="This field is required." required >
                      <option value="">Select Product Type</option>
                      <?php while($row = $sub_categories->fetch_assoc()) {  ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['sub_category_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" data-error="Please enter product name." required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class = "row">
                  <div class="form-group col-md-4">
                    <label for="form-control-3" class="control-label">Choose Weight Type</label>
                    <select id="form-control-3" name="weight_type_id[]" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Weight Type</option>
                      <?php while($row = $getWeights->fetch_assoc()) {  ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['weight_type']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="form-control-2" class="control-label">Product Price</label>
                    <input type="text" class="form-control" id="price" name="product_price[]" placeholder="Product Price" data-error="Please enter product price." required onkeypress="return isNumberKey(event)">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group col-md-3">
                    <label for="form-control-2" class="control-label">Offer Price</label>
                    <input type="text" class="form-control" id="price" name="discount_price[]" placeholder="Offer Price" data-error="Please enter offer price." required onkeypress="return isNumberKey(event)">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group col-md-2">
                     <a href="javascript:void(0);"  ><img style="margin-top: 25px;" src="add-icon.png" onkeypress="return isNumberKey(event)" onclick="addInput('dynamicInput');"/></a>
                  </div>
                  <div id="dynamicInput" class="input-field col s12"></div>
                </div>
                  
                  <!-- <div class="form-group">
                    <label for="form-control-2" class="control-label">Product Info</label>
                    <textarea name="product_info" class="form-control" id="product_info" placeholder="Product Info" data-error="This field is required." required></textarea>
                    <div class="help-block with-errors"></div>
                  </div> -->
                  
                  
                  <div class="form-group">
                    <label for="form-control-4" class="control-label">Image</label>
                    <img id="output" height="100" width="100"/>
                    <label class="btn btn-default file-upload-btn">
                      Choose file...
                        <input id="form-control-22" class="file-upload-input" type="file" accept="image/*" name="fileToUpload" id="fileToUpload"  onchange="loadFile(event)"  multiple="multiple" required >
                      </label>
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Avalability</label>
                    <select id="form-control-3" name="availability_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Avalability</option>
                        <option value="0">In Stock</option>
                        <option value="1">Sold Out</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getDataFromTables('user_status',$status=NULL,$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="status" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) { ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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
   <script src="js/tables-datatables.min.js"></script>
   <script src="js/multi_image_upload.js"></script>
   <link rel="stylesheet" type="text/css" href="css/multi_image_upload.css">
   
   <!-- Below script for ck editor -->
<script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
<script>
    /*CKEDITOR.replace( 'product_info' );*/
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
    var newTextBox1 = "<div class='form-group col-md-3'><input type='text' onkeypress='return isNumberKey(event)' onclick='addInput('dynamicInput');' required name='discount_price[]' class='form-control' id='form-control-2' placeholder='offer Price'></div>";
    
        removeBox="<div class='input-field  form-group col-md-2'><a class='remove_button' ><img src='remove-icon.png'/></a></div><div class='clearfix'></div>";
    for(i = 0; i < choices.length; i = i + 1) {
        selectHTML += "<option value='" + choices[i] + "'>" + choices_names[i] + "</option>";
    }
    selectHTML += "</select></div>";
    newDiv.innerHTML = selectHTML+ " &nbsp;" +newTextBox +" " +newTextBox1 +" " +removeBox;
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

function getSubCategories(val) {
    $.ajax({
    type: "POST",
    url: "get_sub_categories.php",
    data:'category_id='+val,
    success: function(data){
        $("#sub_category_id").html(data);
    }
    });
}

function getSubSubCategories(val) {
    $.ajax({
    type: "POST",
    url: "get_sub_sub_categories.php",
    data:'sub_category_id='+val,
    success: function(data){
        $("#sub_sub_category_id").html(data);
    }
    });
}
</script>
