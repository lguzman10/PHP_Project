<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Error al cargar el archivo</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../estilos/404.css">

        <style>
            body{
                background-color: red;
            }
            .contenedor{
                font-family: 'Roboto', sans-serif;
                display: flex;
                align-items: center;
                margin-top: 350px;
                justify-content: center;
                flex-wrap: nowrap;
                flex-direction: column;
                padding: 30px;
                text-align: center;
            }

            .success{
                font-size: 35px;
                font-weight: 700;
                color: white;
                align-self: center;
            }

            a{
                border: 5px solid rgb(255, 255, 255);
                border-radius: 10px;
                color: rgb(255, 255, 255);
                font-size: 20px;
                font-weight: 400;
                margin-top: 50px;
                padding: 10px;
                text-decoration: none;
            }

            a:hover{
                background-color: white;
                color: black;
            }
        </style>
    </head>
    <body>
        <div class="contenedor">
            <div class="success">Ha ocurrido un error, por favor verifique que su archivo no contenga celdas vacías y/o carácteres o valores no admitidos</div>
            <a href="../index.php">Volver a inicio</a>
        </div>
    </body>
</html>