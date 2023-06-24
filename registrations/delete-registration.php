<?php

require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $query = new Database\Query();
    
    $exists = $query->exists('registrations', $_POST['id']);

    if($exists){
        $query->deleteRegistration($_POST['id']);
        $_SESSION['successMessage'] = 'Registration has been deleted successfully';
        header('Location: ../dashboard.php');
    } else {
        $_SESSION['errorMessage'] = 'No such registration exists';
        header('Location: ../dashboard.php');
    }
}

?>