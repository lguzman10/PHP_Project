<?php
    include_once("../bd.php");
    require '../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

    $db = new db('catalogo');

        //$nombreArchivo = 'reportes.xlsx';
    $archivo = $_FILES["archivo"]["name"];
    $archivo_copiado = $_FILES["archivo"]["tmp_name"];
    $archivo_guardado = "copia_".$archivo;

    copy($archivo_copiado, $archivo_guardado);

    $fp = fopen($archivo_guardado, "r");

    $documento = IOFactory::load($archivo_guardado);
    $totalHojas = $documento->getSheetCount();

    $hojaActual = $documento->getSheet(0);
    $numeroFilas = $hojaActual->getHighestDataRow();
    $letra = $hojaActual->getHighestColumn();
    
    $numeroLetra = Coordinate::columnIndexFromString($letra);

    $errores = '';
    $categoria = 0;
    //$query = "INSERT INTO articulos(id_categoria, nombre_articulo, descripcion_articulo) VALUES ('$categoria', '$valorB', '$valorC')";


    for($indiceFila = 2; $indiceFila<=$numeroFilas; $indiceFila++){

        $valorA = $hojaActual->getCellByColumnAndRow(1, $indiceFila);
        $valorB = $hojaActual->getCellByColumnAndRow(2, $indiceFila);
        $valorC = $hojaActual->getCellByColumnAndRow(3, $indiceFila);

        if ($valorA != '') {
            if ($valorA == 'Dama' || $valorA == 'dama') {
                    $categoria = 1;
                }
            if ($valorA == 'Caballero' || $valorA == 'caballero') {
                    $categoria = 2;
                }
            if ($valorA == 'Infantil' || $valorA == 'infantil') {
                    $categoria = 3;
                }
        }else{
            $errores.= 'La categoría no es válida.<br />';
        }

        if ($valorB != '') {    
    
            if (strlen($valorB)<1 || strlen($valorB)>60){
                $errores.= 'El límite de caracteres es 60.<br />';
            }
    
            $permitidos = " abcdefghijklmnopqrstuvwxyzáéíóúABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚ0123456789";
            
            for ($i=0; $i<strlen($valorB); $i++){
                if (strpos($permitidos, substr($valorB,$i,1))===false){      
                    $errores.= 'Los caracteres ingresados en el título no son válidos.<br />';
                }
            }
            
        } else {
            $errores.= 'El título no puede estar vacío.<br />';
        }
    
        if ($valorC != '') {
    
            if (strlen($valorC)<1 || strlen($valorC)>255){
            $errores.= 'El límite de caracteres es 255.<br />';
            }
    
            $permitidos = " abcdefghijklmnopqrstuvwxyzáéíóúABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚ0123456789";
            for ($i=0; $i<strlen($valorC); $i++){
                if (strpos($permitidos, substr($valorC,$i,1))===false){         
                    $errores.= 'Los caracteres ingresados en la descripción no son válidos.<br />';
                }
            }
        } else {
            $errores.= 'La descricpión no puede estar vacía.<br />';
        }

        if (!$errores) {
    
            $query = "INSERT INTO articulos(id_categoria, nombre_articulo, descripcion_articulo) VALUES ('$categoria', '$valorB', '$valorC')";
            $consulta = $db->query($query);
    
            header("Location: exito.html");
    
        }else{
            //echo 'Error al importar el archivo, por favor corrija los siguientes errores: <br />' . $errores . '<a href="../index.php">Regresar</a>';
            header("Location: error.php");
        }
    }
?>