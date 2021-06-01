<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //establecer la conexion con la base de datos
    require('../class/regionModel.php');
    require('../class/comunaModel.php');
    require('../class/rutas.php');

    //creamos un objeto o instancia de la clases regionModel y comunaModel
    $regiones = new regionModel;
    $comunas = new comunaModel;

    //verificar que la variable id de la comuna exista
    if (isset($_GET['id'])) {

        $id = (int) $_GET['id'];

        $comuna = $comunas->getComunaId($id);
        $regiones = $regiones->getRegiones();

        if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {

             //print_r($_POST);exit;

            $nombre = trim(strip_tags($_POST['nombre'])); //recuperamos la variable POST comuna
            $region = (int) $_POST['region']; //recuperamos la variable POST region => id de region

            if (!$nombre) {
                $msg = 'Ingrese el nombre de la comuna';
            }elseif ($region <= 0) {
                $msg = 'Seleccione la región';
            }else{
                //procedemos a modificar la comuna solicitada
                $row = $comunas->updateComuna($id, $nombre, $region);

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
        <h1>Editar Comuna</h1>
        <div class="contenido">
           <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
            POST => envia datos de manera interna al servidor -->
            <?php if(isset($msg)): ?>
                <p class="alert-danger">
                    <?php echo $msg; ?>
                </p>
            <?php endif; ?>

            <?php if(!empty($comuna)): ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="comuna">Comuna</label>
                        <input type="text" name="nombre" value="<?php echo $comuna['nombre']; ?>" class="form-control" placeholder="Ingrese el nombre de la comuna">
                    </div>
                    <div class="form-group">
                    <label for="region">Región</label>
                        <select name="region" class="form-control">
                            <option value="<?php echo $comuna['region_id']; ?>">
                                <?php echo $comuna['region']; ?>
                            </option>

                            <!-- mostrar la lista de regiones -->
                            <?php foreach($regiones as $region): ?>
                                <option value="<?php echo $region['id']; ?>">
                                    <?php echo $region['nombre']; ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
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