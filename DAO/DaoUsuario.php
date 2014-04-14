<?php

include_once 'Dao.php';
include_once 'DaoGeneral.php';

/**
 * Description of DaoUsuario
 *
 * @author Cristian
 */
class DaoUsuario extends DaoGeneral implements Dao {

    function __construct() {
        
    }

    function select($condicion) {
        
       
        $this->Conectarse();
        $link = $this->Conectarse();
        $respuesta = mysql_query($condicion, $link);
        $this->cerrarConexion($link);
        return $respuesta;
    }

    function buscar($nombre, $password) {
        
        $sql = " SELECT * FROM paciente WHERE usuario = '".$nombre."' AND `password` = '".$password."'";
        $link = $this->Conectarse();
        $respuesta = mysql_query($sql, $link);
        $this->cerrarConexion($link);
        return $respuesta;
        //Creamos el Objeto Json
    }
    
        function listar($codigo,$fecha) {

        $sql = "SELECT * FROM usuario WHERE codigoUsuario = 1 ";
        $link = $this->Conectarse();
        $respuesta = mysql_query($sql, $link);
        $this->cerrarConexion($link);
        return $respuesta;
    }

}

?>
