<?php
session_start();
date_default_timezone_set("Asia/Kolkata"); 

$setcon = 1;
if($setcon == 2) {
	$servername = "localhost";
	$username = "lanciyqs_food_do";
	$password = "lancius12#";
	$dbname = "lanciyqs_food_dose";
} else {
	$servername = "localhost";	
	$username = "root";
	$password = "";
	$dbname = "food_dose";
}  

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//$base_url = "http://lancius.in/fooddose/";
$base_url= "http://localhost/food_dose/";

?>