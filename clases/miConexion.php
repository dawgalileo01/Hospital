<?php
class miConexion {
    private static $dns = 'mysql:host=localhost;dbname=hospital;charset=utf8';
	/* dns: Nombre del Origen de Datos, host y dbname nombres reservados del controlador PDO */
    private static $usuario = 'daw';
    private static $pasw = 'galileo';
    private static $instancia;

    private function __construct() {  }

    public static function conexion_instancia() {
        if ( !isset(self::$instance) ) {
			try {
                self::$instancia = new PDO(self::$dns, self::$usuario, self::$pasw);
                self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
				printf ("<h3 style='color:red'>Error al conectar la Base de Datos: %s </h3>", $e->getMessage());
				exit;
            }
		}
		return self::$instancia;
    }

    public function __clone() {
		trigger_error('Clonación no permitida', E_USER_ERROR);
    }
}
?>