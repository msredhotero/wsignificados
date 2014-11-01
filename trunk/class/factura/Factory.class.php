<?php

    namespace factura{

        class Factory{


			public static function traerIdFactura($id=NULL){

               $id  = \Validator::int($id,'Debe seleccionar un id de Factura');

               $conexion    =   \Db\Singleton::getInstance();
               $sql         =   "select idfactura,nrofactura from dbfacturas where idfactura= $id";
               $resultado   =   $conexion->query($sql);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   throw(new Exception("El usuario no posee facturas con id $id"));

               }

               $resultado   =   $resultado->fetch_assoc();

               return self::getInstanceBySQLRow($resultado);

            }


            
            
            public static function traerClienteFacturas($id=NULL){

               $id  = \Validator::emptyString($id,'Debe seleccionar un Número de Factura');

               $conexion    =   \Db\Singleton::getInstance();
               $sql         =   "call TraerClienteFacturas('$id')";
               $resultado   =   $conexion->query($sql);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql".$conexion->error));

               }
               if(!$resultado->num_rows){

                   throw(new Exception("El usuario no posee facturas con id $id"));

               }

               //$resultado   =   $resultado->fetch_assoc();

               return $resultado;

            }
            
            
            public static function traerDetallesFactura($id=NULL){

               $id  = \Validator::emptyString($id,'Debe seleccionar un Número de Factura');

               $conexion2    =   \Db\Singleton::getInstance();
               $sql         =   "call TraerDetalleFactura('$id')";
               $resultado2   =   $conexion2->query($sql);


               if(!$resultado2){

                    throw(new Exception("fallo en query $sql".$conexion2->error));

               }
               if(!$resultado2->num_rows){

                   throw(new Exception("El usuario no posee facturas con id $id"));

               }

               //$resultado   =   $resultado->fetch_assoc();

               return $resultado2;

            }
            
            
            public static function traerFactura($id=NULL){

               $id  = \Validator::emptyString($id,'Debe seleccionar un Número de Factura');

               $conexion    =   \Db\Singleton::getInstance();
               $sql         =   "call TraerFactura('$id')";
               $resultado   =   $conexion->query($sql);

               if(!$resultado){

                    throw(new Exception("fallo en query $sql".$conexion->error));

               }
               if(!$resultado->num_rows){

                   throw(new Exception("El usuario no posee facturas con id $id"));

               }

               //$resultado   =   $resultado->fetch_assoc();

               //$resultado   =   $resultado->fetch_assoc();

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
                  //idusuario,usuario,password,tr.descripcion,email,nombrecompleto
                   $factura =   new \Factura();
                   $factura->setNroFactura($row["nrofactura"]);
                   $factura->setConcepto($row["concepto"]);               
                   $factura->setImporte($row["importe"]);
                   $factura->setCantidad($row["cantidad"]);
                   $factura->setDescripcion($row["descripcion"]);
				   $factura->setImporte($row["montototal"]);
				   $factura->setPalabraClave($row["palabraclave"]);
				   $factura->setUrl($row["url"]);
				   $factura->setFechaIngreso($row["fechaingreso"]);
				   $factura->setFechaBaja($row["fechabaja"]);
				   
                   return $usuario;

            }
            
            
        }
        
    }

?>