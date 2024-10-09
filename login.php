<?php
require("db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    // fetch user from db
    $stmt = $conn->prepare('SELECT id, username, password, role FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // set session variables
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            echo 'login successfull';

            // redirect user depending on role
            if ($user['role'] == "admin") {
                header("Location:admin_dashboard.php");
            } elseif ($user['role'] == 'agent') {
                header("Location:agent_dashboard.php");
            } else {
                header("Location:user_dashboard.php");
            }
        } else {
            echo 'invalid password';
        }
    } else {
        echo 'No user found';
    }
}



?>
<!-- login form -->
<form action="login.php" method="POST">
    <label for="username">username</label>
    <input type="text" name="username" id="username" required> <br>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required> <br>

    <button type="submit">Login</button>
</form>