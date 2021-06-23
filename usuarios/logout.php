<?php

require('../class/session.php');
require('../class/rutas.php');

$session = new Session;

$session->logout();

header('Location: ' . BASE_URL);