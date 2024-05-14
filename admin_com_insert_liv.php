<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}
include('connection.php');
$bdd = connect();
$error="";
$ok="";
require 'GereImg.php';



if(isset($_POST["envoi"]))
{

  $verific=$bdd->query("select * from livreur where nomliv='".$_POST["nomliv"]."' 
  and prenomliv='".$_POST["prenomliv"]."' and telliv='".$_POST["telliv"]."' and cni='".$_POST["cni"]."'");

 $vrf=$verific->rowCount();

  $verifik=$bdd->query("select * from livreur where identifiant='".$_POST["identifiant"]."' ");

 $vrfk=$verifik->rowCount();

  if($vrf<1){
      
        if($vrfk<1){

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
$stmt = $bdd->prepare('INSERT INTO livreur (nomliv,prenomliv,telliv,cni,typeVehicule,imatVehicule,capacite,Numero_permis,Numero_assurance_en_cours,Date_validite,type_permis,photo_permis,identifiant,password,IDCOM)
values(:nomliv,:prenomliv,:telliv,:cni,:typeVehicule,:imatVehicule,:capacite,:Numero_permis,:Numero_assurance_en_cours,:Date_validite,:type_permis,:photo_permis,:identifiant,:password,:IDCOM)');
    
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
        $stmt->bindParam(':IDCOM', $IDCOM);

        
        
        
    
if(isset($_POST["nomliv"])) $nomliv=strtoupper(htmlspecialchars($_POST["nomliv"]));
if(isset($_POST["prenomliv"])) $prenomliv=strtoupper(htmlspecialchars($_POST["prenomliv"]));
if(isset($_POST["telliv"]))  $telliv=strtoupper(htmlspecialchars($_POST["telliv"]));
if(isset($_POST["cni"])) $cni=strtoupper(htmlspecialchars($_POST["cni"]));  
if(isset($_POST["typeVehicule"])) $typeVehicule=strtoupper(htmlspecialchars($_POST["typeVehicule"]));
if(isset($_POST["imatVehicule"])){ $imatVehicule=strtoupper(htmlspecialchars($_POST["imatVehicule"]));}else{ $imatVehicule=null; }
if(isset($_POST["capacite"])){ $capacite=strtoupper(htmlspecialchars($_POST["capacite"]));}else{ $capacite=null; }

if(isset($_POST["Numero_permis"])){  $Numero_permis=strtoupper(htmlspecialchars($_POST["Numero_permis"]));}else{ $Numero_permis=null; }
if(isset($_POST["Numero_assurance_en_cours"])){ $Numero_assurance_en_cours=strtoupper(htmlspecialchars($_POST["Numero_assurance_en_cours"])); }else{ $Numero_assurance_en_cours=null; } 
if(isset($_POST["Date_validite"])){ $Date_validite=strtoupper(htmlspecialchars($_POST["Date_validite"]));}else{ $Date_validite=null; }
if(isset($_POST["type_permis"])) $type_permis=strtoupper(htmlspecialchars($_POST["type_permis"]));
$photo_permis=$photo;
if(isset($_POST["identifiant"])) $identifiant=htmlspecialchars($_POST["identifiant"]);
if(isset($_POST["password"])) $password= sha1($_POST["password"].'doudounet');
$IDCOM=$_SESSION['codecom'];



              if 
              ($stmt->execute()) 
              {
                    $error='<div class="form-group text-center alert alert-success" role="alert">
                          Enregistrement reussi !
                      </div>';
             
                  
              }else{
                   $error='<div class="form-group text-center alert alert-success" role="alert">
                          Enregistrement non effectué !
                      </div>';
              }
                    }else{
                  $error='<div class="form-group text-center alert alert-danger" role="alert">
                  Vous êtes déjà inscrit !
              </div>';
                }
              
            }else{
              $error='<div class="form-group text-center alert alert-danger" role="alert">
              Il est déjà inscrit !
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
    <title>TOUTLIVRER</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <!--<meta http-equiv="Refresh" content=""; url="admin_client.php">-->
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
          <h1>TOUTLIVRER</h1>
        </header>
           
           
         <?php include("admin_com_menu.php"); ?>

       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">NOUVEAU LIVREUR</h2></center>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
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
                    <input type="text" name="imatVehicule" class="form-control" placeholder="" id="inputConfirmNewPassword" >
                </div> 
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">CAPACITE DU VEHICULE</label>
                    <input type="text" name="capacite" class="form-control" placeholder="" id="inputNewPassword" >
                </div>

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">NUMERO DU PERMIS</label>
                    <input type="text" name="Numero_permis" class="form-control" placeholder="" id="inputConfirmNewPassword" >
                </div> 

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">NUMERO D'ASSURANCE EN COURS DE VALIDITÉ</label>
                    <input type="text" name="Numero_assurance_en_cours" class="form-control" placeholder="" id="inputNewPassword">
                </div>

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">DATE DE VALIDITÉ</label>
                    <input type="date" name="Date_validite" class="form-control" placeholder="" id="inputConfirmNewPassword" >
                </div> 
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">TYPE DE PERMIS</label>                
                    <select id="inputState" name="type_permis" class="form-control">

                      <option selected>Pas de permis</option>
                      <option>Gatégorie A</option>
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
    <script>

     

    </script>
    
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>