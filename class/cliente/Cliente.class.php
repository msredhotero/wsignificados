<?php

    class Cliente extends Persona{
        
        private $idcliente    =   NULL;
        private $estado       =   NULL;
        private $fechaingreso =   NULL;
        private $fechabaja    =   NULL;
        private $acceso       =   NULL;
        private $refformapago =   NULL;
        private $descripcion  =   NULL;


        public function getIdCliente(){

            return $this->idcliente;

        }


        public function setIdCliente($idcliente=NULL){
            
            $this->idcliente  =   $idcliente;

        }

        public function setFechaIngreso($fechaingreso=NULL){
            
            $mensaje    =   "La Fecha de Ingreso no puede ser vacio";
            $fechaingreso        =   Validator::emptyString($fechaingreso,$mensaje);
            
            $this->fechaingreso  =   $fechaingreso;

        }

        
        public function getEstado(){

            return $this->estado;

        }


        public function setEstado($estado=NULL){
            
            $this->estado  =   $estado;

        }
        
        public function getAcceso(){

            return $this->acceso;

        }


        public function setAcceso($acceso=NULL){
            
            $this->acceso  =   $acceso;

        }
        
        public function getFechaIngreso(){

            return $this->fechaingreso;

        }


        public function setRefFormaPago($refformapago=NULL){
            
            $this->refformapago  =   $refformapago;

        }

        public function getRefFormaPago(){

            return $this->refformapago;

        }

        public function setFechaBaja($fechabaja=NULL){
            
            $this->fechabaja  =   $fechabaja;

        }

        public function getFechaBaja(){

            return $this->fechabaja;

        }


        public function getDescripcion(){

            return $this->descripcion;

        }

        public function setDescripcion($descripcion=NULL){
            
            $this->descripcion  =   $descripcion;

        }


        public function existe(){

           $this->setUrl($this->url);
 
           $conexion = \Db\Singleton::getInstance();

/*
           $campos = Array(
               "url" => $this->url
           );

           foreach ($campos as $key => &$campo) {

               $campo = "$key='" . $conexion->real_escape_string($campo) . "'";
           }
*/
           $sql        =   "SELECT idcliente FROM dbclientes WHERE url= '".$conexion->real_escape_string($this->url) . "'";         
           $resultado  =   $conexion->query($sql);

           if(!$resultado){

                throw(new Exception("fallo en query $sql\n".$conexion->error));

           }
           
           if($resultado->num_rows>0){

               return TRUE;

           }

           return FALSE;

        }
        
        public function alta() {

            if($this->existe()){

                $msg    =   "Ya existe un cliente con esa url ".
                            $this->url;

                throw(new Exception($msg));

            }
            
           $conexion = \Db\Singleton::getInstance();

           $campos = Array(
               "url"            => $this->url,
               "fechaingreso"   => $this->fechaingreso,
               "estado"         => $this->estado,
               "refformapago"   => $this->refformapago,
               "acceso"         => $this->acceso,
               "fechabaja"      => $this->fechabaja
           );

           foreach ($campos as $key => &$campo) {

               $campo = "$key='" . $conexion->real_escape_string($campo) . "'";
           }

           $sql = "INSERT INTO dbclientes SET " . implode(',', $campos);

           if (!$conexion->query($sql)) {

               throw(new Exception("fallo en query $sql\n".$conexion->error));

           }

           return $conexion->affected_rows;

       }

    }

?>