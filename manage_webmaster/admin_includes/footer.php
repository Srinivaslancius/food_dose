    <div class="site-footer"> Design & Developed By Lancius IT Solutions</div> 
    </div>
    <script src="js/vendor.min.js"></script>
    <script src="js/cosmos.min.js"></script>
    <script src="js/application.min.js"></script>
    <script src="js/index.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
      $( function() {
        $( "#start_date,#end_date,#created_date,#order_date,#cancel_date,#date" ).datepicker();
      } );
    </script>
    <script>
    	function isNumberKey(evt){
  	    var charCode = (evt.which) ? evt.which : event.keyCode
  	    if (charCode > 31 && (charCode < 48 || charCode > 57))
  	        return false;
  	    return true;
    	}
	  </script>
    <script type="text/javascript">
      //$(document).ready(function(){
          $(".click_view").click(function(){
              var modalId = $(this).attr('data-modalId');
              $("#myModal_"+modalId).modal('show');  
          });
      //});
    </script>
	  <script>
      var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
      };

      //check status active or not
        $(".check_active").click(function(){
          var check_active_id = $(this).attr("data-incId");
          var table_name = $(this).attr("data-tbname");
          var current_status = $(this).attr("data-status");
          if(current_status == 0) {
            send_status = 1;
          } else {
            send_status = 0;
          }
          $.ajax({
            type:"post",
            url:"changestatus.php",
            data:"check_active_id="+check_active_id+"&table_name="+table_name+"&send_status="+send_status,
            success:function(result){  
              if(result ==1) {
                //alert("Your Status Updated!");
                //location.reload();
                window.location = "?msg=success";
              }
            }
          });
        }); 
      //Set time for messge notifications
      $(document).ready(function () {
        setTimeout(function () {
          $('#set_valid_msg').hide();
        }, 2000);
      });
    </script>
    <script type="text/javascript">
      function checkUserAvailTest() {
        var userInput = document.getElementById("user_input").value;
        var table = document.getElementById("table_name").value;
        var columnName = document.getElementById("column_name").value;
        if (userInput){
          $.ajax({
          type: "POST",
          url: "common_user_avail_check.php",
          data: {
            userInput:userInput,table:table,columnName:columnName,
          },
          success: function (response) {
            if (response > 0){
              $('#input_status').html("<span>Already Exist</span>");
              $("#user_input").val("");
            } else {
              $('#input_status').html("");        
            }
          }
          });          
        }
      }
    </script>
  </body>
  <style>
    .modal-body{
      font-size:15px;
      text-align:justify;
      padding-left:110px;
      padding-top:30px;
      font-family:Roboto,sans-serif;
    }
    .open_cursor {
      cursor: pointer !important;
    }
  </style>
</html>