<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 3/25/2018
 * Time: 9:01 PM
 */

require '../lib/site.inc.php';

echo "<pre>";
print_r($_POST);
echo "</pre>";

$controller = new Felis\DeleteCaseController($site, $_POST);
header("location: " . $controller->getRedirect());