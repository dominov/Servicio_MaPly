<?php

/**
 * Description of DaoGeneral
 *
 * @author Cristian
 */
include_once 'Conexion.php';
class DaoGeneral {

    function Conectarse() {
        $bd = Conexion::getInstance();
        
        return $bd->getLink();
    }

    function cerrarConexion() {
        $bd = Conexion::getInstance();
        mysql_close($bd->getLink()); //cierra la conexion
    }

}

?>
