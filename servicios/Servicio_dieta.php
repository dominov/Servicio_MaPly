<?php

include_once '../DAO/DaoDieta.php';


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
                $this->ingresar();

            case 3:
                $this->update();

                break;
            default:
                break;
        }
    }

    function listar() {

        $codigo = $_GET["codigo"];
        $fecha = $_GET["fecha"];

        $dao = new DaoDieta();
        $respuesta = $dao->listar($codigo, $fecha);

        $json = array();
        if (mysql_num_rows($respuesta) > 0) {

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

    function ingresar() {

        $data = json_decode(file_get_contents('php://input'), true);
        //print_r($data);
        $sql = "INSERT INTO `sig`.`historial` (`codigo`,`fecha_registro`, `tipo_comida`, `codAlimento`,`codPaciente`,`cantidad`) VALUES ";


        foreach ($data as $key => $value) {
            // echo "$key | $value";
            $sql .= "(NULL";
            foreach ($value as $key2 => $value2) {
                //echo "$key2 | $value2";
                $sql .= ",'" . $value2 . "'";
            }
            $sql .= "),";
        }
        $sql = trim($sql, ',');
        $sql .=";";

        $d = new DaoDieta();
        $respuesta = $d->select($sql);
        echo "$respuesta";
        // echo $data["dietas"];
    }

    function update() {

        mysql_connect("localhost", "root", "");
        mysql_select_db("sig");
        $data = json_decode(file_get_contents('php://input'), true);
        //print_r($data);
        $sql = "";

        foreach ($data as $key => $value) {

            $estado = $value["estado"];
            $cod = $value["codigo_dieta"];
            
            $sSQL = "Update dieta Set estado='$estado' Where codDieta='$cod';";
            mysql_query($sSQL);
             echo "$sSQL";
        }     
        
    }

}

?>
