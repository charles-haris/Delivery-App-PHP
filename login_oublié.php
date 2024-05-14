<?php
session_start();
$error="";
$compt=0;
$cpt1=0;
$cpt2=0;
$cpt3=0;
$compteur=0;
include('connection.php');

$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

$bdd = connect();

if(isset($_POST["valider"])){
	
    $nom=strtoupper(htmlspecialchars($_POST['nom']));
    $prenom=strtoupper(htmlspecialchars($_POST['prenom']));
    $tel=$_POST['tel'];
    $id=htmlspecialchars($_POST['identifiant']);


    //$pwd=isset($_POST['password'])?sha1($_POST['password'].'doudounet'):null;
	 if($id!="" || $nom!="" || $prenom!="" || $tel!=""){
	
$requete="select * from client where identifiant=:identifiant and nom=:nom and prenom=:prenom and tel=:tel";
	
$req1=$bdd->prepare($requete);
$req1->bindParam(':identifiant', $id);
$req1->bindParam(':nom', $nom);
$req1->bindParam(':prenom', $prenom);
$req1->bindParam(':tel', $tel);
$req1->execute();
$cpt1=$req1->rowCount();


 $requete2="select * from livreur where identifiant=:identifiant and nomliv=:nomliv and prenomliv=:prenomliv and telliv=:telliv";
	
$req2=$bdd->prepare($requete2);
$req2->bindParam(':identifiant', $id);
$req2->bindParam(':nomliv', $nom);
$req2->bindParam(':prenomliv', $prenom);
$req2->bindParam(':telliv', $tel);
$req2->execute();
$cpt2=$req2->rowCount();
 
echo $cpt2;
// $requete3="select * from admin where identifiant=:identifiant and password=:password and active='oui' and bloque='non' ";
	
// $req3=$bdd->prepare($requete3);
// $req3->bindParam(':identifiant', $id);
// $req3->bindParam(':password', $pwd);
// $req3->execute();
// $cpt3=$req3->rowCount();

//veification si c'est un client qui a oublié son mot de passe

if($cpt1==1){
	if($result=$req1->fetchObject()){
		//var_dump($result);
	  $_SESSION['id']=$result->IDCLI;
	  
	}
	$compt=$cpt1;
	$_SESSION['table']="client";
}
//veification si c'est un livreur qui a oublié son mot de passe
if($cpt2==1){

	if($result=$req2->fetchObject()){
		//var_dump($result);
	  $_SESSION['id']=$result->IDLIV;
	  
	}
	$compt=$cpt2;
	$_SESSION['table']="livreur";
}





 
if($compt==1){
	
		header('location:login_modification.php');

}else{



    $error='<div class="form-group text-center alert alert-danger" role="alert">
        Informations saisies incorrectes!
    </div>';

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
	          <h1>APP-LIV</h1>
			  <div class="square"></div>

              <hr>
              <h2>Mot de passe oublié</h2>
	        </header>
	        <form action="" class="templatemo-login-form" method="POST">
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input type="text" name="nom" class="form-control" placeholder="votre nom" required>           
		          	</div>	
	        	</div>
                <div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input type="text" name="prenom" class="form-control" placeholder="votre prenom" required>           
		          	</div>	
	        	</div>
                <div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input type="text" name="tel" class="form-control" pattern="[0-9]{9}" placeholder="votre numero de téléphone" required>           
		          	</div>	
	        	</div>
                <div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>	        		
		              	<input type="text" name="identifiant" class="form-control" placeholder="votre identifiant" required>           
		          	</div>	
	        	</div>
	        
					          	
	          	
				<div class="form-group">
                <center>
					<button type="submit" name="valider" class="templatemo-blue-button ">valider</button>
					 <a href="login.php" class="templatemo-white-button " style=" margin-left:10px; " >retour</a>
                    
                </center>
					
				</div>
				<?php echo $error; ?>
					
	        </form>
		</div>
		
		
	</body>
</html>