<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}


 //connexion a la base de donnée
  $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');
  include('admin_abonn_paie_attente.php');
    
    $compt=0;
    //recuperation dans la base de donnée
    $rete =$bdd->query("SELECT IDCOLIS,nom,typescolis,poids,volume,adresseOrig,adresseLivraison,nbColis,Statut,Description FROM livraison,client where livraison.IDCLI=client.IDCLI and IDLIV=".$_SESSION['codeliv']." ");
    $compt=$rete->rowCount();
    //selection des champs et attribution a des variables
        $rete->bindColumn('IDCOLIS',$id);
        $rete->bindColumn('nom',$NOM);
        $rete->bindColumn('typescolis',$TYPE);
        $rete->bindColumn('poids',$POIDS);
        $rete->bindColumn('volume',$VOLUME);
        $rete->bindColumn('adresseOrig',$ADRESS);
        $rete->bindColumn('adresseLivraison',$ADRESSLIV);
        $rete->bindColumn('nbColis',$NB);
        $rete->bindColumn('Statut',$STATUT);
        $rete->bindColumn('Description',$DESCR);

        $verif =$bdd->query("select * from livraison where Statut!='Livré' and Annuler='non' and IDLIV=".$_SESSION['codeliv']);
        //decompte 
        $compt1=$verif->rowCount();
    
        //verification des livraisons non faite appartenant au livreur connecté non abonné
        $verification =$bdd->query("select * from validation_com where IDLIV=".$_SESSION['codeliv']);
        //decompte 
        $compteur=$verification->rowCount();

        $verifier=$bdd->query("SELECT * from reglement_inter where id_livreur='".$_SESSION['codeliv']."' ");

$nbre=$verifier->rowCount();

        
       


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>e-livraison</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <meta http-equiv="Refresh" content="60"; url="admin_liv_historique.php">
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
    
        <!-- Search box -->
        
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
          </div>
        <nav class="templatemo-left-nav">          
           <ul>
                           <li><a href="https://t.me/joinchat/SAKrk-AzDHlhMWI0" style="color:red;"><i class="fa fa-telegram fa-fw"></i>Acceder a la communaute</a></li>

            <li> <?php include('admin_liv_aff_credit.php'); ?> </li>
            <li><a href="admin_livreur.php" ><i class="fa fa-bar-chart fa-fw" ></i>Livraison(s) disponible(s)</a></li>
                        <li><a href="tableau_prix.php"><i class="fa fa-money fa-fw"></i>
            Table Prix Livraison</a></li>
            <li><a href="" class=""><i class="fa fa-home fa-fw"></i>Droit et obligation</a></li>
            <li>
            <?php if($nbre>0){ ?>
            <a href="admin_liv_credit_attente.php"><i class="fa fa-database fa-fw"></i>En Attente</a>

            <?php }else{ ?>
            <a href="admin_liv_crediter.php"><i class="fa fa-database fa-fw"></i>crediter compte</a>
            <?php } ?>
            </li>            
            <li><a href="deconnect.php"><i class="fa fa-eject fa-fw"></i>Deconnexion</a></li>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="admin_liv_info.php"  >Voir mes infos</a></li>
                <li><a href="admin_liv_historique.php" class="active">historique</a></li>
                <li><?php include('admin_abonn_paie_attente_lien.php'); ?></li>
                <?php if($compt1>=1){ ?>
                  <span class="badge"><?php echo $compt1;  ?>+</span>
                <?php }elseif($compteur>=1){ ?>
                  <span class="badge"><?php echo $compteur;  ?>+</span>
                <?php }?>
                
              </ul>  
            </nav> 
          </div>
        </div>
        <br/>
        <!-- <div class="templatemo-content-widget ">
         <form >
          
              
              <input type="text" class="form-control" placeholder="Search" name="recherche">  

          
        </form>
        </div> -->
        
       <?php if($compt>0){ ?>
        <div class="templatemo-content-container">
       
           <?php while ($rete->fetch()){ ?>

           <div class="templatemo-content-widget white-bg">
                        
            <center><h2 class="margin-bottom-10">jour</h2></center>
            <hr>
            <p class="text-center text-uppercase">info sur la livraison n°<?= " 00COL".$id; ?> </p>

              
                <center>Nom du client :<i style="color:green;"> <?php print $NOM; ?></i></center>
                <center>Type de colis : <i style="color:green;"><?php print $TYPE; ?></i></center>
                <center>Adresse d'origine : <i style="color:green;"><?php print $ADRESS; ?></i></center>
                
                <center>Adresse de livraison : <i style="color:green;"><?php print $ADRESSLIV; ?></i></center>
                <center>description du colis : <i style="color:green;"><?php print $DESCR; ?></i></center>
                <center>Etat : <strong style="color:red;"><?php print $STATUT; ?></strong></center>
                
                
            
              <hr>
         
          </div>
                              <?php  }?>

          
                  <?php }else{ ?>
                    <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Info Livreur <?php echo $_SESSION["id"]; ?></h2></center>
            <hr>
            <p class="text-center text-uppercase">Vous n'avez aucune livraison effectuée à votre compte</p>
            <center>
            <a href="admin_livreur.php?" class="templatemo-edit-btn bg-secondary" >commande(s) disponible(s)</a>
            </center>
             
              <hr>
         
          </div>
                                       
        

                  <?php } ?>
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