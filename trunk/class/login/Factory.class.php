<?php

    namespace login{

        class Factory{

            public static function getLogin($nombre=NULL,$password=NULL){

               $id  = \Validator::int($id);

               $conexion    =   \Db\Singleton::getInstance();
               $sqlusu      = "select * from dbusuarios where usuario = '".$nombre."'";
               $resultado   =   $conexion->query($sqlusu);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   throw(new Exception("No existe un cliente con nombre $nombre"));

               } else {
                    $sqlpass     = "select * from dbusuarios where password = '".$password."' and idusuario = ".$resultado->result(0,0);
                    
					$resultado   =   $conexion->query($sqlpass);

                    if(!$resultado){

                    throw(new Exception("fallo en query $sql\n".$conexion->error));

                    }

                    if(!$resultado->num_rows){
                        throw(new Exception("No existe un cliente con password $password"));
                    }

               }

               $resultado   =   $resultado->fetch_assoc();
               $_SESSION['adclie_usuario'] = $nombre;
               $_SESSION['adclie_pass'] = $password;
			   

               return self::getInstanceBySQLRow($resultado);

            }

            

            public static function getInstanceBySQLRow(Array $row){

                   $cliente =   new \Cliente();
                   $cliente->setNombre($row["nombre"]);
                   $cliente->setEdad($row["password"]);               
                   $cliente->setApellido($row["usuario"]);
                   $cliente->setTipoDocumento($row["tipo_doc"]);
                   $cliente->setNumeroDocumento($row["documento"]);
                   $cliente->setSexo($row["sexo"]);

                   return $cliente;

            }
            
        }
        
    }

?>