<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}
  $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');

  echo $_SERVER['REQUEST_URI']; 

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>TOUTLIVRER</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <meta http-equiv="Refresh" content="120"; url="admin_cli_info.php">
    <!-- 
    Visual Admin Template
    https://templatemo.com/tm-455-visual-admin
    -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>  
    <!-- Left column -->
    <div class="templatemo-flex-row">
      <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
          <div class="square"></div>
          <h1>APP-LIV</h1>
          <div class="square"></div>        </header>
        
        <?php include("admin_com_menu.php"); ?>

       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            
            
            <center><p><h4 style="color:black;" class="margin-bottom-10">MON PROFIL</h4></p></center>
            <hr>
            <hr>
            <center><p><strong>NOM</strong> : <i style="color:green;"><?php echo $_SESSION["nom"]; ?></i></p></center>
        
            <center><p><strong>PRENOM</strong> : <i style="color:green;"><?php echo $_SESSION["prenom"]; ?></i></p></center>
            
            <center><p><strong>TELEPHONE</strong> : <i style="color:green;"><?php echo $_SESSION["tel"]; ?></i></p></center>
            
            <center><p><strong>ADRESSE</strong> : <i style="color:green;"><?php echo $_SESSION["adresse"]; ?></i></p></center>
            
            
           
            <hr>
            <hr>
            <center><a href="admin_com_modification.php" class="templatemo-edit-btn" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></center>
     

          </div>
            
                                       
        
          <footer class="text-right">
           <?php include ("foot.php"); ?>
          </footer>         
        </div>
      </div>
    </div>
    
    <!-- JS -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
    
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>