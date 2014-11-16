<?php

session_start();

if (!isset($_SESSION['usua_sign']))
{
	header('Location: login.php');
} else {
	
require 'includes/funcionesUsuarios.php';
require 'includes/funcionesSignificados.php';

$serviciosUsuarios = new ServiciosUsuarios();
$serviciosSignificados = new ServiciosSignificados();

$resCategoria = $serviciosSignificados->traerCategoria();
$resCategoriaAux = $serviciosSignificados->traerCategoria();
$resCategoriaMenu = $serviciosSignificados->traerCategoria();

$resPalabra = $serviciosSignificados->traerPalabra();
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
    <link rel="stylesheet" href="css/chosen.css">
    <style>
		.row {
			padding:10px;
		}
	</style>
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
            <h3 class="panel-title" style="color:#FFF;text-shadow: black 1px 1px 2px;">Cargar Significado</h3>
          </div>
          <div class="panel-body">

          		<form class="form-inline formulario" role="form">
                	<div class="row">
                    	<div class="form-group col-md-4">
                            <label for="refcliente" class="control-label" style="text-align:left">Palabra</label>
                            <div class="input-group col-md-12">
                                <select data-placeholder="selecione el palabra..." id="palabra" name="palabra" class="chosen-select" style="width:100%;" tabindex="2">
                                	
                                    <option value=""></option>
                                    <?php while ($row = mysql_fetch_array($resPalabra)) { ?>
                                    <option value="<?php echo $row['idpalabra']; ?>"><?php echo utf8_encode($row['palabra']); ?></option>   
                                    <?php } ?>  
                                    
                                </select>
                                
                            </div>
                            
                        </div>
          				<div class="form-group col-md-2" style="margin-top:15px;">
                                <button type="button" class="btn btn-success" id="crearpalabra" style="margin-left:0px;">Nuevo Palabra</button>
                        </div>
                        
                    	<div class="form-group col-md-6">
                            <label for="categoria" class="control-label" style="text-align:left">Categoria</label>
                            <div class="input-group col-md-12">
                                <select data-placeholder="selecione el categoria..." id="categoria" name="categoria" class="form-control" tabindex="2">
                                    <?php while ($row = mysql_fetch_array($resCategoria)) { ?>
                                    <option value="<?php echo $row['idcategoria']; ?>"><?php echo utf8_encode($row['categoria']); ?></option>   
                                    <?php } ?>   
                                </select>
                                
                            </div>
                        </div>
                        
                  </div>
                 <div class="row">       
                        <div class="form-group col-md-12">
                            <label for="utlizacion" class="control-label" style="text-align:left">Utilización</label>
                            <div class="input-group col-md-12">
                                <textarea type="text" class="form-control" id="utlizacion" name="utlizacion" rows="3">
                                
                                </textarea>
                            </div>
                        </div>
				</div>
                <div class="row">
                    	<div class="form-group col-md-12">
                            <label for="significado" class="control-label" style="text-align:left">Significado</label>
                            <div class="input-group col-md-12">
                                <textarea type="text" class="form-control" id="significado" name="significado" rows="10">
                                
                                </textarea>
                            </div>
                        </div>
                </div>
                <div class="row">
                    	<button type="button" class="btn btn-primary" id="cargar" style="margin-left:20px;">Cargar</button>
                    </div>
                </form>

          </div>
        </div>
    </div><!--fin del content-->
    
    
<div id="dialogCliente" title="Cargar Palabra">
    	<div class="row"> 
        <div class="col-sm-12 col-md-12">
    				<div class="form-group col-md-6">
                    	<label for="palabra2" class="control-label" style="text-align:left">Palabra</label>
                        <div class="input-group col-md-12">
                        	<input type="text" class="form-control" id="palabra2" name="palabra2" placeholder="Ingrese el Palabra..." required>
                        </div>
                    </div>
                    

                    
                    <div class="form-group col-md-6">
                        <label for="categoria2" class="control-label" style="text-align:left">Categoria</label>
                        <div class="input-group col-md-12">
                            <select data-placeholder="selecione el categoria..." id="categoria2" name="categoria2" class="form-control" tabindex="2">
                            	<?php while ($row = mysql_fetch_array($resCategoriaAux)) { ?>
                                <option value="<?php echo $row['idcategoria']; ?>"><?php echo utf8_encode($row['categoria']); ?></option>   
                                <?php } ?>
                            </select>
                            
                        </div>
                    </div>
					
					


                    </div>
                    </div>
               		
                    <div id="load">
                    
                    </div>
                    <div id="error" class="alert alert-info">
                		<p><strong>Importante!:</strong> El campo Palabra es obligatorios</p>
                    </div>
                    
</div>

<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
  
<script type="text/javascript">
$(document).ready(function(){  


  $('#crearpalabra').click(function(event){
            $("#dialogCliente").dialog("open");
  });//fin del boton crear

  $( "#dialogCliente" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:800,
				height:340,
				modal: true,
				buttons: {
				    "Cargar": function() {
                        if ($('#palabra2').val() != '') {
								$.ajax({
											data:  {refcategoria: $("#categoria2").chosen().val(),
													palabra: $('#palabra2').val(),
													accion: 'insertarPalabra'},
											url:   'ajax/ajax.php',
											type:  'post',
											beforeSend: function () {
													
											},
											success:  function (response) {
												if (response == '') {
													url = "cargarsignificado.php";
													$(location).attr('href',url);
												} else {
													alert(response);
												}
													
											}
									});
                                                        
                                                        $( this ).dialog( "close" );
                                                        $( this ).dialog( "close" );
                                                                $('html, body').animate({
                                                                scrollTop: '1000px'
                                                        },
                                                        1500);
                                                    } else {
                                                        alert("El campo Palabra es obligatorio.");
                                                        
                                                    }
						
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		}); //fin del dialogo para crear cliente
});//fin del document ready            
</script>            
            
<?php } ?>
</div><!-- fin del div del degradado-->
</body>

</html>