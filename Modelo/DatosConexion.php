<?php

/**
 * Clase para realizar conexión
 * a la BD, solo cambiar datos de los
 * campos.
 */
class DatosConexion {
	private $host;
	private $usuario;
	private $password;
	private $dbName;
	/**
	 * Devuelve el nombre de host
	 * @return [type] [string]
	 */
         
        function __construct(){
            $this->host="localhost";
            $this->usuario="root";
            $this->password="";
            $this->dbName="Horta_Jove";   
        }
        
	public function host(){
		return $this->host;
	}
        
	/**
	 * Devuelve el nombre de usuario
	 * @return [type] [string]
	 */
	public function usuario(){
		return $this->usuario;
	}
        
	/**
	 * Devuelve la contraseña de acceso
	 * @return [type] [string]
	 */
	public function password(){
		return $this->password;
	}
        
	/**
	 * Devuelve nombre de la base de datos
	 * @return [type] [string]
	 */
	public function dbName(){
		return $this->dbName;
	}
}
