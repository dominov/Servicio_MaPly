<?php

/*
 *
 * @author Cristian
 */
interface Dao {
   
    function select($condicion);
    function buscar($nombre,$password);
    function listar($codigo,$fecha);
}

?>
