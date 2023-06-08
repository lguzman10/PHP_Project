<?php

include_once("bd.php");

if (isset($_POST['id_articulo'])) {

     $id = $_POST['id_articulo'];

     $db = new db('catalogo');
     $query = "DELETE FROM articulos WHERE id_articulo = $id";
     $consulta = $db->query($query);
}

?>







