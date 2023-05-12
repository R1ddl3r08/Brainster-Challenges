<?php

function uniqueCredentials($users, $email, $username){
    foreach($users as $user){
        $credentials = preg_split("/,\s*|=\s*/", $user);
        if($credentials[0] == $email){
            $_SESSION['inuse']['email'] = "‘A user
            with this email already exists";
        }

        if($credentials[1] == $username){
            $_SESSION['inuse']['username'] = 'Username taken';
        }
    }
}

function isValidUsername($username){
    if(!preg_match('/[\s\W]+/', $username)){
        return true;
    }
    return false;
}

function isValidEmail($email){
    $at = strpos($email, '@');

    if(filter_var($email, FILTER_VALIDATE_EMAIL) && $at >= 5){
        return true;
    }
    return false;
}

function isValidPassword($password){
    if(preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,}$/', $password)){
        return true;
    }
    return false;
}

?>