<?php
require 'config.php';
require 'functions.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if($result && password_verify($password,$result['password'])){
        $_SESSION['admin_id'] = $result['id'];
        $_SESSION['admin_name'] = $result['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Employee Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            background: linear-gradient(to right, #667eea, #764ba2);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            background: #fff;
        }
        .login-card .card-header {
            background: linear-gradient(to right, #667eea, #764ba2);
            color: #fff;
            font-weight: 600;
            font-size: 1.5rem;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .form-control {
            border-radius: 50px;
            padding-left: 40px;
        }
        .form-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
        }
        .btn-login {
            border-radius: 50px;
            padding: 10px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #5a67d8;
        }
        .position-relative { position: relative; }
    </style>
</head>
<body>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-5">
        <div class="card login-card">
            <div class="card-header text-center">Admin Login</div>
            <div class="card-body">
                <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                <form method="POST">
                    <div class="mb-3 position-relative">
                        <i class="fa fa-user form-icon"></i>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="mb-3 position-relative">
                        <i class="fa fa-lock form-icon"></i>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100 btn-login">Login</button>
                </form>
            </div>
            <div class="card-footer text-center text-muted">
                &copy; <?= date('Y'); ?> Employee Management System
            </div>
        </div>
    </div>
</div>
</body>
</html>
