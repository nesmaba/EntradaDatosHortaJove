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
       
    static $datosConexion;
    static $db=null;
       
    /**
     * [constructor recibe argumentos]
     * @param [type] $mail    [ingresar correo]
     * @param [type] $pass [Ingresar contraseña]
     */
    function __construct($user,$pass){
        self::$datosConexion= new DatosConexion();
        // self::$logueado=false;
        $this->user=$user;
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
            //$this->mostrarMsg();
        }else{
            if($this->validarPasswordUser()==false){
                $this->mensaje=$this->mensaje;	
                //$this->mostrarMsg();
            }else{
            //si el logueo es correcto hace la redireccion
                if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
                        $uri = 'https://';
                }else{
                        $uri = 'http://';
                }
                if($_SESSION['logueado']){
                 $uri .= $_SERVER['HTTP_HOST'];
                echo    "<script type=\"text/javascript\">
                               window.location=\"".$uri."/EntradaDatosHortaJove/insertar_datos.php\";
                              </script>";
   
                }
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
         /* LO SIGUIENTE SERÍA SI INTRODUJÉRAMOS UN EMAIL, PERO VAMOS A HACER CON NOMBRE DE USUARIO
         $mailfilter =filter_var($this->mail,FILTER_VALIDATE_EMAIL); //filtramos el correo
         //Validamos el formato  de correo electronico utilizando expresiones regulares
         if(preg_match("/[a-zAZ0-9\_\-]+\@[a-zA-Z0-9]+\.[a-zA-Z0-9]/", $mailfilter )==true){
            //intanciando de las clases
            if(self::$datosConexion==null){
                self::$datosConexion=new DatosConexion();
            }
          * 
          */
         
         //var_dump(self::$datosConexion);
            if(self::$db==null){
                $dsn= "mysql:host=".self::$datosConexion->host().";port=3306;dbname=".self::$datosConexion->dbName();
                
                self::$db=new PDO($dsn,
                        self::$datosConexion->usuario(), 
                        self::$datosConexion->password());
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            //var_dump(self::$datosConexion->host());
            //Determinamos si la conexion a la bd es correcto.
            if(self::$db==null){
                $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> Servidor de datos no econtrado, vuelva a intentar mas tarde. </div>';
            }else{
                //consulta SQL para vereficar si existe tal correo del
                //usario que introdujo 
                $query= self::$db->prepare("SELECT usuarios.Email
                                FROM
                                usuarios
                                WHERE usuarios.User=':user';");
                $stm=
                $query->bindParam(':user', $this->user);

                $respuesta = $query->execute();
                
                //Aquí determinamos con la instrucción if
                //la consulta generada, si mayor a cero
                //retornamos el valor verdadero
                //por el contrario mensaje de error
                                
                if($respuesta){
                    //asignamos el mail sanitizado  al campo Mail_
                    //$this->mail=$mailfilter;
                    // Parse returned data, and displays them
                    
                    $retornar=true;// se retorna un valor verdadero
                    $query->closeCursor();
                    self::$db=null;

                }else {
                    $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> EL correo no existe, usted no podra ingresar. </div>';
                }
         }
         /* ESTO SERÍA SI SE LOGUEARAN CON EL CORREO
         else{
                //Se muestra al usuario el mensaje de error sobre
                //el formato de correo
         $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> El correo que ingresaste no tiene formato correcto. </div>';
         }
          * 
          */
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
            
               if(self::$datosConexion==null){
                    self::$datosConexion=new DatosConexion();
                }
                if(self::$db==null){
                    self::$db=new PDO('mysql:host='.self::$datosConexion->host()
                           .';port=3306;dbname='.self::$datosConexion->dbName(),
                           self::$datosConexion->usuario(), self::$datosConexion->password());
                    self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }

                if(self::$db==null){
                    $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> Servidor de datos no econtrado, vuelva a intentar mas tarde. </div>';
                }else{
                    //consulta SQL para vereficar si existe tal correo del
                    //usario que introdujo 
                    $query= self::$db->prepare("SELECT idUser, Pass, Nombre, Apellidos, Email
                                                FROM usuarios
                                                WHERE User=? ;");

                    $query->bindParam(1,$this->user);
                    
                    
                    //$query->setFetchMode(PDO::FETCH_ASSOC);
                    $respuesta = $query->execute();
                    //Aquí determinamos con la instrucción if
                    //la consulta generada, si mayor a cero
                    //retornamos el valor verdadero
                    //por el contrario mensaje de error
                    
                    if($respuesta){
                         echo $query->rowCount();
                         $row = $query->fetch(PDO::FETCH_ASSOC);
                         
                         //Recuperacion el Hash de la BD
                         $passBD = $row['Pass'];
                         var_dump($row);
                          //Realizamos el comparación del paswrod con la instrucción if
                          // if(password_verify($contra, $Hashing)){ DE MOMENTO LO HACEMOS SIN HASH PORQUE NO REGISTRAMOS
                        
                        if(strcmp($contra,$passBD)==0){ // Son iguales
                             //Recuperamos el Id del usuario
                             $this->idUser=$row['idUser'];
                             //Recuperamos el nombre de usuario para imprimir
                             $this->username = $this->user;
                             $this->nombre = $row['Nombre'];
                             $this->apellidos = $row['Apellidos'];

                             $this->registrarAcceso();

                             $retornar = true;
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
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        if(self::$datosConexion==null){
                    self::$datosConexion=new DatosConexion();
                }
                if(self::$db==null){
                    self::$db=new PDO('mysql:host='.self::$datosConexion->host()
                           .';port=3306;dbname='.self::$datosConexion->dbName(),
                           self::$datosConexion->usuario(), self::$datosConexion->password());
                }

                if(self::$db==null){
                    $this->mensaje='<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error!</strong> Servidor de datos no econtrado, vuelva a intentar mas tarde. </div>';
                }else{
                    $query= self::$db->prepare("INSERT INTO
                                            accesos (IdUser, Fecha, Hora)
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
                        $_SESSION['logueado']=true;
                        //header("insertar_datos.php");
                    }else{
                        echo "ERROR registroAcceso()";
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
