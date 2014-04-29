<?php

include_once '../DAO/Dao_Alimentos.php';


$tipo = $_GET['tipo'];
$ser = new Servicio_dieta();
$ser->elegirServicio($tipo);




class Servicio_dieta {

    function __construct() {
        
    }

        function elegirServicio($tipo) {
        switch ($tipo) {
            case 1:
                $this->listar();

                break;
            case 2:
                $this->buscar();

                break;
            default:
                break;
        }
    }
    
    
    function listar() {

     
        $dao = new Dao_Alimetos;
        $respuesta = $dao->listar("","");

        $json = array();
        if (mysql_num_rows($respuesta)>0) {
          
            $i = 0;
            while ($fila = mysql_fetch_array($respuesta)) {
                $json["alimentos"][$i] = array("codigo_alimento" => $fila["codAlimento"],
                                               "nombre_alimento" => $fila["nombre"]);
                $i++;
            }
            
        } else {

            $json["alimentos"][0] = null;
        }
   echo json_encode($json);
    }

    function  buscar(){
        
        
        $nombre = $_GET['codigo_alimento'];

        $dao = new Dao_Alimetos();
        $respuesta = $dao->buscar($nombre, "");


        $json = array();
        $fila = mysql_fetch_array($respuesta);

        $json["alimento"][0] = array("nombre_alimento" => $fila["nombre"],
                    "medida" => $fila["medida"],
                    "proteinas" => $fila["proteinas"],
                    "carbohidratos" => $fila["carbohidratos"],
                    "grasas" => $fila["grasas"],
                    "calorias" => $fila["calorias"],
                    "colesterol" => $fila["colesterol"],
                    "cod_alimento" => $fila["codAlimento"]);

        echo json_encode($json);
    }
    

}

?>
