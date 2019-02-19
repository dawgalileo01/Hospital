<?php
session_name("dni");
session_start();
include('./clases/miHospital.php');
include('./clases/miConexion.php');
include("./clases/menu.php");
if (isset($_REQUEST["confirmar"])) {
    echo "<body class=borrar>";
    menu();

    $borrar = $_SESSION["borrar"];
    session_destroy();

    echo '<link rel="stylesheet" type="text/css" href="./css/estilo.css" />';

    $hospital = new miHospital();
    $hospital->eliminarPaciente($borrar);
    echo "</body>";

} else if (isset($_REQUEST["cancelar"])) {
    session_destroy();
    header("location: bienvenida.php");
} else if (isset($_REQUEST["borrar"])) {
    echo "<body class=borrar>";
    menu();

    $_SESSION["borrar"] = $_REQUEST["borrar"];

    echo '<link rel="stylesheet" type="text/css" href="./css/estilo.css" />';
    echo "<p class='pregunta'>¿Estás seguro de que lo quieres eliminar?</p>";
    echo "<form action='#' method='post' class='formularioBorrar'>";
    echo '<input type="submit" value="Confirmar" name="confirmar" class="confirmar">&nbsp;&nbsp;&nbsp;';
    echo '<input type="submit" value="Cancelar" name="cancelar" class="cancelar">';
    echo "</form>";
    echo "</body>";
} else {
    menu();
    echo '<link rel="stylesheet" type="text/css" href="./css/estilo.css" />';
    echo "<p>Elija el paciente que quieres eliminar.</p>";
    echo '<a href="bienvenida.php">Volver</a>';
}
?>