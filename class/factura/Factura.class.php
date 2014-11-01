<?php

    class Factura extends Persona{
        
        private $nrofactura		=   NULL;
        private $concepto		=   NULL;
        private $importe		=   NULL;
        private $cantidad       =   NULL;
        private $fechacreacion	=	NULL;
        private $cancelada		=	NULL;
        private $usuariocrea	=	NULL;
        private $reftipoiva		=	NULL;
        private $palabraclave	=	NULL;
        private $descripcion	=	NULL;
        private $refretenciones	=	NULL;
        
        public function setNroFactura($nrofactura=NULL){
            
            $mensaje			=   "El Nº de Factura no puede ser vacio";
            $nrofactura			=   Validator::emptyString($nrofactura,$mensaje);
            
            $this->nrofactura  =   $nrofactura;

        }

        
        public function getNroFactura(){

            return $this->nrofactura;

        }


		public function setConcepto($concepto=NULL){
            
            $mensaje			=   "El Concepto no puede ser vacio";
            $concepto			=   Validator::emptyString($concepto,$mensaje);
            
            $this->concepto		=   $concepto;

        }

        
        public function getConcepto(){

            return $this->concepto;

        }
        
        
        
        public function setImporte($importe=NULL){
            
            $mensaje			=   "El Importe no puede ser vacio";
            $importe			=   Validator::emptyString($importe,$mensaje);
            
            $mensaje			=   "Error al ingresar el importe";
            $importe			=   Validator::decimal($importe,$mensaje,1);
            
            $this->importe		=   $importe;

        }

        
        public function getImporte(){

            return $this->importe;

        }


		public function setCantidad($cantidad=NULL){
            
            $mensaje			=   "La cantidad no puede ser vacia";
            $cantidad			=   Validator::emptyString($cantidad,$mensaje);
            
            $mensaje			=   "La cantidad no puede ser menor a 1";
            $cantidad			=   Validator::int($cantidad,$mensaje,1);
            
            $this->cantidad		=   $cantidad;

        }

        
        public function getCantidad(){

            return $this->cantidad;

        }


		public function setFechaCreacion($fechacreacion=NULL){
            
            $this->fechacreacion  =   $fechacreacion;

        }

        public function getFechaCreacion(){

            return $this->fechacreacion;

        }


		public function setCancelada($cancelada=NULL){
            
            $this->fechacreacion  =   $cancelada;

        }

        public function getCancelada(){

            return $this->cancelada;

        }

		public function setUsuarioCrea($usuariocrea=NULL){
            
            $this->usuariocrea  =   $usuariocrea;

        }

        public function getUsuarioCrea(){

            return $this->usuariocrea;

        }
        
        
        public function setDescripcion($descripcion=NULL){
            
            $this->descripcion  =   $descripcion;

        }

        public function getDescripcion(){

            return $this->descripcion;

        }
        
        
        public function setRefTipoIva($reftipoiva=NULL){
            
            $mensaje				=   "La referencia no puede ser vacia";
            $reftipoiva				=   Validator::emptyString($reftipoiva,$mensaje);
            
            $this->reftipoiva  =   $reftipoiva;

        }

        public function getRefTipoIva(){

            return $this->reftipoiva;

        }
        
        
        public function setPalabraClave($palabraclave=NULL){
            
            $mensaje				=   "La Palabra Clave no puede ser vacia";
            $palabraclave			=   Validator::emptyString($palabraclave,$mensaje);
            
            $this->palabraclave  =   $palabraclave;

        }

        public function getPalabraClave(){

            return $this->palabraclave;

        }
        
        
        public function setRefRetenciones($refretenciones=NULL){
            
            $this->refretenciones  =   $refretenciones;

        }

        public function getRefRetenciones(){

            return $this->$refretenciones;

        }
        
        public function existe(){

           $this->setUrl($this->nrofactura);
 
           $conexion = \Db\Singleton::getInstance();

/*
           $campos = Array(
               "url" => $this->url
           );

           foreach ($campos as $key => &$campo) {

               $campo = "$key='" . $conexion->real_escape_string($campo) . "'";
           }
*/
           $sql        =   "SELECT idfactura FROM dbfacturas WHERE nrofactura= '".$conexion->real_escape_string($this->nrofactura) . "'";         
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
               "email"          => $this->email,
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