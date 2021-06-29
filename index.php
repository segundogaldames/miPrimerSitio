<?php
require('class/rutas.php');
require('class/session.php');

$session = new Session;

//print_r($_SESSION);exit;

//echo uniqid();exit;
?>
<!--Estructura del DOM (Document Object Model)-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Primera Página</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <!--Aqui se ve todo el codigo por el usuario-->
    <!-- cabecera del sitio y menu de navegacion -->
    <header>
        <h1>Cabecera</h1>
        <!-- llamada a sitio menu.php -->
        <?php include('partials/menu.php'); ?>
    </header>
    <!-- cuerpo central de la pagina web -->
    <section>
        <?php include('partials/mensajes.php'); ?>

        <?php if(isset($_SESSION['autenticado'])): ?>
            <h4>Bienvenido@ <?php echo $_SESSION['usuario_nombre']; ?></h4>
        <?php endif; ?>

        <h1>Título De  Mi Primera Página</h1>
        <h4>Este es un subtítulo</h4>
        contenido principal
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit excepturi, perferendis cumque iste sunt corrupti quia doloremque quidem autem laudantium tempore accusamus saepe magni repellat et tenetur exercitationem consectetur aliquid?</p>
        <a href="#">Ver Más</a>
    </section>
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('partials/footer.php'); ?>
    </footer>

</body>
</html>