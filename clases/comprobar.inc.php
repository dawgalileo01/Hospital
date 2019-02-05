<?php
function comprobarLetraNIF($nif)
{
	// Letras del DNI ordenadas
	$letras = "TRWAGMYFPDXBNJZSQVHLCKE";

	$valor = null;
	if (!empty($nif)) {
		// En función de si la letra es correcta, devolvemos 1, -1
		// Seccionamos el nif separando el número de la letra
		$num = substr($nif, 0, 8);
		$letraNif = substr($nif, -1, 1);

		// Hallamos el resto de la posición de la letra correcta
		$resto = $num % 23;
		$letraCorrecta = substr($letras, $resto, 1); 	//Obtenemos la letra correcta

		// Comprobamos que coincida con la letra correspondiente
		if ($letraCorrecta == strtoupper($letraNif)) {
			$valor = 1;
		} else {
			$valor = -1;
		}
	}
	return $valor;
}

function validarNif($nif)
{
	$valor = null; 			// Está vacío
	if (!empty($nif)) {
		// Si no está vacío, comprobamos que el NIF introducido sea correcta, a través de una expresiónn regular
		$patron = "/^[0-9]{8}[A-Za-z]$/";
		if (preg_match($patron, $nif)) {
			if (comprobarLetraNIF($nif) == 1) {
				$valor = 1; 	// Es correcto la letra y el formato
			} else {
				$valor = -1; 	// No es correcta la letra
			}
		} else {
			$valor = 0; 		// No es correcto el formato
		}
	}
	return $valor;
}


function validarEmail($email)
{
	$valor = null;
	if (!empty($email)) {
		// $patron = "/^[A-Za-z0-9_-]*[A-Za-z0-9_-]+@[a-zA-Z0-9_-]+\.[a-zA-Z]{2-6}$/"; 
		$patron = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
		if (preg_match($patron, $email)) {
			$valor = 1;
		} else {
			$valor = -1;
		}
	}
	return $valor;
}
?>