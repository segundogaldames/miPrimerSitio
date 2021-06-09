<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../class/personaModel.php');
require('../class/rutas.php');

//creamos un objeto o instancia de la clase personaModel
$personas = new PersonaModel;

//disponibilizacion de todas las personas
$personas = $personas->getPersonas();

/* echo '<pre>';
print_r($personas);exit;
echo '</pre>'; */


?>
<!--Estructura del DOM (Document Object Model)-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
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
                <p class="alert-success">La persona se ha registrado correctamente</p>
            <?php endif; ?>

            <?php if(isset($_GET['e']) && $_GET['e'] == 'ok'): ?>
                <p class="alert-success">La persona se ha eliminado correctamente</p>
            <?php endif; ?>

            <h1>Personas</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Comuna</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($personas as $persona): ?>
                        <tr>
                            <td>
                                <a href="show.php?id=<?php echo $persona['id']; ?>">
                                    <?php echo $persona['nombre']; ?>
                                </a>
                            </td>
                            <td><?php echo $persona['comuna']; ?></td>
                            <td><?php echo $persona['rol']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="enlace">
                <a href="add.php" class="btn btn-primary">Nueva Persona</a>
            </p>
        </div>
    </section>
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('../partials/footer.php'); ?>
    </footer>

</body>
</html>
