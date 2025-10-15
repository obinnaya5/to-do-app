<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['users_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = (int)$_POST['id'];
    $task_text = trim($_POST['task_text']);
    $user_id = (int)$_SESSION['users_id'];

    if ($task_text === '') {
        die("Task cannot be empty.");
    }

    $stmt = $conn->prepare("UPDATE tasks SET task_text = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sii", $task_text, $task_id, $user_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
