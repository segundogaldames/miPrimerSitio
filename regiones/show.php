<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    require('../class/regionModel.php');
    require('../class/rutas.php');

    //verificar que la variable id enviada desde index.php ha ingresado en esta pagina
    if (isset($_GET['id'])) {
        # guardar la variable GET id en una variable manejable
        $id = (int) $_GET['id']; //parseamos la variable id obligandola a que sea un numero entero

        $regiones = new regionModel;
        $region = $regiones->getRegionId($id);

       /*  echo '<pre>';
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
        <div class="contenido">
            <?php if(isset($_GET['m']) && $_GET['m'] == 'ok'): ?>
                <p class="alert-success">La región se ha modificado correctamente</p>
            <?php endif; ?>

            <h1>Regiones</h1>
            <!-- verificar que el arreglo rol tenga datos -->
            <?php if($region): ?>
                <table class="table">
                    <tr>
                        <th>Id:</th>
                        <td> <?php echo $region['id']; ?> </td>
                    </tr>
                    <tr>
                        <th>Rol:</th>
                        <td> <?php echo $region['nombre']; ?> </td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td> 
                            <?php
                                //creamos una instancia de la fecha mysql en php con la clase Datetime
                                $created = new DateTime($region['created_at']);
                                echo $created->format('d-m-Y H:i:s'); 
                            ?> 
                        </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td> 
                            <?php
                                //creamos una instancia de la fecha mysql en php con la clase Datetime
                                $update = new DateTime($region['updated_at']);
                                echo $update->format('d-m-Y H:i:s'); 
                            ?> 
                        </td>
                    </tr>
                </table>
                <p class="enlace">
                    <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-primary">Editar</a>
                    <a href="index.php" class="btn btn-link">Volver</a>
                </p>
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