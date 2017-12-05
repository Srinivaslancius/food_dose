<?php include_once 'admin_includes/main_header.php'; ?>
<?php $getStates = "SELECT * FROM lkp_states WHERE status = 0 ORDER BY id DESC";
      $getStates1 = $conn->query($getStates); $i=1; ?>
     <div class="site-content">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <a href="add_lkp_states.php" style="float:right">Add States</a>
            <h3 class="m-t-0 m-b-5">States</h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" id="table-1">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>State Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = $getStates1->fetch_assoc()) { ?>
                  <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['state_name'];?></td>
                   <td><?php if ($row['status']==0) { echo "<span class='label label-outline-success check_active open_cursor' data-incId=".$row['id']." data-status=".$row['status']." data-tbname='lkp_states'>Active</span>" ;} else { echo "<span class='label label-outline-info check_active open_cursor' data-status=".$row['status']." data-incId=".$row['id']." data-tbname='lkp_states'>In Active</span>" ;} ?></td>
                   <td> <a href="edit_lkp_states.php?stateid=<?php echo $row['id']; ?>"><i class="zmdi zmdi-edit"></i></a></td>
                  </tr>
                  <?php  $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
   <?php include_once 'admin_includes/footer.php'; ?>
   <script src="js/tables-datatables.min.js"></script>