<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}


 //connexion a la base de donnée
		 $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');
    //recuperation dans la base de donnée
   /*  $recup =$bdd->query("select * from client where identifiant='".$_SESSION['id']."' ");
    //$recup->bindColumn('IDLIV',$IDLIV);
    if($result=$recup->fetchObject()){
      //var_dump($result);
      $IDCLI=$result->IDCLI;
      $nom=$result->nom;
      $prenom=$result->prenom;
      $tel=$result->tel;
      $societe=$result->societe;
      $adresse=$result->adresse;
      $mail=$result->mail;
      $datenaiss=$result->datenaiss;
    }

    //enregistrement dans des session
    $_SESSION['codecli']=$IDCLI;
    $_SESSION['nom']=$nom;
    $_SESSION['prenom']=$prenom;
    $_SESSION['tel']=$tel;
    $_SESSION['societe']=$societe;
    $_SESSION['adresse']=$adresse;
    $_SESSION['mail']=$mail;
    $_SESSION['datenaiss']=$datenaiss; */

    //verification des livraisons non faite appartenant au livreur connecté abonné
    $verif =$bdd->query("select * from livraison where IDCLI=".$_SESSION['codecli']." and Statut='Non Livré' ");
    //decompte 
    $compt=$verif->rowCount();

    $verif->bindColumn('IDCOLIS',$IDCOLIS);
    $verif->bindColumn('typescolis',$typescolis);
    $verif->bindColumn('poids',$poids);
    $verif->bindColumn('Description',$Description);
    $verif->bindColumn('adresseOrig',$adresseOrigine);
    $verif->bindColumn('adresseLivraison',$adresseLivraison);
    $verif->bindColumn('Statut',$Statut);

    /* //verification des livraisons non faite appartenant au livreur connecté non abonné
    $verification =$bdd->query("select * from validation_com where IDCLI=".$IDCLI);
    //decompte 
    $compteur=$verification->rowCount(); */

    //abonné ou pas
    $abonn =$bdd->query("select * from client where identifiant='".$_SESSION['id']."' and Abonne='oui' ");
    $nbr=$abonn->rowCount();

    if($nbr<1){
      $Abonne="M'ABONNER";
      $href="";
    }else{
      $Abonne="SE DESABONNER";
      $href="";
    }

    



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
    <meta http-equiv="Refresh" content="60"; url="admin_cli_com_en_cours.php">

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
          <div class="square"></div>

        </header>
            
        <!-- Search box -->
       
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
          </div>
        <nav class="templatemo-left-nav">          
           <ul>
                           <li><a href="https://t.me/joinchat/SAKrk-AzDHlhMWI0" style="color:red;"><i class="fa fa-telegram fa-fw"></i>Acceder a la communaute</a></li>

            <li><a href="admin_cli_com_en_cours.php" class="active"><i class="fa fa-home fa-fw"></i>Mes Commandes<?php if($compt>=1){ ?>
    <span class="badge"><?php echo $compt;  ?>+</span>
    <?php } ?></a></li>
            <li><a href="admin_client.php" ><i class="fa fa-bar-chart fa-fw"></i>Mon historique</a></li>
                        <li><a href="tableau_prix.php"><i class="fa fa-money fa-fw"></i>
            Table Prix Livraison</a></li>
            <li><a href=""><i class="fa fa-database fa-fw"></i>Droit et Obligation</a></li>
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
                <li><a href="admin_cli_info.php" >Mon profil</a></li>
                <li><a href="page_livraison.php">Commander</a></li>
    <?php if($nbr<1){ ?><li><a href="deconnect.php">Deconnexion</a></li><?php } ?>
    
                
              </ul>  
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
        <?php if($compt>0){  ?>
          
                  <?php
                        while($verif->fetch()){ ?>

<div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Commande de <span class="badge"><?php echo $Description; ?></span></h2></center>
            <hr>
            <p class="text-center text-uppercase">Vous avez effectué une commande pour <strong><?php echo $adresseOrigine ?></strong> 
        jusqu'à <strong><?php echo $adresseLivraison ?></strong> , votre colis a un poids <strong><?php echo $poids ?></strong>. 
        </p>
            <?php 
            
            $test =$bdd->query("select * from livraison where IDCLI=".$_SESSION['codecli']." and Statut='Non Livré' and IDLIV is null and IDCOLIS= ".$IDCOLIS);
            $nb=$test->rowCount();

            if($nb<1){
                $mot="<p style='color:green;'>Votre commande a été prise en charge</p>";

            
            }else{
                $mot="<p style='color:red;'>Votre commande est en cours</p>";

               }?>
              <hr>

              <center><?php echo $mot; ?> </center>
              <center><p><i>NB: Pour annuler ou modifier la commande veillez nous contacter au : +221 76 572 72 03</i></p></center>
         
          </div>
                   
                
                    <?php  }?>
                 
                        <?php  }else {?>

                          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Mon Historique <?php echo $_SESSION["id"]; ?></h2></center>
            <hr>
            <p class="text-center text-uppercase">Vous n'avez aucune commande en cours</p>
            <center><button href="admin_livreur.php" class="templatemo-edit-btn">nouvelle commande</button></center>
             
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
    <script>

     

    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>