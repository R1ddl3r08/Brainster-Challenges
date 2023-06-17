<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create website</title>
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
        <div style="background-image: url('images/bg-form.jpg'); background-position: center; background-size: cover;">
            <div class="container">
                <div class="text-center">
                    <h2 class="text-dark bg-light d-inline-block p-2 rounded my-4">You are one step away from your webpage</h2>
                </div>
                <form action="create-website.php" method="POST">

                    <?php if(!empty($_SESSION['errorMessage'])) : ?>
                        <div class="alert alert-danger d-inline-block"><?= $_SESSION['errorMessage'] ?></div>
                    <?php UNSET($_SESSION['errorMessage']); endif; ?>

                    <div class="row align-items-start">
                        <div class="col-4">
                           <div class="bg-white rounded p-3">
                                <div class="form-group">
                                    <label for="cover_image">Cover Image URL</label>
                                    <input id="cover_image" type="text" name="cover_image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="main_title">Main Title of Page</label>
                                    <input id="main_title" type="text" name="main_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="subtitle">Subtitle of page</label>
                                    <input id="subtitle" type="text" name="subtitle" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="about_you">Something about you</label>
                                    <textarea name="about_you" id="about_you" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tel">Your telephone number</label>
                                    <input id="tel" type="tel" name="tel" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input id="location" type="text" name="location" class="form-control">
                                </div>
                           </div>
                           <div class="row">
                                <div class="col-12">
                                    <div class="bg-white rounded p-3 mt-2">
                                        <div class="form-group">
                                            <label for="type">Do you provide services or products?</label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="Services">Services</option>
                                                <option value="Products">Products</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                           </div>
                        </div>
                        <div class="col-4">
                            <div class="bg-white rounded p-3">
                                <h5>Provide URL for an image and description of your service/product</h5>
                                <div class="form-group">
                                    <label for="image">Image URL</label>
                                    <input id="image" type="text" name="images[0]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description of service/product</label>
                                    <textarea name="descriptions[0]" id="descriptions[0]" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image2">Image URL</label>
                                    <input id="image2" type="text" name="images[1]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description2">Description of service/product</label>
                                    <textarea name="descriptions[1]" id="descriptions[1]" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image3">Image URL</label>
                                    <input id="image3" type="text" name="images[2]" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description3">Description of service/product</label>
                                    <textarea name="descriptions[2]" id="descriptions[2]" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="bg-white rounded p-3">
                                <div class="form-group">
                                    <label for="company_description">Provide a description of your company, something people should be aware of before they contact you:</label>
                                    <textarea name="company_description" id="company_description" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="linkedin">Linkedin</label>
                                    <input id="linkedin" type="text" name="linkedin" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input id="facebook" type="text" name="facebook" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input id="twitter" type="text" name="twitter" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="google">Google+</label>
                                    <input id="google" type="text" name="google" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-secondary w-75 mt-3 mb-5">Submit</button>
                        </div>
                    </div>
                </form>
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