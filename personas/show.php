<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require('../class/personaModel.php');
    require('../class/usuarioModel.php');
    require('../class/session.php');
    require('../class/rutas.php');

    //verificar que la variable id enviada desde index.php ha ingresado en esta pagina
    if (isset($_GET['id'])) {
        # guardar la variable GET id en una variable manejable
        $id = (int) $_GET['id']; //parseamos la variable id obligandola a que sea un numero entero

        $personas = new PersonaModel;
        $usuarios = new UsuarioModel;
        $session = new Session;

        $persona = $personas->getPersonaId($id);

        $usuario = $usuarios->getUsuarioPersona($id);

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
        <div class="contenido">

           <?php include('../partials/mensajes.php'); ?>

            <h1>Personas</h1>
            <!-- verificar que el arreglo rol tenga datos -->
            <?php if($persona): ?>
                <table class="table">
                    <tr>
                        <th>Nombre:</th>
                        <td> <?php echo $persona['nombre']; ?> </td>
                    </tr>
                    <tr>
                        <th>RUT:</th>
                        <td> <?php echo $persona['rut']; ?> </td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td> <?php echo $persona['email']; ?> </td>
                    </tr>
                    <tr>
                        <th>Teléfono:</th>
                        <td> <?php echo $persona['telefono']; ?> </td>
                    </tr>
                    <tr>
                        <th>Dirección:</th>
                        <td> <?php echo $persona['direccion']; ?> </td>
                    </tr>
                    <tr>
                        <th>Comuna:</th>
                        <td> <?php echo $persona['comuna']; ?> </td>
                    </tr>
                    <tr>
                        <th>Rol:</th>
                        <td> <?php echo $persona['rol']; ?> </td>
                    </tr>
                    <tr>
                        <th>Activo:</th>
                        <td>
                            <?php if(!empty($usuario)): ?>
                                <?php if($usuario['activo'] == 1): ?>
                                    Si
                                <?php else: ?>
                                    No
                                <?php endif; ?>
                                 | <a href="<?php echo USUARIOS . 'edit.php?id=' . $usuario['id']; ?>">Modificar</a>
                            <?php else: ?>
                                <span class="text-danger">Cuenta no creada</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td>
                            <?php
                                //creamos una instancia de la fecha mysql en php con la clase Datetime
                                $created = new DateTime($persona['created_at']);
                                echo $created->format('d-m-Y H:i:s');
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td>
                            <?php
                                //creamos una instancia de la fecha mysql en php con la clase Datetime
                                $update = new DateTime($persona['updated_at']);
                                echo $update->format('d-m-Y H:i:s');
                            ?>
                        </td>
                    </tr>
                </table>
                <p class="enlace">
                    <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-primary">Editar</a>

                    <?php if(empty($usuario)): ?>
                        <a href="../usuarios/add.php?id_persona=<?php echo $id; ?>" class="btn btn-success">Crear Cuenta</a>
                    <?php else: ?>
                        <a href="../usuarios/editPassword.php?id=<?php echo $usuario['id']; ?>" class="btn btn-success">Editar Password</a>
                    <?php endif; ?>


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