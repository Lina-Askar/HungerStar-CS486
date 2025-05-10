<?php
$host = 'localhost';
$user = 'root';
$password = ''; // Use your password if any
$database = 'hunger_star';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
