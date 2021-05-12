<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../class/rolModel.php');

$roles = new rolModel;

if (isset($_POST['confirm']) && $_POST['confirm'] == 1) {
    
    $id = (int) $_POST['id'];

    $row = $roles->deleteRol($id);

    if ($row) {
        $msg = 'ok';
        header('Location: index.php?e=' . $msg);
    }
}