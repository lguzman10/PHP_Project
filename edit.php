<?php

if (isset($_POST['id_articulo'])) {

    include_once("bd.php");

    $id = $_POST['id_articulo'];
    $categoria = $_POST['selection'];
    $titulo = $_POST['title'];
    $descripcion = $_POST['description'];
    $jsondata = array();
    $errores = [];

    if(!empty($categoria)){
        $db = new db('catalogo');
        $queryVerificar = "SELECT * FROM categoria WHERE id_categoria = $categoria";
        $consulta = $db->query($queryVerificar);
        $datos = $db->fetchAll();

        if (empty($datos)) {
            $jsondata['success'] = false;
            $jsondata['message'] = $errores[] = 'Elige una categoría válida';              
        }

    }else{
        $jsondata['success'] = false;
        $jsondata['message'] = $errores[] = 'Por favor selecciona una categoría';
    }

    if (!empty($titulo)) {    
        $titulo = trim($titulo);

        if (strlen($titulo)<1 || strlen($titulo)>60){
            $jsondata['success'] = false;
        $jsondata['message'] =
        $errores[] = 'El límite de caracateres es 60';
        }

        $permitidos = " abcdefghijklmnopqrstuvwxyzáéíóúABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚ0123456789";
        
        for ($i=0; $i<strlen($titulo); $i++){
            if (strpos($permitidos, substr($titulo,$i,1))===false){
                $jsondata['success'] = false;
        $jsondata['message'] =          
                $errores[] = 'El nombre del artículo solo puede contener letras y numeros';
            }
        }
       
	} else {
        $jsondata['success'] = false;
        $jsondata['message'] =
		$errores[] = 'Por favor ingresa un nombre';
	}

	if (!empty($descripcion)) {
		$descripcion = htmlspecialchars($descripcion);
		$descripcion = trim($descripcion);
		$descripcion = stripslashes($descripcion);

        if (strlen($descripcion)<1 || strlen($descripcion)>255){
            $jsondata['success'] = false;
        $jsondata['message'] =
        $errores[] = 'El límite de caracateres es 255';
        }

        $permitidos = " abcdefghijklmnopqrstuvwxyzáéíóúABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚ0123456789";
        for ($i=0; $i<strlen($descripcion); $i++){
            if (strpos($permitidos, substr($descripcion,$i,1))===false){
                $jsondata['success'] = false;
        $jsondata['message'] =          
                $errores[] = 'La descripción del articulo solo puede contener letras y números';
            }
        }
	} else {
        $jsondata['success'] = false;
        $jsondata['message'] =
		$errores[] = 'Por favor añade una descripción';
	}

// Comprueba si hay errores, si no hay entonces enviamos.

	if (empty($errores)) {
        $db = new db('catalogo');
        $query = "UPDATE articulos SET id_categoria = '$categoria', 
                                       nombre_articulo = '$titulo', 
                                       descripcion_articulo = '$descripcion' 
                        WHERE id_articulo = '$id'";
        $consulta = $db->query($query);
	}else{
        
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata);
        exit();
    }
    
}

?>