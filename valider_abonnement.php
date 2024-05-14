<?php
session_start();
//error_reporting(-1);
//ini_set('display_errors',false);


if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}

$sql="select nomliv,prenomliv,duree,IDLIV from reglement,livreur,abonnement where abonnement.id_liv=livreur.IDLIV and reglement.id_livreur=livreur.IDLIV  and abonnement.id=reglement.id_abonn and actif='encours' and type='Abonnement' ";



 //connexion a la base de donnée
$bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');
 $requete=$bdd->query($sql);

 $requete->bindColumn('nomliv',$nomliv);
 $requete->bindColumn('prenomliv',$prenomliv);
 $requete->bindColumn('duree',$duree);
 $requete->bindColumn('IDLIV',$idliv);

 $nbr_val=$requete->rowCount();


/*
Ce qui se passe quand on click sur le bouton valider

*/
 if(isset($_POST['valider'])){

  //selection de id de l'abonnement a valider par les attribut actif et id_liv
  $requete2=$bdd->query("select id from abonnement where actif='encours' and id_liv='".$_POST['valider']."' ");
  $requete2->bindColumn('id',$id);

  while($requete2->fetch()){
    $id=$id;
  }
 
  //modification de l'attribut actif dans la table abonnement pour rendre l'abonnement actif
  $actif=$bdd->query("UPDATE abonnement set actif='oui' WHERE id='".$id."' ");

  //modification dans la table livreur de l'attribut Abonne pour passer de non abonné à abonné
  $abonn=$bdd->query("UPDATE livreur set Abonne='oui' WHERE IDLIV='".$_POST['valider']."' ");

  header("location:client_liste.php");

 }


/*
Ce qui se passe quand on click sur le bouton refuter

*/
 if(isset($_POST['refuter'])){

  //selection de l'id de l'abonnement du livreur qui indique avoir payer
  $requete2=$bdd->query("select id from abonnement where actif='encours' and id_liv='".$_POST['refuter']."' ");
  $requete2->bindColumn('id',$id);

  while($requete2->fetch()){
    $id=$id;
  }

  //suppression de l'abonnement du livreur qui indique avoir payer
  $deleteAbon=$bdd->query("delete from abonnement where id='".$id."' and actif='encours' ");

  // selection du règlement de l'abonnement qui est sencé être payé
  $requete3=$bdd->query("select id from reglement where id_abonn='".$id."' ");
  $requete3->bindColumn('id',$id_regle);

  while($requete3->fetch()){
    $id_regle=$id_regle;
  }

  //suppression du règlement de l'abonnement qui est sencé être payé
  $deleteRegle=$bdd->query("delete from reglement where id='".$id_regle."' ");

  header("location:client_liste.php");
   
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
    <meta http-equiv="Refresh" content="60"; url="valider_abonnement.php">

    <!-- 
    Visual Admin Template
    https://templatemo.com/tm-455-visual-admin
    -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styleperso.css" rel="stylesheet">
    
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
          <h1>TOUTLIVRER</h1>
        </header>
       <!--  <div class="profile-photo-container">
          <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
          <div class="profile-photo-overlay"></div>
        </div> -->      
        <!-- Search box -->
        <form class="templatemo-search-form" role="search">
          <div class="input-group">
              <button type="submit" class="fa fa-search"></button>
              <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">           
          </div>
        </form>
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">          
        <ul>
        <li><a href="livreur_liste.php" ><i class="fa fa-home fa-fw"></i>Livreur</a></li>
            <li><a href="client_liste.php" ><i class="fa fa-bar-chart fa-fw"></i>Client</a></li>
            <li><a href="livraison_liste.php"><i class="fa fa-database fa-fw"></i>Livraison</a></li>
                         <li><a href="commercial_liste.php"><i class="fa fa-bar-chart fa-fw"></i>Commercial</a></li>

            <li><a href="valider_credit.php"><i class="fa fa-eject fa-fw"></i>Valider Credit<?php if($_SESSION['notification_credit']>=1){ ?>
              <span class="badge"><?php echo $_SESSION['notification_credit'];  ?>+</span>
            <?php } ?></a>
             </li>
            <li><a href="valider_abonnement.php" class="active"><i class="fa fa-eject fa-fw"></i>Acc / Ref<?php if($_SESSION['notification_abonnement']>=1){ ?>
              <span class="badge"><?php echo $_SESSION['notification_abonnement'];  ?>+</span>
            <?php } ?></a>
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
                <li><a href="index.php"  lass="active">Catégorie</a></li>
                <li><a href="sessionliv.php">Controle</a></li>
                <li><a href="encoursliv.php">En cours</a></li>
                <li><a href="">Infos Livreur</a></li>
              </ul>  
            </nav> 
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Validation du Règlement d'un abonnement</h2></center>
            <hr>

            <?php if($nbr_val>0){ ?>
           <?php while($requete->fetch()){ ?>
            <div class="templatemo-flex-row flex-content-row">
           
          
           

            <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative templatemo-content-img-bg">
              <!--<img src="images/sunset-big.jpg" alt="Sunset" class="img-responsive content-bg-img">-->
              <h2 class="templatemo-position-relative black-text text-center">livreur concerné : <?php echo $nomliv." ".$prenomliv; ?></h2>
              <hr>

              <br/>
              <br/>
              
                            <?php
              $reqtel=$bdd->query("select tel_transf from reglement,abonnement where reglement.id_abonn=abonnement.id and id_livreur=".$idliv." and actif='encours' and type='Abonnement' ");

                  $reqtel->bindColumn('tel_transf',$tel1);
                  while($reqtel->fetch()){
                    $tel1=$tel1;
                  }
                  $rest1="";
                  $rest2="";
                  $rest3="";
                  $rest4="";
                  
                  $rest1 = substr($tel1, 0, 2);
                  $rest2 = substr($tel1, 2, 3);
                  $rest3 = substr($tel1, 4, 2);
                  $rest4 = substr($tel1, 6, 2);


  
  ?>

              <h3 class="templatemo-position-relative black-text text-center">Le livreur nommé <?php echo $nomliv." ".$prenomliv; ?> qui a pour code <?php echo $idliv; ?> affirme avoir payé un abonnement d'une durée de <?php echo $duree; ?> par Orange Money au  <?php echo $rest1." ".$rest2." ".$rest3." ".$rest4; ?> </h3>
              
              <br/>
              
            
              <hr>
              <h3 class="templatemo-position-relative black-text text-center">Vérifier la véracité du contenu du message ci-dessus pour valider ou refuter l'abonnement:</h3>
              <br/>
              
             <br/>

              <form method="post" class="templatemo-login-form">
                    <div class="form-group">
                      <center><button type="submit" name="valider" value="<?php echo $idliv; ?>" class="templatemo-blue-button">Valider</button> 
                    
                      <button type="submit" name="refuter" value="<?php echo $idliv; ?>" class="templatemo-white-button ">Refuter</button>
                    </center>
                    </div>
                  </form>

              <br/>

            </div>
          </div>

           <?php } ?>
           
           <?php  }else {?>

            <div class="templatemo-flex-row flex-content-row">
           
          
           

            <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative ">
              <!--<img src="images/sunset-big.jpg" alt="Sunset" class="img-responsive content-bg-img">-->
           
              
            <br/>
            
              
              <h3 class="templatemo-position-relative black-text text-center"> Il n'y a aucun règlement d'abonnement à effectuer</h3>
             
              <br/>

            </div>
          </div>


          <?php } ?>

<!-- tableau zone 1 -->
        
       
       
         </div>
         </div>

         
            
          <footer class="text-right">
           <?php include ("foot.php"); ?>
          </footer>         
        </div>
      </div>
    </div>
    
    <!-- JS -->
    <script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
    <script>
     
    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo REALISER PAR BOUASSE BU KOMBILE Script -->

  </body>
</html>
