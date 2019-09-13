<?php
$open = true;
require '../lib/site.inc.php';

//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

$controller = new Felis\PasswordValidateController($site, $_POST);
header("location: " . $controller->getRedirect());