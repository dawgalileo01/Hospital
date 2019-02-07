<?php
//require_once('./clases/menu.php');
require_once('./clases/miConexion.php');
require_once('./clases/miHospital.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./css/estilo.css" />
</head>
<body>
    <?php
        //menu();

        if (isset($_REQUEST["dni"])) {
            $hospital = new miHospital();
            $hospital -> infoPaciente($_REQUEST["dni"]);
        }
    ?>
</body>
</html>