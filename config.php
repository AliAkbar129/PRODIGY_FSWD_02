<?php
// Start secure session
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => false, 
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'employee_system';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
