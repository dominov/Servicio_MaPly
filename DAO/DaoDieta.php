<?php

/**
 * Description of DaoProducto
 *
 * @author Cristian
 */
include_once 'DaoGeneral.php';
include_once 'Dao.php';

class DaoDieta extends DaoGeneral implements Dao {

    function __construct() {
        
    }

    function listar($codigo,  $fecha) {

        $sql = "SELECT * FROM `dieta` join alimentos ON dieta.codAlimento =alimentos.codAlimento WHERE `codPaciente` = ".$codigo." AND fecha = '".$fecha."'";
        
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
    
    function buscar($nombreProducto, $codigoUsuario) {
        
        $sql = " SELECT * FROM producto WHERE nombreProducto = '".$nombreProducto.
                "' AND codigoUsuario` = '".$codigoUsuario."'";
        $link = $this->Conectarse();
        $respuesta = mysql_query($sql, $link);
        $this->cerrarConexion($link);
        return $respuesta;
        //Creamos el Objeto Json
    }
}

?>
