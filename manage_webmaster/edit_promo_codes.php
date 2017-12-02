<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['bid'];
 if (!isset($_POST['submit']))  {
            echo "fail";
    } else  {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $rules = $_POST['rules'];
            $status = $_POST['status'];
            
              
            
                    $sql = "UPDATE promo_codes SET start_date = '$start_date', end_date = '$end_date',rules = '$rules' ,status='$status' WHERE id = '$id' ";
                    if($conn->query($sql) === TRUE){
                       echo "<script type='text/javascript'>window.location='promo_codes.php?msg=success'</script>";
                    } else {
                       echo "<script type='text/javascript'>window.location='promo_codes.php?msg=fail'</script>";
                    }
                    
          }
?>
<?php $getPromocodesData = getDataFromTables('promo_codes',$status=NULL,'id',$id,$activeStatus=NULL,$activeTop=NULL);
$getPromocodes = $getPromocodesData->fetch_assoc();
 ?>
<div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Banners</h3>
          </div>
          <div class="panel-body">            
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Start Date</label>
                    <input type="text" class="form-control" id="form-control-2" name="start_date"  required value="<?php echo $getPromocodes['start_date'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">End Date</label>
                    <input type="text" class="form-control" id="form-control-2" name="end_date"  required value="<?php echo $getPromocodes['end_date'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Rules</label>
                    <input type="text" class="form-control" id="form-control-2" name="rules" required value="<?php echo $getPromocodes['rules'];?>">
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getDataFromTables('user_status',$status=NULL,$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="status" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getPromocodes['status']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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

