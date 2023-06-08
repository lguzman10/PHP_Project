<?php

include_once("bd.php");
$db = new db('catalogo');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $jsondata = array();
    $errores = [];
    $categoria = $_POST['selection'];
    $titulo = $_POST['title'];
    $descripcion = $_POST['description'];

    if(!empty($categoria)){

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
       //comprobar_nombre_articulo($titulo);
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

        $query = "INSERT INTO articulos(id_categoria, nombre_articulo, descripcion_articulo) VALUES ('$categoria', '$titulo', '$descripcion')";
        $consulta = $db->query($query);

	}else{
        
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsondata);
        exit();

        // foreach ($errores as $error) {
        //     echo  $error;
        // } 
    }

}

// function comprobar_nombre_articulo($titulo){
//     if (strlen($titulo)<1 || strlen($titulo)>255){
//         return false;
//     }
//     $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_";
//     for ($i=0; $i<strlen($titulo); $i++){
//         if (strpos($permitidos, substr($titulo,$i,1))===false){          
//             return false;
//         }
//     }
//     return true;
//     }    


// $query = "SELECT id_categoria FROM categoria WHERE (nombre_categoria = 'Dama' OR nombre_categoria = 'Caballero' OR nombre_categoria = 'Infantil')";
// $cons = $db->numRows($categoriaExist);

// if ($cons != 1 || $cons !=2 || $cons != 3) {
//     $jsondata['success'] = false;
//     $jsondata['message'] = $errores[] = 'Elige una categoría válida';
// }

?>
