<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../class/productotipoModel.php');
require('../class/rutas.php');
require('../class/session.php');

//creamos un objeto o instancia de la clase regionModel
$tipos = new ProductoTipoModel;
$session = new Session;

//disponibilizacion de todas las regiones
$tipos = $tipos->getProductoTipos();

/* echo '<pre>';
print_r($regiones);exit;
echo '</pre>'; */


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
        <div class="contenido">
            <?php include('../partials/mensajes.php'); ?>

            <h1>Marcas</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tipos as $tipo): ?>
                        <tr>
                            <td> <?php echo $tipo['id']; ?> </td>
                            <td>
                                <a href="show.php?id=<?php echo $tipo['id']; ?>">
                                    <?php echo $tipo['nombre']; ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="enlace">
                <a href="add.php" class="btn btn-primary">Nuevo Producto Tipo</a>
            </p>
        </div>
    </section>
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('../partials/footer.php'); ?>
    </footer>

</body>
</html>
