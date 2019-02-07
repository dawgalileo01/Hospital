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
}
?>