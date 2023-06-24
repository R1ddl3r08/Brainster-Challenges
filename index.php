<?php

require_once('autoload.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $query = new Database\Query();

    $registration = $query->userSearchRegistration(trim($_POST['registration']));
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Vehicle Registration</title>
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
            <a href="login-page.php">Login</a>
        </nav>

        <div class="container mt-3">
            <div class="row">
                <div class="w-75 mx-auto">
                    <div class="jumbotron">
                        <h1 class="display-4 text-center">Vehicle Registration</h1>
                        <div class="w-50 mx-auto">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="text-center">
                                <div class="form-group">
                                    <label for="registration">Enter your registration number to check its validity</label>
                                    <input id="registration" type="text" name="registration" class="form-control" placeholder="Registration number">
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <?php if(isset($registration) && !empty($registration)) : ?>
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
                                </tr>
                            </thead>
                            <tbody>
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
                                </tr>
                            </tbody>
                        </table>
                    <?php elseif(isset($registration) && empty($registration)) : ?>
                        <div class="row">
                            <div class="col">
                                <h3>No results found</h3>
                            </div>
                        </div>
                    <?php endif; ?>
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