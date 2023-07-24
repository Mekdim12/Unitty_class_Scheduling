<?php session_start(); ?>
<?php require_once("db_connection/db_conn.php"); ?>
<?php include_once("includes/basic_functions.php");?> 

<?php
session_destroy();
header('Location: index.php');
?>
