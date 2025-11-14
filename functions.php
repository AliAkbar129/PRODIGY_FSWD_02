<?php
// Sanitize output
function e($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Flash messages
function set_flash($message, $type='success'){
    $_SESSION['flash'] = ['message'=>$message,'type'=>$type];
}

function display_flash(){
    if(isset($_SESSION['flash'])){
        $flash = $_SESSION['flash'];
        echo "<div class='alert alert-{$flash['type']}'>{$flash['message']}</div>";
        unset($_SESSION['flash']);
    }
}

// Authentication check
function check_login(){
    if(!isset($_SESSION['admin_id'])){
        header("Location: login.php");
        exit;
    }
}
?>
