<?php

date_default_timezone_set('America/Buenos_Aires');

class ServiciosHTML {

function enviarMail($nombre,$mensaje,$email)
{
	$error = "";

	if (trim($nombre) == "")
	{
		$error = "Falta el nombre. ";
	}

	if (trim($mensaje) == "")
	{
		$error = $error." Falta el mensaje. ";
	}

	if (trim($email) == "")
	{
		$error = $error." Falta el email.";
	}

	if (strlen($error) < 1)
	{
		$sql = "insert into dbcontactos(idcontacto,nombre,mensaje,email,fecha) values ('','".$nombre."','".$mensaje."','".$email."','".date('Y-m-d H:i:s')."')";
		$this->query($sql,1);	
		return $error;
	} else {
		return $error;
	}
	

}

Function query($sql,$accion) {
		
		
		$hostname = "localhost";
		$database = "portalinmobiliario";
		$username = "root";
		$password = "";
		/*
		$hostname = "localhost";
		$database = "inflable_reycanguro";
		$username = "inflable_marcos";
		$password = "reycanguro7575";
		*/
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		
	}

}




?>