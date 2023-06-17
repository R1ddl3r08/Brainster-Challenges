<?php

require_once('autoload.php');

use Database\Database as Database;
use Database\Query as Query;

$websiteId = $_GET['id'];

$query = new Query();

$website = $query->getWebsiteInfo($websiteId);

$offerings = $query->getServicesProducts($websiteId);

?>

<!DOCTYPE html>
<html>
    <head>
        <title><?= $website['title'] ?></title>
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
        <style>
            html{
                scroll-behavior: smooth;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><?= $website['title'] ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about-us">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#offerings"><?= $website['type'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
                </ul>
            </div>
        </nav>

        <div style="background-image: url('<?= $website['image_url'] ?>'); background-position: center; background-size: cover;">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center my-5 py-5 text-light">
                        <div class="d-inline-block px-5 py-3 bg-light rounded-pill">
                            <h1><?= $website['title'] ?></h1>
                        </div>
                    </div>
                    <div class="col-12 text-center my-5 py-5 text-light">
                        <div class="w-50 mx-auto">
                            <div class="d-inline-block px-4 py-2 bg-light rounded-pill">
                                <h3><?= $website['subtitle'] ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5" id="about-us">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="w-50 mx-auto">
                        <h2>About us</h2>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="w-50 mx-auto">
                        <p class="mb-0"><?= $website['about_you'] ?></p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="w-50 mx-auto">
                        <hr>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="w-50 mx-auto">
                        <p class="mb-0">Tel: <?= $website['tel'] ?></p>
                        <p class="mb-0">Location: <?= $website['location'] ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-4" id="offerings">
            <h3><?= $website['type'] ?></h3>
            <div class="row">
                <?php foreach($offerings as $offering) : ?>
                    <?php if(!empty($offering['description'] && !empty($offering['image_url']))) : ?>
                        <div class="col-4">
                            <div class="card">
                                <img src="<?= $offering['image_url'] ?>" class="card-img-top" alt="...">
                                <div class="card-body bg-dark text-light">
                                    <h5 class="card-title"><?= $website['type'] ?> description</h5>
                                    <p class="card-text"><?= $offering['description'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>    
                <?php endforeach; ?>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
        </div>

        <div class="container my-4" id="contact">
            <div class="row">
                <div class="col-6">
                    <h3>Contact</h3>
                    <p><?= $website['description'] ?></p>
                </div>
                <div class="col-6">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <footer class="bg-dark text-center py-2">
            <p class="text-light">Copyright by Andrej @ Brainster</p>
            <div>
                <a href="<?= $website['linkedin'] ?>">Linkedin</a>
                <a href="<?= $website['facebook'] ?>">Facebook</a>
                <a href="<?= $website['twitter'] ?>">Twitter</a>
                <a href="<?= $website['google'] ?>">Google+</a>
            </div>
        </footer>
        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="ha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        
        <!-- Latest Compiled Bootstrap 4.6 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    </body>
</html>