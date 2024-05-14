<?php
session_start();


if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}

include('connection.php');
$bdd = connect();
if (isset($_GET['supp'])){
	$requ=$bdd->query("DELETE FROM livraison WHERE IDCOLIS='".$_GET['IDCOLIS']."' ");
	
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
    <title>TOUTLIVRER</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <meta http-equiv="Refresh" content="60"; url="livraison_liste_livree.php">
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
            <li><a href="livraison_liste.php" class="active"><i class="fa fa-database fa-fw"></i>Livraison</a></li>
                         <li><a href="commercial_liste.php"><i class="fa fa-bar-chart fa-fw"></i>Commercial</a></li>

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
                <li><a href="livraison.php"  >Ajout livraison</a></li>
                <li><a href="livraison_liste_livree.php" class="active">livraison(s) effectuée(s)</a></li>
                <li><a href="livraison_liste_all.php">Toutes livraisons<?php if($compt>=1){ ?>
              <span class="badge"><?php echo $compt;  ?>+</span>
            <?php } ?></a></li>
                
                
                
              </ul>  
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Liste des livraisons éffectuées</h2></center>
    </div>
              
              
           <?php


      
     
        $con = new PDO ('mysql:host=localhost;dbname=toutl2jw_bd_livraison', 'root', 'root');
        $rete=$con->query("SELECT IDCOLIS,nom,nomliv,typescolis,poids,volume,adresseOrig,adresseLivraison,nbColis,Statut,Description,livraison.TypeVehicule FROM livraison,livreur,client where livraison.IDCLI=client.IDCLI and livraison.IDLIV=livreur.IDLIV and Statut='Livré' ",PDO::FETCH_BOUND);

      
       $rete->bindColumn('IDCOLIS',$id);
       $rete->bindColumn('nom',$NOM);
       $rete->bindColumn('nomliv',$NOMLIV);
       $rete->bindColumn('typescolis',$TYPE);
       $rete->bindColumn('poids',$POIDS);
       $rete->bindColumn('volume',$VOLUME);
       $rete->bindColumn('adresseOrig',$ADRESS);
       $rete->bindColumn('adresseLivraison',$ADRESSLIV);
       $rete->bindColumn('nbColis',$NB);
       $rete->bindColumn('Statut',$STATUT);
       $rete->bindColumn('Description',$DESCR);
       
       $rete->bindColumn('TypeVehicule',$TYPEV);  
?>



          </div>
            
              <div class="panel panel-default table-responsive">

              <br>
              <form class="form-inline active-pink-4 text-center">
                <input class="form-control form-control-sm mr-3 w-75" type="text" placeholder="recherche par nom"
                   aria-label="Search" id="myInput" onkeyup="myFunction()">
                   <i class="fas fa-search" aria-hidden="true"></i>
              </form>

              <br>
              <table class="table table-hover mt-3 table-striped table-bordered templatemo-user-table text-center " id="myTable">
                  <thead>
                    <tr>
                      <td><a href="" class="white-text templatemo-sort-by">#<span class="caret"></span></a></td>

                      <td><a href="" class="white-text templatemo-sort-by">Nom Client<span class="caret"></span></a></td>
                      <td><a href="" class="white-text templatemo-sort-by">Nom Livreur<span class="caret"></span></a></td>
                      <td><a href="" class="white-text templatemo-sort-by">Type de Colis<span class="caret"></span></a></td>
                      <td><a href="" class="white-text templatemo-sort-by">Adresse d'Origine<span class="caret"></span></a></td>
                      <td><a href="" class="white-text templatemo-sort-by">Adresse de Destination<span class="caret"></span></a></td>
                      <td><a href="" class="white-text templatemo-sort-by">Description<span class="caret"></span></a></td>
                      <td><a href="" class="white-text templatemo-sort-by">Statut<span class="caret"></span></a></td>
                      
                      <td>Modification</td>
                      <td>Suppression</td>
                    </tr>
                  </thead>
                  <tbody>
                     <?php while ($rete->fetch()){ ?>
                    <tr>
                        <td><?php print $id; ?></td>
                        <td><?php print $NOM; ?></td>
                        <td><?php print $NOMLIV; ?></td>
                        <td><?php print $TYPE; ?></td>
                        <td><?php print $ADRESS; ?></td>
                        <td><?php print $ADRESSLIV; ?></td>
                        <td><?php print $DESCR; ?></td>
                        
                        <td><?php print $STATUT; ?></td>
                    
        
                        <td><a href="livraison_modification.php?IDCOLIS=<?php  echo $id;?>" class="templatemo-edit-btn" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                      
                        <td><a href="livraison_liste.php?IDCOLIS=<?php  echo $id;?>&supp=ok" class="templatemo-edit-btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php  }?>
                  </tbody>
                </table>    
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

      function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }


    </script>


    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>