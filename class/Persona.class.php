<?php

    /*
     * Las nombres de las clases deben estar en el formato 
     * UpperCamelCase o bien PascalCase
     * 
     */
    class Persona{

        protected  $url               =   NULL;
        protected  $nombrecompleto    =   NULL;
        protected  $email             =   NULL;
        
        
        public function setNombreCompleto($nombrecompleto=NULL){
                       
            $mensaje        =   "El NombreCompleto no puede ser vacio";
            $this->nombrecompleto   =   Validator::emptyString($nombrecompleto,$mensaje);

        }
        
        public function setUrl($url=NULL){

            $mensaje        =   "La url no puede ser vacio";
            $this->url =   Validator::emptyString($url,$mensaje);

        }
        
        public function setEmail($email=NULL){
            
            $mensaje    =   "El E-Mail no puede ser vacio";
            $email        =   Validator::emptyString($email,$mensaje);

            $mensaje    =   "El E-Mail es incorrecto";
            $email        =   Validator::comprobarEmail($email,$mensaje);
            
            $this->email  =   $email;

        }

        
        
        public function getEmail(){

            return $this->email;

        }

        public function getUrl(){

            return $this->url;

        }

        public function getNombreCompleto(){

            return $this->nombrecompleto;

        }
        
        public function alta(){

            $conexion   = \Db\Singleton::getInstance();

            $campos     =   Array(
                                    "nombre"    =>  $this->nombre,
                                    "apellido"  =>  $this->apellido,
                                    "dni"       =>  $this->dni,
                                    "edad"      =>  $this->edad,
                                    "sexo"      =>  $this->sexo
            );
            
            foreach($campos as $key=>&$campo){

                $campo  =   "$key='".$conexion->real_escape_string($campo)."'";

            }

            $sql =   "INSERT INTO clientes SET ".implode(',',$campos);
            
            if(!$conexion->query($sql)){

                throw(new Exception("fallo en query"));

            }
            
            return $conexion->affected_rows;

        }

    }


?>