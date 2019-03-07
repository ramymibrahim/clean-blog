<?php
require_once 'helpers/session.php';
unset($_SESSION['user']);
session_destroy();
header('Location:index.php');
die();
?>