<?php


require 'includes/funcionesUsuarios.php';
require 'includes/funcionesSignificados.php';

$serviciosUsuarios = new ServiciosUsuarios();
$serviciosSignificados = new ServiciosSignificados();

$resCategoriaMenu = $serviciosSignificados->traerCategoria();

$resPalabraUno = $serviciosSignificados->traerPalabraDeUno();
$resPalabraDos = $serviciosSignificados->traerPalabraDeDos();
$resPalabraTres = $serviciosSignificados->traerPalabraDeTres();



?>

<!DOCTYPE HTML>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv='refresh' content='1000' />

<meta name='title' content='Ver' />

<meta name='description' content='Significados' />

<meta name='keywords' content='Significados' />

<meta name='distribution' content='Global' />

<meta name='language' content='es' />

<meta name='identifier-url' content='http://www.significados.mx' />

<meta name='rating' content='General' />

<meta name='reply-to' content='' />

<meta name='author' content='Webmasters' />

<meta http-equiv='Pragma' content='no-cache/cache' />



<meta http-equiv='Cache-Control' content='no-cache' />

<meta name='robots' content='all' />

<meta name='revisit-after' content='7 day' />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Si?nifica¿os</title>



		<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

         <link rel="stylesheet" href="css/jquery-ui.css">

    <script src="js/jquery-ui.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
      <script type="text/javascript">
		$( document ).ready(function() {
			$('#icoCate').click(function() {
				$('#icoCate').hide();
				$('.todoMenu').show(100, function() {
					$('#menuCate').animate({'margin-left':'0px'}, {
													duration: 800,
													specialEasing: {
													width: "linear",
													height: "easeOutBounce"
													}});
				});
			});
			
			$('.ocultar').click(function(){
				$('#icoCate').show(100, function() {
					$('#menuCate').animate({'margin-left':'-235px'}, {
													duration: 800,
													specialEasing: {
													width: "linear",
													height: "easeOutBounce"
													}});
				});
				$('.todoMenu').hide();
			});
			
			
		

		});
	</script>
   <link href="css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="js/jquery.mousewheel.js"></script>
      <script src="js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#menuCate').perfectScrollbar();
      });
    </script>
        
        
</head>



<body>

<div style="background: rgba(255,175,75,1);
background: -moz-linear-gradient(-45deg, rgba(255,175,75,1) 0%, rgba(255,143,13,1) 52%, rgba(255,136,0,1) 63%);
background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(255,175,75,1)), color-stop(52%, rgba(255,143,13,1)), color-stop(63%, rgba(255,136,0,1)));
background: -webkit-linear-gradient(-45deg, rgba(255,175,75,1) 0%, rgba(255,143,13,1) 52%, rgba(255,136,0,1) 63%);
background: -o-linear-gradient(-45deg, rgba(255,175,75,1) 0%, rgba(255,143,13,1) 52%, rgba(255,136,0,1) 63%);
background: -ms-linear-gradient(-45deg, rgba(255,175,75,1) 0%, rgba(255,143,13,1) 52%, rgba(255,136,0,1) 63%);
background: linear-gradient(135deg, rgba(255,175,75,1) 0%, rgba(255,143,13,1) 52%, rgba(255,136,0,1) 63%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffaf4b', endColorstr='#ff8800', GradientType=1 );">
    
    <div id="header">
    	<div class="col-md-6">
    	
    	</div>
        <div class="col-md-6" style="padding-right:60px; margin-top:50px;">
    		<div class="row">
            	<div class="col-md-8" style="height:19px;">
                	<p style="font-style:italic; color:#FFF;">..encuentre el significado de la palabra que busca</p>
                </div>
                <div class="col-md-4">

                </div>
            </div>
            <div class="row">
            	<div class="col-md-8">
                <input type="text" class="form-control" id="buscar" name="buscar">
                </div>
                <div class="col-md-4">
                <button style="background:url(imagenes/button_buscar.png) no-repeat; width:98px; height:31px; border:none;"></button>
                </div>
            </div>
    	</div>
    </div><!-- fin del header-->
	
    <div id="menuCate">
    	<div class="todoMenu">
            <div id="mobile-header">
                Menu
                <p>Usuario: <span style="color: #333; font-weight:900;">AdminMarcos</span></p>
                <p class="ocultar" style="color: #146CAD; font-weight:bold; cursor:pointer; font-family:'Courier New', Courier, monospace; height:20px;">(Ocultar)</p>
            </div>
    
            <nav class="nav">
                <ul>
                    <?php while ($row = mysql_fetch_array($resCategoria)) { ?> 
                    <li><a href="categorias/categorias.php?id=<?php echo $row['idcategoria']; ?>"><?php echo utf8_encode($row['categoria']); ?></a></li>
					<?php } ?> 
                    <li><a href="salir/">Salir</a></li>
                </ul>
            </nav>
        	
            <!--<div id="infoMenu">
                <p>Información del Menu</p>
            </div>
        
            <div id="infoDescrMenu">
                <p>La descripción breve de cada item sera detallada aqui, deslizando el mouse por encima de cada menu.</p>
            </div>-->
    	</div>
    </div>
    <div id="icoCate">
    	
    </div>
    
    <div class="content">
    	<div class="panel panel-significados">
          <div class="panel-heading">
            <h3 class="panel-title" style="color:#FFF;text-shadow: black 1px 1px 2px;">Palabras Nuevas <span style="color:#000; float:right; padding-right:100px; word-spacing:4px;"><a href="" style="color:#000;">a</a> <a href="" style="color:#000;">b</a> <a href="" style="color:#000;">c</a> <a href="" style="color:#000;">d</a> <a href="" style="color:#000;">e</a> <a href="" style="color:#000;">f</a> <a href="" style="color:#000;">g</a> <a href="" style="color:#000;">h</a> <a href="" style="color:#000;">i</a> <a href="" style="color:#000;">j</a> <a href="" style="color:#000;">k</a> <a href="" style="color:#000;">l</a> <a href="" style="color:#000;">m</a> <a href="" style="color:#000;">n</a> <a href="" style="color:#000;">o</a> <a href="" style="color:#000;">p</a> <a href="" style="color:#000;">q</a> <a href="" style="color:#000;">r</a> <a href="" style="color:#000;">s</a> <a href="" style="color:#000;">t</a> <a href="" style="color:#000;">u</a> <a href="" style="color:#000;">v</a> <a href="" style="color:#000;">w</a> <a href="" style="color:#000;">x</a> <a href="" style="color:#000;">y</a> <a href="" style="color:#000;">z</a></span></h3>
          </div>
          <div class="panel-body">
          <div align="center">
          	<h3><span style="color:#06F;">Significados</span><span style="color:#F90;">, es un sitio donde usted puede expresar el significado de una palabra a su manera.</span><a href="cargarsignificado.php" style="color:#999;"> Nuevo significado</a></h3>
            <p style="font-weight:bold;">2.230.652 significados cargados al momento</p>
          </div>
          <div style=" padding-left:30px; padding-right:30px;background: #ffffff; /* Old browsers */
background: -moz-radial-gradient(top, ellipse cover, #ffffff 0%, #f6f6f6 76%, #ededed 100%); /* FF3.6+ */
background: -webkit-gradient(radial, top center, 0px, top center, 100%, color-stop(0%,#ffffff), color-stop(76%,#f6f6f6), color-stop(100%,#ededed)); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(top, ellipse cover, #ffffff 0%,#f6f6f6 76%,#ededed 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(top, ellipse cover, #ffffff 0%,#f6f6f6 76%,#ededed 100%); /* Opera 12+ */
background: -ms-radial-gradient(top, ellipse cover, #ffffff 0%,#f6f6f6 76%,#ededed 100%); /* IE10+ */
background: radial-gradient(ellipse at top, #ffffff 0%,#f6f6f6 76%,#ededed 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed',GradientType=1 );
-webkit-box-shadow: 0px 2px 3px 2px rgba(0,0,0,0.19);
-moz-box-shadow: 0px 2px 3px 2px rgba(0,0,0,0.19);
box-shadow: 0px 2px 3px 2px rgba(0,0,0,0.19);">
            <div class="row" style="padding:10px;">
            	<h4 style="text-shadow: -1px -1px white;">Recientemente agregados a Significados</h4>
            	<div class="col-md-4">
                	<ul style="list-style-image:url(imagenes/list-check.fw.png);">
                    	<?php while ($row1 = mysql_fetch_array($resPalabraUno)) { ?> 
                        <li><a href="significados.php?id=<?php echo $row1['idpalabra']; ?>"><?php echo utf8_encode($row1['palabra']); ?></a></li>
                        <?php } ?> 
                    </ul>
                </div>
                
                <div class="col-md-4">
                	<ul style="list-style-image:url(imagenes/list-check.fw.png);">
                    	<?php while ($row2 = mysql_fetch_array($resPalabraDos)) { ?> 
                        <li><a href="significados.php?id=<?php echo $row2['idpalabra']; ?>"><?php echo utf8_encode($row2['palabra']); ?></a></li>
                        <?php } ?> 
                    </ul>
                </div>
                
                <div class="col-md-4">
                	<ul style="list-style-image:url(imagenes/list-check.fw.png);">
                    	<?php while ($row3 = mysql_fetch_array($resPalabraTres)) { ?> 
                        <li><a href="significados.php?id=<?php echo $row3['idpalabra']; ?>"><?php echo utf8_encode($row3['palabra']); ?></a></li>
                        <?php } ?> 
                    </ul>
                </div>
            </div>
          </div>
          </div>
        </div>
    </div><!--fin del content-->
	

</div><!-- fin del div del degradado-->
</body>

</html>