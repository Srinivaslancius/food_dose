<?php include_once 'admin_includes/main_header.php'; ?>
  <?php //$getWeightsData = getAllDataWithActiveRecent('orders'); 
    $i=1;
    $getProNameQry = "SELECT * FROM orders ORDER BY id DESC";
    $res = $conn->query($getProNameQry);
 ?>
     
      <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <h3 class="m-t-0 m-b-5">Reports</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              
                <div class="clear_fix"></div>
                <p id="date_filter">
                  <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
                  <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
                </p>
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Product Name</th>
                    <th>Sales</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $res->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php $getProName = getDataFromTables('products',$status=NULL,'id',$row['product_id'],$activeStatus=NULL,$activeTop=NULL);
                    $getProName1 = $getProName->fetch_assoc(); echo $getProName1['product_name']; ?></td>
                    <td>Rs.<?php echo $row['product_total_price'];?></td>
                  </tr>
                  <?php  $i++; }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
      </div>
      
   <?php include_once 'admin_includes/footer.php'; ?>
   <script src="js/tables-datatables.min.js"></script>