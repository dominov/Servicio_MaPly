<?php

/**
 * Description of DaoProducto
 *
 * @author Cristian
 */
include_once 'DaoGeneral.php';
include_once 'Dao.php';

class Dao_Alimetos extends DaoGeneral implements Dao {

    function __construct() {
        
    }

    function listar($codigo,$fecha) {

        $sql = "SELECT * FROM `alimentos`";
        
        $link = $this->Conectarse();
        $respuesta = mysql_query($sql, $link);
        $this->cerrarConexion();
       
        return $respuesta;
    }

    function select($condicion) {

        $link = $this->Conectarse();
        $respuesta = mysql_query($condicion, $link);
        $this->cerrarConexion($link);
        return $respuesta;
    }
    
    function buscar($nombre,$password) {
        $sql = "SELECT * FROM `alimentos` WHERE `codAlimento` = '".$nombre."'";
       
        $link = $this->Conectarse();
        $respuesta = mysql_query($sql, $link);
        $this->cerrarConexion($link);
        return $respuesta;
        //Creamos el Objeto Json
    }
}

?>
