<?php

require_once('autoload.php');

$_SESSION['loggedIn'] = false;

header('Location: login-page.php');

?>