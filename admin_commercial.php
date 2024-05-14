<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}

$compt=0;
 //connexion a la base de donnée
  $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');

    //recuperation dans la base de donnée
    $recup =$bdd->query("select * from commerciaux where identifiant='".$_SESSION['id']."' ");
    //$recup->bindColumn('IDLIV',$IDLIV);
    if($result=$recup->fetchObject()){
      //var_dump($result);
      $IDCOM=$result->IDCOM;
      $nom=$result->nom_com;
      $prenom=$result->prenom_com;
      $tel=$result->tel_com;
      $adresse=$result->adresse_com;
      
    }

    //enregistrement dans des session
    $_SESSION['codecom']=$IDCOM;
    $_SESSION['nom']=$nom;
    $_SESSION['prenom']=$prenom;
    $_SESSION['tel']=$tel;
    $_SESSION['adresse']=$adresse;
   

    //verification des livraisons non faite appartenant au livreur connecté abonné
   /*
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
    $verif->bindColumn('temps_colis_livre',$jour);*/


    /* //verification des livraisons non faite appartenant au livreur connecté non abonné
    $verification =$bdd->query("select * from validation_com where IDCLI=".$IDCLI);
    //decompte 
    $compteur=$verification->rowCount(); */
    /*
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
*/
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
           
         <?php include("admin_com_menu.php"); ?>

       
        <div class="templatemo-content-container">
       
            <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10"> <?php echo 'BIENVENU SUR VOTRE BUREAU Mr.'.$_SESSION["nom"].' '.$_SESSION["prenom"] ; ?></h2></center>
            <hr>
            <p class="text-center text-uppercase">Vous avez la possibilité d'ajouter un client ou livreur</p>
            <center><a href="admin_com_insert_cli.php" class="templatemo-edit-btn">nouveau client</a> <a href="admin_com_insert_liv.php" class="templatemo-edit-btn">nouveau livreur</a></center>
            
             
              <hr>
         
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
    <script>

     

    </script>
    
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>