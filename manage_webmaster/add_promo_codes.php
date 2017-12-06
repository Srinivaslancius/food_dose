<?php include_once 'admin_includes/main_header.php'; ?>
<?php
  error_reporting(0);
  if (!isset($_POST['submit']))  {
      echo "fail";
  } else  { 
    //echo "<pre>"; print_r($_POST); exit;
      $coupon_code = $_POST['coupon_code'];
      $price_type_id = $_POST['price_type_id'];
      $discount_price = $_POST['discount_price'];
      $status = $_POST['status'];
      $sql = "INSERT INTO promo_codes (`coupon_code`, `price_type_id`, `discount_price` ,`status`) VALUES ('$coupon_code', '$price_type_id', '$discount_price','$status')";
      if($conn->query($sql) === TRUE){
         echo "<script type='text/javascript'>window.location='promo_codes.php?msg=success'</script>";
      } else {
         echo "<script type='text/javascript'>window.location='promo_codes.php?msg=fail'</script>";
      }
  }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Promo Codes</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Coupon Code</label>
                    <input type="text" name="coupon_code" class="form-control" id="form-control-2" placeholder="Coupon Code" data-error="Please enter Coupon Code" required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose Price Types</label>
                    <select id="form-control-3" name="price_type_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Price Types</option>
                      <option value="1">Price</option>
                      <option value="2">Percentage</option>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Discount Price / Percentage</label>
                    <input type="text" name="discount_price" class="form-control" id="form-control-2" placeholder="Discount Price / Percentage" data-error="Please enter Correct Discount Price / Percentage." required>
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
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
              </div>
            </div>
            <hr>
          </div>
        </div>
      </div>
<?php include_once 'admin_includes/footer.php'; ?>