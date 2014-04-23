<?php

include_once '../DAO/DaoDieta.php';

$ser = new Servicio_dieta();
$ser->listar();

class Servicio_dieta {

    function __construct() {
        
    }

    function listar() {

        $codigo = $_GET["codigo"];
        $fecha = $_GET["fecha"];
        
        $dao = new DaoDieta();
        $respuesta = $dao->listar($codigo,$fecha);

        $json = array();
        if (mysql_num_rows($respuesta)>0) {
          
            $i = 0;
            while ($fila = mysql_fetch_array($respuesta)) {
                $json["dietas"][$i] = array("codigo_dieta" => $fila["codDieta"],
                    "fecha" => $fila["fecha"],
                    "cantidad" => $fila["cantidad"],
                    "comentario" => $fila["comentario"],
                    "estado" => $fila["estado"],
                    "nombre_tipo_comida" => $fila["nombre_tipo_comida"],
                    "codigo_tipo_comida" => $fila["codigo_tipo_comida"],
                    "hora_tipo_comida" => $fila["hora_tipo_comida"],                    
                    "nombre_alimento" => $fila["nombre"],
                    "medida" => $fila["medida"],
                    "proteinas" => $fila["proteinas"],
                    "carbohidratos" => $fila["carbohidratos"],
                    "grasas" => $fila["grasas"],
                    "calorias" => $fila["calorias"],
                    "colesterol" => $fila["colesterol"],
                    "cod_alimento" => $fila["codAlimento"]);
                $i++;
            }
            
        } else {

            $json["dietas"][0] = null;
        }
   echo json_encode($json);
    }

}

?>
