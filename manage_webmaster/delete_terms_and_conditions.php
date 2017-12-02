<?php include_once 'admin_includes/main_header.php'; ?>
<?php
 /*$getTersmsAndConditionsData = getDataFromTables('terms_and_conditions',$status=NULL,$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);*/
$id = $_GET['tid'];
$qry = "DELETE FROM terms_and_conditions WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Terms And Condition Deleted Successfully');window.location.href='terms_and_conditions.php';</script>";
} else {
   echo "<script>alert('Terms And Condition Not Deleted');window.location.href='terms_and_conditions.php';</script>";
}
?>