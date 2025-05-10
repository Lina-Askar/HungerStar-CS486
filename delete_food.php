<?php
session_start();
include("db_connect.php");

// Check if the user is an admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: login.php");
    exit();
}

$food_id = $_GET['id'];

$delete_query = "DELETE FROM foods WHERE id = '$food_id'";

if ($conn->query($delete_query) === TRUE) {
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
