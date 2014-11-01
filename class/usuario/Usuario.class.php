<?php

    class Usuario extends Persona{
        
        private $idusuario	  =	  NULL;
        private $usuario      =   NULL;
        private $password     =   NULL;
        private $refroll      =   NULL;
        private $descripcion  =   NULL;


		public function setIdUsuario($idusuario=NULL){
            
            $this->idusuario  =   $idusuario;

        }

        public function getIdUsuario(){

            return $this->idusuario;

        }


        public function setUsuario($usuario=NULL){
            
            $mensaje    =   "El Usuario no puede ser vacio";
            $usuario        =   Validator::emptyString($usuario,$mensaje);
            
            $this->usuario  =   $usuario;

        }

        
        public function getUsuario(){

            return $this->usuario;

        }


        public function setPassword($password=NULL){
            
            $mensaje    =   "El Password no puede ser vacio";
            $password        =   Validator::emptyString($password,$mensaje);
            
            $this->password  =   $password;

        }

        
        public function getPassword(){

            return $this->password;

        }

        public function setRefRoll($refroll=NULL){
            
            $this->refroll  =   $refroll;

        }

        public function getRefRoll(){

            return $this->refroll;

        }


        public function getDescripcion(){

            return $this->descripcion;

        }

        public function setDescripcion($descripcion=NULL){
            
            $this->descripcion  =   $descripcion;

        }

        
        public function existe(){

           $this->setUsuario($this->usuario);
 
           $conexion = \Db\Singleton::getInstance();

/*
           $campos = Array(
               "url" => $this->url
           );

           foreach ($campos as $key => &$campo) {

               $campo = "$key='" . $conexion->real_escape_string($campo) . "'";
           }
*/
           $sql        =   "SELECT idusuario FROM dbusuarios WHERE usuario= '".$conexion->real_escape_string($this->usuario) . "'";         
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

                $msg    =   "Ya existe un usuario con ese nombre ".
                            $this->url;

                throw(new Exception($msg));

            }
            
           $conexion = \Db\Singleton::getInstance();


           $campos = Array(
               "usuario"            => $this->usuario,
               "password"           => $this->password,
               "refroll"            => $this->refroll,
               "nombrecompleto"     => $this->nombrecompleto,
               "email"              => $this->email
           );

           foreach ($campos as $key => &$campo) {

               $campo = "$key='" . $conexion->real_escape_string($campo) . "'";
           }

           $sql = "INSERT INTO dbusuarios SET " . implode(',', $campos);

           if (!$conexion->query($sql)) {

               throw(new Exception("fallo en query $sql\n".$conexion->error));

           }

           return $conexion->affected_rows;

       }

       public function login() {
            $conexion = \Db\Singleton::getInstance();

            $campos = Array(
               "email"            	=> $this->email,
               "password"           => $this->password
           );

            $sqlusu      = "select * from dbusuarios where email = '".$this->email."'";
            $resultado   =   $conexion->query($sqlusu);

               if(!$resultado){

                    throw(new Exception("fallo en query $sqlusu\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   throw(new Exception("No existe un usuario con ese email $this->usuario"));

               } else {
               		$row = $resultado->fetch_array(MYSQLI_NUM);
                    $sqlpass     = "select * from dbusuarios where password = '".$this->password."' and idusuario = ".$row[0];
                    $resultado   =   $conexion->query($sqlpass);

                    if(!$resultado){

                    throw(new Exception("fallo en query $sqlpass\n".$conexion->error));

                    }

                    if(!$resultado->num_rows){
                        throw(new Exception("No existe un usuario con ese password"));
                    }

               }

               $resultadoF   =   $resultado->fetch_array(MYSQLI_NUM);
               session_start();
			   $_SESSION['rol'] = $row[3];
			   $_SESSION['id'] = $row[0];
               $_SESSION['adclie_usuario'] = $resultadoF[1];
               $_SESSION['adclie_pass'] = $this->password;
			   
			   $sqlCarpeta = "select carpeta from dbclientes c 
			   					inner join dbusuariosclientes uc on uc.refcliente = c.idcliente
								inner join dbarchivosclientes ac on ac.refcliente = c.idcliente
								inner join dbusuarios u on u.idusuario = uc.refusuario
								where u.idusuario =".$row[0];
				$resCarpeta = $conexion->query($sqlCarpeta);
				$rowCarpeta = $resCarpeta->fetch_array(MYSQLI_NUM);
				$_SESSION['carpeta'] = $rowCarpeta[0];

               return "Usuario correcto";
       }
	   
	   
	   public function recuperarPass() {
            $conexion = \Db\Singleton::getInstance();

            $campos = Array(
               "email"            	=> $this->email
           );

            $sqlusu      = "select * from dbusuarios where email = '".$this->email."'";
            $resultado   =   $conexion->query($sqlusu);
			$row = $resultado->fetch_array(MYSQLI_NUM);
               if(!$resultado){

                    throw(new Exception("fallo en query $sqlusu\n".$conexion->error));

               }

               if(!$resultado->num_rows){

                   throw(new Exception("No existe un usuario con ese email $this->usuario"));

               } else {
               		
                    $sqlpass     = "select * from dbusuarios where idusuario = ".$row[0];
                    mail('notificaciones_seo@hotmail.com', 'Recuperar password', 'El usuario: '.$row[1].", requiere recuperar la password. E-Mail: ".$row[4]);
					mail('msredhotero@msn.com', 'Recuperar password', 'El usuario: '.$row[1].", requiere recuperar la password. E-Mail: ".$row[4]);
               }


               return "Mensaje enviado correctamente";
       }

    }

?>