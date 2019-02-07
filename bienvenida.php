<?php
require_once("./clases/miConexion.php");
require_once("./clases/miHospital.php");
session_name("hospital");
session_start();
echo $_SESSION["dni"];
?>