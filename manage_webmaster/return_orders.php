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
                           
              <?php 
                $getProNameQry1 = "SELECT * FROM orders ORDER BY id DESC";
                $res1 = $conn->query($getProNameQry1);
             ?>
                  <div class="form-group col-md-3">                    
                    <select id="select-order" class="custom-select">
                        <option value="">Select Order Id</option>
                        <?php while($getOrdId1 = $res1->fetch_assoc()) {  ?>
                          <option value="<?php echo $getOrdId1['order_id']; ?>"><?php echo $getOrdId1['order_id']; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                <!-- <div class="clear_fix"></div>
                <p id="date_filter">
                  <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
                  <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
                </p> -->
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Order Id</th>
                    <th>User Name</th>
                    <th>Order Status</th>
                    <!-- <th>Order Date</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $res->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['order_id'];?></td>
                    <td><?php echo $row['first_name'];?></td>
                    <td><?php $getOrderStatus = getDataFromTables('order_status',$status=NULL,'id',$row['order_status'],$activeStatus=NULL,$activeTop=NULL);
                    $getOrdSta = $getOrderStatus->fetch_assoc(); echo $getOrdSta['status']; ?></td>
                    <!-- <td><?php echo date('m/d/Y',strtotime($row['order_date']));?></td> -->
                  </tr>
                  <?php  $i++; }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
   <?php include_once 'admin_includes/footer.php'; ?>
   <script src="js/tables-datatables.min.js"></script>