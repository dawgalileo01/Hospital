<?php
require_once("./clases/miConexion.php");
require_once("./clases/miHospital.php");
require_once("./clases/menu.php");
session_name("hospital");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <?php
        menu();
    ?>
    <article class="bienvenida">
    <h2>Bienvenido doctor con DNI: <?php echo $_SESSION["dni"];?></h2>
    </article>
</body>
</html>