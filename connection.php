<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'todo_app';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Database Connection Failed: ' . $conn->connect_error);
}
?>
