<?php

include_once '../DAO/DaoUsuario.php';

/* @var $tipo type */
$tipo = $_GET['tipo'];
$ser = new ServicioUsuario();
$ser->elegirServicio($tipo);

class ServicioUsuario {

    function __construct() {
        
    }

    function elegirServicio($tipo) {
        switch ($tipo) {
            case 1:
                $this->validar();

                break;
            case 2:
                $this->getUsuario();

                break;
            default:
                break;
        }
    }

    function validar() {
        $nombre = $_GET['nombre_usuario'];
        $password = $_GET['password'];

        $sql = " SELECT Count(*) FROM paciente WHERE usuario ='" . $nombre . "' and password = '" . $password . "'";
        $dao = new DaoUsuario();
        $respuesta = $dao->select($sql);

        $json = array();
        $fila = mysql_fetch_array($respuesta);
        $json["respuesta"][0] = array("usuario_valido" => $fila["Count(*)"]);
        echo json_encode($json);
    }

    function getUsuario() {
        $nombre = $_GET['nombre_usuario'];
        $password = $_GET['password'];

        $dao = new DaoUsuario();
        $respuesta = $dao->buscar($nombre, $password);

        $json = array();
        $fila = mysql_fetch_array($respuesta);

        if ($fila["codigo"] == null) {
            $json["usuario"][0] = null;
            
        } else {
            $json["usuario"][0] = array("codigo_usuario" => $fila["codigo"], "codigo_admin" => $fila["codAdmin"], 
                "nombre_completo" => $fila["nombre"], "nombre_usuario" => $fila["usuario"], "password" => $fila["password"], "fecha" => $fila["fecha"]);
                 }
                 
                 
        echo json_encode($json);
    }

}

?>
