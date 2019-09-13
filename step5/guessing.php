<?php
require __DIR__ . '/lib/guessing.inc.php';
$view = new Guessing\GuessingView($guessing);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="guessing.css" type="text/css" rel="stylesheet" />
    <title>Guessing Game</title>
</head>

<body>
<?php echo $view->present(); ?>

</body>