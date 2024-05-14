<?php
session_start();
if(!isset($_SESSION['id'])){
    header("location:deconnect.php");
  }
$error="";
include('connection.php');

$bdd = connect();

if(isset($_POST["valider"])){
	
    $pass1=htmlspecialchars($_POST['password1']);
    $pass2=htmlspecialchars($_POST['password2']);

    //$pwd=isset($_POST['password'])?sha1($_POST['password'].'doudounet'):null;
	if($pass1!="" || $pass2!=""){
        if($pass1==$pass2){

            $pass2= sha1($pass2.'doudounet');
            if($_SESSION['table']=="livreur"){

            $stmt = $bdd -> prepare("UPDATE livreur 
             set
             password=:password
             WHERE IDLIV=:IDLIV");
            $stmt->bindParam(':IDLIV', $_SESSION['id']);
            $stmt->bindParam(':password', $pass2);
            }else{

                $stmt = $bdd -> prepare("UPDATE client 
                set
                password=:password
                WHERE IDCLI=:IDCLI");
               $stmt->bindParam(':IDCLI', $_SESSION['id']);
               $stmt->bindParam(':password', $pass2);

            }
            
                
                  if 
                  ($stmt->execute()) 
                  {
                  //echo"ok";
                  //mettre un suit alerte pour confirmer la validation puis un sleep(5)
                  header('location:deconnect.php');
                }

        }else{
            $error='<div class="form-group text-center alert alert-danger" role="alert">
            Les deux saisies ne sont pas identiques!
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
	          <h1>e-livraison</h1>
              <hr>
              <h2>Nouveau mot de passe</h2>
	        </header>
	        <form action="" class="templatemo-login-form" method="POST">
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
		              	<input type="password" name="password1" class="form-control" placeholder="votre mot de passe" required>           
		          	</div>	
	        	</div>
                <div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>	        		
		              	<input type="password" name="password2" class="form-control" placeholder="confirmation du mot de passe" required>           
		          	</div>	
	        	</div>
               
	        
					          	
	          	
				<div class="form-group">
                
					<button type="submit" name="valider" class="templatemo-blue-button width-100">valider</button>
                
					
				</div>
				<?php echo $error; ?>
					
	        </form>
		</div>
		
		
	</body>
</html>