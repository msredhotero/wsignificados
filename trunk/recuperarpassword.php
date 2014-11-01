<?php
set_include_path("class");

require "db/Singleton.class.php";
require "Validator.class.php";
require "Persona.class.php";

require "cliente/Cliente.class.php";
require "cliente/Factory.class.php";

require "usuario/Usuario.class.php";
require "usuario/Factory.class.php";

require "login/Factory.class.php";

$exito = "";
$errors    =   Array();

try{

/*        
        $parametrosConexion =   Array(
                                        "host"=>"localhost",
                                        "user"=>"root",
                                        "pass"=>"",
                                        "db"=>"dbadministracionclientes"
        );*/
        
       
        $parametrosConexion =   Array(
                                        "host"=>"db494455387.db.1and1.com",
                                        "user"=>"dbo494455387",
                                        "pass"=>"Admin1234",
                                        "db"=>"db494455387"
        );

        /**
         * El patron singleton sirve para mantener una unica instancia de un objeto
         * alrededor de toda la ejecucion de un script.
         */

        $conexion   =   \Db\Singleton::getInstance($parametrosConexion);

        $usuario    =   new Usuario();
       
        if(sizeof($_POST)){
            $requiredKeys   =   Array(
                                        "email"
            );

            Validator::validateArrayKeys($requiredKeys,$_POST);

            try{

                $usuario->setEmail($_POST["email"]);

            }catch(Exception $e){

                $errors[]   =   $e->getMessage();

            }
			

            if(!sizeof($errors)){

                try{

                    if($usuario->recuperarPass()){

                        //header("Location: /AdministracionClientes/");
						$exito = "El mensaje fue enviado correctamente, el administrador se comunicará con usted lo antes posible";
						//exit();
                    }

                }catch(Exception $e){

                    $errors[]   =   $e->getMessage();

                }

            }

        }

    }catch(Exception $e){

        //SI el codigo esta siendo ejecutado en el localhost
        echo $e;
		//echo "error";
        //require "404.php";
        echo die();
        
    }    


?>

<!DOCTYPE HTML>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv='refresh' content='1000' />

<meta name='title' content='Ver' />

<meta name='description' content='Sistema Administrador de Clientes' />

<meta name='keywords' content='Sistema Administrador de Clientes' />

<meta name='distribution' content='Global' />

<meta name='language' content='es' />

<meta name='identifier-url' content='http://www.administradordelientes.com.ar' />

<meta name='rating' content='General' />

<meta name='reply-to' content='' />

<meta name='author' content='Webmasters' />

<meta http-equiv='Pragma' content='no-cache/cache' />



<meta http-equiv='Cache-Control' content='no-cache' />

<meta name='robots' content='all' />

<meta name='revisit-after' content='7 day' />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Administrador de Clientes</title>



		<link rel="stylesheet" type="text/css" href="css/estilo.css"/>

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>

         <link rel="stylesheet" href="css/jquery-ui.css">

    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
</head>



<body>

<header>
	<img src="imagenes/LogoSEO1.png" width="396" height="89"> 
    
</header>
<div style="height:1px; background-color:#575a5f;"></div>
<div class="logueo">
	<section style="width:500px; padding-top:10px;">
  <?php if(sizeof($errors)){?>

            <div class="alert alert-danger">
                <?php foreach($errors as $error){ ?>
                <p><?php echo $error;?></p>
                <?php } ?>
            </div>
			
            <?php } ?>
            
            <?php if ($exito != "") { ?>
            <div class="alert alert-success">
            	<?php echo $exito; ?>
            </div>
            <?php } ?>
            
            <button type="button" class="btn btn-info"><a href="<? echo "/AdministracionClientes/"; ?>" style="color:#FFF; text-decoration:none;">Volver</a></button>
            
            <div align="center">
				<h3 style="color:#EDEDED; text-decoration:underline; padding:8px;">Acceso al panel de control de clientes</h3>
                <br>
            </div>
			<form role="form" class="form-horizontal" method="POST" action="recuperarpassword.php">
              
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
              	<label for="importante" style="color:#FFF;text-align:left;">Se le enviara un email al Administrador para que le genere una nueva contraseña.</label>
              </div>
              
                
              <div class="form-group">
                <label for="usuario" class="col-md-2 control-label" style="color:#FFF;text-align:left;">E-Mail</label>
                <div class="col-lg-10">
                  <input type="email" class="form-control" id="email" name="email" 
                         placeholder="E-Mail">
                </div>
              </div>

             
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                  <button type="submit" class="btn btn-default">Recuperar</button>
                </div>
              </div>


            </form>

     </section>
</div>

</body>

</html>