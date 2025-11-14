<?php
require 'config.php';
require 'functions.php';
check_login();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM employees WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    set_flash("Employee deleted successfully!", "danger");
}
header("Location: index.php");
exit;
