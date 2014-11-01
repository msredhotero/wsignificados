<?php

include ('../includes/funcionesHTML.php');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funcionesInmuebles.php');

$ServiciosFunciones = new ServiciosHTML();
$serviciosInmuebles  = new ServiciosInmueble();
$serviciosUsuarios  = new ServiciosUsuarios();


$accion = $_POST['accion'];



switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
    case 'cargarUsuario':
		cargarUsuario($serviciosUsuarios);
		break;
    case 'insertarInmueble':
		insertarInmueble($serviciosInmuebles);
		break;
    case 'traerBarriosPorZona':
        traerBarriosPorZona($serviciosInmuebles);
        break;
    case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'eliminarUsuario':
		eliminarUsuario($serviciosUsuarios);
		break;
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
function traerBarriosPorZona($serviciosInmuebles) {
    $id     	=   $_POST['idzona'];
	$idBarrio	=	$_POST['idBarrio'];
    $res    	=   $serviciosInmuebles->traerBarriosPorZona($id);
    
    $cad = "";
    while ($row = mysql_fetch_array($res)) {
		if ($idBarrio == $row[0]) {
			$cad = $cad.'<option value="'.$row[0].'" selected="selected">'.utf8_encode($row[1]).'</option>';
		} else {
        	$cad = $cad.'<option value="'.$row[0].'">'.utf8_encode($row[1]).'</option>';
		}
    }
    echo $cad;
}

function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->login($email,$pass);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


function cargarUsuario($serviciosUsuarios) {
	$usuario	=	$_POST['usuario'];
	$pass		=	$_POST['password'];
	$nombrecompleto		=	$_POST['nombrecompleto'];
	$email		=	$_POST['email'];
	$telefono	=	$_POST['telefono'];
	$refrol		=	$_POST['refrol'];
	$direccion	=	$_POST['direccion'];
	
	list($name,$dominio) = explode("@", $email);
	
	$carpeta	=	$name.$dominio;
	
	$datosImagen = devolverImagen('');
	
	echo $serviciosUsuarios->cargarUsuario($usuario,$pass,$refrol,$nombrecompleto,$email,$telefono,$direccion, $datosImagen['tfoto'], $datosImagen['type'],$carpeta);	
}


function insertarInmueble($serviciosInmuebles) {
	session_start();
	$refTipoInmueble	=	$_POST['tipoinmueble'];
    $refZona			=	$_POST['zona'];
    $refBarrio			=	$_POST['barrio'];
    $precio				=	$_POST['precio'] == '' ? 'null' : $_POST['precio'];
    $area				=	$_POST['area'] == '' ? 0 : $_POST['area'];
    $habitaciones		=	$_POST['habitaciones'] == '' ? 0 : $_POST['habitaciones'];
    $baños				=	$_POST['banios'] == '' ? 0 : $_POST['banios'];
    $garage				=	$_POST['garages'] == '' ? 0 : $_POST['garages'];
    $refAntiguedad		=	$_POST['antiguedades'] == '' ? 0 : $_POST['antiguedades'];
    $amoblado			=	$_POST['amoblado'] == 3 ? 'null' : $_POST['amoblado'];
    $rango				=	$_POST['rango'] == '' ? 1 : $_POST['rango'];
    $observacion		=	trim(utf8_decode($_POST['observacion']));
    
	$resId = $serviciosInmuebles->insertarInmueble($refTipoInmueble,$refZona,$refBarrio,$area,$habitaciones,$baños,$garage,$refAntiguedad,$amoblado,$precio,$observacion,$rango,$_SESSION['refid_se']);
	
	//echo $resId;
	
	/*
	$datosImagen1 = $_POST['imagen1'];
	$datosImagen2 = $_POST['imagen2'];
	$datosImagen3 = $_POST['imagen3'];
	$datosImagen4 = $_POST['imagen4'];
	$datosImagen5 = $_POST['imagen5'];
	$datosImagen6 = $_POST['imagen6'];
	$datosImagen7 = $_POST['imagen7'];
	$datosImagen8 = $_POST['imagen8'];
	$datosImagen9 = $_POST['imagen9'];
	$datosImagen10 = $_POST['imagen10'];
	$datosImagen11 = $_POST['imagen11'];
	$datosImagen12 = $_POST['imagen12'];
	$datosImagen13 = $_POST['imagen13'];
	$datosImagen14 = $_POST['imagen14'];
	$datosImagen15 = $_POST['imagen15'];
	$datosImagen16 = $_POST['imagen16'];
	$datosImagen17 = $_POST['imagen17'];
	$datosImagen18 = $_POST['imagen18'];
	$datosImagen19 = $_POST['imagen19'];
	$datosImagen20 = $_POST['imagen20'];
	$datosImagen21 = $_POST['imagen21'];
	$datosImagen22 = $_POST['imagen22'];
	$datosImagen23 = $_POST['imagen23'];
	$datosImagen24 = $_POST['imagen24'];
	$datosImagen25 = $_POST['imagen25'];
	$datosImagen26 = $_POST['imagen26'];
	$datosImagen27 = $_POST['imagen27'];
	$datosImagen28 = $_POST['imagen28'];
	$datosImagen29 = $_POST['imagen29'];
	$datosImagen30 = $_POST['imagen30'];
	*/
	$imagenes = array("imagen1" => 'imagen1',
					  "imagen2" => 'imagen2',
					  "imagen3" => 'imagen3',
					  "imagen4" => 'imagen4',
					  "imagen5" => 'imagen5',
					  "imagen6" => 'imagen6',
					  "imagen7" => 'imagen7',
					  "imagen8" => 'imagen8',
					  "imagen9" => 'imagen9',
					  "imagen10" => 'imagen10',
					  "imagen11" => 'imagen11',
					  "imagen12" => 'imagen12',
					  "imagen13" => 'imagen13',
					  "imagen14" => 'imagen14',
					  "imagen15" => 'imagen15',
					  "imagen16" => 'imagen16',
					  "imagen17" => 'imagen17',
					  "imagen18" => 'imagen18',
					  "imagen19" => 'imagen19',
					  "imagen20" => 'imagen20',
					  "imagen21" => 'imagen21',
					  "imagen22" => 'imagen22',
					  "imagen23" => 'imagen23',
					  "imagen24" => 'imagen24',
					  "imagen25" => 'imagen25',
					  "imagen26" => 'imagen26',
					  "imagen27" => 'imagen27',
					  "imagen28" => 'imagen28',
					  "imagen29" => 'imagen29',
					  "imagen30" => 'imagen30');

	foreach ($imagenes as $valor) {
    	$serviciosInmuebles->subirArchivo($valor,$_SESSION['carpeta_se'],$resId);
	}

	
	echo '';
	
}

?>