<?php if(isset($_SESSION['success'])): ?>
    <p class="alert-success">
        <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        ?>
    </p>
<?php endif; ?>

<?php if(isset($_SESSION['danger'])): ?>
    <p class="alert-danger">
        <?php
            echo $_SESSION['danger'];
            unset($_SESSION['danger']);
        ?>
    </p>
<?php endif; ?>