<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
error_reporting(0);
$cityid = $_GET['cityid'];
$rid = $_GET['rid'];
if (!isset($_POST['submit']))  {
  //If fail
  echo "fail";
}else  {
  //If success
  //echo "<pre>";print_r($_POST);exit;
  $lkp_state_id = $_POST['lkp_state_id'];
  $lkp_district_id = $_POST['lkp_district_id'];
  $lkp_city_id = $_POST['lkp_city_id'];
  $location_name = $_POST['location_name'];     
  $status = $_POST['status'];
  
    $sql = "UPDATE lkp_locations SET lkp_state_id = '$lkp_state_id',lkp_district_id ='$lkp_district_id',lkp_city_id ='$lkp_city_id',location_name = '$location_name',status ='$status' WHERE lkp_city_id = $cityid AND id = '$rid'"; 
    if($conn->query($sql) === TRUE){
       echo "<script type='text/javascript'>window.location='lkp_locations.php?msg=success'</script>";
    } else {
       echo "<script type='text/javascript'>window.location='lkp_locations.php?msg=fail'</script>";
    }
  
}
?>
      <div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Locations</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $sql = "SELECT * FROM lkp_locations WHERE lkp_city_id = $cityid ANd id = $rid";
               $getLocations = $conn->query($sql);
              $getLocationsData = $getLocations->fetch_assoc(); ?>
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST" enctype="multipart/form-data">
                  <?php $getStates = getAllDataWithStatus('lkp_states','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your State</label>
                    <select name="lkp_state_id" class="custom-select" data-error="This field is required." required onChange="getDistricts(this.value);">
                      <option value="">Select State</option>
                      <?php while($row = $getStates->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getLocationsData['lkp_state_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['state_name']; ?></option>
                      <?php } ?>
                   </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getDistrcits = getAllDataWithStatus('lkp_districts','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your District</label>
                    <select id="lkp_district_id" name="lkp_district_id" class="custom-select" data-error="This field is required." required onChange="getCities(this.value);">
                      <option value="">Select District</option>
                      <?php while($row = $getDistrcits->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getLocationsData['lkp_district_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['district_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  <?php $getCities = getAllDataWithStatus('lkp_cities','0');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your City</label>
                    <select id="lkp_city_id" name="lkp_city_id" class="custom-select" data-error="This field is required." required>
                      <option value="">Select City</option>
                      <?php while($row = $getCities->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getLocationsData['lkp_city_id']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
                      <?php } ?>
                    </select>
                    <div class="help-block with-errors"></div>
                  </div>

                  
                  
                    <?php $sql = "SELECT * FROM lkp_locations WHERE lkp_city_id = $cityid AND id='$rid'";
                         $getLocations1 = $conn->query($sql);
                         $getLocationsData1 = $getLocations1->fetch_assoc();
                    ?>
                    
                        <div class="form-group">
                          <label for="form-control-2" class="control-label">Location Name</label>
                          <input type="text" name="location_name" class="form-control" id="user_input" placeholder="Location Name" data-error="Please enter Location Name" required value="<?php echo $getLocationsData1['location_name'];?>">
                          <span id="input_status" style="color: red;"></span>
                          <input type="hidden" id="table_name" value="lkp_locations">
                         <input type="hidden" id="column_name" value="location_name">
                          <div class="help-block with-errors"></div>
                        </div>
                      

                  <?php $getStatus = getAllData('user_status');?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="status" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getLocationsData['status']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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