<?php
session_start();


if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}
/*
include_once "../programers/program.confenv.php";


  if(isset($_POST['valider']))  
  {
    Include_once "../programers/program.identity.php";

    $veri= new Identifiant();

  if(!$veri->verifieChaine($_POST['nom'],'Nom'))
  {
    $nom=input($_POST['nom']);
  }else {
    $veri->verifieChaine($_POST['nom'],'Nom');
  }

  if(!$veri->verifieChaine($_POST['prenom'],'Prenom'))
  {
    $prenom=input($_POST['prenom']);
  }else {
    $veri->verifieChaine($_POST['prenom'],'Prenom');
  }

  if(!$veri->verifieChaine($_POST['societe'],'Societe'))
  {
    $societe=input($_POST['societe']);
  }else {
    $veri->verifieChaine($_POST['societe'],'Societe');
  
  if(!$veri->verifieChaine($_POST['cni'],'Cni'))
  {
    $cni=input($_POST['cni']);
  }else {
    $veri->verifieChaine($_POST['cni'],'Cni');
  }
  if(!$veri->verifieChaine($_POST['tel'],'Tel'))
  {
    $tel=input($_POST['tel']);
  }else {
    $veri->verifieChaine($_POST['tel'],'Tel');
  }
  if(!$veri->verifieChaine($_POST['adresse'],'adresse'))
  {
    $adresse=input($_POST['adresse']);
  }else {
    $veri->verifieChaine($_POST['adresse'],'adresse');
  }
  if(!$veri->verifieChaine($_POST['mail'],'Mail'))
  {
    $mail=input($_POST['mail']);
  }else {
    $veri->verifieChaine($_POST['mail'],'Mail');
  }
  if(!$veri->verifieChaine($_POST['date'],'Date'))
  {
    $date=input($_POST['date']);
  }else {
    $veri->verifieChaine($_POST['date'],'Date');
  }

 
  if (!$veri->verifieChaine($_POST['nom'],'Nom') && !$veri->verifieChaine($_POST['prenom'],'Prenom')  && !$veri->verifieChaine($_POST['email'],'Email')
    &&  !$veri->verifieChaine($_POST['societe'],'Societe') && !$veri->verifieChaine($_POST['cni'],'Cni') && !$veri->verifieChaine($_POST['tel'],'Tel') && !$veri->verifieChaine($_POST['adresse'],'Adresse') && !$veri->verifieChaine($_POST['mail'],'Mail') && !$veri->verifieChaine($_POST['date'],'Date'))
  {
    $sess=$_SESSION['Pseudo'];
    $con = new PDO ("mysql:host=localhost;dbname=neldam","root","");
    $rete=$con->query("DELETE FROM  confirmenvoie WHERE Client='$sess'");
    serializecon();
    header("loacation:confirmenvoie.php");
  }

}
*/

/* 

if (isset($_POST["okay"]))
{
    serializeInsc();
    header("location:../view/client.php");

} */

include('connection.php');
$bdd = connect();
$reponse="";

if(isset($_POST["envoi"]))
{

  include('livraison_prix.php');

  //$prix_command;

  //$selectIdcolis=$bdd->query("SELECT IDCOLIS from livraison where IDCLI='".$IDCLI."' and IDLIV='".$IDLIV."' and typescolis='".$typescolis."' and poids='".$poids."' and volume='".$volume."' and adresseOrig='".$adresseOrig."' and adresseLivraison='".$adresseLivraison."' and nbColis='".$nbColis."' and Description='".$Description."' and TypeVehicule='".$TypeVehicule."' ");
  $selectId=$bdd->query("SELECT max(IDCOLIS) as id from livraison");

  $selectId->bindColumn('id',$id_col);


  while($selectId->fetch()){
    $id_col=$id_col+1;
  }

  //echo " Le prix est : ".$prix_command." et le code est : ".$id_col;
  $insertprix=$bdd->query("INSERT INTO prix_commande (ID_COLIS,prix_comm) values ('".$id_col."','".$prix_command."')");
  
    
    //$_SESSION['id_pers_conn']=1;
/*
if(!empty($_POST["REGLEMENT"])){*/
$stmt = $bdd->prepare('INSERT INTO livraison (IDCLI,IDLIV,typescolis,poids,volume,adresseOrig,adresseLivraison,nbColis,Description,TypeVehicule)values(:IDCLI,:IDLIV,:typescolis,:poids,:volume,:adresseOrig,:adresseLivraison,:nbColis,:Description,:TypeVehicule)');
    
        $stmt->bindParam(':IDCLI', $IDCLI);
        $stmt->bindParam(':IDLIV', $IDLIV);
        $stmt->bindParam(':typescolis', $typescolis);
        $stmt->bindParam(':poids', $poids);
        $stmt->bindParam(':volume', $volume);
        $stmt->bindParam(':adresseOrig', $adresseOrig);
        $stmt->bindParam(':adresseLivraison', $adresseLivraison);
        $stmt->bindParam(':nbColis', $nbColis);
        $stmt->bindParam(':Description', $Description);
        $stmt->bindParam(':TypeVehicule', $TypeVehicule);
   

            
        //  $IDCLI=$_SESSION['id_pers_conn'];
        if(isset($_POST["IDCLI"])) $IDCLI=strtoupper(htmlspecialchars($_POST["IDCLI"]));
        if(isset($_POST["IDLIV"])) $IDLIV=strtoupper(htmlspecialchars($_POST["IDLIV"]));
        if(isset($_POST["typescolis"]))  $typescolis=strtoupper(htmlspecialchars($_POST["typescolis"]));
        if(isset($_POST["poids"])) $poids=strtoupper(htmlspecialchars($_POST["poids"]));  
        if(isset($_POST["volume"])) $volume=strtoupper(htmlspecialchars($_POST["volume"]));
        if(isset($_POST["adresseOrig"])) $adresseOrig=strtoupper(htmlspecialchars($_POST["adresseOrig"]));
        if(isset($_POST["adresseLivraison"]))  $adresseLivraison=strtoupper(htmlspecialchars($_POST["adresseLivraison"]));
        if(isset($_POST["nbColis"])) $nbColis=strtoupper(htmlspecialchars($_POST["nbColis"]));  
        if(isset($_POST["Description"])) $Description=strtoupper(htmlspecialchars($_POST["Description"]));
        if(isset($_POST["TypeVehicule"]))  $TypeVehicule=strtoupper(htmlspecialchars($_POST["TypeVehicule"]));




              if 
              ($stmt->execute()) 
              {
              //echo"ok";
              $reponse="ok";
    
              }else{
                $reponse="not ok";

              }
            }

            if(isset($_POST["Annuler"]))
            {
                $_POST["typescolis"]="";
                $_POST["poids"]="";
                $_POST["adresseOrig"]="";
                $_POST["adresseLivraison"]="";
                $_POST["nbColis"]="";
                $_POST["description"]=""; 
                header('location:livraison.php');  

            }

            $verif =$bdd->query("select validation_com.IDCOLIS,typescolis,poids,Description,adresseOrig,validation_com.IDLIV,adresseLivraison,Statut from validation_com,livraison where validation_com.IDCOLIS=livraison.IDCOLIS  ");
            //decompte 
            $compt=$verif->rowCount();

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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script> 

    
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
            <li><a href="livraison_liste.php" class="active"><i class="fa fa-database fa-fw"></i>Livraison</a></li>
                         <li><a href="commercial_liste.php"><i class="fa fa-bar-chart fa-fw"></i>Commercial</a></li>

            <li><a href="valider_credit.php"><i class="fa fa-eject fa-fw"></i>Valider Credit<?php if($_SESSION['notification_credit']>=1){ ?>
              <span class="badge"><?php echo $_SESSION['notification_credit'];  ?>+</span>
            <?php } ?></a>
             </li>
            <li><a href="valider_abonnement.php"><i class="fa fa-eject fa-fw"></i>Valider Abonnement<?php if($_SESSION['notification_abonnement']>=1){ ?>
              <span class="badge"><?php echo $_SESSION['notification_abonnement'];  ?>+</span>
            <?php } ?></a>
            </li>
            <li><a href="deconnect.php"><i class="fa fa-eject fa-fw"></i>Deconnexion</a></li>          </ul>   
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
          <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="livraison.php"  class="active">Ajout livraison</a></li>
                <li><a href="livraison_liste_livree.php">livraison(s) effectuée(s)</a></li>
                <li><a href="livraison_liste_all.php">Toutes livraisons<?php if($compt>=1){ ?>
              <span class="badge"><?php echo $compt;  ?>+</span>
            <?php } ?></a></li>
                
                
                
              </ul>  
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">DEMANDE DE LIVRAISON</h2></center>
            <hr>
            <form action="" method="post">
              <div class="row form-group">
              
              <div class="col-sm-12 form-group">                  
                    <label for="inputUsername">CLIENT</label> 
                    <select id="inputState" name="IDCLI" class="form-control">
				
				
					
                <?php 
                    $requ=$bdd->query( "SELECT IDCLI,nom,prenom  FROM client");
                    while($aff=$requ->fetch()){?>
                    
                    <option value="<?php echo $aff['IDCLI'];?>"><?php  echo $aff['nom']; ?></option>
                <?php }?>

				</select>               
                </div>
             
                <div class="col-sm-12 form-group">                  
                    <label for="inputUsername">LIVREUR</label> 
                    <select id="inputState" name="IDLIV" class="form-control">
				<?php 
				
					

	$requ=$bdd->query( "SELECT IDLIV,nomliv,prenomliv  FROM livreur");
	while($aff=$requ->fetch()){?>
    
    <option 
    value="<?php echo $aff['IDLIV'];?>"><?php  echo $aff['nomliv']; ?>

</option>
<?php }?>
				</select>               
                </div>
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputEmail">TYPE DE COLIS</label>
                    <input type="text" name="typescolis" class="form-control" id="inputEmail" placeholder="Ex: fragile" >                  
                </div> 
       
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">NOMBRE DE COLIS</label>
                    <input type="text" name="nbColis" class="form-control" placeholder="Ex: 1..." id="inputConfirmNewPassword">
                </div> 
                

                <div class="col-lg-6 col-md-6  form-group" >
                  <label for="exampleFormControlSelect1">Département d'origine</label>
                  <select class="form-control" name="zone1" onmousedown="afficher()" id="departement1">
                    <option>DAKAR</option>
                    <option>PIKINE</option>
                    <option>RUFISQUE</option>
                    <option>GUEDIAWAY</option>
                    
                  </select>
                </div>

                <div class="col-lg-6 col-md-6  form-group">
                  <label for="exampleFormControlSelect1">Département de livraison</label>
                  <select class="form-control" name="zone2" onmousedown="afficher()" id="departement2">
                  <option>DAKAR</option>
                    <option>PIKINE</option>
                    <option>RUFISQUE</option>
                    <option>GUEDIAWAY</option>
                  </select>
                </div>

                <div class="col-lg-6 col-md-6 form-group" id="adresseOrig">                  
                    <label for="inputConfirmNewPassword">ADRESSE D'ORIGINE</label>
                    <input type="text" name="adresseOrig" class="form-control" placeholder="Ex:Rue 22 ..." id="adresse1">
                </div> 
                <div class="col-lg-6 col-md-6 form-group" id="adresseLiv">                  
                    <label for="inputNewPassword">ADRESSE DE LIVRAISON</label>
                    <input type="text" name="adresseLivraison" class="form-control" placeholder="Ex:Rue 22 ..." id="adresse2">
                </div>

                <div class=" col-md-6 form-group">                  
                    <label for="inputCurrentPassword">POIDS</label>
                    
                    <select id="inputState" name="poids" class="form-control">

                      <option selected>inferieur à 1 kg</option>
                      <option>entre 1kg et 5kg</option>
                      <option>entre 5kg et 10kg</option>
                      <option>entre 10kg et 20kg</option>
                      <option>entre 20kg et 30kg</option>
                      <option>entre 30kg et 50kg</option>
                      <option>entre 50kg et 100kg</option>
                      <option>entre 100kg et 500kg</option>
                      <option>entre 500kg et 1t</option>
                      <option>entre 1t et 10t</option>
                      <option>superieur à 10t</option>
                      
                    
                    </select>                  
                      
                </div>                
            
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">VOLUME</label>
                    
                    <select id="inputState" name="volume" class="form-control">

                      <option selected>Volume 1</option>
                      <option>Volume 2</option>
                      <option>Volume 3</option>
                      <option>Volume 4</option>
                    
                    </select>                  
                </div>

                
              

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">DESCRIPTION</label>
                    <input type="text" name="Description" class="form-control" placeholder="Ex: forme,contenu du colis,couleur etc ..." id="inputConfirmNewPassword">
                </div> 

                <div class=" col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">TYPE DE VEHICULE DEMANDER POUR VOTRE LIVRAISON</label>
                    
                      <select id="inputState" name="TypeVehicule" class="form-control">

                      <option selected>Velo</option>
                      <option>Charette</option>
                      <option>Moto</option>
                      <option>Moto a tois roues</option>

                      <option>Fourgonnette</option>
                      <option>Pickup</option>
                      <option>Camionnette </option>
                      <option>Petit camion</option>
                      <option>Grand fourgon</option>
                      <option>Camion Poids Lourd 5T</option>
                      <option>Camion Poids Lourd 10T</option>
                      <option>Camion Poids Lourd (semi-remorque)</option>
                    </select>
                </div>

                
                  <br>
                  <hr> 

                  <div class=" form-group" style="float:center;">  
                  <br>
                  <hr>            
                  <center>  <input type="submit" value="Envoyer" name="envoi" class="btn btn-primary" style="padding: 7px 50px; border-radius:4px; margin-right:10px;"  />
                    <input type="submit" value="Annuler"  class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:10px; " />    </center> 
              </div>
            </div>
              
           <?php


?>


<!-- 
          </div>
            
              <div class="panel panel-default table-responsive">
               
              </div>                           -->
        
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

     
$("#adresseOrig").hide();
$("#adresseLiv").hide();


function afficher(){
    $("#adresseOrig").show();
    $("#adresseLiv").show();


}

    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>

<?php if($reponse!=""){?>
  <?php if($reponse=="ok"){?>

          
<?php

echo '<script type="text/javascript">

          swal(" Commande effectuée!","Prix de la commande: '.$prix_command.' FcFA", "success");
          

          
          setTimeout(rediriger, 5000);
          
          function rediriger(){
            document.location.href="livraison_liste.php";
          }

</script>';
?>


        <?php 
        
      }else{ ?>
          <script>

          swal ( "Votre commande n'est pas enregistrée" ) ;

          </script>
       

      <?php } ?>
      <?php } ?>

    