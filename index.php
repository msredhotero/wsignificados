<?php


require 'includes/funcionesUsuarios.php';

$serviciosUsuarios = new ServiciosUsuarios();



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
	
    <div class="content">
    	<div class="panel panel-significados">
          <div class="panel-heading">
            <h3 class="panel-title" style="color:#FFF;text-shadow: black 1px 1px 2px;">Palabras Nuevas <span style="color:#000; float:right; padding-right:100px; word-spacing:4px;"><a href="" style="color:#000;">a</a> <a href="" style="color:#000;">b</a> <a href="" style="color:#000;">c</a> <a href="" style="color:#000;">d</a> <a href="" style="color:#000;">e</a> <a href="" style="color:#000;">f</a> <a href="" style="color:#000;">g</a> <a href="" style="color:#000;">h</a> <a href="" style="color:#000;">i</a> <a href="" style="color:#000;">j</a> <a href="" style="color:#000;">k</a> <a href="" style="color:#000;">l</a> <a href="" style="color:#000;">m</a> <a href="" style="color:#000;">n</a> <a href="" style="color:#000;">o</a> <a href="" style="color:#000;">p</a> <a href="" style="color:#000;">q</a> <a href="" style="color:#000;">r</a> <a href="" style="color:#000;">s</a> <a href="" style="color:#000;">t</a> <a href="" style="color:#000;">u</a> <a href="" style="color:#000;">v</a> <a href="" style="color:#000;">w</a> <a href="" style="color:#000;">x</a> <a href="" style="color:#000;">y</a> <a href="" style="color:#000;">z</a></span></h3>
          </div>
          <div class="panel-body">
          <div align="center">
          	<h3><span style="color:#06F;">Significados</span><span style="color:#F90;">, es un sitio donde usted puede expresar el significado de una palabra a su manera.</span><a href="" style="color:#999;"> Nuevo significado</a></h3>
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
                	<ul>
                    	<li>Marcos</li>
                        <li>Alex</li>
                        <li>Atun</li>
                        <li>Anteojos</li>
                        <li>Lumbre</li>
                        <li>Perro</li>
                        <li>Costumbre</li>
                        <li>Villa</li>
                        <li>Lagos</li>
                        <li>Monos</li>
                    </ul>
                </div>
                
                <div class="col-md-4">
                	<ul>
                    	<li>Marcos</li>
                        <li>Alex</li>
                        <li>Atun</li>
                        <li>Anteojos</li>
                        <li>Lumbre</li>
                        <li>Perro</li>
                        <li>Costumbre</li>
                        <li>Villa</li>
                        <li>Lagos</li>
                        <li>Monos</li>
                    </ul>
                </div>
                
                <div class="col-md-4">
                	<ul>
                    	<li>Marcos</li>
                        <li>Alex</li>
                        <li>Atun</li>
                        <li>Anteojos</li>
                        <li>Lumbre</li>
                        <li>Perro</li>
                        <li>Costumbre</li>
                        <li>Villa</li>
                        <li>Lagos</li>
                        <li>Monos</li>
                    </ul>
                </div>
            </div>
          </div>
          </div>
        </div>
    </div>
	

</div><!-- fin del div del degradado-->
</body>

</html>