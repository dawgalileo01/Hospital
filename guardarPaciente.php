<?php
    //require_once ('./clases/menu.php');
    require_once ('./clases/miConexion.php');
    require_once ('./clases/miHospital.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        //menus();

        $dni = $_REQUEST["dni"];
        $direccion = $_REQUEST["direccion"];
        $cpostal = $_REQUEST["cpostal"];
        $ciudad = $_REQUEST["ciudad"];
        $provincia = $_REQUEST["provincia"];
        $expediente = $_REQUEST["expediente"];
        $severidad = $_REQUEST["severidad"];

        $hospital = new miHospital();
        $hospital->actualizarPaciente($dni, $direccion, $cpostal, $ciudad, $provincia, $expediente, $severidad);
    ?>
</body>
</html>