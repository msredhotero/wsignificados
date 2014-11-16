<?php


require 'includes/funcionesUsuarios.php';

$serviciosUsuarios = new ServiciosUsuarios();

require 'includes/funcionesUsuarios.php';
require 'includes/funcionesSignificados.php';

$serviciosUsuarios = new ServiciosUsuarios();
$serviciosSignificados = new ServiciosSignificados();

$resCategoriaMenu = $serviciosSignificados->traerCategoria();

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
        <script type="text/javascript">
		
			$(document).ready(function(){
				
				
					$("#email").click(function(event) {
        			$("#email").removeClass("alert alert-danger");
					$("#email").attr('placeholder','Ingrese el email');
					$("#error").removeClass("alert alert-danger");
					$("#error").text('');
        			});

        			$("#email").change(function(event) {
        			$("#email").removeClass("alert alert-danger");
        			$("#email").attr('placeholder','Ingrese el email');
        			});
					
					
					$("#pass").click(function(event) {
        			$("#pass").removeClass("alert alert-danger");
					$("#pass").attr('placeholder','Ingrese el password');
        			});

        			$("#pass").change(function(event) {
        			$("#pass").removeClass("alert alert-danger");
        			$("#pass").attr('placeholder','Ingrese el password');
        			});
					
				
				function validador(){

        				$error = "";
		
        				if ($("#email").val() == "") {
        					$error = "Es obligatorio el campo E-Mail.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").attr('placeholder',$error);
        				}
						
						if ($("#pass").val() == "") {
        					$error = "Es obligatorio el campo Password.";

        					$("#pass").addClass("alert alert-danger");
        					$("#pass").attr('placeholder',$error);
        				}
						

						
						
						var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
						
						if( !emailReg.test( $("#email").val() ) ) {
							$error = "El E-Mail ingresado es inválido.";

        					$("#error").addClass("alert alert-danger");
        					$("#error").text($error);
						  }

        				return $error;
        		}
				
				
				$("#login").click(function(event) {
        			
						if (validador() == "")
        				{
        						$.ajax({
                                data:  {email:		$("#email").val(),
										pass:		$("#pass").val(),
										accion:		'login'},
                                url:   'ajax/ajax.php',
                                type:  'post',
                                beforeSend: function () {
                                        $("#load").html('<img src="imagenes/load13.gif" width="50" height="50" />');
                                },
                                success:  function (response) {
      									
                                        if (response != '') {
                                            
                                            $("#error").removeClass("alert alert-danger");

                                            $("#error").addClass("alert alert-danger");
                                            $("#error").html('<strong>Error!</strong> '+response);
                                            $("#load").html('');

                                        } else {
											url = "cargarsignificado.php";
											$(location).attr('href',url);
										}
                                        
                                }
                        });
        				}
        		});
				
			});/* fin del document ready */
		
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
                Login:
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
          	
               <div class="logueo" align="center">
                <br>
                <br>
                <br>
                    <section style="width:700px; padding-top:10px; padding-top:60px; background-color:#333; border:1px solid #101010; padding:25px;box-shadow: 4px 4px 5px #464646;-webkit-box-shadow: 4px 4px 5px #464646;
                  -moz-box-shadow: 4px 4px 5px #464646;">
                
                            <div id="error" style="text-align:left;">
                            
                            </div>
                
                            <div align="center">
                            	<h3 style="color:#FFF; margin-top:-10px;">Debe loguearse!!</h3>
                                <div align="center"><p style="color:#E9E9E9; font-size:28px;">Acceso al panel de control de La Caldera del Diablo</p></div>
                                <br>
                            </div>
                            <form role="form" class="form-horizontal">
                              	
                             <!--
                                <label for="usuario" class="col-md-2 control-label" style="color:#FFF">Usuario</label>
                                <br>
                                  <input type="text" name="usuario" maxlength="50" />
                                <br>
                              
                
                              
                                <label for="ejemplo_password_2" class="col-md-2 control-label" style="color:#FFF">Contraseña</label>
                                <br>
                                  
                                  <input type="password" name="password" maxlength="50" />
                                <br>
                              
                             
                              
                                
                                  <input type="submit" value="enviar">
                                -->
                              <div class="form-group">
                                <label for="usuario" class="col-md-2 control-label" style="color:#FFF;text-align:left;">E-Mail</label>
                                <div class="col-lg-10">
                                  <input type="email" class="form-control" id="email" name="email" 
                                         placeholder="E-Mail" style="width:400px;">
                                </div>
                              </div>
                
                              <div class="form-group">
                                <label for="ejemplo_password_2" class="col-md-2 control-label" style="color:#FFF">Contraseña</label>
                                <div class="col-lg-10">
                                  <input type="password" class="form-control" id="pass" name="pass" 
                                         placeholder="password" style="width:400px;">
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label for="olvido" class="control-label" style="color:#FFF">¿Has olvidado tu contraseña?. <a href="recuperarpassword.php">Recuperar.</a></label>
                              </div>
                             
                              <div class="form-group">
                                <label for="olvido" class="control-label" style="color:#FFF">Si todavia no estas registrado. <a href="registrarte.php">Registrate.</a></label>
                              </div>
                             
                             
                              <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                  <button type="button" class="btn btn-default" id="login">Login</button>
                                </div>
                              </div>
                                
                                <div id="load">
                                
                                </div>
                
                            </form>
                
                     </section>
                </div>
          </div>
          </div>
        </div>
    </div><!--fin del content-->
    
<footer>
<div align="center">
	<h4 style="color:#FFF;">© 2014 Significados.mx - Todos los derechos reservados</h4>

</div>



</footer>

</div><!-- fin del div del degradado-->
</body>

</html>