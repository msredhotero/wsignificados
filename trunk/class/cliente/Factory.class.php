<?php

    namespace cliente{

        class Factory{

            public static function getInstanceById($id=NULL){

               $id  = \Validator::int($id);

               $conexion    =   \Db\Singleton::getInstance();
               
               $sql         =   "SELECT idcliente,url,fechaingreso,estado,tb.descripcion,acceso,fechabaja 
                                 FROM dbclientes c
                                 inner
                                 join tbformaspago tb
                                 on   c.refformapago = tb.idformapago
                                 WHERE idcliente='$id'";
               $resultado   =   $conexion->query($sql);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   throw(new Exception("No existe un cliente con id $id"));

               }

               $resultado   =   $resultado->fetch_assoc();

               return self::getInstanceBySQLRow($resultado);

            }
			
			
			public static function getInstanceByIdUsuario($id=NULL){

               $id  = \Validator::int($id);

               $conexion    =   \Db\Singleton::getInstance();
               
               $sql         =   "SELECT idcliente,url,fechaingreso,estado,tb.descripcion,acceso,fechabaja 
                                 FROM dbclientes c
                                 inner
                                 join tbformaspago tb
                                 on   c.refformapago = tb.idformapago
								 inner
								 join dbusuariosclientes uc
								 on	  uc.refcliente = c.idcliente
								 inner
								 join dbusuarios u
								 on   u.idusuario = uc.refusuario
                                 WHERE u.idusuario=".$id;
               $resultado   =   $conexion->query($sql);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   throw(new Exception("No existe un cliente con id"));

               }

               $resultado   =   $resultado->fetch_assoc();

               return self::getInstanceBySQLRow($resultado);

            }

			public static function getInstance(){

               $conexion    =   \Db\Singleton::getInstance();
               
               $sql         =   "SELECT idcliente,url,fechaingreso,estado,tb.descripcion,acceso,fechabaja 
                                 FROM dbclientes c
                                 inner
                                 join tbformaspago tb
                                 on   c.refformapago = tb.idformapago
								 order by estado desc,fechabaja,url";
               $resultado   =   $conexion->query($sql);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   throw(new Exception("No existe un cliente con id $id"));

               }

               //$resultado   =   $resultado->fetch_array();

               return $resultado;

            }
            
            
            public static function getInstanceDistribuidor(){

               $conexion    =   \Db\Singleton::getInstance();
               
               $sql         =   "SELECT idcliente,url,fechaingreso,estado,tb.descripcion,acceso,fechabaja,u.usuario,u.idusuario 
                                 FROM dbclientes c
                                 inner
                                 join tbformaspago tb
                                 on   c.refformapago = tb.idformapago
								 inner
								 join dbusuariosclientes uc
								 on	  uc.refcliente = c.idcliente
								 inner
								 join dbusuarios u
								 on   u.idusuario = uc.refusuario and u.refroll = 3";
               $resultado   =   $conexion->query($sql);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   $error = "No existe un cliente con id";

               }

               //$resultado   =   $resultado->fetch_array();

               return $resultado;

            }
            
/*
            public static function getInstanceByTipoYNumeroDoc($numero=NULL,$tipo="DNI"){

               $numero  = \Validator::int($numero);

               $conexion    =   \Db\Singleton::getInstance();
               $tipo        =   $conexion->real_escape_string($tipo);

               $sql         =   "SELECT id,nombre,apellido,edad,documento,tipo_doc,sexo FROM clientes ".
                                "WHERE documento='$numero' AND tipo_doc='$tipo'";

               $resultado   =   $conexion->query($sql);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   throw(new Exception("No existe un cliente con id $id"));

               }

               $resultado   =   $resultado->fetch_assoc();

               return self::getInstanceBySQLRow($resultado);

            }
*/
            public static function getInstanceBySQLRow(Array $row){
                  //idcliente,url,fechaingreso,estado,tb.descripcion,email,acceso,fechabaja
                   $cliente =   new \Cliente();

                   $cliente->setUrl($row["url"]);
                   $cliente->setFechaIngreso($row["fechaingreso"]);               
                   $cliente->setEstado($row["estado"]);
                   $cliente->setDescripcion($row["descripcion"]);
                   $cliente->setAcceso($row["acceso"]);
                   $cliente->setFechaBaja($row["fechabaja"]);
                   $cliente->setIdCliente($row["idcliente"]);
                   return $cliente;

            }
            
        }
        
    }

?>