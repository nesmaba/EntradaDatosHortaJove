<?php

session_start();
//importando datos para
//conectarse
// require_once 'PasswordHash.Class.php';
require_once 'DatosConexion.php';
/**
* clase para hacer login
* a la seccionde administracion
*/
class Login{
    //campos que alamcenan los valores 
    private $idUser="";
    private $user="";
    private $name="";
    private $apellidos="";
    private $mail="";
    private $pass="";
    private $mensaje="";
       
    private static $datosConexion=null;
    private static $db=null;
       
    /**
     * [constructor recibe argumentos]
     * @param [type] $mail    [ingresar correo]
     * @param [type] $pass [Ingresar contraseña]
     */
    function __construct($mail,$pass){
        $this->mail_=$mail;
        $this->pass=$pass;
    }

    /**
     * [Metdo devuelve true o false para ingresar
     * a la sección de pagina restringida
     * ]
     */
    public function ingresar(){
        //determinamos cada uno de los
        //metodos devueltos
        if($this->validarUser()==false){
            $this->mensaje=$this->mensaje;	
            $this->mostrarMsg();
        }else{
            if($this->passwordUsr()==false){
                $this->mensaje=$this->mensaje;	
                $this->mostrarMsg();
            }else{
                //si el logueo es correcto hace la redireccion
                        if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                                $uri = 'https://';
                        }else{
                                $uri = 'http://';
                        }
                    $uri .= $_SERVER['HTTP_HOST'];

                    //Aqui modificar si el pag de aministracion esta 
                    //en un subdirectorio
                    // "<script type=\"text/javascript\">
                        // window.location=\"".$uri."/wp-admin/admin.php\";
                        // </script>";

                        echo    "<script type=\"text/javascript\">
                                   window.location=\"".$uri."/admin.php\";
                                  </script>";

                } 
        }
    }

    /**
     * Validamos la entrada de correo
     * electrónico
     * @param [String mail]
     */
    private function validarUser(){
         $retornar=false;
         $mailfilter =filter_var($this->mail,FILTER_VALIDATE_EMAIL); //filtramos el correo
         //Validamos el formato  de correo electronico utilizando expresiones regulares
         if(preg_match("/[a-zAZ0-9\_\-]+\@[a-zA-Z0-9]+\.[a-zA-Z0-9]/", $mailfilter )==true){
            //intanciando de las clases
            if(parent::$datosConexion==null){
                parent::$datosConexion=new DatosConexion();
            }
            if(parent::$db==null){
                parent::$db=new PDO('mysql:host='.parent::$datosConexion->host()
                        .';port=3306;dbname='.parent::$datosConexion->dbName(),
                        parent::$datosConexion->usuario(), parent::$datosConexion->password());
            }
            //Determinamos si la conexion a la bd es correcto.
            if(parent::$db==null){
                $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> Servidor de datos no econtrado, vuelva a intentar mas tarde. </div>';
            }else{
                //consulta SQL para vereficar si existe tal correo del
                //usario que introdujo 
                $query= parent::$db->prepare("SELECT usuarios.Email
                                FROM
                                usuarios
                                WHERE usuarios.Email=':mail';");

                $query->bindParam(':mail', $mailfilter);

                $respuesta = $query->execute();
                //Aquí determinamos con la instrucción if
                //la consulta generada, si mayor a cero
                //retornamos el valor verdadero
                //por el contrario mensaje de error
                if($respuesta){
                    //asignamos el mail sanitizado  al campo Mail_
                    $this->mail=$mailfilter;
                    $retornar=true;// se retorna un valor verdadero	
                }else {
                    $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> EL correo no existe, usted no podra ingresar. </div>';
                }
            }
         }else{
                //Se muestra al usuario el mensaje de error sobre
                //el formato de correo
         $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> El correo que ingresaste no tiene formato correcto. </div>';
         }
    return $retornar;
    }

    /**
     * Método para determinar
     * la existencia de la contraseña y verificación 
     * @param [type] $password [ingresar contraseña]
     */
    private function validarPasswordUser(){
            $retornar = false;
            
            //saneamos la entrada de los caracteres
            $contra   = filter_var($this->pass, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_ENCODE_AMP);
            if($contra==""){
                //si es que no existen ninguna
                //contraseña mostramos el mensaje de error
                $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> Escriba su contraseña. </div>';	
            }else{
                    //Realizamos la consulta sql a la bd
                    //y verificamos la contraseña
                // $contrasenya = password_hash($contra, PASSWORD_DEFAULT);
            
               if(parent::$datosConexion==null){
                    parent::$datosConexion=new DatosConexion();
                }
                if(parent::$db==null){
                    parent::$db=new PDO('mysql:host='.parent::$datosConexion->host()
                           .';port=3306;dbname='.parent::$datosConexion->dbName(),
                           parent::$datosConexion->usuario(), parent::$datosConexion->password());
                }

                if(parent::$db==null){
                    $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> Servidor de datos no econtrado, vuelva a intentar mas tarde. </div>';
                }else{
                    //consulta SQL para vereficar si existe tal correo del
                    //usario que introdujo 
                    $query= parent::$db->prepare("SELECT
                                            usuarios.Email,
                                            usuarios.Pass,
                                            usuarios.Nombre,
                                            usuarios.idUser
                                            FROM
                                            usuarios
                                            WHERE usuarios.Email=':email';");

                    $query->bindParam(':email', $this->mail);
                    $query->setFetchNode(PDO::FETCH_ASSOC);

                    $respuesta = $query->execute();
                    //Aquí determinamos con la instrucción if
                    //la consulta generada, si mayor a cero
                    //retornamos el valor verdadero
                    //por el contrario mensaje de error
                    if($respuesta){

                         $row = $query->fetch();
                         //Recuperacion el Hash de la BD
                         $passBD = $row['Pass'];

                              //Realizamos el comparación del paswrod con la instrucción if
                              // if(password_verify($contra, $Hashing)){ DE MOMENTO LO HACEMOS SIN HASH PORQUE NO REGISTRAMOS
                              if($contra==$passBD){
                                  //Recuperamos el Id del usuario
                                  $this->idUser=$row['idUser'];
                                  //Recuperamos el nombre de usuario para imprimir
                                  $this->username = $row['User'];
                                  $this->nombre = $row['Nombre'];
                                  $this->apellidos = $row['Apellidos'];
                                  
                                  registrarAcceso();
                                 
                                  $retornar           = true;
                               }else {
                                  $this->Mensaje ='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> Contraseña incorrecto escriba nuevamente. </div>';
                                  $retornar      =false; //El paswor ingresado no es correcto
                               }
                    }else {
                        $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> EL correo no existe, usted no podra ingresar. </div>';
                    }
                    
                }
            }
     return $retornar; //Retornamos el valor true o false
    }
    
    private function registrarAcceso(){
        // Registramos el acceso a la página en nuestra BD.
        $fecha = time("d/m/Y");
        $hora = time("H:m:s");
        if(parent::$datosConexion==null){
                    parent::$datosConexion=new DatosConexion();
                }
                if(parent::$db==null){
                    parent::$db=new PDO('mysql:host='.parent::$datosConexion->host()
                           .';port=3306;dbname='.parent::$datosConexion->dbName(),
                           parent::$datosConexion->usuario(), parent::$datosConexion->password());
                }

                if(parent::$db==null){
                    $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> Servidor de datos no econtrado, vuelva a intentar mas tarde. </div>';
                }else{
                    $query= parent::$db->prepare("INSERT INTO
                                            usuarios (IdUser, Fecha, Hora)
                                            VALUES (:idUser, :fecha, :hora);");

                    $query->bindParam(':idUser', $this->idUser);
                    $query->bindParam(':fecha', $fecha);
                    $query->bindParam(':hora', $hora);

                    $respuesta = $query->execute();
                    //Aquí determinamos con la instrucción if
                    //la consulta generada, si mayor a cero
                    //retornamos el valor verdadero
                    //por el contrario mensaje de error
                    if($respuesta){
                        echo "Acceso registrado correctamente.";
                    }else{
                        $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> EL correo no existe, usted no podra ingresar. </div>';
                    }
                }
        
    }
    
    /**
     * Retorna el IP de usuario
     * @return [string] [devuel la io del usuario]
     */
    private function IPuser() {
            $returnar ="";
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
         $returnar=$_SERVER['HTTP_X_FORWARDED_FOR'];}
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
         $returnar=$_SERVER['HTTP_CLIENT_IP'];}
    if(!empty($_SERVER['REMOTE_ADDR'])){
             $returnar=$_SERVER['REMOTE_ADDR'];}
    return $returnar;
    }
    /**
     * Devuelve el mensaje generado
     * para mostrar al usuario
     */
    public function mostrarMsg(){
            return $this->mensaje;
    }
}
 ?>
