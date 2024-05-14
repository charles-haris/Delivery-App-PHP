<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', TRUE);
if(isset($_SESSION['id'])){
//	header('location:deconnect.php'); 
}else{

    echo "";
}


?>

<?php
$error="";
$compt=0;
$cpt1=0;
$cpt2=0;
$cpt3=0;
$cpt4=0;

$compteur=0;
$compteur1=0;
$compteur2=0;
$compteur3=0;
$compteur4=0;

include('connection.php');

$bdd = connect();

if(isset($_POST["connect"])){
	$table="";
$id=$_POST['identifiant'];
$pwd=$_POST['password'];
$pwd=isset($_POST['password'])?sha1($_POST['password'].'doudounet'):null;
	if($id!="" && $pwd!=""){
	
$requete="select * from client where identifiant=:identifiant and password=:password and active='oui' and bloque='non' ";
	
$req1=$bdd->prepare($requete);
$req1->bindParam(':identifiant', $id);
$req1->bindParam(':password', $pwd);
$req1->execute();
$cpt1=$req1->rowCount();

$requete2="select * from livreur where identifiant=:identifiant and password=:password and active='oui' and bloque='non' ";
	
$req2=$bdd->prepare($requete2);
$req2->bindParam(':identifiant', $id);
$req2->bindParam(':password', $pwd);
$req2->execute();
$cpt2=$req2->rowCount();


$requete3="select * from admin where identifiant=:identifiant and password=:password and active='oui' and bloque='non' ";
	
$req3=$bdd->prepare($requete3);
$req3->bindParam(':identifiant', $id);
$req3->bindParam(':password', $pwd);
$req3->execute();
$cpt3=$req3->rowCount();

$requete4="select * from commerciaux where identifiant=:identifiant and password=:password and active='oui' and bloque='non' ";
	
$req4=$bdd->prepare($requete4);
$req4->bindParam(':identifiant', $id);
$req4->bindParam(':password', $pwd);
$req4->execute();
$cpt4=$req4->rowCount();

if($cpt1==1){
	if($result=$req1->fetchObject()){
		//var_dump($result);
	  $_SESSION['id']=$result->identifiant;
	  
	}
	$compt=$cpt1;
	$table="client";
}
if($cpt2==1){

	if($result=$req2->fetchObject()){
		//var_dump($result);
	  $_SESSION['id']=$result->identifiant;
	  
	}
	$compt=$cpt2;
	$table="livreur";
}

if($cpt3==1){

	if($result=$req3->fetchObject()){
		//var_dump($result);
	  $_SESSION['id']=$result->identifiant;
	  
	}
	$compt=$cpt3;
	$table="admin";
}

if($cpt4==1){

	if($result=$req4->fetchObject()){
		//var_dump($result);
	  $_SESSION['id']=$result->identifiant;
	  
	}
	$compt=$cpt4;
	$table="commerciaux";
}




 
if($compt==1){
	if($table=="client"){
	    
	    ?>
	    <script>
	                    document.location.href="admin_client.php";
	    </script>
	    <?php
		
	}elseif($table=="livreur"){
?>
	    <script>
	                    document.location.href="admin_livreur.php";
	    </script>
	    <?php	}elseif($table=="admin"){
?>
	    <script>
	                    document.location.href="client_liste.php";
	    </script>
	    <?php	}elseif($table=="commerciaux"){
?>
	    <script>
	                    document.location.href="admin_commercial.php";
	    </script>
	    <?php	}

}else{
$requet1="select * from client where identifiant=:identifiant and password=:password and bloque='oui' ";
	
$requ1=$bdd->prepare($requet1);
$requ1->bindParam(':identifiant', $id);
$requ1->bindParam(':password', $pwd);
$requ1->execute();
$compteur1=$requ1->rowCount();

$requet2="select * from livreur where identifiant=:identifiant and password=:password and bloque='oui' ";
	
$requ2=$bdd->prepare($requet2);
$requ2->bindParam(':identifiant', $id);
$requ2->bindParam(':password', $pwd);
$requ2->execute();
$compteur2=$requ2->rowCount();

$requet3="select * from admin where identifiant=:identifiant and password=:password and bloque='oui' ";
	
$requ3=$bdd->prepare($requet3);
$requ3->bindParam(':identifiant', $id);
$requ3->bindParam(':password', $pwd);
$requ3->execute();
$compteur3=$requ3->rowCount();

$requet4="select * from commerciaux where identifiant=:identifiant and password=:password and bloque='oui' ";
	
$requ4=$bdd->prepare($requet4);
$requ4->bindParam(':identifiant', $id);
$requ4->bindParam(':password', $pwd);
$requ4->execute();
$compteur4=$requ4->rowCount();

if($compteur1==1){
	$compteur=$compteur1;
}elseif($compteur2==1){
	$compteur=$compteur2;
}elseif($compteur3==1){
	$compteur=$compteur3;
}elseif($compteur4==1){
	$compteur=$compteur4;
}else{
	$compteur=0;
}

if($compteur<1){
$error='<div class="form-group text-center alert alert-danger" role="alert">
	  Identifiant ou mot de passe incorrect !
</div>';
}else{
	$error='<div class="form-group text-center alert alert-danger" role="alert">
	  Ce compte a été bloqué !
</div>';
}
} 


}else{
	$error='<div class="form-group text-center alert alert-danger" role="alert">
	  Présence de champs vide!
</div>';
}
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
	    
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body class="light-gray-bg">
		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="text-center">
	          <div class="square"></div>
	          <a href="#" style="color:black"><h1>APP-LIV&nbsp</h1></a><div class="square"></div>

	        </header>
	        <form action="" class="templatemo-login-form" method="POST">
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input type="text" name="identifiant" class="form-control" placeholder="Identifiant" required>           
		          	</div>	
	        	</div>
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
						  <input type="password" name="password" class="form-control" placeholder="***********" required>  
						 
		          	</div>	
				</div>
					          	
	          
				<div class="form-group">
					<button type="submit" name="connect" class="templatemo-blue-button width-100">Se connecter</button>
					
				</div>
				<?php echo $error; ?>

				<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p><strong><a href="login_oublié.php" class="blue-text">J'ai oublié mon mot de passe</a></strong></p>
			<p><strong><br><a href="page_client.php" class="blue-text">Je m'inscrire</a></strong></p>

		</div>

					
	        </form>
		
		</div>
		

		
	</body>
</html>