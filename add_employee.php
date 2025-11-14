<?php
require 'config.php';
require 'functions.php';
check_login();

if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $department = $_POST['department'];
    $position   = $_POST['position'];
    $salary     = $_POST['salary'];

    $stmt = $conn->prepare("INSERT INTO employees (first_name,last_name,email,phone,department,position,salary) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssd",$first_name,$last_name,$email,$phone,$department,$position,$salary);
    $stmt->execute();

    set_flash("Employee added successfully!");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Add Employee</h2>
    <form method="POST">
        <div class="row mb-3">
            <div class="col"><input type="text" name="first_name" placeholder="First Name" class="form-control" required></div>
            <div class="col"><input type="text" name="last_name" placeholder="Last Name" class="form-control" required></div>
        </div>
        <div class="mb-3"><input type="email" name="email" placeholder="Email" class="form-control" required></div>
        <div class="mb-3"><input type="text" name="phone" placeholder="Phone" class="form-control"></div>
        <div class="row mb-3">
            <div class="col"><input type="text" name="department" placeholder="Department" class="form-control"></div>
            <div class="col"><input type="text" name="position" placeholder="Position" class="form-control"></div>
        </div>
        <div class="mb-3"><input type="number" name="salary" placeholder="Salary" class="form-control" step="0.01"></div>
        <button type="submit" name="submit" class="btn btn-success">Add Employee</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
