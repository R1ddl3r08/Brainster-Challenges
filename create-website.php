<?php

require_once 'autoload.php';

use Database\Database as Database;
use Database\Query as Query;

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $image_url = $_POST['cover_image'];
    $title = $_POST['main_title'];
    $subtitle = $_POST['subtitle'];
    $about_you = $_POST['about_you'];
    $tel = $_POST['tel'];
    $location = $_POST['location'];
    $type = $_POST['type'];
    $descriptions = $_POST['descriptions'];
    $image_urls = $_POST['images'];
    $company_description = $_POST['company_description'];
    $linkedin = $_POST['linkedin'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $google = $_POST['google'];

    $query = new Query();

    if(($query->exists('website_info', $type)) && !empty($image_url) && !empty($title) && !empty($subtitle) && !empty($about_you) && !empty($tel) && !empty($location) && !empty($type) && !empty($descriptions) && !empty($image_urls) && !empty($company_description) && !empty($linkedin) && !empty($facebook) && !empty($twitter) && !empty($google)){
        
        $id = $query->store($image_url, $title, $subtitle, $about_you, $tel, $location, $type, $company_description, $linkedin, $facebook, $twitter, $google, $descriptions, $image_urls);
        header('Location: your-website.php?id=' . $id);
    } else {
        $_SESSION['errorMessage'] = 'Please fill in all the required fields';
        header('Location: form.php');
    }
}

?>