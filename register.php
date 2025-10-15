<?php 
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Register</h2>
<form action="register.php" method="post">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button> <br><br>
    <a href="login.php">login.php</a>
</form>
<style>
form{
    border: 1px solid black;
    background: whitesmoke;
    padding: 20px 31px;
    text-align: center;
}
input[type="text"]{
    padding: 12px;
    width: 50%;
    margin-bottom: 7px;
}
input[type="email"]{
    padding: 12px;
    width: 50%;
    margin-bottom: 7px;
}
input[type="password"]{
    padding: 12px;
    width: 50%;
    margin-right: 20px;
    margin-bottom: 7px;
}
button{
     padding: 12px;
    width: 30%;
    margin-left: 20px;
    margin-bottom: 7px;
}
</style>