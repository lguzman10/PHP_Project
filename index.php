<?php
    include_once("bd.php");
    include("include/header.php");
?>

<div class="contenedor">

<!-- Formulario -->

<h1>Catálogo</h1>

<form name="frm-articulo" id="frm-articulo">
    
    <label for="list" class="form-label">Categoría</label>
    <select id="list" class="form-select aria" aria-label="Default select example" name="selection">  
        <?php
            $db = new db('catalogo');
            $query = "SELECT * FROM categoria";
            $consulta = $db->query($query);
            $datos = $db->fetchAll();

            foreach ($datos as $element){
                echo '<option value="'.$element['id_categoria'].'">'.$element['nombre_categoria'].'</option>';
            }
        ?>                                          
    </select>

    <input type="text" hidden="" id="idpersona" name="">

    <div class="mb-3">
        <label for="titulo" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="titulo" placeholder="Ingresa un nombre para el articulo" name="title" />
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" rows="3" placeholder="Ingresa una descripción del articulo" name="description"></textarea>  
    </div>

    <!-- <input type="submit" name="submit" class="btn btn-primary" value="Guardar" id="guardar"> -->
    <button type="submit" class="btn btn-primary" name="save_task" value="save_task" id="guardar">Guardar</button>
    <button type="submit" class="btn btn-success" name="update_task" value="update_task" id="actualizar">Actualizar</button>
    <button type="submit" class="btn btn-light" name="cancelar" value="cancelar" id="cancelar">Cancelar</button>
</form>

<!-- <form enctype="multipart/form-data" action="reportes/importarExcel.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
    <p>Importar datos desde excel: <input name="subir_archivo" type="file" /></p>
    <p><input class="btn btn-success" type="submit" value="Importar datos" /></p>
</form> -->

<div class="buttons">
<!-- <form enctype="multipart/form-data" action="reportes/importarExcel.php" method="POST">
    <div class="card">
        <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
        <input type="file" class="btn-success" name="importar" id="file" accept=".xls,.xlsx" id="src-file">
    </div>
</form> -->
    <div class="form">
        <form action="reportes/importarExcel.php" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo" accept=".xls,.xlsx" class="btn btn-success">
            <input type="submit" value="Cargar datos desde excel" class="btn btn-success">
        </form>
    </div>
    <div class="buttons">
        <a href="reportes/excel.php" class="btn btn-success">Generar reporte en excel</a>
        <a href="reportes/pdf.php" class="btn btn-danger">Generar reporte PDF</a>
    </div>
</div>

<?php include("tabla.php") ?>

</div>

<?php
    include("include/footer.php");
?>

