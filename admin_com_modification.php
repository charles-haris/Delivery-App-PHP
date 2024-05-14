<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}

include('connection.php');
$bdd = connect();
$ok="";
$pass="";
$error="";
$requ=$bdd->query( "SELECT *  FROM commerciaux WHERE IDCOM=".$_SESSION['codecom']." ");
$aff=$requ->fetch();

if(isset($_POST["envoi"])){
/*
if(!empty($_POST["REGLEMENT"])){*/

if($_POST["password1"]==$_POST["password2"]){
    $pass="ok";
}else{
    $pass="not ok";
}

if($_POST["password1"]=="" and $_POST["password2"]==""){
    $pass="good";
}

if($pass=="ok"){
    if(strlen($_POST["password1"])>=8){
 $stmt = $bdd -> prepare("UPDATE commerciaux 
 set nom_com=:nom_com ,prenom_com=:prenom_com 
 ,tel_com=:tel_com ,adresse_com=:adresse_com
  ,identifiant=:identifiant ,password=:password
			WHERE IDCOM=:IDCOM  ");
    $stmt->bindParam(':IDCOM', $IDCOM);
$stmt->bindParam(':nom_com', $nom);
        $stmt->bindParam(':prenom_com', $prenom);
        $stmt->bindParam(':tel_com', $tel);
        $stmt->bindParam(':adresse_com', $adresse);
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->bindParam(':password', $password);

 $IDCOM=htmlspecialchars($_SESSION['codecom']);
if(isset($_POST["nom"])) $nom=strtoupper(htmlspecialchars($_POST["nom"]));
if(isset($_POST["prenom"])) $prenom=strtoupper(htmlspecialchars($_POST["prenom"]));
if(isset($_POST["tel"])) $tel=strtoupper(htmlspecialchars($_POST["tel"]));  
if(isset($_POST["adresse"])) $adresse=strtoupper(htmlspecialchars($_POST["adresse"]));

if(isset($_POST["identifiant"])) $identifiant=htmlspecialchars($_POST["identifiant"]);
if(isset($_POST["password1"]))  $password= sha1($_POST["password1"].'doudounet');




              if 
              ($stmt->execute()) 
              {
              $ok="ok";
              header("location:admin_commercial.php");
              }
                    }else{
                         $error='<div class="form-group text-center alert alert-danger" role="alert">
                                         Le mot de passe doit avoir au moins 8 caraxtères !
                                      </div>'; 
                    }
            }
            
            if($pass=="good"){
                     $stmt = $bdd -> prepare("UPDATE commerciaux 
                     set nom_com=:nom_com ,prenom_com=:prenom_com 
                     ,tel_com=:tel_com ,adresse_com=:adresse_com
                      ,identifiant=:identifiant 
                    			WHERE IDCOM=:IDCOM  ");
                        $stmt->bindParam(':IDCOM', $IDCOM);
                    $stmt->bindParam(':nom_com', $nom);
                            $stmt->bindParam(':prenom_com', $prenom);
                            $stmt->bindParam(':tel_com', $tel);
                            $stmt->bindParam(':adresse_com', $adresse);
                            $stmt->bindParam(':identifiant', $identifiant);
                          
                    
                     $IDCOM=htmlspecialchars($_SESSION['codecom']);
                    if(isset($_POST["nom"])) $nom=strtoupper(htmlspecialchars($_POST["nom"]));
                    if(isset($_POST["prenom"])) $prenom=strtoupper(htmlspecialchars($_POST["prenom"]));
                    if(isset($_POST["tel"])) $tel=strtoupper(htmlspecialchars($_POST["tel"]));  
                    if(isset($_POST["adresse"])) $adresse=strtoupper(htmlspecialchars($_POST["adresse"]));
                    
                    if(isset($_POST["identifiant"])) $identifiant=htmlspecialchars($_POST["identifiant"]);

                    
                    
                    
                                  if 
                                  ($stmt->execute()) 
                                  {
                                  $ok="ok";
                                  header("location:admin_commercial.php");

                                  }
                                }
                
                if($pass=="not ok"){
 $error='<div class="form-group text-center alert alert-danger" role="alert">
                         Confirmation du mot de passe incorrect !
                      </div>';                }
            
            
            }



            if(isset($_POST["annuler"]))
            {
                

                header('location:admin_com_info.php'); 

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
          <div class="square"></div>
        </header>
          
    <?php include("admin_com_menu.php"); ?>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Modification de mon Profil</h2></center>
            <hr>
            <form action="" method="post">
              <div class="row form-group">
              <div class=" col-sm-12 form-group">                  
                    <label for="inputLastName">Code Agent Commercial</label>
                    <input type="text" name="IDCOM" type="hidden" class="form-control" id="inputLastName" value="<?php  echo $aff['IDCOM'];?>" placeholder="votrte nom" required="" disabled>              
                </div> 
                <div class=" col-md-6 form-group">                  
                    <label for="inputLastName">NOM</label>
                    <input type="text" name="nom" class="form-control" id="inputLastName" placeholder="votrte nom"  value="<?php  echo $aff['nom_com'];?>" required="">                  
                </div> 
              
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputUsername">PRENOM</label>
                    <input type="text" name="prenom" class="form-control" id="inputUsername" placeholder="votre prenom"  value="<?php  echo $aff['prenom_com'];?>" required="">                  
                </div>
               
                <div class=" col-md-6 form-group">                  
                    <label for="inputCurrentPassword">TEL</label>
                    <input type="text" name="tel" class="form-control " placeholder="Ex:78......." id="inputCurrentPassword"  value="<?php  echo $aff['tel_com'];?>" pattern="[0-9]{9}" required="">                  
                </div>                
            
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">ADRESSE</label>
                    <input type="text" name="adresse" class="form-control"  value="<?php  echo $aff['adresse_com'];?>" placeholder="Ex:Rue 22 ..." id="inputNewPassword">
                </div>

               

             <!--   <div class=" col-sm-12 form-group">                  
                    <label for="inputConfirmNewPassword">DATE DE NAISSANCE</label>
                    <input type="date" name="datenaiss"  value="<?php // echo $aff['datenaiss'];?>" class="form-control" id="inputConfirmNewPassword">
                </div> -->

                <div class=" col-sm-12   form-group">                  
                    <label for="inputConfirmNewPassword">Identifiant</label>
                    <input type="text" name="identifiant" class="form-control"  value="<?php  echo $aff['identifiant'];?>" placehorder="votre identifiant" id="inputConfirmNewPassword">
                </div> 

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">Nouveau mot de passe</label>
                    <input type="password" name="password1" class="form-control"  value="<?php  //echo $aff['password'];?>" placeholder="votre nouveau mot de passe" id="inputConfirmNewPassword">
                </div> 
                 <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">Confirmer le mot de passe</label>
                    <input type="password" name="password2" class="form-control"  value="<?php  //echo $aff['password'];?>" placeholder="confirmation du mot de passe" id="inputConfirmNewPassword">
                </div> 

                
              <br>
              <br>
                  <hr> 

                  <div class=" form-group" style="float:center;">
                  <br>
                  <hr>            
                  <center>  <input type="submit" value="Envoyer" name="envoi" class="btn btn-primary" style="padding: 7px 50px; border-radius:4px; margin-right:10px;"  />
                    <input type="submit" value="Annuler" name="annuler" class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:10px; " />    </center>
                    
                     
              </div>
                 <?php echo $error; ?>
            </div>
              
           <?php

//  $con = new PDO ("mysql:host=localhost;dbname=bd_livraison","root","root");
      
     

//         $rete=$con->query("SELECT * FROM  client ",PDO::FETCH_BOUND);

      
//        $rete->bindColumn('IDCLI',$id);
//        $rete->bindColumn('nom',$NOM);
//        $rete->bindColumn('prenom',$PRENOM);
//        $rete->bindColumn('societe',$SOCIETE);
//        $rete->bindColumn('tel',$TEL);
//        $rete->bindColumn('adresse',$ADRESS);
//        $rete->bindColumn('mail',$MAIL);
//        $rete->bindColumn('datenaiss',$DATEE); 
?>



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
<?php
/*if($ok!=""){
echo '<script type="text/javascript">

          swal(" Modification effectuée!", "cliquer sur ok!", "success");
          

          
          setTimeout(rediriger, 2000);
          
          function rediriger(){
            document.location.href="admin_com_info.php";
          }

</script>';
        }*/
?>