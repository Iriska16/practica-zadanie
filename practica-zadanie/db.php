<?php
session_start();
$host = 'localhost';
$db   = 'proect';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Ошибка подключения к БД: ' . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");

function checkAuth() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
}
?>