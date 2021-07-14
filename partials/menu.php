<!-- start nav -->
<nav id="menu">
<!-- start menu -->
    <ul>
        <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
        <li><a href="<?php echo BASE_URL . 'nosotros.php' ?>">Nosotros</a>

        </li>
        <li><a href="#">Contacto</a></li>
        <?php if(isset($_SESSION['autenticado']) && $_SESSION['usuario_rol'] != 'Cliente'): ?>
            <li><a href="#">Administración</a>
                <!-- start menu desplegable -->
                <ul>
                    <li><hr></li>
                    <li><a href="<?php echo COMUNAS; ?>">Comunas</a></li>
                    <li><a href="<?php echo REGIONES; ?>">Regiones</a></li>
                    <li><hr></li>
                    <li><a href="<?php echo ATRIBUTOS; ?>">Atributos</a></li>
                    <li><a href="<?php echo MARCAS; ?>">Marcas</a></li>
                    <li><a href="<?php echo PRODUCTOS; ?>">Productos</a></li>
                    <li><a href="<?php echo TIPOS; ?>">Producto Tipos</a></li>
                    <li><hr></li>
                    <li><a href="<?php echo PERSONAS; ?>">Personas</a></li>
                    <li><a href="<?php echo ROLES; ?>">Roles</a></li>
                    <li><a href="#">Usuarios</a></li>

                </ul>
                <!-- end menu desplegable -->
            </li>
        <?php endif; ?>
        <!-- preguntar si el usuario ha iniciado sesion -->
        <?php if(!isset($_SESSION['autenticado'])): ?>
            <li><a href="<?php echo USUARIOS . 'login.php'; ?>">Login</a></li>
        <?php else: ?>
            <li><a href="#" style="color:blue"><?php echo ucwords($_SESSION['usuario_nombre']); ?></a>
                <ul>
                    <li>
                        <a href="<?php echo USUARIOS . 'editPassword.php?id=' . $_SESSION['usuario_id']; ?>">Cambiar Password</a>
                    </li>
                    <li><a href="<?php echo USUARIOS . 'logout.php'; ?>">Logout</a></li>
                </ul>
            </li>
        <?php endif; ?>
    </ul>
    <!-- end menu -->
</nav>
<!-- end nav -->