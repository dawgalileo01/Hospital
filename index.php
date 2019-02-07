<?php
    require_once("./clases/miConexion.php");
    require_once("./clases/miHospital.php");
    session_name("hospital");
    session_start();

    if (isset($_REQUEST["btnAcceder"])){
        $hospital=new miHospital();
        $hospital->comprobarDoctor($_REQUEST["nif"],md5($_REQUEST["pass"]));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio - Hospital</title>
    <link rel="stylesheet" href="./css/estilo.css">
</head>
<body class="index">
    <fieldset>
        <legend><h1>Gestión hospital</h1></legend>
        <article class="form">
            <form action="#" method="post" id="form01">
                NIF: <input type="text" name="nif" id="nif" required placeholder="Introduzca su nif">
                
                Contraseña: <input type="password" name="pass" id="pass" required placeholder="Introduzca su contraseña">
                
                <input type="submit" name="btnAcceder" id="btnAcceder" value="Acceder">
                
                <input type="reset" name="btnBorrar" id="btnBorrar" value="Borrar datos">
            </form>
            
            <a id="btnReg" href="./registrar.php">Registrarse</a>
        </article>
    </fieldset>
</body>
</html>