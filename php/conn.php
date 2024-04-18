<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "barangay_health_center";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
