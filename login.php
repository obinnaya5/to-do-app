<?php
session_start();
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
        $_SESSION['users_id'] = $userId;
        header("Location: dashboard.php");
    } else {
        echo "Invalid login details.";
    }
}
?>

<h2>Login</h2>
<form action="login.php" method="post" class="form">
    Email:
     <input type="email" name="email" required placeholder="enter email here example@gmail.com"><br><br>
    Password:
     <input type="password" name="password" required placeholder="enter your password"><br><br>
    <button type="submit">Login</button>
    <h2>:</h2>
</form>
<style>

form{
    border: 1px solid black;
    flex-direction: column;
    padding: 20px;
    background-color: gold;
    border-radius: 10px;



}
input[type="email"]{
    padding: 15px;
    width: 300px;
    margin-left: 21px;
    border-radius: 40px;
}
input[type="password"]{
      padding: 15px;
    width: 300px;
    border-radius: 40px;
}
button{
   padding: 15px;
    width: 300px; 
    /* text-align: center; */
    position: absolute;
    left: 35%;
    right: 50%;
    top: 40%;
    transform: translate(-50%, -50%);
    border-radius: 40px;
    
}

</style>