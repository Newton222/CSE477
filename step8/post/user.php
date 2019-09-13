<?php
require '../lib/site.inc.php';

echo "<pre>";
print_r($_POST);
echo "</pre>";

$controller = new Felis\UserController($site, $user, $_POST, $_GET);
//header("location: " . $controller->getRedirect());