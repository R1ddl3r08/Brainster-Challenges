<?php

require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $query = new Database\Query();

    $query->updateVehicleModel(trim($_POST['vehicle_model']), $_POST['vehicle_id']);
    $_SESSION['successMessage'] = 'Model has been updated successfully';
    header('Location: view-models.php');
}

?>