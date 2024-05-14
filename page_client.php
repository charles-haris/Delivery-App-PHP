<?php
include('connection.php');
$bdd = connect();
$error="";

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

if(isset($_POST["envoi"]))
{
 $verific=$bdd->query("select * from client where nom='".$_POST["nom"]."' 
 and prenom='".$_POST["prenom"]."' and societe='".$_POST["societe"]."' and adresse='".$_POST["adresse"]."'");

 $vrf=$verific->rowCount();

  $verifik=$bdd->query("select * from client where identifiant='".$_POST["identifiant"]."' ");

 $vrfk=$verifik->rowCount();

  if($vrf<1){
      
        if($vrfk<1){
            
$stmt = $bdd->prepare('INSERT INTO client (nom,prenom,societe,tel,adresse,mail,identifiant,password)
values
(:nom,:prenom,:societe,:tel,:adresse,:mail,:identifiant,:password)');
    
$stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':societe', $societe);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':mail', $mail);
        //$stmt->bindParam(':datenaiss', $datenaiss);
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->bindParam(':password', $password);
        
    
if(isset($_POST["nom"])) $nom=strtoupper(htmlspecialchars($_POST["nom"]));
if(isset($_POST["prenom"])) $prenom=strtoupper(htmlspecialchars($_POST["prenom"]));
if(isset($_POST["societe"]))  $societe=strtoupper(htmlspecialchars($_POST["societe"]));
if(isset($_POST["tel"])) $tel=strtoupper(htmlspecialchars($_POST["tel"]));  
if(isset($_POST["adresse"])) $adresse=strtoupper(htmlspecialchars($_POST["adresse"]));
if(isset($_POST["mail"])) $mail=strtoupper(htmlspecialchars($_POST["mail"]));

if(isset($_POST["identifiant"])) $identifiant=htmlspecialchars($_POST["identifiant"]);
if(isset($_POST["password"]))  $password= sha1($_POST["password"].'doudounet');




              if 
              ($stmt->execute()) 
              {
              echo"ok";
              ?>
   <script>

        window.location.replace("http://toutlivrer.com/login.php");
        
  </script>
              <?php
                  
              }
              
        }else{
              $error='<div class="form-group text-center alert alert-danger" role="alert">
              identifiant déja existant !
          </div>';
            }
            
            }else{
              $error='<div class="form-group text-center alert alert-danger" role="alert">
              Vous êtes déjà inscrit !
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
    <title>e-livraison</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <!-- 
    -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="sweetalert2.all.min.js"></script>

    
  

  </head>
  <body> 
 
 
   
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                
            <header class="text-center">
	          <div class="square"></div>
	          <p style="color:black"><h1>APP-LIV</h1></p>
	        </header>
            <!--<center><h2>Cette page concerne les clients</h2></center>-->
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">NOUVEAU CLIENT</h2></center>
            <hr>
            <form action="page_client.php" method="post">
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
                    <input type="text" name="tel" class="form-control " placeholder="Ex:78......." id="inputCurrentPassword" pattern="[0-9]{9}" required>                 
                </div>                
            
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">ADRESSE</label>
                    <input type="text" name="adresse" class="form-control" placeholder="Ex:Rue 22 ..." id="inputNewPassword">
                </div>

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">E-MAIL</label>
                    <input type="text" name="mail" class="form-control" placeholder="Ex: exemple@gmail.com" id="inputConfirmNewPassword">
                </div> 

            <!--    <div class=" col-sm-12 form-group">                  
                    <label for="inputConfirmNewPassword">DATE DE NAISSANCE</label>
                    <input type="date" name="datenaiss" class="form-control" id="inputConfirmNewPassword">
                </div> -->

                <div class=" col-lg-6 col-md-6  form-group">                  
                    <label for="inputConfirmNewPassword">Identifiant</label>
                    <input type="text" name="identifiant" class="form-control" placehorder="votre identifiant" id="inputConfirmNewPassword">
                </div> 

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">Mot de passe</label>
                    <input type="password" id="password1" name="password" class="form-control" placeholder="votre mot de passe" pattern=".{8,}" title="Eight or more characters">
                    <span style="position: absolute;right:13px;top:4px; margin-top:27px; margin-right:5px; padding:1px;" onclick="hideshow()" >
													<i id="slash" class="fa fa-eye-slash"></i>
													<i id="eye" class="fa fa-eye"></i>
												</span>
                </div> 

                

                        
                  <center>  <input type="submit" value="Envoyer" name="envoi" class="btn btn-primary" style="padding: 7px 50px; border-radius:4px; margin-right:5px;"  />
                  
                   <a href="login.php" class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:5px; " >Annuler</a>
                  
                   <!-- <input type="submit" value="Annuler"  class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:10px; " /> -->   </center> 
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

    
    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
    
    	<script>
    			var eye = document.getElementById("eye");
				eye.style.display = "none";

		function hideshow(){
			var password = document.getElementById("password1");
			var slash = document.getElementById("slash");
			var eye = document.getElementById("eye");
			
			if(password.type === 'text'){
				
				
				password.type = "password";
				slash.style.display = "block";
				eye.style.display = "none";
			}
			else{
				password.type = "text";
				slash.style.display = "none";
				eye.style.display = "block";
			}

		}
	</script>
  </body>
</html>
