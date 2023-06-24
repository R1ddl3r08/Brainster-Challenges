<?php 

    require_once('../autoload.php');

    $query = new Database\Query();
    $vehicleModels = $query->getAll('vehicle_models');

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Vehicle Models</title>
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
            <a class="navbar-brand" href="#">Vehicle Models</a>
            <div class="navbar-links">
                <a href="../dashboard.php" class="mr-3">Registrations</a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>

        <div class="container">
            <div class="row mt-3">
                <div class="col-6">
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
                    <form action="add-model.php" method="POST">
                        <div class="form-group">
                            <label for="vehicle_model">Add new vehicle model</label>
                            <input type="text" id="vehicle_model" name="vehicle_model" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Add model</button>
                    </form>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-8">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Model Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($vehicleModels as $model) : ?>
                                <tr>
                                    <td><?= $model['vehicle_model'] ?></td>
                                    <td>
                                        <a href="edit-model.php?id=<?= $model['id'] ?>" class="btn btn-warning">Edit</a>
                                        <form action="delete-model.php" method="POST" class="d-inline-block">
                                            <div class="form-group">
                                                <input type="text" name="id" value="<?= $model['id'] ?>" hidden>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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