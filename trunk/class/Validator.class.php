<?php

    class Validator{
        
        
        /**
         * Valida que una cadena de texto (string) tenga un minimo de N
         * caracteres.
         * @param string $string La cadena a validar
         * @param int $minLength, longitud Minima que debe tener el string
         * @param string $mensaje, el mensaje que deberia ser arrojado en caso de cumplirse la condicion
         * @throws Exception En caso de que la logitud del string no coincida con el minimo
         */
        public static function minLength($string=NULL,$minLength=0,$mensaje=NULL){
            
            $string =   trim($string);
            
            if($minLength<=0){
                throw(new Exception("Longitud ingresada invalida $minLength"));
            }
            
            $longitud   =   strlen($string);
            
            if($longitud<$minLength){
                
                if(is_null($mensaje)){
                    $mensaje    =   "La longitud de la cadena debe ser de al menos $minLength caracteres";
                }

                throw(new Exception($mensaje));

            }
            
            return $string;

        }


        public static function comprobar_email($email){ 
            $mail_correcto = 0; 
            //compruebo unas cosas primeras 
            if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
                 if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
                     //miro si tiene caracter . 
                     if (substr_count($email,".")>= 1){ 
                         //obtengo la terminacion del dominio 
                         $term_dom = substr(strrchr ($email, '.'),1); 
                         //compruebo que la terminación del dominio sea correcta 
                         if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
                         //compruebo que lo de antes del dominio sea correcto 
                         $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
                         $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
                         if ($caracter_ult != "@" && $caracter_ult != "."){ 
                             $mail_correcto = 1; 
                         } 
                         } 
                     } 
                 } 
            } 
            if ($mail_correcto) 
                 return 1; 
            else 
                 return 0; 
        }

        public static function comprobarEmail($string=NULL,$mensaje=NULL){
            $string =   trim($string);

            if (self::comprobar_email($string) == 0) {
                if(empty($mensaje)){
                    $mensaje    =   "El E-Mail es incorrecto.";
                }

                throw(new Exception($mensaje));
            }

            return $string;
        }

        public static function fechaMenorHoy($string=NULL,$mensaje=NULL){
            $string =   trim($string);
            $hoy=date("Y-m-d");
            
            if ($string > $hoy) {
                if(empty($mensaje)){
                    $mensaje    =   "La Fecha de ingreso no puede ser mayor a la actual.";
                }

                throw(new Exception($mensaje));
            }

            return $string;
        }
        
        public static function validateArrayKeys(Array &$required,Array &$values){
            
            if(!sizeof($required)){
                
                throw(new Exception("El array de parametros requeridos debe tener algun valor",1));
                
            }
            
            if(!sizeof($values)){
                
                throw(new Exception("El array de valores debe tener algun valor",2));
                
            }
            
            foreach($required as $req){
                    
                if(!array_key_exists($req,$values)){

                    throw(new Exception("Es necesario el key \"$req\" en el Array de parametros"));

                }                    

            }

        }
                
        public static function int($number=NULL,$mensaje=NULL,$greater=0){
            
            $number =   (int)$number;

            if($number<=$greater){

                if(is_null($mensaje)){
                    $mensaje    =   "El numero debe ser mayor que $greater";
                }

                throw(new Exception($mensaje));

            }
            
            return $number;

        }
        
        public static function emptyString($string=NULL,$mensaje=NULL){

            $string =   trim($string);
            
            if(empty($string)){

                /*
                 LA EXCEPCION CORTA LA EJECUCION DEL METODO
                 Y EN CASO DE QUE ESTA EXCEPCION O CUALQUIER EXCEPCION
                 NO SEA ATRAPADA SE ARROJA UN ERROR FATAL 
                 EL CUAL CORTA LA EJECUCION COMPLETA DEL SCRIPT
                */

                if(empty($mensaje)){
                    $mensaje    =   "El string no puede ser vacio";
                }

                throw(new Exception($mensaje));

            }
            
            return $string;

        }
        
    }

?>