<?php
session_start();
date_default_timezone_set("Asia/Kolkata"); 

$setcon = 2;
if($setcon == 1) {
	$servername = "localhost";
	$username = "lanciyqs_food_do";
	$password = "lancius12#";
	$dbname = "lanciyqs_food_dose";
} else {
	$servername = "192.168.0.110";	
	$username = "root";
	$password = "root";
	$dbname = "food_dose";
}  

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$base_url = "http://192.168.0.110/fooddose/";

?>