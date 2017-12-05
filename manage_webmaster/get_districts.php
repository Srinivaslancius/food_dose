<?php
include_once('admin_includes/config.php');
include_once('admin_includes/common_functions.php');
if(!empty($_POST["lkp_state_id"])) {
	$query ="SELECT * FROM lkp_districts WHERE status = 0 AND lkp_state_id = '" . $_POST["lkp_state_id"] . "'";
	$results = $conn->query($query);
?>
	<option value="">Select District</option>
<?php
	foreach($results as $districts) {
?>
	<option value="<?php echo $districts["id"]; ?>"><?php echo $districts["district_name"]; ?></option>
<?php
	}
}
?>
