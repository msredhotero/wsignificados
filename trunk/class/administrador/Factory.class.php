<?php

    namespace cliente{

        class Factory{

            public static function getInstanceById($id=NULL){

               $id  = \Validator::int($id);

               $conexion    =   \Db\Singleton::getInstance();
               $sql         =   "SELECT idcliente,url,fechaingreso,estado,tb.descripcion,email,acceso,fechabaja 
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
                   $cliente->setEmail($row["email"]);
                   $cliente->setAcceso($row["acceso"]);
                   $cliente->setFechaBaja($row["fechabaja"]);

                   return $cliente;

            }
            
        }
        
    }

?>