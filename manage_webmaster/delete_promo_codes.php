<?php include_once 'admin_includes/main_header.php'; ?>
<?php
 /*$getTersmsAndConditionsData = getDataFromTables('terms_and_conditions',$status=NULL,$clause=NULL,$id=NULL,$activeStatus=NULL,$activeTop=NULL);*/
$id = $_GET['tid'];
$qry = "DELETE FROM promo_codes WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Promo Code Deleted Successfully');window.location.href='promo_codes.php';</script>";
} else {
   echo "<script>alert('Promo Code Not Deleted');window.location.href='promo_codes.php';</script>";
}
?>