<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../class/personaModel.php');
require('../class/rutas.php');
require('../class/session.php');

//creamos un objeto o instancia de la clase personaModel
$session = new Session;
$personas = new PersonaModel;

//disponibilizacion de todas las personas
$personas = $personas->getPersonas();

/* echo '<pre>';
print_r($personas);exit;
echo '</pre>'; */


?>
<?php if(isset($_SESSION['autenticado']) && $_SESSION['usuario_rol'] != 'Cliente'): ?>
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

            <?php include('../partials/mensajes.php'); ?>

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
                <?php if($_SESSION['usuario_rol'] == 'Administrador'): ?>
                    <a href="add.php" class="btn btn-primary">Nueva Persona</a>
                <?php endif; ?>
            </p>
        </div>
    </section>
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('../partials/footer.php'); ?>
    </footer>

</body>
</html>
<?php else: ?>
    <script>
        //alert('Acceso indebido');
        window.location="<?php echo BASE_URL; ?>";
    </script>
<?php endif; ?>
