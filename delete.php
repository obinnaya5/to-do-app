<?php
session_start();
include('connection.php');

if (!isset($_SESSION['users_id'])) {
    header("Location: login.php");
    exit;
}

$users_id = $_SESSION['users_id'];

if (isset($_GET['id'])) {
    $task_id = intval($_GET['id']); // security: force integer
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $users_id);
    $stmt->execute();
}

// After delete, redirect back to dashboard
header("Location: dashboard.php");
exit;
?>
