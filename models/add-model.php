<?php

require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $query = new Database\Query();

    if(!empty($_POST['vehicle_model'])){
        $query->addVehicleModel(trim($_POST['vehicle_model']));
        $_SESSION['successMessage'] = 'Model added successfully';
        header('Location: view-models.php');
    } else {
        $_SESSION['errorMessage'] = 'Please try again';
        header('Location: view-models.php');
    }
}

?>