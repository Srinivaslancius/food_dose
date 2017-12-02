<?php include_once 'admin_includes/main_header.php'; ?>
<?php
$id = $_GET['tid'];
$qry = "DELETE FROM faqs WHERE id ='$id'";
$result = $conn->query($qry);
if(isset($result)) {
   echo "<script>alert('Faq Deleted Successfully');window.location.href='faqs.php';</script>";
} else {
   echo "<script>alert('Faq Not Deleted');window.location.href='faqs.php';</script>";
}
?>