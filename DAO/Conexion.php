<?php


/**
 * Description of Db
 *
 * @author Cristian

  Clase encargada de gestionar las conexiones a la base de datos */
class Conexion {

    private $host;
    private $usuario;
    private $password;
    private $baseDatos;
    private $link;

    private static $_instance;
    
    /* La función construct es privada para evitar que el objeto pueda ser creado mediante new */

    private function __construct() {

        /* establecemos los parámetros de la conexión */
        $this->host = "localhost";
        $this->usuario = "root";
        $this->password = "";
        $this->baseDatos = "sig";

        $this->conectar();
    }

    /* Evitamos el clonaje del objeto. Patrón Singleton */

    private function __clone() {
        
    }

    /* Función encargada de crear, si es necesario, el objeto y devolverlo */

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /* Realiza la conexión a la base de datos. */

    private function conectar() {

        if (!($this->link = mysql_connect($this->host, $this->usuario, $this->password))) {
            echo "Error conectando a la base de datos.";
            exit();
        }
        if (!mysql_select_db($this->baseDatos, $this->link)) {
            echo "Error seleccionando la base de datos.";
            exit();
        }
    }

// devolvemos el link de la instance
    public function getLink() {
        return $this->link;
    }
}

?>
