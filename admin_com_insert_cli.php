<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}
$compt=0;
 //connexion a la base de donnée
  $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');

    //enregistrement par le livreur 
    
    if(isset($_POST["envoi"]))
{
 $verific=$bdd->query("select * from client where nom='".$_POST["nom"]."' 
 and prenom='".$_POST["prenom"]."' and societe='".$_POST["societe"]."' and adresse='".$_POST["adresse"]."'");

 $vrf=$verific->rowCount();

 
  $verifik=$bdd->query("select * from client where identifiant='".$_POST["identifiant"]."' ");

 $vrfk=$verifik->rowCount();

  if($vrf<1){
      
        if($vrfk<1){
$stmt = $bdd->prepare('INSERT INTO client (nom,prenom,societe,tel,adresse,mail,identifiant,password,IDCOM)
values
(:nom,:prenom,:societe,:tel,:adresse,:mail,:identifiant,:password,:IDCOM)');
    
$stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':societe', $societe);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':IDCOM', $IDCOM);
        
    
if(isset($_POST["nom"])) $nom=strtoupper(htmlspecialchars($_POST["nom"]));
if(isset($_POST["prenom"])) $prenom=strtoupper(htmlspecialchars($_POST["prenom"]));
if(isset($_POST["societe"]))  $societe=strtoupper(htmlspecialchars($_POST["societe"]));
if(isset($_POST["tel"])) $tel=strtoupper(htmlspecialchars($_POST["tel"]));  
if(isset($_POST["adresse"])) $adresse=strtoupper(htmlspecialchars($_POST["adresse"]));
if(isset($_POST["mail"])) $mail=strtoupper(htmlspecialchars($_POST["mail"]));

if(isset($_POST["identifiant"])) $identifiant=htmlspecialchars($_POST["identifiant"]);
if(isset($_POST["password"]))  $password= sha1($_POST["password"].'doudounet');
$IDCOM="".$_SESSION['codecom']."";
                     echo substr($mail,-10,10);

                $mail = str_replace(' ', '', $mail);
                if(strlen($mail)>strlen("@gmail.com")){

                     
                          if 
                          ($stmt->execute()) 
                          {
                          $error='<div class="form-group text-center alert alert-success" role="alert">
                          Enregistrement reussi !
                      </div>';
                       
                          }else{
                               $error='<div class="form-group text-center alert alert-danger" role="alert">
                          Enregistrement non effectué !
                      </div>';
                              
                          }
                 
                          
                    }else{
                        $error='<div class="form-group text-center alert alert-danger" role="alert">
                          E-mail incorrect !<br>

                          Enregistrement non effectué !
                      </div>';
                    }
                }else{
                     $error='<div class="form-group text-center alert alert-danger" role="alert">
                          E-mail incorrect !<br>

                          Enregistrement non effectué !
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
                $_POST["nom"]="";
                $_POST["prenom"]="";
                $_POST["societe"]="";
                $_POST["tel"]="";
                $_POST["adresse"]="";
                $_POST["mail"]="";
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
          <h1>APP-LIV</h1>
          <div class="square"></div>        </header>
           
           
         <?php include("admin_com_menu.php"); ?>

       
         <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">NOUVEAU CLIENT</h2></center>
            <hr>
            <form action="" method="post">
              <div class="row form-group">
                <div class=" col-md-6 form-group">                  
                    <label for="inputLastName">NOM</label>
                    <input type="text" name="nom" class="form-control" id="inputLastName" placeholder="votrte nom" required="">                  
                </div> 
              
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputUsername">PRENOM</label>
                    <input type="text" name="prenom" class="form-control" id="inputUsername" placeholder="numero prenom" required="">                  
                </div>
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputEmail">SOCIETE</label>
                    <input type="text" name="societe" class="form-control" id="inputEmail" placeholder="votre societe" >                  
                </div> 
       
             
                <div class=" col-md-6 form-group">                  
                    <label for="inputCurrentPassword">TEL</label>
                    <input type="text" name="tel" class="form-control " placeholder="Ex:78......." id="inputCurrentPassword" pattern="[0-9]{9}" required="">                  
                </div>                
            
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">ADRESSE</label>
                    <input type="text" name="adresse" class="form-control" placeholder="Ex:Rue 22 ..." id="inputNewPassword">
                </div>

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">E-MAIL</label>
                    <input type="text" name="mail" class="form-control" placeholder="Ex: exemple@gmail.com" id="inputConfirmNewPassword">
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
                  
                   <a href="http://toutlivrer.com/admin_com_insert_cli.php" class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:5px; " >Annuler</a>
                  
                   <!-- <input type="submit" value="Annuler"  class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:10px; " /> -->   </center> 
              </div>
              <?php echo $error; ?>
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