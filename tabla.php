<?php include_once("bd.php") ?>

<table class="table" id="data_table">
    <thead class="encabezado">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Categoría</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Editar</th>
            <th scope="col">Eliminar</th>
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
                    echo '<td>'.
                                "<button data-id='".$id."'
                                         data-categoria = '".$id_categoria."'
                                         data-nombre = '".$nombre."'
                                         data-descripcion = '".$descripcion."'
                                         class='btn btn-warning modif' 
                                         id='mod_buttton'
                                         title='Editar'>
                                         <i class='fa-solid fa-pen'></i>
                                </button>".
                        '</td>';
                    echo '<td>'."<button idRopa='".$id."' class='btn btn-danger delete' id='delete_buttton' title='Eliminar'><i class='fa-solid fa-trash'></i></button>".'</td>';               
                echo '</tr>';   
            }

 ?> 
    </tbody>
</table>