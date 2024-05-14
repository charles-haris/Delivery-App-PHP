<?php
session_start();
//error_reporting(-1);
//ini_set('display_errors',false);

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}



 //connexion a la base de donnée
		 $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');
if(isset($_POST['abonnee'])){
 
    $duree="";

  if($_POST['abonnee']=="10000"){
    $duree="1 mois";
    $datefin=date('Y-m-d H:i:s',strtotime("+43200 minutes"));

  }
  if($_POST['abonnee']=="20000"){
    $duree="3 mois";
    $datefin=date('Y-m-d H:i:s',strtotime("+129600 minutes"));

  }
  if($_POST['abonnee']=="40000"){
    $duree="6 mois";
    $datefin=date('Y-m-d H:i:s',strtotime("+259200 minutes"));

  }
  if($_POST['abonnee']=="60000"){
    $duree="1 an";
    $datefin=date('Y-m-d H:i:s',strtotime("+525600 minutes"));

  }
  //verification d'abonné ou non
  $verif_abonnee =$bdd->query("select * from abonnement where actif='oui' and id_liv=".$_SESSION['codeliv']);
//decompte 
$compt_abonnee=$verif_abonnee->rowCount();

if($compt_abonnee==0){
  $requete = $bdd->prepare('INSERT INTO abonnement (id_liv,duree,debut,fin,Tarif,actif)
  values (:id_liv,:duree,:debut,:fin,:Tarif,:actif)');
      
  $requete->bindParam(':id_liv', $IDL);
  $requete->bindParam(':duree', $temps);
  $requete->bindParam(':debut', $debut);
  $requete->bindParam(':fin', $fin);
  $requete->bindParam(':Tarif', $tarif);
    $requete->bindParam(':actif', $actif);


  $temp=time();
  $temps=$duree;
  $debut=date("Y-m-d H:i:s",$temp);
  $fin=$datefin;
  $actif="encours";
  $tarif=$_POST['abonnee'];
   $IDL=$_SESSION['codeliv'];

   $_SESSION['tarif']=$tarif;
   $_SESSION['duree']=$duree;

   //echo $tarif;

  

  if 
 ($requete->execute()) 
  {
  echo"ok";
  //header('location:admin_liv_abonne_payer.php');   
  
  ?>
  <script>
                document.location.href="admin_liv_abonne_payer.php";

  </script>

  <?php
 }
}else{
  
  //reabonnement pour un abonné
  
   $requeteup = $bdd->prepare('UPDATE abonnement set actif="non"
  where id_liv=:id_liv AND actif=:actif' );
      
  
  $requeteup->bindParam(':id_liv', $IDL);
  $requeteup->bindParam(':actif', $actif1);



  $actif1="oui";
   $IDL=$_SESSION['codeliv'];


   //echo $tarif;
   
     if 
 ($requeteup->execute()) 
  {
  //echo"ok";
  //header('location:admin_liv_abonne_payer.php');   
  
  }
  
  //modification dans la table livreur du champs Abonne
  
   $requeteup2 = $bdd->prepare('UPDATE livreur set Abonne="non"
  where IDLIV=:IDLIV AND Abonne="oui" ' );
      
  
  $requeteup2->bindParam(':IDLIV', $IDL);
 



 
   $IDL=$_SESSION['codeliv'];


   //echo $tarif;
   
     if($requeteup2->execute()) 
  {
  //echo"ok";
  //header('location:admin_liv_abonne_payer.php');   
  
  }
  
  
  
  
   
  //nouvelle insertion pour un abonnement 
   $requete = $bdd->prepare('INSERT INTO abonnement (id_liv,duree,debut,fin,Tarif,actif)
  values (:id_liv,:duree,:debut,:fin,:Tarif,:actif)');
      
  $requete->bindParam(':id_liv', $IDL);
  $requete->bindParam(':duree', $temps);
  $requete->bindParam(':debut', $debut);
  $requete->bindParam(':fin', $fin);
  $requete->bindParam(':Tarif', $tarif);
  $requete->bindParam(':actif', $actif);


  $temp=time();
  $temps=$duree;
  $debut=date("Y-m-d H:i:s",$temp);
  $fin=$datefin;
    $actif="encours";

  $tarif=$_POST['abonnee'];
   $IDL=$_SESSION['codeliv'];

   $_SESSION['tarif']=$tarif;
   $_SESSION['duree']=$duree;


  

  if($requete->execute()) 
  {
  //echo"ok";
  //header('location:admin_liv_abonne_payer.php'); 
  //modification dans livreur du champs Abonne
   $ab=$bdd->query("UPDATE livreur set Abonne='encours' WHERE IDLIV='".$_SESSION['codeliv']."' ");
  
  ?>
  <script>
                document.location.href="admin_liv_abonne_payer.php";

  </script>

  <?php
 }
    
}
}

$verif =$bdd->query("select * from livraison where Statut!='Livré' and Annuler='non' and IDLIV=".$_SESSION['codeliv']);
//decompte 
$compt1=$verif->rowCount();

//verification des livraisons non faite appartenant au livreur connecté non abonné
$verification =$bdd->query("select * from validation_com where IDLIV=".$_SESSION['codeliv']);
//decompte 
$compteur=$verification->rowCount();

$verifier=$bdd->query("SELECT * from reglement_inter where id_livreur='".$_SESSION['codeliv']."' ");

$nbre=$verifier->rowCount();



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
       
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">          
        <ul>
                        <li><a href="https://t.me/joinchat/SAKrk-AzDHlhMWI0" style="color:red;"><i class="fa fa-telegram fa-fw"></i>Acceder a la communaute</a></li>

            <li> <?php include('admin_liv_aff_credit.php'); ?> </li>
            <li><a href="admin_livreur.php" ><i class="fa fa-bar-chart fa-fw" ></i>Livraison(s) disponible(s)</a></li>
                        <li><a href="tableau_prix.php"><i class="fa fa-money fa-fw"></i>
            Table Prix Livraison</a></li>
            <li><a href="" class=""><i class="fa fa-home fa-fw"></i>Droit et obligation</a></li>
            <li>
            <?php if($nbre>0){ ?>
            <a href="admin_liv_credit_attente.php"><i class="fa fa-database fa-fw"></i>En Attente</a>

            <?php }else{ ?>
            <a href="admin_liv_crediter.php"><i class="fa fa-database fa-fw"></i>crediter compte</a>
            <?php } ?>
            </li>            <li><a href="deconnect.php"><i class="fa fa-eject fa-fw"></i>Deconnexion</a></li>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
            <ul class="text-uppercase">
                <li><a href="admin_liv_info.php"  >Voir mes infos</a></li>
                <li><a href="admin_liv_historique.php" >historique</a></li>
                <li><a href="" class="active">m'abonner</a></li>
                <?php if($compt1>=1){ ?>
                  <span class="badge"><?php echo $compt1;  ?>+</span>
                <?php }elseif($compteur>=1){ ?>
                  <span class="badge"><?php echo $compteur;  ?>+</span>
                <?php }?>
                
              </ul>  
            </nav> 
          </div>
        </div>

        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Abonnement</h2></center>
            <hr>


            <div class="templatemo-flex-row flex-content-row">
           
          
            <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative templatemo-content-img-bg">
              <!--<img src="images/sunset-big.jpg" alt="Sunset" class="img-responsive content-bg-img">-->
              
              <h2 class="templatemo-position-relative black-text text-center">1 mois</h2>
              <hr>
              <br/>
              <br/>

              <h3 class="templatemo-position-relative black-text text-center">10 000 FcFa</h3>
              <br/>
              <br/>
              <br/>

              

              

              <form method="post" class="templatemo-login-form">
                    <div class="form-group">
                      <center><button type="submit" name="abonnee" value="<?php echo "10000";  ?>" class="templatemo-blue-button">S'abonner</button> 
                    
                      
                    </center>
                    </div>
                  </form>                        
            </div>

            <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative templatemo-content-img-bg">
            <h2 class="templatemo-position-relative black-text text-center">3 mois</h2>
              <hr>

              <br/>
              <br/>

              <h3 class="templatemo-position-relative black-text text-center">20 000 FcFa</h3>
              <br/>
              <br/>
              <br/>

              

              

              <form method="post" class="templatemo-login-form">
                    <div class="form-group">
                      <center><button type="submit" name="abonnee" value="<?php echo "20000";  ?>" class="templatemo-blue-button">S'abonner</button> 
                    
                      
                    </center>
                    </div>
                  </form>                             
            </div>

            <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative templatemo-content-img-bg">
            <h2 class="templatemo-position-relative black-text text-center">6 mois</h2>
              <hr>

              <br/>
              <br/>

              <h3 class="templatemo-position-relative black-text text-center">40 000 FcFa</h3>
              <br/>
              <br/>
              <br/>

              

              

              <form method="post" class="templatemo-login-form">
                    <div class="form-group">
                      <center><button type="submit" name="abonnee" value="<?php echo "40000";  ?>" class="templatemo-blue-button">S'abonner</button> 
                    
                      
                    </center>
                    </div>
                  </form>                            
            </div>

            <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative templatemo-content-img-bg">
              <!--<img src="images/sunset-big.jpg" alt="Sunset" class="img-responsive content-bg-img">-->
              <h2 class="templatemo-position-relative black-text text-center">1 an</h2>
              <hr>

              <br/>
              <br/>

              <h3 class="templatemo-position-relative black-text text-center">60 000 FcFa</h3>
              <br/>
              <br/>
              <br/>

              

              

              <form method="post" class="templatemo-login-form">
                    <div class="form-group">
                      <center><button type="submit" name="abonnee" value="<?php echo "60000";  ?>" class="templatemo-blue-button">S'abonner</button> 
                    
                      
                    </center>
                    </div>
                  </form>              
            </div>
          </div>
<!-- tableau zone 1 -->
        
       
       
         </div>
         </div>

         
            
          <footer class="text-right">
           <?php include ("foot.php"); ?>
          </footer>         
        </div>
      </div>
    </div>
    
    <!-- JS -->
    <script src="js/jquery-1.11.2.min.js"></script>      <!-- jQuery -->
    <script src="js/jquery-migrate-1.2.1.min.js"></script> <!--  jQuery Migrate Plugin -->
    <script src="https://www.google.com/jsapi"></script> <!-- Google Chart -->
    <script>
      /* Google Chart 
      -------------------------------------------------------------------*/
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart); 
      
      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

          // Create the data table.
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Topping');
          data.addColumn('number', 'Slices');
          data.addRows([
            ['Mushrooms', 3],
            ['Onions', 1],
            ['Olives', 1],
            ['Zucchini', 1],
            ['Pepperoni', 2]
          ]);

          // Set chart options
          var options = {'title':'How Much Pizza I Ate Last Night'};

          // Instantiate and draw our chart, passing in some options.
          var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart_div'));
          pieChart.draw(data, options);

          var barChart = new google.visualization.BarChart(document.getElementById('bar_chart_div'));
          barChart.draw(data, options);
      }

      $(document).ready(function(){
        if($.browser.mozilla) {
          //refresh page on browser resize
          // http://www.sitepoint.com/jquery-refresh-page-browser-resize/
          $(window).bind('resize', function(e)
          {
            if (window.RT) clearTimeout(window.RT);
            window.RT = setTimeout(function()
            {
              this.location.reload(false); /* false to get page from cache */
            }, 200);
          });      
        } else {
          $(window).resize(function(){
            drawChart();
          });  
        }   
      });
      
    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->

  </body>
</html>