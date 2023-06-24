<?php

require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    $_SESSION['errorMessage'] = 'Please try again';
    header('Location: ../dashboard.php');
    exit();
}

$query = new Database\Query();

$id = $_POST['id'];
$registration = $query->select('registrations', $id);

if($registration){
    $query->extendRegistration($registration, $id);
    $_SESSION['successMessage'] = 'Registration extended for 1 year';
    header('Location: ../dashboard.php');
} else {
    $_SESSION['errorMessage'] = "Couldn't extend registration";
    header('Location: ../dashboard.php');
}

?>