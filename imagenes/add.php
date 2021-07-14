<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //establecer la conexion con la base de datos
    require('../class/imagenModel.php');
    require('../class/productoModel.php');
    require('../class/rutas.php');
    require('../class/session.php');


    $imagenes = new ImagenModel;
    $productos = new ProductoModel;
    $session = new Session;

    if(isset($_GET['id_producto'])){
        $id_producto = (int) $_GET['id_producto'];

        $producto = $productos->getProductoId($id_producto);

        //validamos que el formulario sea enviado via post
        if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {
            $titulo = trim(strip_tags($_POST['titulo']));
            $descripcion = trim(strip_tags($_POST['descripcion']));
            $imagen = $_FILES['imagen']['name'];

            //nombre temporal de imagen
            $tmp_name = $_FILES['imagen']['tmp_name'];

            if (strlen($titulo) < 4) {
                $msg = 'Ingrese un título de al menos de 4 caracteres';
            }elseif (strlen($descripcion) < 10) {
                $msg = 'Ingrese una descripción de al menos 10 caracteres';
            }elseif (!$imagen) {
                $msg = 'Seleccione una imagen';
            }else {
                //validar que la imagen subida no este registrada
                $row = $imagenes->getImagenNombre($imagen);

                if ($row) {
                    $msg = 'Esta imagen ya está registrada... Intente con otra';
                }

                //verificar portada
                $row = $imagenes->getImagenPortada($id_producto);

                if($row){
                    $portada = 1;
                }else {
                    $portada = 2;
                }

                //directorio en donde se guardara la imagen
                $upload = $_SERVER['DOCUMENT_ROOT'] . '/miPrimerSitio/productos/img';

                //definir la forma de guardado del archivo en el directorio
                $fichero = $upload . basename($_FILES['imagen']['name']);

                //validamos que el archivo se haya movido al servidor
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero)) {
                    //registramos la imagen en la tabla imagenes
                    $row = $imagenes->setImagen($titulo, $descripcion, $imagen, $portada, $id_producto);

                    if ($row) {
                        $_SESSION['success'] = 'La imagen se ha registrado correctamente';
                        header('Location: ' . PRODUCTOS . 'show.php?id=' . $id_producto);
                    }
                }else {
                    $_SESSION['danger'] = 'La imagen no se ha podido registrar... Intente nuevamente';
                    header('Location: ' . PRODUCTOS . 'show.php?id=' . $id_producto);
                }
            }

        }
    }


?>

<!--Estructura del DOM (Document Object Model)-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagenes Producto</title>
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
        <h1>Nueva Imagen</h1>
        <div class="contenido">
           <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
            POST => envia datos de manera interna al servidor -->
            <?php if(isset($msg)): ?>
                <p class="text-danger">
                    <?php echo $msg; ?>
                </p>
            <?php endif; ?>

            <?php if($producto): ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input type="text" name="titulo" class="form-control" placeholder="Ingrese el titulo de la imagen" value="<?php if(isset($_POST['titulo'])) echo $_POST['titulo']; ?>">

                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" placeholder="Ingrese la descripción de la imagen" value="<?php if(isset($_POST['descripcion'])) echo $_POST['descripcion']; ?>">

                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="form-control" placeholder="Seleccione una imagen">

                    </div>
                    <div class="form-group">
                        <input type="hidden" name="confirm" value="1">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="../productos/show.php?id=<?php echo $id_producto; ?>" class="btn btn-link">Volver</a>
                    </div>
                </form>
            <?php else: ?>
                <p class="text-info">No se puede cargar imagenes</p>
            <?php endif; ?>
        </div>


    </section>
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('../partials/footer.php'); ?>
    </footer>

</body>
</html>