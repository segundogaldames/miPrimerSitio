<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //establecer la conexion con la base de datos
    require('../class/usuarioModel.php');
    require('../class/session.php');
    require('../class/rutas.php');


    //creamos un objeto o instancia de la clase regionModel
    $usuarios = new UsuarioModel;
    $session = new Session;

    if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {
        //print_r($_POST);exit;
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $clave = trim(strip_tags($_POST['clave']));

        if (!$email) {
            $msg = 'Ingrese un email válido';
        }elseif (!$clave) {
            $msg = 'Ingrese su password';
        }else {
            //preguntamos por el usuario y clave registrados
            $row = $usuarios->getUsuarioLogin($email, $clave);

            if (!$row) {
                $msg = 'El email o la password ingresados no existen';
            }else{
                //creamos el login usando variables de sesion
                $id_usuario = $row['id'];
                $nom_usuario = $row['nombre'];
                $rol = $row['rol'];

                $session->login($id_usuario, $nom_usuario, $rol);

                header('Location: ' . BASE_URL);
            }
        }
    }

?>

<!--Estructura del DOM (Document Object Model)-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h1>Login</h1>
        <div class="contenido">
           <!--  GET => envia datos a traves de la url del navegador (URI) al servidor
            POST => envia datos de manera interna al servidor -->
            <?php if(isset($msg)): ?>
                <p class="alert-danger">
                    <?php echo $msg; ?>
                </p>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Ingrese su correo electrónico">

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="clave" class="form-control" placeholder="Ingrese su password">

                </div>
                <div class="form-group">
                    <input type="hidden" name="confirm" value="1">
                    <button type="submit" class="btn btn-primary">Iniciar</button>
                </div>
            </form>
        </div>


    </section>
    <!-- pie de pagina del sitio -->
    <footer>
        <?php include('../partials/footer.php'); ?>
    </footer>

</body>
</html>