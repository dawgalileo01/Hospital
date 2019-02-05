<?php
class miHospital
{
	private $conex;

	public function __construct()
	{
		$this->conex = miConexion::conexion_instancia();
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
}
?>