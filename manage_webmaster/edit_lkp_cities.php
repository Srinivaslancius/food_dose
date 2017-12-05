<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
error_reporting(0);
$id = $_GET['cityid'];
if (!isset($_POST['submit'])) {
      //If fail
        echo "fail";
    } else {
    //If success            
    $lkp_state_id = $_POST['lkp_state_id'];
    $lkp_district_id = $_POST['lkp_district_id'];
    $city_name = $_POST['city_name'];
    $status = $_POST['status'];

      $sql = "UPDATE `lkp_cities` SET lkp_state_id = '$lkp_state_id', lkp_district_id = '$lkp_district_id', city_name = '$city_name', status='$status' WHERE id = '$id' ";
      if($conn->query($sql) === TRUE){
         echo "<script type='text/javascript'>window.location='lkp_cities.php?msg=success'</script>";
      } else {
         echo "<script type='text/javascript'>window.location='lkp_cities.php?msg=fail'</script>";
      }
        
    }   
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Cities</h3>
          </div>
          <div class="panel-body">            
            <div class="row">
              <?php $getCities = getDataFromTables('lkp_cities','0','id',$id,$activeStatus=NULL,$activeTop=NULL);
              $getCitiesData = $getCities->fetch_assoc(); ?>   
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <?php $getStates = getAllDataWithStatus('lkp_states','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your State</label>
                    <select name="lkp_state_id" class="custom-select" data-error="This field is required." required onChange="getDistricts(this.value);">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getCitiesData['lkp_state_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getDistrictsData = getAllDataWithStatus('lkp_districts','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your District</label>
                    <select id="lkp_district_id" name="lkp_district_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select District</option>
                      <?php while($row = $getDistrictsData->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getCitiesData['lkp_district_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['district_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">City Name</label>
                    <input type="text" name="city_name" class="form-control" id="user_input" data-error="Please enter City Name" required value="<?php echo $getCitiesData['city_name'];?>" onkeyup="checkUserAvailTest()">
                    <span id="input_status" style="color: red;"></span>
                    <input type="hidden" id="table_name" value="lkp_cities">
                    <input type="hidden" id="column_name" value="city_name">
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getAllData('user_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="status" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getCitiesData['status']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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