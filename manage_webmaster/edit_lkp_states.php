<?php include_once 'admin_includes/main_header.php'; ?>
<?php
error_reporting(0);
$id = $_GET['stateid'];
 if (!isset($_POST['submit']))  {
            echo "fail";
    } else  {
            $state_name = $_POST['state_name'];
            $status = $_POST['status'];
            $sql = "UPDATE `lkp_states` SET state_name='$state_name', status = '$status' WHERE id = '$id' ";
            if($conn->query($sql) === TRUE){
               echo "<script type='text/javascript'>window.location='lkp_states.php?msg=success'</script>";
            } else {
               echo "<script type='text/javascript'>window.location='lkp_states.php?msg=fail'</script>";
            }
        }
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">States</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getStates = getAllDataWhere('lkp_states','id',$id);
              $getStatesData = $getStates->fetch_assoc(); ?>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" autocomplete="off">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">State Name</label>
                    <input type="text" name="state_name" class="form-control" id="user_input" placeholder="State Name" data-error="Please enter State Name" required value="<?php echo $getStatesData['state_name'];?>" onkeyup="checkUserAvailTest()">
                    <span id="input_status" style="color: red;"></span>
                    <input type="hidden" id="table_name" value="lkp_states">
                    <input type="hidden" id="column_name" value="state_name">
                    <div class="help-block with-errors"></div>
                  </div>
                 <?php $getStatus = getAllData('user_status');?> 
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="status" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getStatesData['status']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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