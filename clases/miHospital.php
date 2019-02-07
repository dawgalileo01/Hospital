<?php
class miHospital
{
	private $conex;

	public function __construct()
	{
		$this->conex = miConexion::conexion_instancia();
    }

    public function comprobarDoctor($nif, $clave){
        try {
            $sql="SELECT * FROM `doctores` where DNI=? and PASSWORD=?";
            $consulta=$this->conex->prepare($sql);
            $consulta->bindParam(1, $nif);
            $consulta->bindParam(2, $clave);
            $consulta->execute();
            if ($consulta->rowCount()>0){
                $_SESSION["dni"]=$nif;
                header("Location: ./bienvenida.php");
            } else {
                echo "<p class='error'>El usuario o la contraseña introducido/a no es válida.</p>";
            }
        } catch (PDOException $e){
            echo "<p>Consulta: <b>" . $sql . "</b></p>";
            echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }
    }


    public function registrarDoctor($dni, $password, $nombre, $apellidos, $correo, $direccion, $cpostal, $ciudad, $provincia) {
        try {
            $sql = "INSERT INTO doctores(DNI, PASSWORD, NOMBRE, APELLIDOS, CORREO, DIRECCION, CPOSTAL, CIUDAD, PROVINCIA) VALUES (?,?,?,?,?,?,?,?,?)";

            $contrasena = md5($password);

            $consulta = $this->conex->prepare($sql);
            $consulta->bindParam(1, $dni);
            $consulta->bindParam(2, $contrasena);
            $consulta->bindParam(3, $nombre);
            $consulta->bindParam(4, $apellidos);
            $consulta->bindParam(5, $correo);
            $consulta->bindParam(6, $direccion);
            $consulta->bindParam(7, $cpostal);
            $consulta->bindParam(8, $ciudad);
            $consulta->bindParam(9, $provincia);

            $consulta->execute();

           echo "<p>" . $sql . "</p>";
           echo "<p>Doctor registrado con éxito</p>";
        } catch (PDOException $e) {
			echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }
    }

    public function listarPacientes($dniDoctor){
        try{
            $sql="SELECT DNI, NOMBRE, APELLIDOS, CORREO, DIRECCION, CPOSTAL, CIUDAD, PROVINCIA, EXPEDIENTE, SEVERIDAD FROM pacientes WHERE DNI_DOCTOR=?";
            $consulta=$this->conex->prepare($sql);
            $consulta->bindParam(1, $dniDoctor);
            $consulta->execute();
            if ($consulta->rowCount() > 0) {
                echo "<table id='listar_table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Dni</th>";
                echo "<th>Nombre</th>";
                echo "<th>Apellidos</th>";
                echo "<th>Correo</th>";
                echo "<th>Dirección</th>";
                echo "<th>C. Postal</th>";
                echo "<th>Ciudad</th>";
                echo "<th>Provincia</th>";
                echo "<th>Expedinete</th>";
                echo "<th>Severidad</th>";
                echo "<th>Borrar</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)){
                    $dni="";
                    echo "<tr>";
                        foreach ($fila as $clave => $valor) {
                            if ($clave=="DNI"){
                                $dni=$valor;
                                echo "<td>";
                                echo "<a href='mostrarPaciente.php?dni=" . $valor . "'>" . $valor . "</a>";
                                echo "</td>";
                            } else {
                                echo "<td>" . $valor . "</td>";
                            }
                            
                        }
                    echo "<td><input type='checkbox' name='borrar[]' value='" . $dni . "'></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No tiene ningún paciente.</p>";
            }
        } catch (PDOException $e){
            echo "<p>Consulta: <b>" . $sql . "</b></p>";
            echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }

    }

    
}
?>