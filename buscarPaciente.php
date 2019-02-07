<?php
    session_name("hospital");
    session_start();
    require_once("./clases/miConexion.php");
    require_once("./clases/miHospital.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar Paciente</title>
</head>
<body>
    <form action="#" method="post">
        <h3>Buscar paciente</h3>
        <br><br>
        <select name="opciones" id="opciones">
            <option value="">Buscar por...</option>
            <option value="dni">DNI</option>
            <option value="expediente">Expediente</option>
            <option value="severidad">Severidad</option>
        </select>
        <input type="text" name="valorPaciente" id="valorPaciente">
        <br><br>
        <input type="submit" value="Buscar" name="btnBuscar">
    </form>

    <?php


    if (isset($_REQUEST["btnBuscar"])){
        $hospital=new miHospital();
        $hospital->buscarPaciente($_REQUEST["opciones"],$_REQUEST["valorPaciente"]);
    }
    ?>
</body>
</html>