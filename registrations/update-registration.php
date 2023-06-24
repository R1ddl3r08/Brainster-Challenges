<?php

require_once('validate-registration.php');

$id = $_POST['id'];

if(empty($_SESSION['validationErrors'])){
    $query->updateRegistration($id, $vehicleModel, $vehicleType, $vehicleChassisNumber, $vehicleProductionYear, $vehicleRegistrationNumber, $fuelType, $registrationTo);
    $_SESSION['successMessage'] = 'Registration updated successfully';
    header('Location: ../dashboard.php');
} else {
    header('Location: ../registration.php?id=' . $id);
}

?>