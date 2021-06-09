<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //establecer la conexion con la base de datos
    require('../class/regionModel.php');
    require('../class/rutas.php');

    //creamos un objeto o instancia de la clase regionModel
    $regiones = new regionModel;

    //validamos que el formulario sea enviado via post
    if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {

        //guardaremos el nombre de la region en la variable nombre
        $nombre = trim(strip_tags($_POST['nombre'])); //sanitizar la variable nombre

        //validar que la variable no este vacia
        if (!$nombre) {
            $msg = 'Debe ingresar el nombre de la region';
        }else {
            # verificar que el dato no este registrado en la tabla regiones
            $row = $regiones->getRegionNombre($nombre);

            if ($row) {
                $msg = 'La región ingresada ya existe... intente con otra';
            }else {
                //insertar la region en la base de datos
                $row = $regiones->setRegiones($nombre);

                if ($row) {
                    //crear una variable de exito
                    $msg = 'ok';
                    //redireccionar hacia index.php con el mensaje de la variable msg
                    header('Location: index.php?m=' . $msg);
                }
            }
            //print_r($row);exit;
        }

        //la funcion print_r permite imprimir datos a manera de prueba
        //print_r($nombre);exit;
    }
?>

<!--Estructura del DOM (Document Object Model)-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <!--Aqui se ve todo el codigo por el usuario-->
    <!-- cabecera del sitio y menu de navegacion -->
    <header>
        <h1>Cabecera</h1>
        <!-- llamada a sitio menu.php -->
        <?php include('../partials/menu.php'); ?>
    </header>
    <!-- cuerpo central de la pagina web -->
    <section>
        <h1>Nueva Región</h1>
        <div class="contenido">
           <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
            POST => envia datos de manera interna al servidor -->
            <form action="" method="post">
                <div class="form-group">
                    <label for="region">Región</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre de la region">
                    <?php if(isset($msg)): ?>
                        <p class="text-danger">
                            <?php echo $msg; ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="hidden" name="confirm" value="1">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php" class="btn btn-link">Volver</a>
                </div>
            </form>
        </div>


    </section>
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('../partials/footer.php'); ?>
    </footer>

</body>
</html>