<?php

require_once('autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $query = new Database\Query();

    $validated = $query->validateAdmin($_POST['email'], $_POST['password']);

    if($validated){
        $_SESSION['loggedIn'] = true;
        header('Location: dashboard.php');
    } else {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['errorMessage'] = "Email and password don't match";
        header('Location: login-page.php');
    }

} else {
    $_SESSION['errorMessage'] = 'Please try again';
    header('Location: login-page.php');
}

?>