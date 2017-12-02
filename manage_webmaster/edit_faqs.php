<?php include_once 'admin_includes/main_header.php'; ?>
<?php  
$id = $_GET['tid'];
 if (!isset($_POST['submit']))  {
            echo "";
    } else  {            

    $faq = $_POST['faq'];
    $answer = $_POST['answer'];  
    $status = $_POST['status'];
        $sql = "UPDATE `faqs` SET faq = '$faq',answer='$answer', status='$status' WHERE id = '$id' ";
        if($conn->query($sql) === TRUE){
         echo "<script type='text/javascript'>window.location='faqs.php?msg=success'</script>";
        } else {
         echo "<script type='text/javascript'>window.location='faqs.php?msg=fail'</script>";
        }
    }    
       
?>
<div class="site-content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="m-y-0">Faqs</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <?php $getFaqsData = getDataFromTables('faqs','0','id',$id,$activeStatus=NULL,$activeTop=NULL);
              $getFaqsData1 = $getFaqsData->fetch_assoc(); ?>		
              <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form data-toggle="validator" method="POST">
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Faq</label>
                    <input type="text" name="faq" class="form-control" id="form-control-2" placeholder="Faq" data-error="Please enter Faq" required value="<?php echo $getFaqsData1['faq'];?>"> 
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form-group">
                    <label for="form-control-2" class="control-label">Answer</label>
                    <textarea name="answer" class="form-control" id="answer" placeholder="Answer" data-error="This field is required." required value="<?php echo $getFaqsData1['answer']; ?>"><?php echo $getFaqsData1['answer']; ?></textarea>
                    <div class="help-block with-errors"></div>
                  </div>
                  <?php $getStatus = getDataFromTables('user_status',$status=NULL,$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);?>
                  <div class="form-group">
                    <label for="form-control-3" class="control-label">Choose your status</label>
                    <select id="form-control-3" name="status" class="custom-select" data-error="This field is required." required>
                      <option value="">Select Status</option>
                      <?php while($row = $getStatus->fetch_assoc()) {  ?>
                          <option <?php if($row['id'] == $getFaqsData1['status']) { echo "Selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['status']; ?></option>
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
<!-- Below script for ck editor -->
<script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'answer' ); 
</script>