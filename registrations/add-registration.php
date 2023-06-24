<?php

require_once('validate-registration.php');

if($query->chassisExists($vehicleChassisNumber)){
    $_SESSION['validationErrors']['vehicleChassisNumber'] = 'Registration for this vehicle chassis number already exists';
} else {
    $_SESSION['vehicleChassisNumber'] = $vehicleChassisNumber;
}

if(empty($_SESSION['validationErrors'])){
    $formatRegistrationTo = $query->formatDate($registrationTo);
    $formatVehicleProductionYear = $query->formatDate($vehicleProductionYear);
    $query->addRegistration($vehicleModel, $vehicleType, $vehicleChassisNumber, $formatVehicleProductionYear, $vehicleRegistrationNumber, $fuelType, $formatRegistrationTo);
    $_SESSION['successMessage'] = 'Registration added successfully';
    header('Location: ../dashboard.php');
} else {
    header('Location: ../dashboard.php');
}

?>