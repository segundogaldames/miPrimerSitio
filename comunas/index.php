<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../class/comunaModel.php');
require('../class/rutas.php');

//creamos un objeto o instancia de la clase regionModel
$comunas = new comunaModel;

//disponibilizacion de todas las regiones
$comunas = $comunas->getComunas();

/* echo '<pre>';
print_r($comunas);exit;
echo '</pre>'; */


?>
<!--Estructura del DOM (Document Object Model)-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunas</title>
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
            <?php if(isset($_GET['m']) && $_GET['m'] == 'ok'): ?>
                <p class="alert-success">La comuna se ha registrado correctamente</p>
            <?php endif; ?>

            <h1>Comunas</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Comuna</th>
                        <th>Región</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($comunas as $comuna): ?>
                        <tr>
                            <td>
                                <a href="show.php?id=<?php echo $comuna['id']; ?>">
                                    <?php echo $comuna['nombre'] ?>
                                </a>
                            </td>
                            <td> 
                               <?php echo $comuna['region']; ?> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="enlace">
                <a href="add.php" class="btn btn-primary">Nueva Región</a>
            </p>
        </div>
    </section> 
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('../partials/footer.php'); ?>
    </footer> 
    
</body>
</html>
