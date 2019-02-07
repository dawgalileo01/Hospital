<?php
include('./clases/comprobar.inc.php');
include('./clases/miHospital.php');
include('./clases/miConexion.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="registrar">
    <header class="cabecera">
        <h1>Gestión Hospital</h1>
    </header>
    <article class="formulario">
        <h1>Formulario de registro</h1>
        <form action="#" method="post">
            <fieldset>
                <legend>
                    Introduzca sus datos
                </legend>
                <p>
                    <label>DNI (*):</label>
                    <input type="text" name="dni" required="required">
                </p>

                <p>
                    <label>Password (*):</label>
                    <input type="password" name="password" required="required">
                </p>

                <p>
                    <label>Nombre (*):</label>
                    <input type="text" name="nombre" required="required">
                </p>

                <p>
                    <label>Apellidos (*):</label>
                    <input type="text" name="apellidos" required="required">
                </p>

                <p>
                    <label>Correo (*):</label>
                    <input type="text" name="correo" required="required">
                </p>

                <p>
                    <label>Direccion (*):</label>
                    <input type="text" name="direccion" required="required">
                </p>

                <p>
                    <label>CPostal (*):</label>
                    <input type="text" name="cpostal" required="required">
                </p>

                <p>
                    <label>Ciudad (*):</label>
                    <input type="text" name="ciudad" required="required">
                </p>

                <p>
                    <label>Provincia (*):</label>
                    <input type="text" name="provincia" required="required">
                </p>

                <p>
                
                    <button type="submit" name="registro"><i class="fa fa-check"></i> Registrar</button>
                    <button onclick="location='index.php'"><i class="fa fa-close"></i> Cancelar</button>
                </p>
            </fieldset>
        </form>
    
        <?php
            if (isset($_REQUEST["registro"])) {
                $dni = $_REQUEST["dni"];
                $password = $_REQUEST["password"];
                $nombre = $_REQUEST["nombre"];
                $apellidos = $_REQUEST["apellidos"];
                $correo = $_REQUEST["correo"];
                $direccion = $_REQUEST["direccion"];
                $cpostal = $_REQUEST["cpostal"];            
                $ciudad = $_REQUEST["ciudad"];
                $provincia = $_REQUEST["provincia"];

                $error = false;

                if (validarNif($dni) === 0) {
                    echo "<p class='error'>El formato del dni no es correcto.</p>";
                    $error = true;
                } else if (validarNif($dni) === -1) {
                    echo "<p class='error'>La letra del dni no es correcta.</p>";
                    $error = true;
                }

                if (validarEmail($correo) === -1) {
                    echo "<p class='error'>El formato del correo no es correcto.</p>";
                    $error = true;
                }

                if (!$error) {
                    $miHospital = new miHospital();
                    $miHospital->registrarDoctor($dni, $password, $nombre, $apellidos, $correo, $direccion, $cpostal, $ciudad, $provincia);
                }
            }
        ?>
    </article>
</body>
</html>