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

    public function listarPacientes($dniDoctor){
        try{
            $sql="SELECT DNI, NOMBRE, APELLIDOS, CORREO, DIRECCION, CPOSTAL, CIUDAD, PROVINCIA, EXPEDIENTE, SEVERIDAD FROM pacientes WHERE DNI_DOCTOR=?";
            $consulta=$this->conex->prepare($sql);
            $consulta->bindParam(1, $dniDoctor);
            $consulta->execute();
            if ($consulta->rowCount() > 0) {
                echo "<form method='post' action='eliminarPaciente.php'>";
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
                echo "<input type='submit' name='boton' class='boton' value='Borrar'>";
                echo "</form>";
            } else {
                echo "<p>No tiene ningún paciente.</p>";
            }
        } catch (PDOException $e){
            echo "<p>Consulta: <b>" . $sql . "</b></p>";
            echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }

    }

    
    public function altaPaciente($dni, $nombre, $apellidos, $correo, $direccion, $cpostal, $ciudad, $provincia, $descripcion, $severidad, $dniDoctor) {
        try {
            $sql = "INSERT INTO pacientes(DNI, NOMBRE, APELLIDOS, CORREO, DIRECCION, CPOSTAL, CIUDAD, PROVINCIA, EXPEDIENTE, SEVERIDAD, DNI_DOCTOR) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

            $consulta = $this->conex->prepare($sql);
            $consulta->bindParam(1, $dni);
            $consulta->bindParam(2, $nombre);
            $consulta->bindParam(3, $apellidos);
            $consulta->bindParam(4, $correo);
            $consulta->bindParam(5, $direccion);
            $consulta->bindParam(6, $cpostal);
            $consulta->bindParam(7, $ciudad);
            $consulta->bindParam(8, $provincia);
            $consulta->bindParam(9, $descripcion);
            $consulta->bindParam(10, $severidad);
            $consulta->bindParam(11, $dniDoctor);

            $consulta->execute();

           echo "<p>" . $sql . "</p>";
           echo "<p>Paciente registrado con éxito</p>";
        } catch (PDOException $e) {
			echo "<p class='error'>Error: " . $e->getMessage() . "</p>";

        }
    }

    public function infoPaciente($dni)
    {
        try {
            $sql = "SELECT DNI, NOMBRE, APELLIDOS, CORREO, DIRECCION, CPOSTAL, CIUDAD, PROVINCIA, EXPEDIENTE, SEVERIDAD FROM pacientes WHERE DNI=?";
            $consulta = $this->conex->prepare($sql);
            $consulta->bindParam(1, $dni);
            $consulta->execute();

            $paciente = $consulta->fetch(PDO::FETCH_NUM);
            echo "<p>DNI: " . $paciente[0] . "</p>";
            echo "<p>NOMBRE: " . $paciente[1] . "</p>";
            echo "<p>APELLIDOS: " . $paciente[2] . "</p>";
            echo "<p>CORREO: " . $paciente[3] . "</p>";
            echo "<p>DIRECCION: " . $paciente[4] . "</p>";
            echo "<p>CPOSTAL: " . $paciente[5] . "</p>";
            echo "<p>CIUDAD: " . $paciente[6] . "</p>";
            echo "<p>PROVINCIA: " . $paciente[7] . "</p>";
            echo "<p>EXPEDIENTE: " . $paciente[8] . "</p>";
            echo "<p>SEVERIDAD: " . $paciente[9] . "</p>";

            echo "<form action='modificarPaciente.php' method='post'>";
            echo "<input type='hidden' name='dni' value='" . $dni . "'>";
            echo "<input type='submit' value='Modificar' name='modificar'>";
            echo "</form>";
        } catch (PDOException $e) {
            echo "<p>Consulta: <b>" . $sql_query . "</p>";
            echo "<p class='error'>Error:" . $e->getMessage() . "</p>";
        }
    }


    public function modificarPaciente($dni)
    {
        try {
            $sql = "SELECT DNI, NOMBRE, APELLIDOS, CORREO, DIRECCION, CPOSTAL, CIUDAD, PROVINCIA, EXPEDIENTE, SEVERIDAD FROM pacientes WHERE DNI=?";
            $consulta = $this->conex->prepare($sql);
            $consulta->bindParam(1, $dni);
            $consulta->execute();

            $paciente = $consulta->fetch(PDO::FETCH_NUM);
            echo "<form action='guardarPaciente.php' method='post' enctype='multipart/form-data'>";
            echo "<p>DNI: " . $paciente[0] . "</p>";
            echo "<p>NOMBRE: " . $paciente[1] . "</p>";
            echo "<p>APELLIDOS: " . $paciente[2] . "</p>";
            echo "<p>CORREO: " . $paciente[3] . "</p>";
            echo "<p>DIRECCION: <input type='text' name='direccion' value='" . $paciente[4] . "'></p>";
            echo "<p>CPOSTAL: <input type='text' name='cpostal' value='" . $paciente[5] . "'></p>";
            echo "<p>CIUDAD: <input type='text' name='ciudad' value='" . $paciente[6] . "'></p>";
            echo "<p>PROVINCIA: <input type='text' name='provincia' value='" . $paciente[7] . "'></p>";
            echo "<p>EXPEDIENTE: <input type='text' name='expediente' value='" . $paciente[8] . "'></p>";
            echo "<p>SEVERIDAD:";
            echo "<select name='severidad'>";
            echo "<option value='Alta'>Alta</option>";
            echo "<option value='Media'>Media</option>";
            echo "<option value='Baja'>Baja</option>";
            echo "</select>";
            echo "</p>";
            echo "<input type='hidden' name='dni' value='" . $dni . "'>";
            echo "<input type='submit' value='Guardar Cambios' name='guardar'>";
            echo "</form>";
        } catch (PDOException $e) {
            echo "<p>Consulta: <b>" . $sql_query . "</b></p>";
            echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }

    }


    public function actualizarPaciente($dni, $direccion, $cpostal, $ciudad, $provincia, $expediente, $severidad)
    {
        try {
            $sql = "UPDATE pacientes SET DIRECCION=?,CPOSTAL=?,CIUDAD=?,PROVINCIa=?,EXPEDIENTE=?,SEVERIDAD=? WHERE dni=?";

            $consulta = $this->conex->prepare($sql);
            $consulta->bindParam(1, $direccion);
            $consulta->bindParam(2, $cpostal);
            $consulta->bindParam(3, $ciudad);
            $consulta->bindParam(4, $provincia);
            $consulta->bindParam(5, $expediente);
            $consulta->bindParam(6, $severidad);
            $consulta->bindParam(7, $dni);

            $consulta->execute();
            echo "<p>Paciente actualizado con exito</p>";
            echo "<a href='bienvenida.php'>Volver</a>";
        } catch (PDOException $e) {
            echo "<p>Consulta: <b>" . $sql_query . "</b></p>";
            echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
        }
    }

    public function eliminarPaciente($borrar){
        try {
			$this->conex->beginTransaction();

			$id = [];

			for ($i=0; $i < count($borrar); $i++) { 
				$sql = "DELETE FROM pacientes WHERE dni=?";

				$consulta = $this->conex->prepare($sql);
				$consulta->bindParam(1, $borrar[$i]);

				$consulta->execute();
			}

			$this->conex->commit();
			echo "<p class='pregunta'>Paciente/s eliminado/s con exito</p>";
			
			echo "<a href='bienvenida.php' class='volverBorrar'>Volver</a>";
		} catch (PDOException $e) {
			$this->conex->rollBack();
			echo "<p>Consulta: <b>" . $sql . "</b></p>";
			echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
		}
    }
}
?>