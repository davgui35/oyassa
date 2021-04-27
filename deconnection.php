<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}
//Supprime une variable
unset($_SESSION['admin']);
unset($_SESSION['newOrder']);
session_destroy();

if (!isset($_SESSION['user_admin'])) {
    header('Location: index.php');
    exit();
}
//Supprime une variable
unset($_SESSION['user_admin']);
unset($_SESSION['newOrder']);
session_destroy();

header('Location: index.php');

//Attention, session_destroy supprime tout.(les paniers, les messages, etc)