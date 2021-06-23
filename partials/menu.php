<!-- start nav -->
<nav id="menu">
<!-- start menu -->
    <ul>
        <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
        <li><a href="<?php echo BASE_URL . 'nosotros.php' ?>">Nosotros</a>

        </li>
        <li><a href="#">Contacto</a></li>
        <li><a href="#">Administración</a>
            <!-- start menu desplegable -->
            <ul>
                <li><a href="#">Productos</a></li>
                <li><hr></li>
                <li><a href="<?php echo COMUNAS; ?>">Comunas</a></li>
                <li><a href="<?php echo REGIONES; ?>">Regiones</a></li>
                <li><hr></li>
                <li><a href="<?php echo PERSONAS; ?>">Personas</a></li>
                <li><a href="<?php echo ROLES; ?>">Roles</a></li>
                <li><a href="#">Usuarios</a></li>

            </ul>
            <!-- end menu desplegable -->
        </li>
        <!-- preguntar si el usuario ha iniciado sesion -->
        <?php if(!isset($_SESSION['autenticado'])): ?>
            <a href="<?php echo USUARIOS . 'login.php'; ?>">Login</a>
        <?php else: ?>
            <a href="<?php echo USUARIOS . 'logout.php'; ?>">Logout</a>
        <?php endif; ?>
    </ul>
    <!-- end menu -->
</nav>
<!-- end nav -->