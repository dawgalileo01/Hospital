<?php
    include('./clases/comprobar.inc.php');
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
<body class="alta">
    
<?php
    menu();
    echo "<article>";
    if (isset($_REQUEST["expediente"])) {
        $error = false;

        if (validarNif($_REQUEST["dni"]) === 0) {
            echo "<p class='error'>El formato del dni no es correcto.</p>";
            $error = true;
        } else if (validarNif($_REQUEST["dni"]) === -1) {
            echo "<p class='error'>La letra del dni no es correcta.</p>";
            $error = true;
        }

        if (validarEmail($_REQUEST["correo"]) === -1) {
            echo "<p class='error'>El formato del correo no es correcto.</p>";
            $error = true;
        }

        if(!$error) {

?>
    <fieldset>
        <legend>Nuevo paciente</legend>
        <form action="#" method="post">
            <p>
                <label>Descripcion:</label>
                <textarea name="descripcion" cols="30" rows="5" required="required"></textarea>
            </p>
            <p>
                <label>Severidad:</label>
                <select name="severidad">
                    <option value="Alta">Alta</option>
                    <option value="Media">Media</option>
                    <option value="Baja">Baja</option>
                </select>
            </p>
            <p>
                <input type="submit" value="Alta" name="alta" class="btnAlta">
            </p>
        </form>
    </fieldset>
<?php
        $_SESSION["dniPaciente"] = $_REQUEST["dni"];
        $_SESSION["nombrePaciente"] = $_REQUEST["nombre"];
        $_SESSION["apellidosPaciente"] = $_REQUEST["apellidos"];
        $_SESSION["correoPaciente"] = $_REQUEST["correo"];
        $_SESSION["direccionPaciente"] = $_REQUEST["direccion"];
        $_SESSION["cpostalPaciente"] = $_REQUEST["cpostal"];
        $_SESSION["ciudadPaciente"] = $_REQUEST["ciudad"];
        $_SESSION["provinciaPaciente"] = $_REQUEST["provincia"];
        } else {
            echo "<a href='alta.php'>Volver</a>";
        }
    } else if (isset($_REQUEST["alta"])) {
        $miHospital = new miHospital();
        $miHospital->altaPaciente($_SESSION["dniPaciente"], $_SESSION["nombrePaciente"], $_SESSION["apellidosPaciente"], $_SESSION["correoPaciente"], $_SESSION["direccionPaciente"], $_SESSION["cpostalPaciente"], $_SESSION["ciudadPaciente"], $_SESSION["provinciaPaciente"], $_REQUEST["descripcion"], $_REQUEST["severidad"], $_SESSION["dni"]);
    } else {
?>
<fieldset>
    <legend>Nuevo paciente</legend>
    <form action="#" method="post">
        <p>
            <label>DNI (*):</label>
            <input type="text" name="dni" required="required">
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
            <label>Codigo Postal (*):</label>
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
            <input type="submit" value="Expediente" name="expediente" class="expediente">
        </p>
    </form>
</fieldset>
<?php
}
?>

</article>
</body>
</html>