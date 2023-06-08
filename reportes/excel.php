<?php
    include_once("../bd.php");
    require '../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $db = new db('catalogo');
    $query = "SELECT *FROM categoria, articulos WHERE categoria.id_categoria = articulos.id_categoria";
    $consulta = $db->query($query);
    $datos = $db->fetchAll();

    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $activeWorksheet->setTitle("Articulos");

    $activeWorksheet->setCellValue('A1', 'ID');
    $activeWorksheet->setCellValue('B1', 'Categoría');
    $activeWorksheet->setCellValue('C1', 'Nombre del articulo');
    $activeWorksheet->setCellValue('D1', 'Descripción del articulo');

    $fila = 2;

     foreach ($datos as $element){

        $activeWorksheet->getColumnDimension('A')->setWidth(10);
        $activeWorksheet->setCellValue('A'.$fila, $element['id_articulo']);
        $activeWorksheet->getColumnDimension('B')->setWidth(35);
        $activeWorksheet->setCellValue('B'.$fila, $element['nombre_categoria']);
        $activeWorksheet->getColumnDimension('C')->setWidth(35);
        $activeWorksheet->setCellValue('C'.$fila, $element['nombre_articulo']);
        $activeWorksheet->getColumnDimension('D')->setWidth(35);
        $activeWorksheet->setCellValue('D'.$fila, $element['descripcion_articulo']);
        $fila++;
    }
   
    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="reporte.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit;
?>