<?php

class Application{

    private static $instance;
    private $conn = false;
    private function __construct(){}
    
    public static function getInstance(){
        if (!self::$instance instanceof self) {
            self::$instance = new self;
	    }
            
        return self::$instance;
    }
    
    public function init(){
	    if (!$this->conn ) {

            $dbHost = "localhost";
            $dbName = "messages_db";
		    $dbUsername = "root"; 
		    $dbPassword = "";
            
		    $this->conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
		    if ( $this->conn->connect_errno ) {
		    	echo "Error de conexión a la BD: (" . $this->conn->connect_errno . ") " . utf8_encode($this->conn->connect_error);
		    	exit();
		    }
		    if ( ! $this->conn->set_charset("utf8mb4")) {
		    	echo "Error al configurar la codificación de la BD: (" . $this->conn->errno . ") " . utf8_encode($this->conn->error);
		    	exit();
		    }
	    }
		
		return $this->conn;
	}
}

?>