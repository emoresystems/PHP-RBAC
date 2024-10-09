<?php

require("db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // insert the details to db
    $stmt = $conn->prepare('INSERT INTO users(username, password, role) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $username, $password, $role);
    
    if($stmt->execute()){
        echo'registration sucessful';
    }else{
        echo 'failed to register';
    }
}

?>

<form action="register.php" method="POST">
    <label for="username">username</label>
    <input type="text" name="username" id="username" required> <br>

    <label for="password">password</label>
    <input type="password" name="password" id="password" required> 

    <label for="Role">Select Role</label>
    <select name="role">
        <option value="user">Normal User</option>
        <option value="agent">Agent User</option>
        <!-- <option value="admin">Admin User</option> -->
    </select> <br>

    <button type="submit">Register</button>


</form>