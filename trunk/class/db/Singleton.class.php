<?php

    namespace Db{

        class Singleton{

            private static $instance    =   NULL;

            private function __construct(){
            }

            /**
             * Obtiene una instancia de un objeto de conexion a la base de datos
             * @param array $parametros
             * @return \mysqli Mysqli Instance
             * @throws string
             */
            
            public static function getInstance(Array $parametros=Array()){

                if(self::$instance){

                    return self::$instance;

                }

                $parametrosRequeridos   =   Array(
                    "host",
                    "user",
                    "pass",
                    "db"
                );

                \Validator::validateArrayKeys($parametrosRequeridos,$parametros);
                
                if(!array_key_exists("port",$parametros)){

                    $parametros["port"] =   3306;

                }elseif(empty($parametros["port"])){

                    $parametros["port"] =   3306;

                }

                $mysqli =   new \MySQLi(
                                        \Validator::emptyString($parametros["host"]),
                                        \Validator::emptyString($parametros["user"]),
                                        $parametros["pass"],
                                        \Validator::emptyString($parametros["db"]),
                                        \Validator::int($parametros["port"])
                );

                if($mysqli->connect_error){
                    
                    $msg    =   "No se pudo conectar a la base de datos ".
                                $mysqli->connect_errno.':'.$mysqli->error;

                    throw(new Exception($msg));

                }
                
                $mysqli->set_charset("utf8");

                self::$instance =   $mysqli;
                
                return self::$instance;

            }
            
        }

    }

?>