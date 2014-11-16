<?php



date_default_timezone_set('America/Buenos_Aires');

class ServiciosSignificados {

/* negocio para la tabla significados */


function traerSignificados() {
	$sql		=		"select s.*
							 from s_significados s
							 inner join s_palabras p on p.idpalabra = s.refpalabra
							 inner join s_categorias c on p.refcategoria = c.idcategoria
							 order by s.fechacreacion";
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al consultar datos';
	} else {
		return $res;
	}
}

function insertarSignificados($significado, $refpalabra, $utilizacion, $refusuario) {
	$sql		=		"insert into s_significados(idsignificado, significado, refpalabra, utilizacion, refusuario, fechacreacion)
								values 
								('',
								'".utf8_decode($significado)."',
								".$refpalabra.",
								'".utf8_decode($utilizacion)."',
								".$refusuario.",
								'')";
	$res		=		$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return '';
	}			
}

function modificarSignificados($id, $significado, $refpalabra, $utilizacion, $refusuario) {
	$sql		=		"update s_significados 
							 set
								significado = '".utf8_decode($significado)."',
								refpalabra = ".$refpalabra.",
								utilizacion = '".utf8_decode($utilizacion)."',
								refusuario = ".$refusuario."
								where idsignificado =".$id;
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}			
}


function eliminarSignificados($id) {
	$sql		=		"delete from s_significados where idsignificado =".$id;
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}			
}


/* fin */

/* negocio para la tabla palabras */

function traerPalabraPorCategoria($idCategoria) {
	$sql		=		"select p.idpalabra, p.refcategoria, p.palabra, p.fechacreacion, c.categoria
							 from s_palabras p
							 inner join s_categorias c on p.refcategoria = c.idcategoria
							 where c.idcategoria = ".$idCategoria."
							 order by palabra";
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al consultar datos';
	} else {
		return $res;
	}
}

function existePalabra($palabra) {
	$sql		=	"select p.idpalabra
						from s_palabras p
						 where p.palabra = '".$palabra."'";
	$resultado  =   $this->query($sql,0);
           
           if(mysql_num_rows($resultado)>0){

               return mysql_result($resultado,0,0);

           }

           return 0;	
}


function traerPalabraDeUno() {
	$sql		=		"select p.idpalabra, p.refcategoria, p.palabra, p.fechacreacion, c.categoria
							 from s_palabras p
							 inner join s_categorias c on p.refcategoria = c.idcategoria
							 order by palabra limit 10";
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al consultar datos';
	} else {
		return $res;
	}
}

function traerPalabraDeDos() {
	$sql		=		"select p.idpalabra, p.refcategoria, p.palabra, p.fechacreacion, c.categoria
							 from s_palabras p
							 inner join s_categorias c on p.refcategoria = c.idcategoria
							 order by palabra limit 10,10";
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al consultar datos';
	} else {
		return $res;
	}
}

function traerPalabraDeTres() {
	$sql		=		"select p.idpalabra, p.refcategoria, p.palabra, p.fechacreacion, c.categoria
							 from s_palabras p
							 inner join s_categorias c on p.refcategoria = c.idcategoria
							 order by palabra limit 20,10";
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al consultar datos';
	} else {
		return $res;
	}
}

function insertarPalabra($refcategoria, $palabra) {
	$sql		=		"insert into s_palabras(idpalabra, refcategoria, palabra, fechacreacion)
								values 
								('',
								".$refcategoria.",
								'".utf8_decode($palabra)."',
								'')";
	if ($this->existePalabra(utf8_decode($palabra)) == 0) {
		
		$res		=		$this->query($sql,1);
		if ($res == false) {
			return 'Error al insertar datos';
		} else {
			return '';
		}
		
	} else {
		return 'Ya existe esa palabra.';	
	}
}

function modificarPalabra($id, $refcategoria, $palabra) {
	$sql		=		"update s_palabras 
							 set
								palabra = '".utf8_decode($palabra)."',
								refcategoria = ".$refcategoria."
								where idpalabra =".$id;
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}			
}


function eliminarPalabra($id) {
	$sql		=		"delete from s_palabras where idpalabra =".$id;
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}			
}



/* fin del negocio */


/* negocio para la tabla Categoria */

function traerCategoria() {
	$sql		=		"select idcategoria, categoria, activo from s_categorias order by categoria";
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al consultar datos';
	} else {
		return $res;
	}
}

function insertarCategoria($categoria, $activo) {
	$sql		=		"insert into s_categorias(idcategoria, categoria, activo)
								values 
								('',
								'".utf8_decode($categoria)."',
								1)";
	$res		=		$this->query($sql,1);
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return '';
	}			
}

function modificarCategoria($id, $categoria, $activo) {
	$sql		=		"update s_categorias 
							 set
								categoria = '".utf8_decode($categoria)."',
								activo = ".$activa."
								where idcategoria =".$id;
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return '';
	}			
}


function eliminarCategoria($id) {
	$sql		=		"delete from s_categorias where idcategoria =".$id;
	$res		=		$this->query($sql,0);
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}			
}

/* fin del negocio */




Function query($sql,$accion) {
		
		
		$hostname = "localhost";
		$database = "significados";
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