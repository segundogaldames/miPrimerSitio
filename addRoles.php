<!--Estructura del DOM (Document Object Model)-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Nuevo Rol</title>
    
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
        <div class="formulario">
            <h1>Nuevo Rol</h1>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Nombre:</label>
                    <input type="text" name="nombre" placeholder="Ingrese el nombre del rol" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
                
            </form>
        </div>
        
    </section> 
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('partials/footer.php'); ?>
    </footer> 
    
</body>
</html>

