<?php
session_start();
//error_reporting(-1);
//ini_set('display_errors',false);


if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}


 //connexion a la base de donnée
		 $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');
 //$sql="select duree,Tarif from abonnement where id_liv='".$_SESSION['codeliv']."' ";
 $recup1=$bdd->query("select id,duree,Tarif from abonnement where id_liv='".$_SESSION['codeliv']."' and actif='encours' ");
 $recup1->bindColumn('duree',$dure);
 $recup1->bindColumn('Tarif',$prix);
 $recup1->bindColumn('id',$id);



 while($recup1->fetch()){
  $_SESSION['duree']=$dure;
  $_SESSION['tarif']=$prix;
  $_SESSION['identifie']=$id;
 }



if(isset($_POST['payer'])){

    //en cours d'abonnement ou non
    $variabl =$bdd->query("select * from abonnement where id_liv='".$_SESSION['codeliv']."' and actif='encours
    ' ");

    $variabl->bindColumn('id',$id);

  
    $nbr_encours=$variabl->rowCount();

    while($variabl->fetch()){
      $id=$id;
    }

    //echo $id;


  $requete = $bdd->prepare('INSERT INTO reglement (id_livreur,type,prix,tel_transf,id_abonn)
  values(:id_livreur,:type,:prix,:tel_transf,:id_abonn)');
      
  $requete->bindParam(':id_livreur', $IDL);
  $requete->bindParam(':type', $type);
  $requete->bindParam(':prix', $tarif);
  $requete->bindParam(':tel_transf', $tel);
  $requete->bindParam(':id_abonn', $idAbonn);

  

  $IDL=$_SESSION['codeliv'];
  $type="Abonnement";
  $tel=strtoupper(htmlspecialchars($_POST['tel']));
  //$tel=$_POST['tel'];
  $tarif=$_SESSION['tarif'];
  $idAbonn=$_SESSION['identifie'];
   
   

   
  

  if 
 ($requete->execute()) 
  {
  //echo"ok";
  //header('location:admin_liv_abonne_attente.php'); 
  
    ?>
  <script>
                document.location.href="admin_liv_abonne_attente.php";

  </script>

  <?php
 }


}

//if we click on button annuler
if($_POST['annuler']){
$delete=$bdd->query("delete from abonnement where id=".$_SESSION['identifie']);
header('location:admin_liv_abonnement.php');   

$ab=$bdd->query("UPDATE livreur set Abonne='non' WHERE IDLIV='".$_SESSION['codeliv']."' ");


}

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
    <title>TOUTLIVRER</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
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
        <style>
    .templatemo-red-button {
	border-radius: 2px;
	padding: 10px 30px;
	text-transform: uppercase;
	transition: all 0.3s ease;
}
.templatemo-red-button {
	background-color: #e74a3b;
	border: none;	
	color: white;	
}
.templatemo-red-button:hover {	background-color: #e02d1b; }
  </style>
     
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
            </li>            <li><a href="deconnect.php"><i class="fa fa-eject fa-fw"></i>Deconnexion</a></li>
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
                <li><a href="admin_liv_historique.php">historique</a></li>
                <li><a href="" class="active">Règlement</a></li>
                <?php if($compt1>=1){ ?>
                  <span class="badge"><?php echo $compt1;  ?>+</span>
                <?php }elseif($compteur>=1){ ?>
                  <span class="badge"><?php echo $compteur;  ?>+</span>
                <?php }?>
                
              </ul>  
            </nav> 
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Règlement de l'abonnement choisi</h2></center>
            <hr>


            <div class="templatemo-flex-row flex-content-row">
           
          
           

            <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative templatemo-content-img-bg">
              <!--<img src="images/sunset-big.jpg" alt="Sunset" class="img-responsive content-bg-img">-->
              <h2 class="templatemo-position-relative black-text text-center">Votre choix : Abonnement de <?php echo  $_SESSION['duree']; ?></h2>
              <hr>

              
  
              <br/>
              <br/>

              <h3 class="templatemo-position-relative black-text text-center">Vous avez choisi un abonnement de <?php echo  $_SESSION['duree']; ?> . Pour régler vos frais d'abonnement, vous devez effectuer un versement de <?php echo  $_SESSION['tarif']; ?>FcFa par Orange Money au 78 058 79 29 </h3>
              
              <br/>
              <br/>

              <form method="post"> 
              <center><button type="submit" name="annuler" value="ok" class="templatemo-red-button">Annuler</button>  </center>
              </form>
              <hr>
              <h3 class="templatemo-position-relative black-text text-center">Si le depôt a été effectué :</h3>
              <br/>
              <h3 class="templatemo-position-relative black-text text-center">Veuillez saisir le numéro de téléphone avec lequel le dépôt a été effectué :</h3>
             <br/>

              <form method="post" class="templatemo-login-form">
                    <div class="form-group">
                      <input type="tel" class="form-control" name="tel" id="inputEmail" placeholder="Entrer le numero de téléphone" pattern="[0-9]{9}"  required>
                    </div>
                    <div class="form-group">
                      <center><button type="submit" name="payer" value="ok" class="templatemo-blue-button">Abonnement Payé</button></center>
                    </div>
                  </form>

              <br/>
              

              

                            
            </div>
          </div>
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
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>