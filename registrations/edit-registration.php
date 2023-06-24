<?php

require_once('../autoload.php');

$query = new Database\Query();
$id = $_GET['id'];

if($query->exists('registrations', $id)){
    $registration = $query->select('registrations', $id);
} else {
    echo 'Error: No such registration exists';
    die();
}

$vehicleModels = $query->getAll('vehicle_models');
$vehicleTypes = $query->getAll('vehicle_types');
$fuelTypes = $query->getAll('fuel_types');

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Registration</title>
        <meta charset="utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />

        <!-- Latest compiled and minified Bootstrap 4.6 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <!-- CSS script -->
        <link rel="stylesheet" href="style.css">
        <!-- Latest Font-Awesome CDN -->
        <script src="https://kit.fontawesome.com/64087b922b.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="container">
            <div class="row">
                <div class="col-12 text-center mt-4">
                    <h1>Vehicle Registration</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                    
                        $successMessage = $_SESSION['successMessage'] ?? '';
                        $errorMessage = $_SESSION['errorMessage'] ?? '';

                        if($successMessage){
                            echo '<div class="alert alert-success">'. $successMessage .'</div>';
                        }

                        if($errorMessage){
                            echo '<div class="alert alert-danger">'. $errorMessage .'</div>';
                        }

                        unset($_SESSION['successMessage']);
                        unset($_SESSION['errorMessage']);
                    
                    ?>
                    <form action="update-registration.php" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="id" value="<?= $id ?>" hidden>
                                <div class="form-group">
                                    <label for="vehicle_model">Vehicle Model</label>
                                    <select name="vehicle_model" id="vehicle_model" class="form-control">
                                        <option value="">Default select</option>
                                        <?php foreach($vehicleModels as $model) : ?>
                                            <option value="<?= $model['id'] ?>" <?= ($registration['vehicle_model'] == $model['id']) ? 'selected' : '' ?>><?= $model['vehicle_model'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if(!empty($_SESSION['validationErrors']['vehicleModel'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['vehicleModel'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['vehicleModel']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_chassis_number">Vehicle chassis number</label>
                                    <input type="text" id="vehicle_chassis_number" name="vehicle_chassis_number" class="form-control" value="<?= $registration['vehicle_chassis_number'] ?>">
                                    <?php if(!empty($_SESSION['validationErrors']['vehicleChassisNumber'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['vehicleChassisNumber'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['vehicleChassisNumber']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_registration_number">Vehicle registration number</label>
                                    <input type="text" id="vehicle_registration_number" name="vehicle_registration_number" class="form-control" value="<?= $registration['registration_number'] ?>">
                                    <?php if(!empty($_SESSION['validationErrors']['registrationNumber'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['registrationNumber'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['registrationNumber']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="registration_to">Registration to</label>
                                    <input type="text" id="registration_to" name="registration_to" class="form-control" placeholder="mm/dd/yyyy" value="<?= $registration['registration_to'] ?>">
                                    <?php if(!empty($_SESSION['validationErrors']['registrationTo'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['registrationTo'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['registrationTo']); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="vehicle_type">Vehicle Type</label>
                                    <select name="vehicle_type" id="vehicle_type" class="form-control">
                                        <option value="">Default select</option>
                                        <?php foreach($vehicleTypes as $type) : ?>
                                            <option value="<?= $type['id'] ?>" <?= $registration['vehicle_type'] == $type['id'] ? 'selected' : '' ?> ><?= $type['vehicle_type'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if(!empty($_SESSION['validationErrors']['vehicleType'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['vehicleType'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['vehicleType']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_production_year">Vehicle production year</label>
                                    <input type="text" id="vehicle_production_year" name="vehicle_production_year" class="form-control" placeholder="mm/dd/yyyy" value="<?= $registration['vehicle_production_year'] ?>">
                                    <?php if(!empty($_SESSION['validationErrors']['vehicleProductionYear'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['vehicleProductionYear'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['vehicleProductionYear']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="fuel_type">Fuel Type</label>
                                    <select name="fuel_type" id="fuel_type" class="form-control">
                                        <option value="">Default select</option>
                                        <?php foreach($fuelTypes as $fuel) : ?>
                                            <option value="<?= $fuel['id'] ?>" <?= $registration['fuel_type'] == $fuel['id'] ? 'selected' : '' ?> ><?= $fuel['fuel_type'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if(!empty($_SESSION['validationErrors']['fuelType'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['fuelType'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['fuelType']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="submit" class="invisible">Edit</label>
                                    <button type="submit" class="btn btn-warning form-control">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="ha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        
        <!-- Latest Compiled Bootstrap 4.6 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    </body>
</html>