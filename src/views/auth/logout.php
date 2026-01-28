<?php require_once '../auth/bdd.php'; session_start();?>
<?php session_destroy(); ?>
<?php header("Location: ../../../index.php"); exit(); ?>