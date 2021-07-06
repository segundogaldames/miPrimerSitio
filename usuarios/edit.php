<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //establecer la conexion con la base de datos
    require('../class/usuarioModel.php');
    require('../class/rutas.php');
    require('../class/session.php');

    //creamos un objeto o instancia de la clase regionModel
    $session = new Session;
    $usuarios = new UsuarioModel;

    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        $usuario = $usuarios->getUsuarioId($id);

        //validamos que el formulario sea enviado via post
        if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {

            //guardaremos el nombre de la region en la variable nombre
            $activo = filter_var($_POST['activo'], FILTER_VALIDATE_INT);

            //validar que la variable no este vacia
            if (!$activo) {
                $msg = 'Seleccione un estado';
            }else {
                //actualizar o modificar el estado del usuario
                $row = $usuarios->updateEstado($id, $activo);

                if ($row) {
                    $_SESSION['success'] = 'El estado se ha modificado correctamente';
                    header('Location: ' . PERSONAS . 'show.php?id=' . $usuario['persona_id']);
                }
            }

            //la funcion print_r permite imprimir datos a manera de prueba
            //print_r($nombre);exit;
        }
    }

?>
<?php if(isset($_SESSION['autenticado']) && $_SESSION['usuario_rol'] == 'Administrador'): ?>

<!--Estructura del DOM (Document Object Model)-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
        <h1>Editar Estado de Usuario</h1>
        <div class="contenido">
           <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
            POST => envia datos de manera interna al servidor -->
            <?php if(isset($msg)): ?>
                <p class="alert-danger">
                    <?php echo $msg; ?>
                </p>
            <?php endif; ?>

            <?php if($usuario): ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="activo">Estado</label>
                        <select name="activo" class="form-control">
                            <option value="<?php echo $usuario['activo']; ?>">
                                <?php if($usuario['activo'] == 1): ?>
                                    Activo
                                <?php else: ?>
                                    Inactivo
                                <?php endif; ?>
                            </option>

                            <option value="1">Activar</option>
                            <option value="2">Desactivar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="confirm" value="1">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="../personas/show.php?id=<?php echo $usuario['persona_id']; ?>" class="btn btn-link">Volver</a>
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
<?php else:?>
    <?php header('Location: ' . BASE_URL); ?>
<?php endif; ?>