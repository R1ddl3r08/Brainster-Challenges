<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    @include "functions.php";
    $username = trim($_POST['username']);
    $unhashedPassword = $_POST['password'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = trim($_POST['email']);
    $users = file('users.txt');

    $_SESSION['email'] = $email;

    uniqueCredentials($users, $email, $username);

    if(empty($username)){
        $_SESSION['errors']['username'] = "Username is required";
    } elseif(!isValidUsername($username)){
        $_SESSION['errors']['username'] = "The username can't contain space or specials characters";
    } else {
        $_SESSION['username'] = $username;
    }

    if(empty($email)){
        $_SESSION['errors']['email'] = "Email is required";
    } elseif(!isValidEmail($email)){
        $_SESSION['errors']['email'] = "Email is invalid(must have at least 5 characters before '@')";
    } else {
        $_SESSION['email'] = $email;
    }

    if(empty($unhashedPassword)){
        $_SESSION['errors']['password'] = "Password is required";
    } elseif(!isValidPassword($unhashedPassword)){
        $_SESSION['errors']['password'] = "Password must contain one uppercase letter, one number and one special sign";
    } else {
        $_SESSION['password'] = $unhashedPassword;
    }

    if(empty($_SESSION['errors']) && empty($_SESSION['inuse'])){
        file_put_contents("users.txt", "$email, $username=$password" . PHP_EOL, FILE_APPEND);

        header("Location:welcome.php?username=$username");

    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup">
        <div class="wrap">
            <div class="title">
                <h1>Sign Up</h1>
            </div>
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="email" placeholder="Enter email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''?>">
                    <small class='red'><?= isset($_SESSION['errors']['email']) ? $_SESSION['errors']['email'] : ''?></small>
                    <small class='yellow'><?= isset($_SESSION['inuse']['email']) ? $_SESSION['inuse']['email'] : ''?></small>
                </div>
                <div class="form-group">
                    <input type="text" name="username" placeholder="Enter username" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : ''?>">
                    <small class='red'><?= isset($_SESSION['errors']['username']) ? $_SESSION['errors']['username'] : ''?></small>
                    <small class='yellow'><?= isset($_SESSION['inuse']['username']) ? $_SESSION['inuse']['username'] : ''?></small>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Enter password">
                    <small class='red'><?= isset($_SESSION['errors']['password']) ? $_SESSION['errors']['password'] : ''?></small>
                </div>
                <button type="submit">Sign up</button>
            </form>
        </div>
    </div>

    <?php 
        unset($_SESSION['errors']);
        unset($_SESSION['inuse']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['password']);
    ?>
</body>
</html>