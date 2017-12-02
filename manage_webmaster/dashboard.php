<?php include_once 'admin_includes/main_header.php'; ?>
      <div class="site-content">
        <div class="row">
          <!-- <a href="admin_users.php" style="color: white;text-decoration: none !important;">
          <div class="col-md-4 col-sm-5">
            <div class="widget widget-tile-2 bg-warning m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Admin Users</div>
                <div class="wt-number"><?php echo getRowsCount('admin_users')?></div>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-accounts"></i>
              </div>
            </div>
          </div>
          </a> -->
          <?php 

        $getNewOrders = "SELECT * FROM orders WHERE order_status=4 AND order_date > DATE_SUB(DATE(NOW()), INTERVAL 1 DAY) ORDER BY id DESC";
        $getNewOrders1 = $conn->query($getNewOrders);
        $getNewOrders2 = $getNewOrders1->num_rows;
        
      ?>
      <?php 

        $getCompletedOrders = "SELECT * FROM orders WHERE order_status=2 AND order_date > DATE_SUB(DATE(NOW()), INTERVAL 1 DAY) ORDER BY id DESC";
        $getCompletedOrders1 = $conn->query($getCompletedOrders);
        $getCompletedOrders2 = $getCompletedOrders1->num_rows;
        
        
      ?>
      <?php 

        $getProcessingOrders = "SELECT * FROM orders WHERE order_status=1 AND order_date > DATE_SUB(DATE(NOW()), INTERVAL 1 DAY) ORDER BY id DESC";
        $getProcessingOrders1 = $conn->query($getProcessingOrders);
        $getProcessingOrders2 = $getProcessingOrders1->num_rows;
        
      ?>
       <?php 
              /*$ord_status = $getNewProducts2['order_status'];
              $sql = "SELECT * FROM order_status WHERE id = '$ord_status'";
              $result = $conn->query($sql);
              $noRows = $result->num_rows;*/
       ?>
          <a href="orders.php">
          <div class="col-md-4 col-sm-4">
            <div class="widget widget-tile-2 bg-danger m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">New Orders</div>
                <div class="wt-number"><?php echo $getNewOrders2;?></div>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
              </div>
            </div>
          </div>
          </a>
          <a href="orders.php">
          <div class="col-md-4 col-sm-4">
            <div class="widget widget-tile-2 bg-danger m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Orders In Process</div>
                <div class="wt-number"><?php echo $getProcessingOrders2;?></div>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
              </div>
            </div>
          </div>
          </a>
          <a href="orders.php">
          <div class="col-md-4 col-sm-4">
            <div class="widget widget-tile-2 bg-danger m-b-30">
              <div class="wt-content p-a-20 p-b-50">
                <div class="wt-title">Completed Orders</div>
                <div class="wt-number"><?php echo $getCompletedOrders2; ?></div>
              </div>
              <div class="wt-icon">
                <i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i>
              </div>
            </div>
          </div>
          </a>
          
        </div>


      
       <?php /*if($noRows!=0) {*/ ?>
        <!-- <div class="col-md-6 m-b-30">
          <h4 class="m-t-0 m-b-30">Pie chart</h4>
          <div id="pie" style="height: 300px"></div>
        </div> -->
        <?php /*}*/ ?>

      </div>
     <?php include_once 'admin_includes/footer.php'; ?>
      
     <script src="js/charts-flot.min.js"></script>
     <script type="text/javascript">
            /*$(document).ready(function() {
                
                var pie = function () {
                    var data = [
                      {
                        label: "Orders",
                        data: <?php echo getRowsCount('orders')?>,
                        color: "#34a853",
                      }, 
                      {
                        label: "Number Of Deliveries",
                        data: <?php echo $noRows;?>,
                        color: "#7d57c1",
                    }];
                    var options = {
                        series: {
                            pie: {
                                show: true
                            }
                        },
                        legend: {
                            labelFormatter: function(label, series){
                                return '<span class="pie-chart-legend">'+label+'</span>';
                            }
                        },
                        grid: {
                            hoverable: true
                        },
                        tooltip: true,
                        tooltipOpts: {
                            content: "%p.0%, %s",
                            shifts: {
                                x: 20,
                                y: 0
                            },
                            defaultTheme: false
                        }
                    };
                    $.plot($("#pie"), data, options);
                };

                pie();
               
            });*/
        </script>