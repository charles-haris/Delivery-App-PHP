<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}

$compt=0;
 //connexion a la base de donnée
  $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');

    //recuperation dans la base de donnée
    $recup =$bdd->query("select * from client where identifiant='".$_SESSION['id']."' ");
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
    $_SESSION['datenaiss']=$datenaiss;

    //verification des livraisons non faite appartenant au livreur connecté abonné
    $verif =$bdd->query("select livraison.IDCOLIS,typescolis,poids,Description,adresseOrig,adresseLivraison,Statut,temps_colis_livre from livraison,Temps where IDCLI=".$_SESSION['codecli']." and livraison.IDCOLIS=Temps.IDCOLIS ");
    //decompte 
    $compt=$verif->rowCount();

    $verif->bindColumn('IDCOLIS',$IDCOLIS);
    $verif->bindColumn('typescolis',$typescolis);
    $verif->bindColumn('poids',$poids);
    $verif->bindColumn('Description',$Description);
    $verif->bindColumn('adresseOrig',$adresseOrigine);
    $verif->bindColumn('adresseLivraison',$adresseLivraison);
    $verif->bindColumn('Statut',$Statut);
    $verif->bindColumn('temps_colis_livre',$jour);


    /* //verification des livraisons non faite appartenant au livreur connecté non abonné
    $verification =$bdd->query("select * from validation_com where IDCLI=".$IDCLI);
    //decompte 
    $compteur=$verification->rowCount(); */
    $nbr=0;
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

    $decompt=0;
    $verifions =$bdd->query("select * from livraison where IDCLI=".$_SESSION['codecli']." and Statut='Non Livré' ");
    //decompte 
    $decompt=$verifions->rowCount();

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
    <meta http-equiv="Refresh" content="60"; url="admin_client.php">
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
            <li><a href="https://t.me/joinchat/SAKrk-AzDHlhMWI0" style="color:red;"><i class="fa fa-telegram" aria-hidden="true"></i>Acceder a la communaute</a></li>
            <li><a href="admin_cli_com_en_cours.php" ><i class="fa fa-home fa-fw"></i>Commandes en cours</a></li>
            <li><a href="admin_client.php" class="active"><i class="fa fa-bar-chart fa-fw"></i>Mon historique</a></li>
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
    <?php if($decompt>=1){ ?>
    <span class="badge"><?php echo $decompt;  ?>+</span>
    <?php } ?>
                
              </ul>  
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
        <?php if($compt>0){  ?>
          
                      
                  <?php
                        while($verif->fetch()){ ?>
                        
                        <div class="templatemo-content-widget white-bg">
                        
            <center><h2 class="margin-bottom-10">
                <?php 
                
                if($jour==null){
                echo 'LIVRAISON NON EFFECTUÉE'; 
                }else{
                 echo 'LIVRAISON DU '.$jour; 
                    
                }
                 
                 ?>
                
                
                </h2></center>
            <hr>
            
            
  
              
                <center>Nom du client : <i style="color:green;"><?php print $nom; ?></i></center>
                <center>Type de colis : <i style="color:green;"><?php print $typescolis; ?></i></center>
                <center>Poids : <i style="color:green;"><?php print $poids; ?></i></center>
                <center>Adresse d'origine : <i style="color:green;"><?php print $adresseOrigine; ?></i></center>
            

                <center>Adresse de livraison : <i style="color:green;"><?php print $adresseLivraison; ?></i></center>
                <center>description du colis : <i style="color:green;"><?php print $Description; ?></i></center>
                <center>Etat : <strong style="color:red;"><?php print $Statut; ?></strong></center>
                
                
            
              <hr>
         
          </div>
                        

                    <?php  }?>
            
                        <?php  }else {?>

                          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Mon Historique <?php echo $_SESSION["id"]; ?></h2></center>
            <hr>
            <p class="text-center text-uppercase">Vous n'avez effectué aucune commande</p>
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