<?php

require_once('../autoload.php');

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    $_SESSION['errorMessage'] = 'Please try again';
    header('Location: dashboard.php');
}

$query = new Database\Query();

$vehicleModel = trim($_POST['vehicle_model']);
$vehicleChassisNumber = trim($_POST['vehicle_chassis_number']);
$vehicleRegistrationNumber = trim($_POST['vehicle_registration_number']);
$registrationTo = trim($_POST['registration_to']);
$vehicleType = trim($_POST['vehicle_type']);
$vehicleProductionYear = trim($_POST['vehicle_production_year']);
$fuelType = trim($_POST['fuel_type']);

if(empty($vehicleModel)){
    $_SESSION['validationErrors']['vehicleModel'] = 'Vehicle Model is required';
} else {
    $_SESSION['vehicleModel'] = $vehicleModel;
}

if(empty($vehicleChassisNumber)){
    $_SESSION['validationErrors']['vehicleChassisNumber'] = 'Vehicle chassis number is required';
}

if(empty($vehicleRegistrationNumber)){
    $_SESSION['validationErrors']['registrationNumber'] = 'Registration number is required';
} else {
    $_SESSION['registrationNumber'] = $vehicleRegistrationNumber;
} 

if(empty($registrationTo)){
    $_SESSION['validationErrors']['registrationTo'] = 'Registration to is required';
} elseif(!($query->isValidDateFormat($registrationTo))) {
    $_SESSION['validationErrors']['registrationTo'] = 'Please enter with the following date format: mm/dd/yyyy';
} else {
    $_SESSION['registrationTo'] = $registrationTo;
} 


if(empty($vehicleType)){
    $_SESSION['validationErrors']['vehicleType'] = 'Vehicle type is required';
} elseif(!($query->exists('vehicle_types', $vehicleType))) {
    $_SESSION['validationErrors']['vehicleType'] = 'Vehicle type does not exist';
} else {
    $_SESSION['vehicleType'] = $vehicleType;
} 

if(empty($vehicleProductionYear)){
    $_SESSION['validationErrors']['vehicleProductionYear'] = 'Vehicle production year is required';
} elseif(!($query->isValidDateFormat($vehicleProductionYear))) {
    $_SESSION['validationErrors']['vehicleProductionYear'] = 'Please enter with the following date format: mm/dd/yyyy';
} else {
    $_SESSION['vehicleProductionYear'] = $vehicleProductionYear;
} 


if(empty($fuelType)){
    $_SESSION['validationErrors']['fuelType'] = 'Fuel type is required';
} elseif(!($query->exists('fuel_types', $fuelType))) {
    $_SESSION['validationErrors']['fuelType'] = 'Fuel type does not exist';
} else {
    $_SESSION['fuelType'] = $fuelType;
} 


?>