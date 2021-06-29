<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //establecer la llamada con los archivos necesarios
    require('../class/personaModel.php');
    require('../class/rolModel.php');
    require('../class/comunaModel.php');
    require('../class/rutas.php');
    require('../class/session.php');

    //creamos un objeto o instancia de la clase personaModel, rolModel y comunaModel
    $session = new Session;
    $personas = new PersonaModel;
    $roles = new rolModel;
    $comunas = new comunaModel;

    //verificar que la variable id de la persona exista
    if (isset($_GET['id'])) {

        $id = (int) $_GET['id'];

        $persona = $personas->getPersonaId($id);

        //lista de roles
        $roles = $roles->getRoles();

        //lista de comunas
        $comunas = $comunas->getComunas();

        if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {
            //recepcionar los datos que vienen del formulario
            $nombre = trim(strip_tags($_POST['nombre']));
            $rut = trim(strip_tags($_POST['rut']));
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $direccion = trim(strip_tags($_POST['direccion']));
            $comuna = filter_var($_POST['comuna'], FILTER_VALIDATE_INT);
            $fecha_nac = trim(strip_tags($_POST['fecha_nac']));
            $telefono = filter_var($_POST['telefono'], FILTER_VALIDATE_INT);
            $rol = filter_var($_POST['rol'], FILTER_VALIDATE_INT);


            if (strlen($nombre) < 5) {
                $msg = 'Ingrese el nombre de al menos 5 caracteres';
            }elseif (strlen($rut) < 8) {
                $msg = 'Ingrese un rut de al menos 8 caracteres';
            }elseif (!$email) {
                $msg = 'Ingrese un correo electrónico válido';
            }elseif (strlen($direccion) < 8) {
                $msg = 'La dirección debe contener al menos 8 caracteres';
            }elseif (!$comuna) {
                $msg = 'Seleccione una comuna';
            }elseif (!$fecha_nac) {
                $msg = 'Ingrese la fecha de nacimiento';
            }elseif (strlen($telefono) < 9) {
                $msg = 'El número de teléfono debe contener al menos 9 dígitos';
            }elseif (!$rol) {
                $msg = 'Seleccione un rol';
            }else{
                //actualizamos el registro de la persona segun el id
                $row = $personas->updatePersona($id, $nombre, $rut, $email, $direccion, $fecha_nac, $telefono, $rol, $comuna);

                if ($row) {
                    $_SESSION['success'] = 'La persona se ha modificado correctamente';
                    header('Location: show.php?id=' . $id);
                }
            }

        }

        /* echo '<pre>';
        print_r($persona);exit;
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
        <h1>Editar Persona</h1>
        <div class="contenido">
           <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
            POST => envia datos de manera interna al servidor -->
            <?php if(!empty($persona)): ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre <span class="text-danger">*</span> </label>
                        <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre de la persona" value="<?php echo $persona['nombre']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="rut">RUT <span class="text-danger">*</span></label>
                        <input type="text" name="rut" class="form-control" placeholder="Ingrese el rut de la persona" value="<?php echo $persona['rut']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="Ingrese el email de la persona" value="<?php echo $persona['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección (calle y número) <span class="text-danger">*</span></label>
                        <input type="text" name="direccion" class="form-control" placeholder="Ingrese la dirección de la persona" value="<?php echo $persona['direccion']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="comuna">Comuna <span class="text-danger">*</span></label>
                        <select name="comuna" class="form-control">
                            <option value="<?php echo $persona['comuna_id']; ?>">
                                <?php echo $persona['comuna']; ?>
                            </option>

                            <!-- mostrar la lista de comunas -->
                            <?php foreach($comunas as $comuna): ?>
                                <option value="<?php echo $comuna['id']; ?>">
                                    <?php echo $comuna['nombre']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                        <input type="number" name="telefono" class="form-control" placeholder="Ingrese el teléfono de la persona" value="<?php echo $persona['telefono']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="fecha_nac">Fecha de nacimiento <span class="text-danger">*</span></label>
                        <input type="date" name="fecha_nac" class="form-control" placeholder="Ingrese la fecha de nacimiento de la persona" value="<?php echo $persona['fecha_nac']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol <span class="text-danger">*</span></label>
                        <select name="rol" class="form-control">
                            <option value="<?php echo $persona['rol_id']; ?>">
                                <?php echo $persona['rol']; ?>
                            </option>

                            <!-- mostrar la lista de roles -->
                            <?php foreach($roles as $rol): ?>
                                <option value="<?php echo $rol['id']; ?>">
                                    <?php echo $rol['nombre']; ?>
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