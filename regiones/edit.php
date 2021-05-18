<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    //establecer la conexion con la base de datos
    require('../class/regionModel.php');
    require('../class/rutas.php');

    //creamos un objeto o instancia de la clase regionModel
    $regiones = new regionModel;
    
    //verificar que la variable id de la region exista
    if (isset($_GET['id'])) {
        
        $id = (int) $_GET['id'];
        
        $region = $regiones->getRegionId($id);

        if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {

            $nombre = trim(strip_tags($_POST['nombre']));

            if (!$nombre) {
                $msg = 'Ingrese el nombre de la region';
            }else{
                //procedemos a modificar la region solicitada
                $row = $regiones->updateRegion($id, $nombre);

                if ($row) {
                    $msg = 'ok';
                    header('Location: show.php?id=' . $id . '&m=' . $msg);
                }
            }
        }

        /* echo '<pre>';
        print_r($region);exit;
        echo '</pre>'; */
    }
?>

<!--Estructura del DOM (Document Object Model)-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regiones</title>
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
        <h1>Editar Región</h1>
        <div class="contenido">
           <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
            POST => envia datos de manera interna al servidor -->
            <?php if(!empty($region)): ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="region">Región</label>
                        <input type="text" name="nombre" value="<?php echo $region['nombre']; ?>" class="form-control" placeholder="Ingrese el nombre de la region">
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