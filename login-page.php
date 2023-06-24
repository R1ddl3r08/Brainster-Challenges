<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
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
            <div class="row vh-100 align-items-center">
                <div class="w-50 mx-auto mb-5">
                    <?php
                    
                    $errorMessage = $_SESSION['errorMessage'] ?? '';
                    
                    if(!empty($errorMessage)){
                        echo '<div class="alert alert-danger">'. $errorMessage .'</div>';
                        unset($_SESSION['errorMessage']);
                    }

                    session_destroy();
                    
                    ?>
                    <h1>Login</h1>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" class="form-control" placeholder="Enter your email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" class="form-control" placeholder="Enter your password">
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
                        <a href="index.php" class="btn btn-secondary">Back</a>
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