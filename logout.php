<?php

session_start();
session_destroy();
session_unset();
header('location:testconnec.php');
 $con = new PDO ("mysql:host=localhost;dbname=toutl2jw_bd_livraison","root","root");
$select = $con->query("UPDATE session set  allocation=0 ");
$select->execute();

exit();

?>