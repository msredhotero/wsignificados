<?php

date_default_timezone_set('America/Buenos_Aires');

class ServiciosUsuarios {


    Function login($usuario,$pass) {

            $sqlusu = "select * from se_usuarios where email = '".$usuario."'";



        if (trim($usuario) != '' and trim($pass) != '') {

            $respusu = $this->query($sqlusu,0);

            if (mysql_num_rows($respusu) > 0) {
                    $error = '';

                    $idUsua = mysql_result($respusu,0,0);
                    $sqlpass = "select * from se_usuarios where password = '".$pass."' and IdUsuario = ".$idUsua;

                    $resppass = $this->query($sqlpass,0);

                    if (mysql_num_rows($resppass) > 0) {
                            $error = '';
                            } else {
                                    $error = 'Usuario o Password incorrecto';
                            }

                    }
                    else

                    {
                            $error = 'Usuario o Password incorrecto';	
                    }

                    if ($error == '') {
                            session_start();
                            $_SESSION['usua_sign'] 	= $usuario;
                            $_SESSION['nombre_sign']	= mysql_result($resppass,0,5);
							$_SESSION['refid_sign']	= $idUsua;
                            $_SESSION['refrol_sign']	= mysql_result($resppass,0,3);
							$_SESSION['carpeta_sign']	= mysql_result($resppass,0,10);
                    }

        }	else {
                $error = 'Usuario y Password son campos obligatorios';	
        }


                return $error;

    }
    
function TraerUsuarios()
{
		$sql		= "select * from se_usuarios";
		$resultado	= $this->query($sql,0);
		return $resultado;	
}

function TraerAgente()
{
		$sql		= "select idusuario,nombrecompleto,email,telefono,imagen,mime,direccion from se_usuarios where refroll = 2";
		$resultado	= $this->query($sql,0);
		return $resultado;	
}

function TraerAgentePorId($id)
{
		$sql		= "select idusuario,usuario,password,nombrecompleto,email,telefono,refroll,imagen,mime,direccion from se_usuarios where refroll = 2 and idusuario =".$id;
		$resultado	= $this->query($sql,0);
		return $resultado;	
}


function existe($usuario){
 
           $sql        =   "SELECT idusuario FROM se_usuarios WHERE email= '".$usuario. "'";         
           $resultado  =   $this->query($sql,0);
           
           if(mysql_num_rows($resultado)>0){

               return mysql_result($resultado,0,0);

           }

           return 0;

        }
        
 

function cargarUsuario($usuario,$password,$refrol,$nombrecompleto,$email,$telefono,$direccion, $imagen, $mime,$carpeta)
{
	$devuelve = "";
	if($this->existe($email)!=0){
        $devuelve    =   "Ya existe un usuario con ese nombre ".$usuario;                        
        } 
    
        if ($devuelve == "") {
            $sql = "INSERT INTO se_usuarios
                                                                            (idusuario,
                                                                            usuario,
                                                                            password,
                                                                            refroll,
                                                                            email,
                                                                            nombrecompleto,
                                                                            telefono,
                                                                            direccion,
                                                                            imagen,
                                                                            mime,
                                                                            carpeta)
                                                                            VALUES
                                                                            ('',
                                                                            '".$usuario."',
                                                                            '".$password."',
                                                                            ".$refrol.",
                                                                            '".$email."',
                                                                            '".$nombrecompleto."',
                                                                            '".$telefono."',
                                                                            '".$direccion."',
                                                                            '$imagen',
                                                                            '$mime',
                                                                            '$carpeta');";
               $resultado = $this->query($sql,1);

			   mkdir("../archivos/".$carpeta, 0777);
        }
	
	return $devuelve;
	
}

function modificarUsuario($id,$usuario,$password,$nombrecompleto,$email,$telefono,$direccion, $imagen, $mime,$refroll) {

	$devuelve = "";
	$idExiste = $this->existe($usuario);
	if($idExiste!=0){
				if($idExiste == $id) {
					$sql		= "update se_usuarios set usuario = '".$usuario."'"
                                                . ", password ='".$password."'"
                                                . ", email='".$email."'"
                                                . ", nombrecompleto= '".$nombrecompleto."'"
                                                . ", telefono = '".$telefono."'"
                                                . ", direccion = '".$direccion."'"
                                                . ",imagen = '".$imagen."'"
                                                . ", refroll = ".$refroll
                                                . ",mime = '".$mime."'  where idusuario =".$id;
					$resultado	= $this->query($sql,0);
				} else {
					$devuelve    =   "Ya existe un usuario con ese nombre ".$usuario;	
				}
                
                            
            } else {

				$sql		= "update se_usuarios set usuario = '".$usuario."'"
                                                . ", password ='".$password."'"
                                                . ", email='".$email."'"
                                                . ", nombrecompleto= '".$nombrecompleto."'"
                                                . ", telefono = '".$telefono."'"
                                                . ", direccion = '".$direccion."'"
                                                . ",imagen = '".$imagen."'"
                                                . ",mime = '".$mime."'  where idusuario =".$id;
				$resultado	= $this->query($sql,0);
	}
	return $devuelve;
}



function eliminarAsignacionInmueble($idInmueble) {
    
    $sql        =   "delete from pusuarioinmuebles where refinmueble =".$idInmueble;
    $resultado  =   $this->query($sql, 0);
    return      "";
    
}

function eliminarTodaAsignacionInmueble($idUsuario) {
    
    $sql        =   "delete from pusuarioinmuebles where refusuario =".$idUsuario;
    $resultado  =   $this->query($sql, 0);
    return      "";
    
}

function eliminarUsuario($idUsuario) {
    
	//borro las imagenes de los inmuebles asociados al usuario
	$sqlInmuebles =		"delete im
						 from pusuarioinmuebles ui
						 inner join pifotos im on ui.refinmueble = im.refinmueble
						 where ui.refusuario =".$idUsuario;
	$this->query($sqlInmuebles,0);
	
	//borro los inmuebles asociados al usuario
	$sqlInmuebles =		"delete i
						 from pusuarioinmuebles ui
						 inner join	piinmuebles i on ui.refinmueble = i.idinmueble
						 where ui.refusuario =".$idUsuario;
	$this->query($sqlInmuebles,0);					 
	
	//borro la relacion
	$sqlInmueblesUsuario =		"delete from pusuarioinmuebles where refusuario =".$idUsuario;
	$this->query($sqlInmueblesUsuario,0);
	
	//borro al usuario
	$this->query($sqlInmuebles,0);
	
    $sql        =       "delete from se_usuarios where idusuario =".$idUsuario;
    $resultado	=       $this->query($sql,0);
    
    return      "";
}


function traerCategorias() {
	$sql = "select * from s_categorias order by categorias";
	$res = $this->query($sql,0);
	return $res;	
}
Function query($sql,$accion) {
		
		
		
		$hostname = "localhost";
		$database = "significados";
		$username = "root";
		$password = "";
		
/*		$hostname = "db494455387.db.1and1.com";
		$database = "db494455387";
		$username = "dbo494455387";
		$password = "Admin1234";*/
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		/*
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
                */
                $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>