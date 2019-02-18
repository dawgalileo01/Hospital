<?php
session_name("hospital");
session_start();
require_once("./clases/miConexion.php");
require_once("./clases/miHospital.php");
require_once("./clases/menu.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar Paciente</title>
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="cuerpoBuscar">
    <?php
        menu();
    ?>
    <div class="buscar">
        <form action="#" method="post" class="form02">
            <h3>Buscar paciente</h3>
            <br><br>
            <select name="opciones" id="opciones">
                <option value="vacio">Buscar por...</option>
                <option value="dni">DNI</option>
                <option value="expediente">Expediente</option>
                <option value="severidad">Severidad</option>
            </select><br>
            <input type="text" name="valorPaciente" id="valorPaciente">
            <br><br>
            <button class="btnBuscar" name="btnBuscar" type="submit"><i class="fa fa-search"></i> Buscar</button>



        
        </form>
        
    </div>
    <article class="cuerpoListar">

    <?php
        if (isset($_REQUEST["btnBuscar"])){
            if($_REQUEST["opciones"]!="vacio"){
                $hospital=new miHospital();
                $hospital->buscarPaciente($_REQUEST["opciones"],$_REQUEST["valorPaciente"]);
            }else{
                echo "<h2 class=error>Error. Seleccione una opcion.</h2>";
            }
        }

    ?>

    </article>
    
</body>
</html>