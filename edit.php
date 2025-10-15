<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['users_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$task_id = (int)$_GET['id'];
$user_id = (int)$_SESSION['users_id'];

$stmt = $conn->prepare("SELECT task_text FROM tasks WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $task_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();

if (!$task) {
    die("Task not found or you don't have permission to edit it.");
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Edit Task</title></head>
<body>
    <h2>Edit Task</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= $task_id ?>">
        <input type="text" name="task_text" value="<?= htmlspecialchars($task['task_text']) ?>" required>
        <button type="submit">Update</button>
    </form>
    <p><a href="dashboard.php">⬅ Back</a></p>
</body>
</html>
<style>
    [type="text"]{
        width: 600px;
        padding: 5%;

    }
    button{
        padding: 2%;
        width: 20%
    }
</style>