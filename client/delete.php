<?php 
session_start();
if (isset($_SESSION['admin'])) {
    unset($_SESSION['newOrder']);
    header('Location: ../admin/admin.php');
    exit();
}
if (isset($_SESSION['user_admin'])) {
    unset($_SESSION['newOrder']);
    header('Location: ../user/user.php');
    exit();
}
?>