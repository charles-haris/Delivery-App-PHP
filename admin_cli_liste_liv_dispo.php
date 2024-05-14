<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}


 //connexion a la base de donnée
    $bdd = new PDO('mysql:host=localhost; dbname=bd_livraison', 'root', 'root');

    //recuperation dans la base de donnée
    /* $recup =$bdd->query("select * from client where identifiant='".$_SESSION['id']."' ");
    //$recup->bindColumn('IDLIV',$IDLIV);
    if($result=$recup->fetchObject()){
      //var_dump($result);
      $IDCLI=$result->IDCLI;
      $nom=$result->nom;
      $prenom=$result->prenom;
      $tel=$result->tel;
      $societe=$result->societe;
      $adresse=$result->adresse;
      $mail=$result->mail;
      $datenaiss=$result->datenaiss;
    }

    //enregistrement dans des session
    $_SESSION['codecli']=$IDCLI;
    $_SESSION['nom']=$nom;
    $_SESSION['prenom']=$prenom;
    $_SESSION['tel']=$tel;
    $_SESSION['societe']=$societe;
    $_SESSION['adresse']=$adresse;
    $_SESSION['mail']=$mail;
    $_SESSION['datenaiss']=$datenaiss; */

    //verification des livraisons non faite appartenant au livreur connecté abonné
    $verif =$bdd->query("select IDLIV,nomliv,prenomliv,telliv,typeVehicule from livreur,abonnement where livreur.IDLIV=abonnement.idflogin");
    //decompte 
    $compt=$verif->rowCount();

    $verif->bindColumn('IDLIV',$id);
    $verif->bindColumn('nomliv',$nomliv);
    $verif->bindColumn('prenomliv',$prenomliv);
    $verif->bindColumn('telliv',$telliv);
    $verif->bindColumn('typeVehicule',$typeVehicule);
    

    /* //verification des livraisons non faite appartenant au livreur connecté non abonné
    $verification =$bdd->query("select * from validation_com where IDCLI=".$IDCLI);
    //decompte 
    $compteur=$verification->rowCount(); */

    //abonné ou pas
   /*  $abonn =$bdd->query("select * from client where identifiant='".$_SESSION['id']."' and Abonne='oui' ");
    $nbr=$abonn->rowCount();

    if($nbr<1){
      $Abonne="M'ABONNER";
      $href="admin_cli_s_abonne.php";
    }else{
      $Abonne="LIVREUR(S) DISPONIBLE(S)";
      $href="admin_cli_liste_liv_dipo.php"; */
    

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
            <li><a href="admin_cli_com_en_cours.php" ><i class="fa fa-home fa-fw"></i>Commandes en cours</a></li>
            <li><a href="admin_client.php" ><i class="fa fa-bar-chart fa-fw"></i>Mon historique</a></li>
            <li><a href=""><i class="fa fa-database fa-fw"></i>Droit et Obligation</a></li>
            <li><a href="deconnect.php"><i class="fa fa-eject fa-fw"></i>Deconnexion</a></li>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="admin_cli_info.php" >Mon profil</a></li>
                <li><a href="page_livraison.php">Nouvelle commande</a></li>
                <li><a href="admin_cli_liste_liv_dispo.php" class="active">Livreur(s) Disponible(s)</a></li>
               
                
              </ul>  
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
        <?php if($compt>0){  ?>
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Livreurs Abonnes Disponibles "<?php echo $_SESSION["id"]; ?>"</h2></center>
            <hr>
          
             
            <table class="table table-striped table-bordered templatemo-user-table text-center">
                  <thead>
                    <tr>
                      <td><a  class="white-text templatemo-sort-by">Nom<span class="caret"></span></a></td>

                      <td><a  class="white-text templatemo-sort-by">Prenom<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Telephone<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Type de Vehicule<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Sélection<span class="caret"></span></a></td>

                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        while($verif->fetch()){ ?>
                    <tr>
                        <td><?php echo $nomliv ?></td>
                        <td><?php echo $prenomliv ?></td>
                        <td><?php echo $telliv ?></td>
                        <td><?php echo $typeVehicule ?></td>
                        <td><a href="page_livraison.php?IDLIV=<?php  echo $id;?>&selection=ok" class="templatemo-edit-btn btn-danger" >Choisir</a></td>
                       

                       
                    
        
                        
                    </tr>
                    <?php  }?>
                  </tbody>
                </table>    
            




          </div>
                        <?php  }else {?>

                          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Livreurs Abonnes Disponibles  <?php echo $_SESSION["id"]; ?></h2></center>
            <hr>
            <p class="text-center text-uppercase">Aucun livreur Abonné disponible</p>
            <center><button href="admin_livreur.php" class="templatemo-edit-btn">nouvelle commande</button></center>
             
              <hr>
         
          </div>

                       <?php } ?>

            
                                       
        
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