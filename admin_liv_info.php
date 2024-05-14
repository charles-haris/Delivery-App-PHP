<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}
include('connection.php');
$bdd = connect();

include('admin_abonn_paie_attente.php');
$verif =$bdd->query("select * from livraison where Statut!='Livré' and Annuler='non' and IDLIV=".$_SESSION['codeliv']);
        //decompte 
        $compt1=$verif->rowCount();
    
        //verification des livraisons non faite appartenant au livreur connecté non abonné
        $verification =$bdd->query("select * from validation_com where IDLIV=".$_SESSION['codeliv']);
        //decompte 
        $compteur=$verification->rowCount();
        //recupération du crédit
        $credit=$_SESSION['credit'];

        $verifier=$bdd->query("SELECT * from reglement_inter where id_livreur='".$_SESSION['codeliv']."' ");

$nbre=$verifier->rowCount();

$recup =$bdd->query("select * from livreur where identifiant='".$_SESSION['id']."' ");
    //$recup->bindColumn('IDLIV',$IDLIV);
    if($result=$recup->fetchObject()){
      //var_dump($result);
      $IDLIV=$result->IDLIV;
      $nomliv=$result->nomliv;
      $prenom=$result->prenomliv;
      $tel=$result->telliv;
      $cni=$result->cni;
      $type=$result->typeVehicule;
      $imatricule=$result->imatVehicule;
      $capacite=$result->capacite;
      $date_validite=$result->Date_validite;
      $type_permis=$result->type_permis;
      $numero_permis=$result->Numero_permis;
      
    }
    //enregistrement dans des session
    $_SESSION['codeliv']=$IDLIV;
    $_SESSION['nomliv']=$nomliv;
    $_SESSION['prenomliv']=$prenom;
    $_SESSION['telliv']=$tel;
    $_SESSION['cni']=$cni;
    $_SESSION['typeV']=$type;
    $_SESSION['imatricule']=$imatricule;
    $_SESSION['capacite']=$capacite;
    $_SESSION['date_validite']=$date_validite;
    $_SESSION['type_permis']=$type_permis;
    $_SESSION['numero_permis']=$numero_permis;





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
           <li><?php include('admin_liv_aff_credit.php'); ?></li>
                       <li><a href="https://t.me/joinchat/SAKrk-AzDHlhMWI0" style="color:red;"><i class="fa fa-telegram fa-fw"></i>Acceder a la communaute</a></li>


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
              <li><a href="admin_liv_info.php"  class="active">Voir mes infos</a></li>
                <li><a href="admin_liv_historique.php">historique</a></li>
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
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            
            <center><p><h4 style="color:black;" class="margin-bottom-10">MON PROFIL</h4></p></center>
            <hr>
            <hr>
            
            <center><p><strong>NOM</strong> : <i style="color:green;"><?php echo $_SESSION["nomliv"]; ?></i></p></center>
        
            <center><p><strong>PRENOM</strong> : <i style="color:green;"><?php echo $_SESSION["prenomliv"]; ?></i></p></center>
            
            <center><p><strong>TELEPHONE</strong> : <i style="color:green;"><?php echo $_SESSION["telliv"]; ?></i></p></center>
            
            <center><p><strong>CNI</strong> : <i style="color:green;"><?php echo $_SESSION["cni"]; ?></i></p></center>
            <hr>
            <hr>
            <center><p><h4 style="color:black;" class="margin-bottom-10">INFO SUR MON VEHICULE</h4></p></center>
            <hr>
            <hr>
            
            <center><p><strong>TYPE DE VEHICULE</strong> : <i style="color:green;"><?php echo $_SESSION["typeV"]; ?></i></p></center>
            
            <center><p><strong>IMATRICULATION</strong> : <i style="color:green;"><?php echo $_SESSION["imatricule"]; ?></i></p></center>
            
            <center><p><strong>CAPACITE</strong> : <i style="color:green;"><?php echo $_SESSION["capacite"]; ?></i></p></center>
            
            <center><p><strong>DATE DE VALIDITE</strong> : <i style="color:green;"><?php echo $_SESSION["date_validite"]; ?></i></p></center>
            
            <center><p><strong>TYPE DE PERMIS</strong> : <i style="color:green;"><?php echo $_SESSION["type_permis"]; ?></i></p></center>
            
            <center><p><strong>NUMERO DE PERMIS</strong> : <i style="color:green;"><?php echo $_SESSION["numero_permis"]; ?></i></p></center>
            <hr>
            <hr>
            <center><a href="admin_liv_modification.php" class="templatemo-edit-btn" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></center>
            
          
             
           
            
              
           
            

           




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
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script BOUASSE BU KOMBILE CHARLES-HARIS -->
  </body>
</html>