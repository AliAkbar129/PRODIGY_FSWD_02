<?php
require 'config.php';
require 'functions.php';
check_login();

$result = $conn->query("SELECT * FROM employees ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h2>Employees</h2>
        <div>
            <a href="add_employee.php" class="btn btn-success">Add Employee</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <?php display_flash(); ?>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
                <th>Department</th><th>Position</th><th>Salary</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= e($row['id']) ?></td>
                <td><?= e($row['first_name']." ".$row['last_name']) ?></td>
                <td><?= e($row['email']) ?></td>
                <td><?= e($row['phone']) ?></td>
                <td><?= e($row['department']) ?></td>
                <td><?= e($row['position']) ?></td>
                <td><?= e($row['salary']) ?></td>
                <td>
                    <a href="edit_employee.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_employee.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this employee?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
