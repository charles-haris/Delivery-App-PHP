<?php
session_start();


if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}
//require 'GereImg.php';



include('connection.php');
$bdd = connect();
$error="";
if(isset($_POST["envoi"]))
{

  $verific=$bdd->query("select * from commerciaux where nom_com='".$_POST["nom_com"]."' 
  and prenom_com='".$_POST["prenom_com"]."' and tel_com='".$_POST["tel_com"]."' ");

 $vrf=$verific->rowCount();
 
  $verifik=$bdd->query("select * from commerciaux where identifiant='".$_POST["identifiant"]."' ");

 $vrfk=$verifik->rowCount();

  if($vrf<1){
      
        if($vrfk<1){


       
  $stmt = $bdd->prepare('INSERT INTO commerciaux (nom_com,prenom_com,tel_com,adresse_com,identifiant,password)
  values(:nom_com,:prenom_com,:tel_com,:adresse_com,:identifiant,:password)');
      
          $stmt->bindParam(':nom_com', $nom);
          $stmt->bindParam(':prenom_com', $prenom);
          $stmt->bindParam(':tel_com', $tel);
          $stmt->bindParam(':adresse_com', $adresse);
          $stmt->bindParam(':identifiant', $identifiant);
          $stmt->bindParam(':password', $password);
          
          
          
      
  if(isset($_POST["nom_com"])) $nom=strtoupper(htmlspecialchars($_POST["nom_com"]));
  if(isset($_POST["prenom_com"])) $prenom=strtoupper(htmlspecialchars($_POST["prenom_com"]));
  if(isset($_POST["tel_com"]))  $tel=strtoupper(htmlspecialchars($_POST["tel_com"]));
  if(isset($_POST["adresse_com"])) $adresse=strtoupper(htmlspecialchars($_POST["adresse_com"]));
  if(isset($_POST["identifiant"])) $identifiant=htmlspecialchars($_POST["identifiant"]);
  if(isset($_POST["password"]))  $password= sha1($_POST["password"].'doudounet');




              if 
              ($stmt->execute()) 
              {
              echo"ok";
              //header('location:livreur_liste.php');   
               $error='<div class="form-group text-center alert alert-success" role="alert">
                    Inscription réussie
                    </div>';;
              }
                  }else{
                      $error='<div class="form-group text-center alert alert-danger" role="alert">
              identifiant deja existant !
          </div>'; 
                  }
            }else{
              $error='<div class="form-group text-center alert alert-danger" role="alert">
              il est déjà inscrit !
          </div>';
            }
            }

            if(isset($_POST["Annuler"]))
            {
                $_POST["nom_com"]="";
                $_POST["prenom_com"]="";
                $_POST["tel_com"]="";
                $_POST["adresse_com"]="";
               
                $_POST["identifiant"]="";
                $_POST["password"]="";
            }

            $verif =$bdd->query("select validation_com.IDCOLIS,typescolis,poids,Description,adresseOrig,validation_com.IDLIV,adresseLivraison,Statut from validation_com,livraison where validation_com.IDCOLIS=livraison.IDCOLIS  ");
            //decompte 
            $compt=$verif->rowCount();

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>e-TOUTLIVRER</title>
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
<!--         <div class="profile-photo-container">
          <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
          <div class="profile-photo-overlay"></div>
        </div>       -->
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
            <li><a href="livreur_liste.php" ><i class="fa fa-home fa-fw"></i>Livreur</a></li>
            <li><a href="client_liste.php" ><i class="fa fa-bar-chart fa-fw"></i>Client</a></li>
            <li><a href="livraison_liste.php"><i class="fa fa-database fa-fw"></i>Livraison<?php if($compt>=1){ ?>
              <span class="badge"><?php echo $compt;  ?>+</span>
            <?php } ?></a>
            
             </li>
                          <li><a href="commercial_liste.php" class="active"><i class="fa fa-bar-chart fa-fw"></i>Commercial</a></li>

             <li><a href="valider_credit.php"><i class="fa fa-eject fa-fw"></i>Valider Credit<?php if($_SESSION['notification_credit']>=1){ ?>
              <span class="badge"><?php echo $_SESSION['notification_credit'];  ?>+</span>
            <?php } ?></a>
             </li>
            <li><a href="valider_abonnement.php"><i class="fa fa-eject fa-fw"></i>Valider Abonnement<?php if($_SESSION['notification_abonnement']>=1){ ?>
              <span class="badge"><?php echo $_SESSION['notification_abonnement'];  ?>+</span>
            <?php } ?></a>
            </li>           
            <li><a href="deconnect.php"><i class="fa fa-eject fa-fw"></i>Deconnexion</a></li>          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="commercial.php"  class="active">Ajout Commercial</a></li>
                <li><a href="">Contrat</a></li>
                <li><a href="">Compte Courant</a></li>
                
              </ul>  
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Inscription d'un agent commercial</h2></center>
            <hr>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="row form-group">
                <div class=" col-md-6 form-group">                  
                    <label for="inputLastName">NOM</label>
                    <input type="text" name="nom_com" class="form-control" id="inputLastName" placeholder="votrte nom" required="">                  
                </div> 
              
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputUsername">PRENOM</label>
                    <input type="text" name="prenom_com" class="form-control" id="inputUsername" placeholder="votre prenom" required="">                  
                </div>
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputEmail">TEL</label>
                    <input type="text" name="tel_com" class="form-control" id="inputEmail" placeholder="Ex:78......." required="">                  
                </div> 
       
             
                <div class=" col-md-6 form-group">                  
                    <label for="inputCurrentPassword">ADRESSE</label>
                    <input type="text" name="adresse_com" class="form-control " placeholder="" id="inputCurrentPassword" required="">                  
                </div>                
            
             
               
                <div class=" col-lg-6 col-md-6  form-group">                  
                    <label for="inputConfirmNewPassword">Identifiant</label>
                    <input type="text" name="identifiant" class="form-control" placehorder="votre identifiant" id="inputConfirmNewPassword">
                </div> 

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="votre mot de passe" id="inputConfirmNewPassword">
                </div> 
              <br>
              <br>
                  <hr> 

                  <div class=" form-group" style="float:center;">  
                  <br>
                  <hr>            
                  <center>  <input type="submit" value="Envoyer" name="envoi" class="btn btn-primary" style="padding: 7px 50px; border-radius:4px; margin-right:10px;"  />
                    <input type="submit" value="Annuler"  class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:10px; " />    </center> 
              </div>
              <?php echo $error; ?>
            </div>
              
           <?php

//  $con = new PDO ("mysql:host=localhost;dbname=bd_livraison","root","root");
      
     

//         $rete=$con->query("SELECT * FROM  livreur ",PDO::FETCH_BOUND);

      
//        $rete->bindColumn('IDLIV',$id);
//        $rete->bindColumn('nomliv',$NOM);
//        $rete->bindColumn('prenomliv',$PRENOM);
//        $rete->bindColumn('telliv',$TEL);
//        $rete->bindColumn('cni',$CNI);
//        $rete->bindColumn('typeVehicule',$TYPEVEHICULE);
//        $rete->bindColumn('imatVehicule',$IMATVEHICULE);
//        $rete->bindColumn('capacite',$CAPACITE); 
//        $rete->bindColumn('Numero_permis',$NUMERO_PERMIS);
//        $rete->bindColumn('Numero_assurance_en_cours',$NUMERO_ASSURANCE);
//        $rete->bindColumn('Date_validite',$DATE);
//        $rete->bindColumn('type_permis',$TYPE_PERMIS);
//        $rete->bindColumn('photo_permis',$PHOTO_PERMIS);
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

      var gaugeChart;
      var gaugeData;
      var gaugeOptions;
      var timelineChart;
      var timelineDataTable;
      var timelineOptions;
      var areaData;
      var areaOptions;
      var areaChart;

      /* Gauage 
      --------------------------------------------------*/
      google.load("visualization", "1", {packages:["gauge"]});
      google.setOnLoadCallback(drawGauge);
      google.load("visualization", "1", {packages:["timeline"]});
      google.setOnLoadCallback(drawTimeline);
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);

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
            drawCharts();
          });  
        }   
      });

      function drawGauge() {

        gaugeData = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['Memory', 80],
          ['CPU', 55],
          ['Network', 68]
        ]);

        gaugeOptions = {
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        gaugeChart = new google.visualization.Gauge(document.getElementById('gauge_div'));
        gaugeChart.draw(gaugeData, gaugeOptions);

        setInterval(function() {
          gaugeData.setValue(0, 1, 40 + Math.round(60 * Math.random()));
          gaugeChart.draw(gaugeData, gaugeOptions);
        }, 13000);
        setInterval(function() {
          gaugeData.setValue(1, 1, 40 + Math.round(60 * Math.random()));
          gaugeChart.draw(gaugeData, gaugeOptions);
        }, 5000);
        setInterval(function() {
          gaugeData.setValue(2, 1, 60 + Math.round(20 * Math.random()));
          gaugeChart.draw(gaugeData, gaugeOptions);
        }, 26000);        
      } // End function drawGauage

      /* Timeline
      --------------------------------------------------*/
      function drawTimeline() {
        var container = document.getElementById('timeline_div');
        timelineChart = new google.visualization.Timeline(container);
        timelineDataTable = new google.visualization.DataTable();
        timelineDataTable.addColumn({ type: 'string', id: 'Room' });
        timelineDataTable.addColumn({ type: 'string', id: 'Name' });
        timelineDataTable.addColumn({ type: 'date', id: 'Start' });
        timelineDataTable.addColumn({ type: 'date', id: 'End' });
        timelineDataTable.addRows([
          [ 'Magnolia Room',  'CSS Fundamentals',    new Date(0,0,0,12,0,0),  new Date(0,0,0,14,0,0) ],
          [ 'Magnolia Room',  'Intro JavaScript',    new Date(0,0,0,14,30,0), new Date(0,0,0,16,0,0) ],
          [ 'Magnolia Room',  'Advanced JavaScript', new Date(0,0,0,16,30,0), new Date(0,0,0,19,0,0) ],
          [ 'Gladiolus Room', 'Intermediate Perl',   new Date(0,0,0,12,30,0), new Date(0,0,0,14,0,0) ],
          [ 'Gladiolus Room', 'Advanced Perl',       new Date(0,0,0,14,30,0), new Date(0,0,0,16,0,0) ],
          [ 'Gladiolus Room', 'Applied Perl',        new Date(0,0,0,16,30,0), new Date(0,0,0,18,0,0) ],
          [ 'Petunia Room',   'Google Charts',       new Date(0,0,0,12,30,0), new Date(0,0,0,14,0,0) ],
          [ 'Petunia Room',   'Closure',             new Date(0,0,0,14,30,0), new Date(0,0,0,16,0,0) ],
          [ 'Petunia Room',   'App Engine',          new Date(0,0,0,16,30,0), new Date(0,0,0,18,30,0) ]]);

        timelineOptions = {
          timeline: { colorByRowLabel: true },
          backgroundColor: '#ffd'
        };

        timelineChart.draw(timelineDataTable, timelineOptions);
      } // End function drawTimeline

      /* Area Chart 
      --------------------------------------------------*/
      function drawChart() {
        areaData = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2013',  1000,      400],
          ['2014',  1170,      460],
          ['2015',  660,       1120],
          ['2016',  1030,      540]
        ]);

        areaOptions = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        areaChart = new google.visualization.AreaChart(document.getElementById('area_chart_div'));
        areaChart.draw(areaData, areaOptions);
      } // End function drawChart

      function drawCharts () {
          gaugeChart.draw(gaugeData, gaugeOptions);
          timelineChart.draw(timelineDataTable, timelineOptions);
          areaChart.draw(areaData, areaOptions);
      }

    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>