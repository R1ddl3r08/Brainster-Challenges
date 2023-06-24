<?php 
    
    require_once('autoload.php');

    $query = new Database\Query();

    $vehicleModels = $query->getAll('vehicle_models');
    $vehicleTypes = $query->getAll('vehicle_types');
    $fuelTypes = $query->getAll('fuel_types');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $registrations = $query->adminSearchRegistration(trim($_POST['search']));
    } else {
        $registrations = $query->getRegistrations();
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
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
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">Vehicle Registration</a>
            <div class="navbar-links">
                <a href="models/view-models.php" class="mr-3">View all vehicle models</a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>

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
                    <form action="registrations/add-registration.php" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="vehicle_model">Vehicle Model</label>
                                    <select name="vehicle_model" id="vehicle_model" class="form-control">
                                        <option value="">Default select</option>
                                        <?php foreach($vehicleModels as $model) : ?>
                                            <option value="<?= $model['id'] ?>" <?= (isset($_SESSION['vehicleModel']) && $_SESSION['vehicleModel'] == $model['id']) ? 'selected' : '' ?>><?= $model['vehicle_model'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if(!empty($_SESSION['validationErrors']['vehicleModel'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['vehicleModel'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['vehicleModel']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_chassis_number">Vehicle chassis number</label>
                                    <input type="text" id="vehicle_chassis_number" name="vehicle_chassis_number" class="form-control" value="<?= isset($_SESSION['vehicleChassisNumber']) ? $_SESSION['vehicleChassisNumber'] : '' ?>">
                                    <?php if(!empty($_SESSION['validationErrors']['vehicleChassisNumber'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['vehicleChassisNumber'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['vehicleChassisNumber']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_registration_number">Vehicle registration number</label>
                                    <input type="text" id="vehicle_registration_number" name="vehicle_registration_number" class="form-control" value="<?= isset($_SESSION['registrationNumber']) ? $_SESSION['registrationNumber'] : '' ?>">
                                    <?php if(!empty($_SESSION['validationErrors']['registrationNumber'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['registrationNumber'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['registrationNumber']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="registration_to">Registration to</label>
                                    <input type="text" id="registration_to" name="registration_to" class="form-control" placeholder="mm/dd/yyyy" value="<?= isset($_SESSION['registrationTo']) ? $_SESSION['registrationTo'] : '' ?>">
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
                                            <option value="<?= $type['id'] ?>" <?= (isset($_SESSION['vehicleType']) && $_SESSION['vehicleType'] == $type['id']) ? 'selected' : '' ?>><?= $type['vehicle_type'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if(!empty($_SESSION['validationErrors']['vehicleType'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['vehicleType'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['vehicleType']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_production_year">Vehicle production year</label>
                                    <input type="text" id="vehicle_production_year" name="vehicle_production_year" class="form-control" placeholder="mm/dd/yyyy" value="<?= isset($_SESSION['vehicleProductionYear']) ? $_SESSION['vehicleProductionYear'] : '' ?>">
                                    <?php if(!empty($_SESSION['validationErrors']['vehicleProductionYear'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['vehicleProductionYear'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['vehicleProductionYear']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="fuel_type">Fuel Type</label>
                                    <select name="fuel_type" id="fuel_type" class="form-control">
                                        <option value="">Default select</option>
                                        <?php foreach($fuelTypes as $fuel) : ?>
                                            <option value="<?= $fuel['id'] ?>" <?= (isset($_SESSION['fuelType']) && $_SESSION['fuelType'] == $fuel['id']) ? 'selected' : '' ?>><?= $fuel['fuel_type'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if(!empty($_SESSION['validationErrors']['fuelType'])) : ?>
                                        <p class="text-danger"><?= $_SESSION['validationErrors']['fuelType'] ?></p>
                                    <?php endif; unset($_SESSION['validationErrors']['fuelType']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="submit" class="invisible">Submit</label>
                                    <button type="submit" class="btn btn-primary form-control">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div style="width: 95%; margin: 0 auto;">
            <div class="card my-3">
                <div class="card-header">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="d-flex justify-content-end">
                            <div class="w-50">
                                <input type="text" id="search" name="search" class="form-control w-75 d-inline-block ml-5" placeholder="Search">
                                <button type="submit" class="btn btn-primary ml-3">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <?php if(!empty($registrations)) : ?>
                        <table class="table m-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Vehicle Model</th>
                                    <th scope="col">Vehicle Type</th>
                                    <th scope="col">Vehicle chassis Number</th>
                                    <th scope="col">Vehicle production year</th>
                                    <th scope="col">Registration number</th>
                                    <th scope="col">Fuel type</th>
                                    <th scope="col">Registration to</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($registrations as $registration) : ?>
                                    <?php
                                    
                                    $registrationTo = strtotime($registration['registration_to']);
                                    $currentDate = strtotime(date('Y-m-d'));

                                    $difference = ($registrationTo - $currentDate) / (60 * 60 * 24);

                                    if($difference < 0){
                                        $textColor = 'text-danger';
                                        $display = 'd-inline-block';
                                    } elseif($difference < 31) {
                                        $textColor = 'text-warning';
                                        $display = 'd-inline-block';
                                    } else {
                                        $textColor = '';
                                        $display = 'd-none';
                                    }

                                    $productionDateParts = explode('-', $registration['vehicle_production_year']);

                                    $productionYear = $productionDateParts[0];
                                        
                                    ?>
                                    <tr class="<?= $textColor ?>">
                                        <td><?= $registration['id'] ?></td>
                                        <td><?= $registration['vehicle_model'] ?></td>
                                        <td><?= $registration['vehicle_type'] ?></td>
                                        <td><?= $registration['vehicle_chassis_number'] ?></td>
                                        <td><?= $productionYear ?></td>
                                        <td><?= $registration['registration_number'] ?></td>
                                        <td><?= $registration['fuel_type'] ?></td>
                                        <td><?= $registration['registration_to'] ?></td>
                                        <td>
                                            <form action="registrations/delete-registration.php" method="POST" class="d-inline-block">
                                                <div class="form-group">
                                                    <input type="text" name="id" value="<?= $registration['id'] ?>" hidden>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                            <a href="registrations/edit-registration.php?id=<?= $registration['id'] ?>" class="btn btn-warning">Edit</a>
                                            <form action="registrations/extend-registration.php" method="POST" class="d-inline-block">
                                                <div class="form-group">
                                                    <input type="text" name="id" value="<?= $registration['id'] ?>" hidden>
                                                    <button type="submit" class="btn btn-success <?= $display ?>">Extend</button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <div class="row">
                            <div class="col">
                                <h3>No results found</h3>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php session_destroy(); ?>
        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="ha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        
        <!-- Latest Compiled Bootstrap 4.6 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    </body>
</html>