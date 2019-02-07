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

    public function buscarPaciente($opc,$valor){
        try {
            $opc=$_REQUEST["opciones"];
 
            $sql="SELECT * FROM pacientes WHERE";
            if($opc=="dni"){
                $sql.=" DNI=?";

            }else if($opc=="expediente"){
                $sql.=" EXPEDIENTE=?";

            }else if($opc=="severidad"){
                $sql.=" SEVERIDAD=?";

            }
            $consulta=$this->conex->prepare($sql);
            $consulta->bindParam(1,$valor);


            $consulta->execute();

            echo "<table class='tablaPaciente' border='1'>";
            if ($consulta->rowCount()>0){
                echo "<thead><tr>";

                echo "<th>DNI</th>";
				echo "<th>Nombre</th>";
				echo "<th>Apellidos</th>";
				echo "<th>E-mail</th>";
                echo "<th>Direccion</th>";
                echo "<th>Codigo Postal</th>";
                echo "<th>Ciudad</th>";
                echo "<th>Provincia</th>";
                echo "<th>Expediente</th>";
                echo "<th>Severidad</th>";
				echo "<th>Borrar</th>";

                echo "</tr></thead><tbody>";
                echo "<tr>";

                while($regto=$consulta->fetch(PDO::FETCH_ASSOC)){
                    $alias="";
                    
                    foreach ($regto as $ind => $campo) {
                        if($ind=="DNI"){
                            $alias=$campo;
                            echo "<td><a href='mostrarPaciente.php?dni=".$campo."'>".$campo."</a></td>";

                        }else{
                            echo "<td>".$campo."</td>";
                        }
                    }
                    echo "<td><input type='checkbox' name='borrar[]' value='" . $alias . "'></td>";
					echo "</tr>";

                }

            } else {
                echo "<p class='error'>DNI del paciente incorrecto</p>";
            }            
            echo "</tbody></table>";


        } catch (PDOException $e) {
            echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }
    }
}
?>