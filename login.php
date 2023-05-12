<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $usersFile = trim(file_get_contents('users.txt'));
    $users = explode(PHP_EOL, $usersFile);

    foreach($users as $user){
        $credentials = preg_split("/,\s*|=\s*/", $user);
        
        if($credentials[1] === $username && password_verify($password, $credentials[2])){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            return header("Location:welcome.php?username=$username");
        }

        $_SESSION['errors']['combination'] = "Wrong username and password combination"; 
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login">
        <div class="wrap">
            <div class="title">
                <h1>Login</h1>
            </div>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Enter your password">
                </div>
                <?php if(isset( $_SESSION['errors']['combination'])){echo "<p class='error'>".  $_SESSION['errors']['combination'] ."</p>";} ?>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <?php 
    unset($_SESSION['errors']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    ?>
</body>
</html>