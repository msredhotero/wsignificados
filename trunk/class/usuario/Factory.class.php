<?php

    namespace usuario{

        class Factory{

            public static function getInstanceById($id=NULL){

               $id  = \Validator::int($id);

               $conexion    =   \Db\Singleton::getInstance();
               $sql         =   "SELECT idusuario,usuario,password,tr.descripcion,email,nombrecompleto
                                 FROM dbusuarios u
                                 inner
                                 join tbroles tr
                                 on   u.refroll = tr.idrol
                                 WHERE idusuario=".$id;
               $resultado   =   $conexion->query($sql);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   throw(new Exception("No existe un usuario con id $id"));

               }

               $resultado   =   $resultado->fetch_assoc();

               return self::getInstanceBySQLRow($resultado);

            }
            
            
            
            public static function getInstance(){

               $conexion    =   \Db\Singleton::getInstance();
               $sql         =   "SELECT 
                                        u.idusuario,
                                        u.usuario,
                                        u.password,
                                        tr.descripcion,
                                        u.email,
                                        u.nombrecompleto,
                                    	c.url,
                                    	c.idcliente,
	                                    c.acceso
                                    FROM
                                        dbusuarios u
                                            inner join
                                        tbroles tr ON u.refroll = tr.idrol
                                    		left join
                                    	dbusuariosclientes uc on uc.refusuario = u.idusuario
                                    		left join
                                    	dbclientes c on c.idcliente = uc.refcliente";
               $resultado   =   $conexion->query($sql);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   throw(new Exception("No existen clientes"));

               }

               return $resultado;

            }

            
            public static function getInstanceBySQLRow(Array $row){
                  //idusuario,usuario,password,tr.descripcion,email,nombrecompleto
                   $usuario =   new \Usuario();
                   $usuario->setIdUsuario($row["idusuario"]);
                   $usuario->setUsuario($row["usuario"]);
                   $usuario->setPassword($row["password"]);               
                   $usuario->setEmail($row["email"]);
                   $usuario->setDescripcion($row["descripcion"]);
                   $usuario->setNombreCompleto($row["nombrecompleto"]);

                   return $usuario;

            }
            
        }
        
    }

?>