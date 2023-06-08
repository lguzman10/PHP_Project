<?php 

include_once("bd.php");
$db = new db('catalogo');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $categoria = $_POST['selection'];
        $jsondata = array();
        $errores = [];
        $bandera = true;


            $queryVerificar = "SELECT * FROM categoria WHERE id_categoria = $categoria";
            $consulta = $db->query($queryVerificar);
            $datos = $db->fetchAll();
    
            if (empty($datos)) {
                $jsondata['success'] = false;
                $jsondata['message'] = $bandera = false;              
            }
    

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata);
        exit();
    }
?>