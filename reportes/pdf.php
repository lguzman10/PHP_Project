<?php
    use Dompdf\Dompdf;
    ob_start();
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" type="text/css"> -->
        <!-- <link type="text/css" rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.min.css"> -->
        <title>Reporte de articulos</title>

        <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
            }

            table {
                font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
                font-size: 12px;    
                margin: 30px;     
                width: 90%; 
                text-align: left;    
                border-collapse: collapse; 
            }

            th{     
                text-align: left;
                font-size: 15px;     
                font-weight: bold;    
                padding: 8px;     
                background: #ddc0ba;
            }
            
            td {
                padding: 8px;     
                background: #f6d8d1;     
                border-bottom: 1px solid #fff;
            }
        </style>
    </head>
    <body>
        <?php
            include_once("../bd.php");
        ?>
        
        <h1>Reporte de artículos</h1>
        
        <table class="table table-striped" id="data_table">
            <thead class="encabezado">
                <tr>
                  <th scope="col">Id de artículo</th>
                  <th scope="col">Categoría</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripción</th>
                 </tr>
            </thead>
            <tbody class="body">
                <?php 
                    $db = new db('catalogo');
                    $query = "SELECT *
                                FROM categoria, articulos 
                                WHERE categoria.id_categoria = articulos.id_categoria
                                ORDER BY id_articulo ASC";
                    $consulta = $db->query($query);
                    $datos = $db->fetchAll();
          
                    foreach ($datos as $element) {
                        $id = $element['id_articulo'];
                        $id_categoria = $element['id_categoria'];
                        $categoria = $element['nombre_categoria'];
                        $nombre = $element['nombre_articulo'];
                        $descripcion = $element['descripcion_articulo'];
      
                        echo '<tr>';
                            echo '<td id="a_id">'.$id.'</td>';
                            echo '<td id="a_cat">'.$categoria.'</td>';
                            echo '<td id="a_name">'.$nombre.'</td>';
                            echo '<td id="a_des">'.$descripcion.'</td>';  
                    } 
                ?> 
            </tbody>
        </table>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>

<?php
    $html = ob_get_clean();
    //echo $html;

    require_once '../librerias/dompdf/autoload.inc.php';
    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $options->set(array('isPhpEnabled' => true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);
    $dompdf->setBasePath("https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"); 
    $dompdf->setPaper('letter');
    $dompdf->render();
    $dompdf->stream("articulos.pdf", array("Attachment" => false));
?>