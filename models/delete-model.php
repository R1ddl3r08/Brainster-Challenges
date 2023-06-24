<?php

require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $query = new Database\Query();
    
    $exists = $query->exists('vehicle_models', $_POST['id']);

    if($exists){
        $query->deleteVehicleModel($_POST['id']);
        $_SESSION['successMessage'] = 'Model has been deleted successfully';
        header('Location: view-models.php');
    } else {
        $_SESSION['errorMessage'] = 'No such model exists';
        header('Location: view-models.php');
    }
}

?>