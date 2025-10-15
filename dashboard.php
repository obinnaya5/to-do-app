<?php
session_start();
include('connection.php');

if (!isset($_SESSION['users_id'])) {
    header("Location: login.php");
    exit;
}

$users_id = $_SESSION['users_id'];

// Handle task add
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task_text'];
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, task_text) VALUES (?, ?)");
    $stmt->bind_param("is", $users_id, $task);
    $stmt->execute();
}

// Fetch tasks with id for delete button
$stmt = $conn->prepare("SELECT id, task_text, created_at FROM tasks WHERE user_id = ?");
$stmt->bind_param("i", $users_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>Your ToDo List</h2>
<form action="dashboard.php" method="post">
    <input type="text" name="task_text" required placeholder="Enter new task"><br><br>
    <button type="submit">Add Task</button>
</form>

<h3>Tasks:</h3>

<table border="1" cellpadding="8" cellspacing="0" >
    <thead>
        <tr>
            <th>Task 🥇</th>
            <th>Created At 🔢</th>
            <th>Edit ✏️</th>
            <th>Delete 🗓️</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['task_text']) ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>">✏️</a>
                </td>
                <td>
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">🗑</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<a href="logout.php">Logout</a>



<!-- styling the type text -->

<style>
    button{
        padding: 13px;
        width: 20%;
    }
    input[type="text"]{
        padding: 13px;
        width: 50%;
    }
</style>




<!-- STYLING FOR THE TABLE ONLY -->

<style>
    table {
        width: 100%;
        border-collapse: collapse; 
    }

    th {
        background-color: #007BFF; 
        color: white;              
        padding: 12px;             
        text-align: left;           
    }

    td {
        padding: 10px;
        border: 1px solid #ccc;     
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;  
    }

    tr:hover {
        background-color: #eef6ff;  
    }
</style>

