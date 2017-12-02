<?php include_once 'admin_includes/main_header.php'; ?>

<?php  if (!isset($_POST['submit']))  {
          //If fail
          echo "fail";
        } else  {
            //If success
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $rules = $_POST['rules'];
            $status = $_POST['status'];
            
            $sql = "INSERT INTO promo_codes (`start_date`, `end_date`, `rules`,`status`) VALUES ('$start_date', '$end_date','$rules','$status')";
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
                <form data-toggle="validator" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Start Date</label>
                    <input type="text" class="form-control" id="form-control-2" name="start_date" placeholder="Start Date" data-error="Please enter Start Date." required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">End Date</label>
                    <input type="text" class="form-control" id="form-control-2" name="end_date" placeholder="End Date" data-error="Please enter End Date." required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Rules</label>
                    <input type="text" class="form-control" id="form-control-2" name="rules" placeholder="Rules" data-error="Please enter Rules." required>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getDataFromTables('user_status',$status=NULL,$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="status" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
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

      
       

      
      

      






