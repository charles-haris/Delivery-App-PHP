<?php
include('connection.php');
$bdd = connect();
$error="";
$ok="";
require 'GereImg.php';

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

if(isset($_POST["envoi"]))
{

  $verific=$bdd->query("select * from livreur where nomliv='".$_POST["nomliv"]."' 
  and prenomliv='".$_POST["prenomliv"]."' and telliv='".$_POST["telliv"]."' and cni='".$_POST["cni"]."'");

 $vrf=$verific->rowCount();


  if($vrf<1){

    $traitement= new GereImg();
    echo $traitement->erreurTransfer($_FILES['photo_permis']['error']);
    echo $traitement->size($_FILES['photo_permis']['size']);
    echo $traitement->controlExtension($_FILES['photo_permis']['name']);


    $extension_upload = strtolower(  substr(  strrchr($_FILES['photo_permis']['name'], '.')  ,1)  );
    $nom1= $_POST['nomliv'].$_POST['prenomliv'].$_POST['telliv'];
    $resultat = move_uploaded_file($_FILES['photo_permis']['tmp_name'],'permis_livreur/'.$nom1.'.'.$extension_upload);

    
        $photo=$nom1.'.'.$extension_upload;

/*
if(!empty($_POST["REGLEMENT"])){*/
$stmt = $bdd->prepare('INSERT INTO livreur (nomliv,prenomliv,telliv,cni,typeVehicule,imatVehicule,capacite,Numero_permis,Numero_assurance_en_cours,Date_validite,type_permis,photo_permis,identifiant,password)
values(:nomliv,:prenomliv,:telliv,:cni,:typeVehicule,:imatVehicule,:capacite,:Numero_permis,:Numero_assurance_en_cours,:Date_validite,:type_permis,:photo_permis,:identifiant,:password)');
    
$stmt->bindParam(':nomliv', $nomliv);
        $stmt->bindParam(':prenomliv', $prenomliv);
        $stmt->bindParam(':telliv', $telliv);
        $stmt->bindParam(':cni', $cni);
        $stmt->bindParam(':typeVehicule', $typeVehicule);
        $stmt->bindParam(':imatVehicule', $imatVehicule);
        $stmt->bindParam(':capacite', $capacite);
        $stmt->bindParam(':Numero_permis', $Numero_permis);
        $stmt->bindParam(':Numero_assurance_en_cours', $Numero_assurance_en_cours);
        $stmt->bindParam(':Date_validite', $Date_validite);
        $stmt->bindParam(':type_permis', $type_permis);
        $stmt->bindParam(':photo_permis', $photo_permis);
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->bindParam(':password', $password);
        
        
        
    
if(isset($_POST["nomliv"])) $nomliv=strtoupper(htmlspecialchars($_POST["nomliv"]));
if(isset($_POST["prenomliv"])) $prenomliv=strtoupper(htmlspecialchars($_POST["prenomliv"]));
if(isset($_POST["telliv"]))  $telliv=strtoupper(htmlspecialchars($_POST["telliv"]));
if(isset($_POST["cni"])) $cni=strtoupper(htmlspecialchars($_POST["cni"]));  
if(isset($_POST["typeVehicule"])) $typeVehicule=strtoupper(htmlspecialchars($_POST["typeVehicule"]));
if(isset($_POST["imatVehicule"])) $imatVehicule=strtoupper(htmlspecialchars($_POST["imatVehicule"]));
if(isset($_POST["capacite"]))  $capacite=strtoupper(htmlspecialchars($_POST["capacite"]));

if(isset($_POST["Numero_permis"]))  $Numero_permis=strtoupper(htmlspecialchars($_POST["Numero_permis"]));
if(isset($_POST["Numero_assurance_en_cours"])) $Numero_assurance_en_cours=strtoupper(htmlspecialchars($_POST["Numero_assurance_en_cours"]));  
if(isset($_POST["Date_validite"])) $Date_validite=strtoupper(htmlspecialchars($_POST["Date_validite"]));
if(isset($_POST["type_permis"])) $type_permis=strtoupper(htmlspecialchars($_POST["type_permis"]));
$photo_permis=$photo;
if(isset($_POST["identifiant"])) $identifiant=htmlspecialchars($_POST["identifiant"]);
if(isset($_POST["password"])) $password= sha1($_POST["password"].'doudounet');




              if 
              ($stmt->execute()) 
              {
              $ok="ok";

             
                  
              }
            }else{
              $error='<div class="form-group text-center alert alert-danger" role="alert">
              Vous êtes déjà inscrit !
          </div>';
            }
            }

            if(isset($_POST["Annuler"]))
            {
                $_POST["nomliv"]="";
                $_POST["prenomliv"]="";
                $_POST["cni"]="";
                $_POST["telliv"]="";
                $_POST["capacite"]="";
                $_POST["numero_assurance"]="";
                $_POST["numero_permis"]=""; 
                $_POST["imatVehicule"]="";
                $_POST["identifiant"]="";
                $_POST["password"]="";
            }

          
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
          <h1>e-livraison</h1>
        </header>
        <div class="profile-photo-container">
          <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
          <div class="profile-photo-overlay"></div>
        </div>      
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
           <li><a href="login.php" ><i class="fa fa-user fa-fw"></i>SE CONNECTER</a></li>
            <li><a href="page_client.php" ><i class="fa fa-sign-in fa-fw"></i>S'INSCRIRE COMME CLIENT</a></li>
            <li><a href="page_livreur.php" class="active"><i class=" fa fa-sign-in fa-fw"></i>S'INSCRIRE COMME LIVREUR</a></li>
            <li><a href="page_livraison.php"><i class="fa fa-database fa-fw"></i>BESOIN D'UNE LIVRAISON</a></li>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
            <center><h2>Cette page concerne les livreurs</h2></center>
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">NOUVEAU LIVREUR</h2></center>
            <hr>
            <form action="page_livreur.php" method="post" enctype="multipart/form-data">
              <div class="row form-group">
                <div class=" col-md-6 form-group">                  
                    <label for="inputLastName">NOM</label>
                    <input type="text" name="nomliv" class="form-control" id="inputLastName" placeholder="votrte nom" required="">                  
                </div> 
              
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputUsername">PRENOM</label>
                    <input type="text" name="prenomliv" class="form-control" id="inputUsername" placeholder="votre prenom" required="">                  
                </div>
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputEmail">TEL</label>
                    <input type="text" name="telliv" class="form-control" id="inputEmail" placeholder="Ex:78......." pattern="[0-9]{9}" required>                                   
                </div> 
       
             
                <div class=" col-md-6 form-group">                  
                    <label for="inputCurrentPassword">CNI</label>
                    <input type="text" name="cni" class="form-control " placeholder="" id="inputCurrentPassword" required="">                  
                </div>                
            
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">TYPE DE VEHICULE</label>
                  
                    <select id="inputState" name="typeVehicule" class="form-control">

                      <option selected>Velo</option>
                      <option>Charette</option>
                      <option>Moto</option>
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

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">IMATRICULE DU VEHICULE</label>
                    <input type="text" name="imatVehicule" class="form-control" placeholder="" id="inputConfirmNewPassword" required="">
                </div> 
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">CAPACITE DU VEHICULE</label>
                    <input type="text" name="capacite" class="form-control" placeholder="" id="inputNewPassword" required="">
                </div>

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">NUMERO DU PERMIS</label>
                    <input type="text" name="Numero_permis" class="form-control" placeholder="" id="inputConfirmNewPassword" required="">
                </div> 

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">NUMERO D'ASSURANCE EN COURS DE VALIDITÉ</label>
                    <input type="text" name="Numero_assurance_en_cours" class="form-control" placeholder="" id="inputNewPassword" required="">
                </div>

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">DATE DE VALIDITÉ</label>
                    <input type="date" name="Date_validite" class="form-control" placeholder="" id="inputConfirmNewPassword" required="">
                </div> 
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">TYPE DE PERMIS</label>                
                    <select id="inputState" name="type_permis" class="form-control">

                      <option selected>Gatégorie A</option>
                      <option>Gatégorie B</option>
                      <option>Gatégorie C</option>
                      <option>Gatégorie D</option>                   
                    </select>
                </div>

                <div class=" col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">PHOTO DU PERMIS</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="2048576" />
                    <input   
                    type="file"
                    id="inputConfirmNewPassword" 
                    class="form-control validate"
                    name="photo_permis"
                    value=""
                    equired>
                                    </div> 
                <div class=" col-lg-6 col-md-6  form-group">                  
                    <label for="inputConfirmNewPassword">Identifiant</label>
                    <input type="text" name="identifiant" class="form-control" placehorder="votre identifiant" id="inputConfirmNewPassword">
                </div> 

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="votre mot de passe" id="inputConfirmNewPassword" pattern=".{8,}" title="Eight or more characters">
                </div> 

                      
                  <center>  <input type="submit" value="Envoyer" name="envoi" class="btn btn-primary" style="padding: 7px 50px; border-radius:4px; margin-right:5px;"  />
                  
                  <a href="<?= $previous ?>" class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:5px; " >Annuler</a>
                  
                    <!--<input type="submit" value="Annuler"  class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:10px; " /> -->   </center> 
              </div>
              <?php echo $error; ?>
            </div>
          



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
<?php 
if($ok!=""){
?>
<script type="text/javascript">

          swal("Enregistrement reussi!", "cliquer sur ok!", "success");

</script>
<?php 
}
?>



