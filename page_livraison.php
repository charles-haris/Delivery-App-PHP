<?php
session_start();
//error_reporting();

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}
$reponse="";


include('connection.php');
$bdd = connect();

            //abonné ou pas
            $abonn =$bdd->query("select * from client where identifiant='".$_SESSION['id']."' and Abonne='oui' ");
            $nbr=$abonn->rowCount();
        
            if($nbr<1){
              $Abonne="M'ABONNER";
              $href="admin_cli_s_abonne.php";
            }else{
              $Abonne="LIVREUR(S) DISPONIBLE(S)";
              $href="admin_cli_liste_liv_dispo.php";
            }
            
        

if(isset($_POST["envoi"]))
{
echo  "charles est la";
  
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
   
  
              $IDCLI=$_SESSION['codecli'];

              $IDLIV=null;
              
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
              //header('location:admin_cli_com_en_cours.php');  
              }else{
              $reponse="not ok";

              }

              


            }

            if(isset($_POST["annuler"]))
            {
                $_POST["typescolis"]="";
                $_POST["poids"]="";
                $_POST["adresseOrig"]="";
                $_POST["adresseLivraison"]="";
                $_POST["nbColis"]="";
                $_POST["description"]=""; 
                header('location:admin_cli_com_en_cours.php');  



            }


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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
        </header>
            
        <!-- Search box -->
       
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
          </div>
        <nav class="templatemo-left-nav">          
        <ul>
            <li><a href="admin_cli_com_en_cours.php"><i class="fa fa-home fa-fw"></i>Commandes en cours</a></li>
            <li><a href="admin_client.php" ><i class="fa fa-bar-chart fa-fw"></i>Mon histoire</a></li>
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
                <li><a href="page_livraison.php" class="active">Commander</a></li>
                <li><a href=""></a></li>
    <?php if($nbr<1){ ?><li><a href="deconnect.php">Deconnexion</a></li><?php } ?>
    <?php if($decompt>=1){ ?>
    <span class="badge"><?php echo $decompt;  ?>+</span>
    <?php } ?>
                
              </ul>  
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">DEMANDE DE LIVRAISON</h2></center>
            <hr>
            <form action="page_livraison.php" method="post">
              <div class="row form-group">
              
              
             
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputEmail">TYPE DE COLIS</label>
                    <input type="text" name="typescolis" class="form-control" id="inputEmail" placeholder="Ex: fragile ..." required>                  
                </div> 
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">NOMBRE DE COLIS</label>
                    <input type="text" name="nbColis" class="form-control" placeholder="Ex: 1..." id="inputConfirmNewPassword" required>
                </div> 

                <div class="col-lg-6 col-md-6  form-group" >
                  <label for="exampleFormControlSelect1">Département d'origine</label>
                  <select class="form-control" name="zone1" onmousedown="afficher()" id="departement1">
                    <option value="DAKAR" >choisir un departement</option>
                    <option>DAKAR</option>
                    <option>PIKINE</option>
                    <option>RUFISQUE</option>
                    <option>GUEDIAWAY</option>
                    
                  </select>
                </div>

                <div class="col-lg-6 col-md-6  form-group">
                  <label for="exampleFormControlSelect1">Département de livraison</label>
                  <select class="form-control" name="zone2" onmousedown="afficher()" id="departement2">
                  <option value="DAKAR" >choisir un departement</option>
                  <option>DAKAR</option>
                    <option>PIKINE</option>
                    <option>RUFISQUE</option>
                    <option>GUEDIAWAY</option>
                  </select>
                </div>
       
                <div class="col-lg-6 col-md-6 form-group" id="adresseOrig">                  
                    <label for="inputConfirmNewPassword">ADRESSE D'ORIGINE</label>
                    <input type="text" name="adresseOrig" class="form-control" placeholder="Ex: Rue 23 ..." id="adresse1" required>
                </div> 
                <div class="col-lg-6 col-md-6 form-group" id="adresseLiv">                  
                    <label for="inputNewPassword">ADRESSE DE LIVRAISON</label>
                    <input type="text" name="adresseLivraison" class="form-control" placeholder="Ex:Rue 22 ..." id="adresse2" required>
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
                    <label for="inputConfirmNewPassword">DESCRIPTION</label>
                    <input type="text" name="Description" class="form-control" placeholder="Ex: pot de fleur ..." id="inputConfirmNewPassword" required>
                </div> 

                <div class=" col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">TYPE DE VEHICULE DEMANDER POUR VOTRE LIVRAISON</label>
                    
                      <select id="inputState" name="TypeVehicule" class="form-control">

                      <option selected>Velo</option>
                      <option>Charette</option>
                      <option>Moto à 2 roues</option>
                      <option>Moto à 3 roues</option>
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

                
                                 

                     <center>       
                    <input type="submit" value="Envoyer" name="envoi" class="btn btn-primary" style="padding: 7px 50px; border-radius:4px; margin-right:5px;"  />
                    <input type="submit" value="Annuler" name="annuler"  class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:5px; " />   
                    </center>
                    
              </div>
            </div>
              



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

function goBack() {
  window.history.back();
}


    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>

<?php if($reponse!=""){?>
  <?php if($reponse=="ok"){?>

    <?php

echo '<script type="text/javascript">

          swal(" Commande effectué!", "Prix de la commande: '.$prix_command.' FcFA", "success");
          

          
          setTimeout(rediriger, 5000);
          
          function rediriger(){
            document.location.href="admin_cli_com_en_cours.php";
          }

</script>';
?>
        <?php }else{ ?>
          <script>

          swal ( "Votre commande n'est pas enregistrée" ) ;

          </script>
       

      <?php } ?>
      <?php } ?>
      
      <!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
-->