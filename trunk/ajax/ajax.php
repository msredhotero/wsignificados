<?php


include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesSignificados.php');

$serviciosSignificados  = new ServiciosSignificados();
$serviciosUsuarios  = new ServiciosUsuarios();


$accion = $_POST['accion'];



switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
    case 'cargarUsuario':
		cargarUsuario($serviciosUsuarios);
		break;
    case 'insertarPalabra':
		insertarPalabra($serviciosSignificados);
		break;
    case 'insertarSignificados':
		insertarSignificados($serviciosSignificados);
		break;
}

function insertarSignificados($serviciosSignificados) {
	session_start();
	$refpalabra		=		$_POST['palabra'];
	$utilizacion	=		$_POST['utilizacion'];
	$significado	=		$_POST['significado'];
	$refusuario		=		$_SESSION['usua_sign'];
	echo $serviciosSignificados->insertarSignificados($significado, $refpalabra, $utilizacion, $refusuario);
}

function insertarPalabra($serviciosSignificados) {
	$refcategoria	=		$_POST['refcategoria'];
	$palabra			=		$_POST['palabra'];
	echo $serviciosSignificados->insertarPalabra($refcategoria, $palabra);
}

function eliminarUsuario($serviciosUsuarios) {
	$id			=	$_POST['id'];
	echo $serviciosUsuarios->eliminarUsuario($id);	
}

function modificarUsuario($serviciosUsuarios) {
        $usuario	=	$_POST['usuario'];
	$password	=	$_POST['password'];
	$nombrecompleto	=	$_POST['nombrecompleto'];
	$email		=	$_POST['email'];
	$telefono	=	$_POST['telefono'];
	$refrol		=	$_POST['refrol'];
	$direccion	=	$_POST['direccion'];
	$id             =       $_POST['idusuario'];
	$datosImagen = devolverImagen('');
        
        echo $serviciosUsuarios->modificarUsuario($id,$usuario,$password,$nombrecompleto,$email,$telefono,$direccion, $datosImagen['tfoto'], $datosImagen['type'],$refrol);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->login($email,$pass);
}



?>