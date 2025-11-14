<?php
require 'config.php';
require 'functions.php';
check_login();

if(!isset($_GET['id'])) header("Location: index.php");

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM employees WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$employee = $stmt->get_result()->fetch_assoc();

if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $department = $_POST['department'];
    $position   = $_POST['position'];
    $salary     = $_POST['salary'];

    $stmt = $conn->prepare("UPDATE employees SET first_name=?,last_name=?,email=?,phone=?,department=?,position=?,salary=? WHERE id=?");
    $stmt->bind_param("ssssssdi",$first_name,$last_name,$email,$phone,$department,$position,$salary,$id);
    $stmt->execute();

    set_flash("Employee updated successfully!");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Edit Employee</h2>
    <form method="POST">
        <div class="row mb-3">
            <div class="col"><input type="text" name="first_name" class="form-control" value="<?= e($employee['first_name']) ?>" required></div>
            <div class="col"><input type="text" name="last_name" class="form-control" value="<?= e($employee['last_name']) ?>" required></div>
        </div>
        <div class="mb-3"><input type="email" name="email" class="form-control" value="<?= e($employee['email']) ?>" required></div>
        <div class="mb-3"><input type="text" name="phone" class="form-control" value="<?= e($employee['phone']) ?>"></div>
        <div class="row mb-3">
            <div class="col"><input type="text" name="department" class="form-control" value="<?= e($employee['department']) ?>"></div>
            <div class="col"><input type="text" name="position" class="form-control" value="<?= e($employee['position']) ?>"></div>
        </div>
        <div class="mb-3"><input type="number" name="salary" class="form-control" value="<?= e($employee['salary']) ?>" step="0.01"></div>
        <button type="submit" name="submit" class="btn btn-warning">Update Employee</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
