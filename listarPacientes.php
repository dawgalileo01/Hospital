<?php
    require_once("./clases/miConexion.php");
    require_once("./clases/miHospital.php");
    session_name("hospital");
    session_start();
    $hospital=new miHospital();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado pacientes - Hospital</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body>
    <?php
        $hospital->listarPacientes($_SESSION["dni"]);
    ?>
</body>
</html>