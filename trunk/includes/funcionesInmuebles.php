<?php



date_default_timezone_set('America/Buenos_Aires');

class ServiciosInmueble {

/* negocio para los archivos */

function borrarDirecctorio($dir) {
	array_map('unlink', glob($dir."/*.*"));	
	
}

function borrarArchivo($id,$archivo) {
	$sql	=	"delete from dbarchivosclientes where idarchivos =".$id;
	$archivo = $this->TraerArchivo($id);
	$res =  unlink("../archivos/".$archivo);
	if ($res)
	{
		$this->query($sql,0);	
	}
	return $res;
}

function TraerArchivo($id) {
	$sql	=	"select carpeta,archivo,concat(carpeta,'/',archivo) as nombrecompleto from dbarchivosclientes where idarchivos =".$id;
	return	mysql_result($this->query($sql,0),0,2);
}

function cargarArchivo($idcliente,$carpeta,$archivo,$tipoarchivo) {
	$sql	=	"insert into dbarchivosclientes values ('',".$idcliente.",'".$archivo."','".$tipoarchivo."','".$carpeta."')";
	return $this->query($sql,1);
		
}

function existeArchivo($refinmueble,$nombre,$type) {
	$sql		=	"select * from pifotos where refinmueble =".$refinmueble." and imagen = '".$nombre."' and type = '".$type."'";
	$resultado  =   $this->query($sql,0);
           
           if(mysql_num_rows($resultado)>0){

               return mysql_result($resultado,0,0);

           }

           return 0;	
}

function subirArchivo($file,$carpeta,$idInmueble) {
	$dir_destino = '../archivos/'.$carpeta.'/'.$idInmueble.'/';
	$imagen_subida = $dir_destino . basename($_FILES[$file]['name']);
	
	$noentrar = '../imagenes/index.php';
	$nuevo_noentrar = '../archivos/'.$carpeta.'/'.$idInmueble.'/'.'index.php';
	
	if (!file_exists($dir_destino)) {
    	mkdir($dir_destino, 0777);
	}
	
	 
	if(!is_writable($dir_destino)){
		
		echo "no tiene permisos";
		
	}	else	{
		if ($_FILES[$file]['tmp_name'] != '') {
			if(is_uploaded_file($_FILES[$file]['tmp_name'])){
				/*echo "Archivo ". $_FILES['foto']['name'] ." subido con éxtio.\n";
				echo "Mostrar contenido\n";
				echo $imagen_subida;*/
				if (move_uploaded_file($_FILES[$file]['tmp_name'], $imagen_subida)) {
					
					$archivo = utf8_decode($_FILES[$file]["name"]);
					$tipoarchivo = $_FILES[$file]["type"];
					
					if ($this->existeArchivo($idInmueble,$archivo,$tipoarchivo) == 0) {
						$sql	=	"insert into pifotos(idfoto,refinmueble,imagen,type) values ('',".$idInmueble.",'".$archivo."','".$tipoarchivo."')";
						$this->query($sql,1);
					}
					echo "";
					
					copy($noentrar, $nuevo_noentrar);
	
				} else {
					echo "Posible ataque de carga de archivos!\n";
				}
			}else{
				echo "Posible ataque del archivo subido: ";
				echo "nombre del archivo '". $_FILES[$file]['tmp_name'] . "'.";
			}
		}
	}	
}

/* fin archivos */


/* negocio para la tabla TipoInmueble */

function insertarTipoInmueble($tipoinmueble)
{
	
	$sql		=	"insert into pitipoinmueble(idtipoinmueble,tipoinmueble) values ('','".utf8_decode($tipoinmueble)."')";
	
	$res 		=	$this->query($sql,1);
	
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}


function modificarTipoInmueble($id,$tipoinmueble)
{
	
	$sql		=	"update pitipoinmueble set tipoinmueble = '".utf8_decode($tipoinmueble)."' where idtipoinmueble =".$id;
	
	$res 		=	$this->query($sql,0);
	
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}


function eliminarTipoInmueble($id)
{
	
	$sql		=	"delete from pitipoinmueble where idtipoinmueble =".$id;
	
	$res 		=	$this->query($sql,0);
	
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}


function traerTipoInmueble()
{
	$sql        =   "select * from pitipoinmueble order by idtipoinmueble";
    $res        =   $this->query($sql, 0);
    return $res;
}
/* fin del negocio para la tabala */


/* negocio para la tabla Zona */


function insertarZona($zona)
{
	
	$sql		=	"insert into pizona(idzona,zona) values ('','".utf8_decode($zona)."')";
	
	$res 		=	$this->query($sql,1);
	
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}


function modificarZona($id,$zona)
{
	
	$sql		=	"update pizona set zona = '".utf8_decode($zona)."' where idzona =".$id;
	
	$res 		=	$this->query($sql,0);
	
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}


function eliminarZona($id)
{
	
	$sql		=	"delete from pizona where idzona =".$id;
	
	$res 		=	$this->query($sql,0);
	
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}

function traerZonas() {
    $sql        =   "select * from pizona order by idzona";
    $res        =   $this->query($sql, 0);
    return $res;
}

/* fin del negocio */




/* negocio para la tabla Barrio */


function insertarBarrio($barrio)
{
	
	$sql		=	"insert into pibarrio(idbarrio,barrio) values ('','".utf8_decode($barrio)."')";
	
	$res 		=	$this->query($sql,1);
	
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}


function modificarBarrio($id,$barrio)
{
	
	$sql		=	"update pibarrio set barrio = '".utf8_decode($barrio)."' where idbarrio =".$id;
	
	$res 		=	$this->query($sql,0);
	
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}


function eliminarBarrio($id)
{
	
	$sql		=	"delete from pibarrio where idbarrio =".$id;
	
	$res 		=	$this->query($sql,0);
	
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}

function traerBarrios() {
    $sql        =   "select * from pibarrio order by barrio";
    $res        =   $this->query($sql, 0);
    return $res;
}

function traerBarriosPorZona($id) {
    $sql        =   "select idbarrio,barrio from pibarrio b "
            . " inner join pizona z on b.refzona = z.idzona "
            . " where b.refzona = ".$id. " order by b.barrio";
    $res        =   $this->query($sql, 0);
    return $res;
}

/* fin del negocio */






/* negocio para la tabla Fotos */


function insertarFoto($foto1,$foto2,$foto3,$foto4,$foto5,$foto6,$refInmueble)
{
	
	$sql		=	"insert into pifotos(idfoto,refinmueble,imagen1,imagen2,imagen3,imagen4,imagen5,imagen6) 
									values (''
											,".$refInmueble."
											,'".$foto1."'
											,'".$foto2."'
											,'".$foto3."'
											,'".$foto4."'
											,'".$foto5."'
											,'".$foto6."'
											)";
	
	$res 		=	$this->query($sql,1);
	
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}
}


function modificarFoto($id,$foto1,$foto2,$foto3,$foto4,$foto5,$foto6,$refInmueble)
{
	
	$sql		=	"update pifotos set imagen1 = '".utf8_decode($foto1)."'
										,imagen2 = '".utf8_decode($foto2)."'
										,imagen3 = '".utf8_decode($foto3)."'
										,imagen4 = '".utf8_decode($foto4)."'
										,imagen5 = '".utf8_decode($foto5)."'
										,imagen6 = '".utf8_decode($foto6)."'
										,refinmueble = ".$refInmueble." where idfoto =".$id;
	
	$res 		=	$this->query($sql,0);
	
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}


function eliminarFoto($id)
{
	
	$sql		=	"delete from pifotos where idfoto =".$id;
	
	$res 		=	$this->query($sql,0);
	
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}


/* fin del negocio */

function traerTipoAntiguedad() {
	$sql        =   "select * from pitipoantiguedad order by valor";
    $res        =   $this->query($sql, 0);
    return $res;
}


/* negocio para la tabla Inmuebles */

/* joineo de la tabla piusuarioinmuebles con la de inmuebles */

function insertarRelacionInmuebleUsuario($refUsuario,$refInmuebles) {
	$sql = "insert into piusuarioinmuebles(idusuarioinmueble,refusuario,refinmueble)
						values ('',".$refUsuario.",".$refInmuebles.")";
	$res 		=	$this->query($sql,1);
	
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return '';
	}	
}

function insertarInmueble($refTipoInmueble,$refZona,$refBarrio,$area,$habitaciones,$baños,$garage,$refAntiguedad,$amoblado,$precio,$observaciones,$rango,$refUsuario)
{
	
	$sql	=	"insert into piinmuebles(idinmueble
                                                ,reftipoinmueble
                                                ,refbarrio
                                                ,area
                                                ,habitaciones
                                                ,banios
                                                ,garages
                                                ,refantiguedad
                                                ,amoblado
                                                ,precio
                                                ,observaciones
                                                ,rango
												,fechacreacion) 
						values (''
							,".$refTipoInmueble."
                                                        ,".$refBarrio."
							,".$area."
							,".$habitaciones."
							,".$baños."
							,".$garage."
							,".$refAntiguedad."
                                                        ,".$amoblado."
                                                        ,".$precio."
							,'".$observaciones."'
                                                        ,".$rango."
							,'".date('Y-m-d')."')";
	
	$res 		=	$this->query($sql,1);
	
	//return $sql;
	if ($res == false) {
		return 'Error al insertar datos2';
	} else {
		
		$this->insertarRelacionInmuebleUsuario($refUsuario,$res);
		return $res;
	}
	
}

function insertarImagenes($refInmueble,$imagen1,$imagen2,$imagen3,$imagen4,$imagen5,$imagen6,$mime1,$mime2,$mime3,$mime4,$mime5,$mime6) {
	$sql	=	"insert into pifotos(idfoto,refinmueble,imagen1,imagen2,imagen3,imagen4,imagen5,imagen6,mime1,mime2,mime3,mime4,mime5,mime6)
				 values ('',
				 		 ".$refInmueble.",
				 		 '".$imagen1."',
						 '".$imagen2."',
						 '".$imagen3."',
						 '".$imagen4."',
						 '".$imagen5."',
						 '".$imagen6."',
						 '".$mime1."',
						 '".$mime2."',
						 '".$mime3."',
						 '".$mime4."',
						 '".$mime5."',
						 '".$mime6."')";
						 
	$res	=	$this->query($sql,1);
	
//	return $sql;
	if ($res == false) {
		return 'Error al insertar datos3';
	} else {
		return '';
	}
}

function modificarInmueble($id,$refTipoInmueble,$refZona,$refBarrio,$area,$habitaciones,$baños,$garage,$refAntiguedad,$amoblado,$precio,$observaciones,$rango)
{
	
	$sql		=	"update piinmuebles set  reftipoinmueble = ".$refTipoInmueble."
                                                        ,refzona = ".$refZona."
                                                        ,refbarrio = ".$refBarrio."
                                                        ,area = ".$area."
                                                        ,habitaciones = ".$habitaciones."
                                                        ,banios = ".$baños."
                                                        ,garages = ".$garage."
                                                        ,refantiguedad = ".$refAntiguedad."
                                                        ,amoblado = ".$amoblado."
                                                        ,precio = ".$precio."
                                                        ,rango = ".$rango."
                                                        ,observaciones = '".utf8_decode($observaciones)."'"
                                . " where idinmueble =".$id;
	
	$res 		=	$this->query($sql,0);
	
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}
}


function eliminarInmueble($id)
{
	
	$sql		=	"delete from piinmuebles where idinmueble =".$id;
	
	$res 		=	$this->query($sql,0);
	
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}

function TraerInmuebles() {
    $sql    =   "SELECT 
					i.idinmueble,
					i.reftipoinmueble,
					b.refzona,
					i.refbarrio,
					i.area,
					i.habitaciones,
					i.banios,
					i.garages,
					i.refantiguedad,
					i.amoblado,
					i.precio,
					i.observaciones,
					i.rango,
					u.carpeta,
					MAX(f.imagen) AS imagen
				FROM
					piinmuebles i
						INNER JOIN
					pitipoinmueble ti ON i.reftipoinmueble = ti.idtipoinmueble
						INNER JOIN
					pibarrio b ON i.refbarrio = b.idbarrio
						INNER JOIN
					pizona z ON b.refzona = z.idzona
						LEFT JOIN
					pifotos f ON f.refinmueble = i.idinmueble
						LEFT JOIN
					pitipoantiguedad a ON i.refantiguedad = a.idtipoantiguedad
						INNER JOIN
					piusuarioinmuebles ui ON ui.refinmueble = i.idinmueble
						INNER JOIN
					se_usuarios u ON u.idusuario = ui.refusuario
				GROUP BY i.idinmueble , i.reftipoinmueble , b.refzona , i.refbarrio , i.area , i.habitaciones , i.banios , i.garages , i.refantiguedad , i.amoblado , i.precio , i.observaciones , i.rango
				ORDER BY i.rango,i.fechacreacion desc";
    $result =   $this->query($sql, 0);
    return $result;
}

function TraerFotosInmuebles($idInmueble) {
	$sql    =   "select u.carpeta,i.idinmueble,f.imagen
                        from piinmuebles i
						
						inner
						join pifotos f
						on	i.idinmueble = f.refinmueble
						
						INNER JOIN
						piusuarioinmuebles ui ON ui.refinmueble = i.idinmueble
						
						INNER JOIN
						se_usuarios u ON u.idusuario = ui.refusuario
					
						where i.idinmueble = ".$idInmueble;
    $result =   $this->query($sql, 0);
    return $result;
}

function TraerFotosInmueblesUsuario($idInmueble,$idUsuario) {
	$sql    =   "select u.carpeta,i.idinmueble,f.imagen
                        from piinmuebles i
						
						inner
						join pifotos f
						on	i.idinmueble = f.refinmueble
						
						INNER JOIN
						piusuarioinmuebles ui ON ui.refinmueble = i.idinmueble
						
						INNER JOIN
						se_usuarios u ON u.idusuario = ui.refusuario
						
						where i.idinmueble = ".$idInmueble." and ui.refusuario =".$idUsuario;
    $result =   $this->query($sql, 0);
    return $result;
}

function TraerInmueblesPorFiltros($filtro) {
    $sql    =   "select i.idinmueble ,i.reftipoinmueble
                                   ,i.refzona
                                   ,i.refbarrio
                                   ,i.area
                                   ,i.habitaciones
                                   ,i.banios
                                   ,i.garages
                                   ,i.refantiguedad
                                   ,i.amoblado
                                   ,i.precio
                                   ,i.observaciones
                                   ,i.rango
                        from piinmuebles i
                        inner
                        join pitipoinmueble ti
                        on  i.reftipoinmueble = ti.idtipoinmueble
                        
                        inner
                        join pibarrio b
                        on  i.refbarrio = b.idbarrio
                        
						inner
                        join pizona z
                        on  b.refzona = z.idzona
						
                        inner
                        join pitipoantiguedad a
                        on  i.refantiguedad = a.idtipoantiguedad
                        where ".$filtro."
                        order by rango";
    $result =   $this->query($sql, 0);
    return $result;
}

function TraerInmueblesPorId($id) {
    $sql    =   "select i.idinmueble ,i.reftipoinmueble
                                   ,ti.tipoinmueble 
                                   ,b.refzona
                                   ,z.zona
                                   ,i.refbarrio
                                   ,b.barrio
                                   ,i.area
                                   ,i.habitaciones
                                   ,i.banios
                                   ,i.garages
                                   ,i.refantiguedad
                                   ,a.antiguedad
                                   ,i.amoblado
                                   ,i.precio
                                   ,i.observaciones
                                   ,i.rango
								   ,a.valor
                        from piinmuebles i
                        inner
                        join pitipoinmueble ti
                        on  i.reftipoinmueble = ti.idtipoinmueble
                        
                        inner
                        join pibarrio b
                        on  i.refbarrio = b.idbarrio
                        
						inner
                        join pizona z
                        on  b.refzona = z.idzona
						
                        left
                        join pitipoantiguedad a
                        on  i.refantiguedad = a.idtipoantiguedad
                        where idinmueble = ".$id;
    $result =   $this->query($sql, 0);
    return $result;
}

function TraerInmueblesPorIdUsuario($id,$idUsuario) {

    $sql    =   "select i.idinmueble ,i.reftipoinmueble
                                   ,ti.tipoinmueble 
                                   ,b.refzona
                                   ,z.zona
                                   ,i.refbarrio
                                   ,b.barrio
                                   ,i.area
                                   ,i.habitaciones
                                   ,i.banios
                                   ,i.garages
                                   ,i.refantiguedad
                                   ,a.antiguedad
                                   ,i.amoblado
                                   ,i.precio
                                   ,i.observaciones
                                   ,i.rango
								   ,a.valor
                        from piinmuebles i
                        inner
                        join pitipoinmueble ti
                        on  i.reftipoinmueble = ti.idtipoinmueble
                        
                        inner
                        join pibarrio b
                        on  i.refbarrio = b.idbarrio
                        
						inner
                        join pizona z
                        on  b.refzona = z.idzona
						
						inner
						join piusuarioinmuebles ui
						on	ui.refinmueble = i.idinmueble
						
                        left
                        join pitipoantiguedad a
                        on  i.refantiguedad = a.idtipoantiguedad
                        where idinmueble = ".$id." and ui.refusuario =".$idUsuario;
    $result =   $this->query($sql, 0);
    return $result;
}


function TraerInmueblesPorAgente($idAgente) {
    $sql    =   "select i.idinmueble,
					i.reftipoinmueble,
					b.refzona,
					i.refbarrio,
					i.area,
					i.habitaciones,
					i.banios,
					i.garages,
					i.refantiguedad,
					i.amoblado,
					i.precio,
					i.observaciones,
					i.rango,
					u.carpeta,
					MAX(f.imagen) AS imagen
                        from piinmuebles i
                        inner
                        join pitipoinmueble ti
                        on  i.reftipoinmueble = ti.idtipoinmueble
                        
                        inner
                        join pibarrio b
                        on  i.refbarrio = b.idbarrio
                        
						inner
                        join pizona z
                        on  b.refzona = z.idzona
						
                        left
                        join pitipoantiguedad a
                        on  i.refantiguedad = a.idtipoantiguedad
						
						left
						join pifotos f
						on	f.refinmueble = i.idinmueble
						
						inner
						join piusuarioinmuebles ui
						on	ui.refinmueble = i.idinmueble
						
						inner
						join se_usuarios u
						on	u.idusuario = ui.refusuario

                        where u.idusuario = ".$idAgente."
						GROUP BY i.idinmueble , i.reftipoinmueble , b.refzona , i.refbarrio , i.area , i.habitaciones , i.banios , i.garages , i.refantiguedad , i.amoblado , i.precio , i.observaciones , i.rango
						ORDER BY i.rango,i.fechacreacion desc";
    $result =   $this->query($sql, 0);
    return $result;
}


/* fin del negocio */




/* para subir imagenes */

function SubirFotos($imagenS)
{
	// Verificamos que el formulario no ha sido enviado aun
	
	
	  // Nivel de errores
	  error_reporting(E_ALL);
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  # Servidor de base de datos
	  define("DBHOST", "localhost");
	  # nombre de la base de datos
	  define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  define("DBUSER", "root");
	  # Password de base de datos
	  define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["foto"]["name"];
	  $type = $_FILES["foto"]["type"];
	  $tmp_name = $_FILES["foto"]["tmp_name"];
	  $size = $_FILES["foto"]["size"];
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
	  $ratio = ($datos[1]/ALTURA);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, ALTURA);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, ALTURA, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen(NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize(NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  @unlink($tmp_name);
	  @unlink(NAMETHUMB);
	  // Guardamos todo en la base de datos
	  #nombre de la foto
	  $nombre = $_POST["nombre"];
	  $link = mysql_connect(DBHOST, DBUSER, DBPASSWORD) or die(mysql_error($link));;
	  mysql_select_db(DBNAME, $link) or die(mysql_error($link));
	  $sql = "INSERT INTO tabla(nombre, foto, thumb, mime)
		VALUES
		('$nombre', '$tfoto', '$tthumb', '$type')";
	  mysql_query($sql, $link) or die(mysql_error($link));
	  
	  
	  return "Fotos guardadas";


}

/* fin subir imagenes */


Function query($sql,$accion) {
		
		
		$hostname = "localhost";
		$database = "portalinmobiliario";
		$username = "root";
		$password = "";
		
/*		$hostname = "";
		$database = "";
		$username = "";
		$password = "";*/
		
        

		
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