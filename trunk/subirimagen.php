<?php 

$link=mysql_connect("localhost","root",""); 

mysql_select_db("portalinmobiliario",$link);


if (is_uploaded_file($_FILES["userfile"]["tmp_name"])) 
{ 
	# Cogemos el formato de la imagen 
		if ($_FILES["userfile"]["type"]=="image/jpeg" 
				|| $_FILES["userfile"]["type"]=="image/pjpeg" 
				|| $_FILES["userfile"]["type"]=="image/gif" 
				|| $_FILES["userfile"]["type"]=="image/bmp" 
				|| $_FILES["userfile"]["type"]=="image/png") { 
		
				# Cogemos la anchura y altura de la imagen 
				
				$info=getimagesize($_FILES["userfile"]["tmp_name"]); 
				
				//echo "<BR>".$info[0]; 
				//anchura 
				//echo "<BR>".$info[1]; 
				//altura 
				//echo "<BR>".$info[2]; 
				//1-GIF, 2-JPG, 3-PNG 
				//echo "<BR>".$info[3]; 
				
				//cadena de texto para el tag <img # Escapa caracteres especiales 
				
				$imagenEscapes=mysql_real_escape_string(file_get_contents($_FILES["userfile"]["tmp_name"])); 
				
				# Agregamos la imagen a la base de datos 
				
				$result=mysql_query("INSERT INTO `imagephp` (anchura,altura,tipo,imagen) VALUES (".$info[0].",".$info[1].",'".$_FILES["userfile"]["type"]."','".$imagenEscapes."')",$link);
				
				# Cogemos el identificador con que se ha guardado 
				
				$id=mysql_insert_id(); 
				
				# Mostramos la imagen agregada 
				
				echo "Imagen agregada con el id ".$id."<BR>"; 
				echo "<img src='imagen_mostrar.php?id=".$id."' width='".$info[0]."' height='".$info[1]."'>"; 
	
		}   else   { 
	
			$error="El formato de archivo tiene que ser JPG, GIF, BMP o PNG."; 
			
		} 

}  else  { 

	$error="No ha seleccionado ninguna imagen..."; 

}

?>