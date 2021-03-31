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
        <!-- navegador principal del sitio -->
        <?php include('partials/menu.php'); ?>
        <!-- fin navegador -->
    </header>
    <!-- cuerpo central de la pagina web -->
    <section>
        <h1>Nuestra Empresa</h1>
        <!-- lado derecho de la pagina -->
        <article style="with:40%;float:left">
            lado derecho
        </article>
        <!-- lado izquierdo de la pagina -->
        <article style="with:60%;float:left">
            lado izquierdo
        </article>
    </section> 
    <!-- pie de pagina del sitio -->
    <footer>
        <h1>Hola</h1>
        <p>Politicas de privacidad</p>
        pie de pagina
    </footer> 
    
</body>
</html>