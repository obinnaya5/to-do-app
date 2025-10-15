<?php
session_start();
include ('connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$title = $_POST['title'];

$stmt = $conn->prepare("INSERT INTO tasks (user_id, title) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $title);
$stmt->execute();

header("Location: index.php");
