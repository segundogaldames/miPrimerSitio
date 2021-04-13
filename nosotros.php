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
        <article class="derecho">
            <img src="img/img_empresa.jpeg" alt="Imagen Empresa" style="width: 96%; margin-right:4%">
        </article>
        <!-- lado izquierdo de la pagina -->
        <article class="izquierdo">
            <div class="texto">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing amet consectetur adipisicing elit. Similique, corporis corrupti doloremque id error, maiores magni aliquid nobis aspernatur veritatis facilis eaque quis ad quod ea odit! Omnis, ab possimus?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, corporis corrupti doloremque id error, maiores magni aliquid nobis aspernatur veritatis facilis eaque quis ad quod ea odit! Omnis, ab possimus?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, corporis corrupti doloremque id error, maiores magni aliquid nobis aspernatur veritatis facilis eaque quis ad quod ea odit! Omnis, ab possimus?</p>
            </div>
            <div class="video">
                <iframe width="640" height="360" src="https://www.youtube.com/embed/ht4LFdcZhCw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            
        </article>
    </section> 
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('partials/footer.php'); ?>
    </footer> 
    
</body>
</html>