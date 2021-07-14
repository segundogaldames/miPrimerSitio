<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //establecer la conexion con la base de datos
    require('../class/productotipoModel.php');
    require('../class/rutas.php');
    require('../class/session.php');


    $tipos = new ProductoTipoModel;
    $session = new Session;

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        $tipo = $tipos->getProductoTipoId($id);

        //validamos que el formulario sea enviado via post
        if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {

            //guardaremos el nombre del rol en la variable nombre
            $nombre = trim(strip_tags($_POST['nombre'])); //sanitizar la variable nombre

            //validar que la variable no este vacia
            if (!$nombre) {
                $msg = 'Debe ingresar el nombre del producto tipo';
            }else {
                $row = $tipos->updateProductoTipo($id, $nombre);

                if ($row) {
                    $_SESSION['success'] = 'El producto tipo se ha modificado correctamente';
                    header('Location: show.php?id=' . $id);
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
    <title>Producto Tipos</title>
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
        <h1>Editar Producto Tipo</h1>
        <div class="contenido">
           <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
            POST => envia datos de manera interna al servidor -->
            <?php if($tipo): ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="marca">Producto Tipo</label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del producto tipo" value="<?php echo $tipo['nombre']; ?>">
                        <?php if(isset($msg)): ?>
                            <p class="text-danger">
                                <?php echo $msg; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="confirm" value="1">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="show.php?id=<?php echo $id; ?>" class="btn btn-link">Volver</a>
                    </div>
                </form>
            <?php else: ?>
                <p class="text-info">El dato no existe</p>
            <?php endif; ?>
        </div>


    </section>
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('../partials/footer.php'); ?>
    </footer>

</body>
</html>