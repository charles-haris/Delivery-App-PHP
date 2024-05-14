<?php
session_start();


if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}


    $compt="";
    //connexion a la base de donnée
    $bdd = new PDO('mysql:host=localhost; dbname=bd_livraison', 'root', 'root');
    //recuperation des info du livreur connecté
    $recup =$bdd->query("select * from livreur where identifiant='".$_SESSION['id']."' ");
    //$recup->bindColumn('IDLIV',$IDLIV);
    if($result=$recup->fetchObject()){
      //var_dump($result);
      $IDLIV=$result->IDLIV;
      $nomliv=$result->nomliv;
      $prenom=$result->prenomliv;
      $tel=$result->telliv;
      $cni=$result->cni;
      $type=$result->typeVehicule;
      $imatricule=$result->imatVehicule;
      $capacite=$result->capacite;
      $date_validite=$result->Date_validite;
      $type_permis=$result->type_permis;
      $numero_permis=$result->Numero_permis;
      
    }
    //enregistrement dans des session
    $_SESSION['codeliv']=$IDLIV;
    $_SESSION['nomliv']=$nomliv;
    $_SESSION['prenomliv']=$prenom;
    $_SESSION['telliv']=$tel;
    $_SESSION['cni']=$cni;
    $_SESSION['typeV']=$type;
    $_SESSION['imatricule']=$imatricule;
    $_SESSION['capacite']=$capacite;
    $_SESSION['date_validite']=$date_validite;
    $_SESSION['type_permis']=$type_permis;
    $_SESSION['numero_permis']=$numero_permis;

    //verification des livraisons non faite appartenant au livreur connecté
    $verif =$bdd->query("select * from livraison where Statut!='Livré' and IDLIV=".$IDLIV);
    //decompte 
    $compt=$verif->rowCount();
    if($result=$verif->fetchObject()){
      //var_dump($result);
      $ID=$result->IDCOLIS;
      
    }




    //recuperation dans la base de donnée des livraisons disponible
    $var =$bdd->query("select * from livraison where Statut!='Livré' and IDLIV is null");

    //selection des champs et attribution a des variables
    $var->bindColumn('IDCOLIS',$IDCOLIS);
    $var->bindColumn('typescolis',$typescolis);
    $var->bindColumn('poids',$poids);
    $var->bindColumn('volume',$volume);
    $var->bindColumn('Description',$Description);
    
    //lorsqu'on clique sur le bouton prendre
if(isset($_POST['prendre'])){

  $st = $bdd -> prepare("UPDATE livraison
  set
  IDLIV=:IDLIV
  WHERE IDCOLIS=:IDCOLIS ");

  $st->bindParam(':IDLIV', $IDLI);
  $st->bindParam(':IDCOLIS', $IDCOL);
     
  $IDLI=$_SESSION['codeliv'];
  $IDCOL=$_POST['prendre'];

  if ($st->execute()) 
          {
          echo "ok";
         }
         
         $requete = $bdd->prepare('INSERT INTO Temps (IDCOLIS,IDLIV,temps_accept_liv)
         values(:IDCOLIS,:IDLIV,:temps_accept_liv)');
             
         $requete->bindParam(':IDCOLIS', $IDCOLI);
         $requete->bindParam(':IDLIV', $IDL);
         $requete->bindParam(':temps_accept_liv', $recupTemps);
        
          $IDCOLI=$_POST['prendre'];
          $IDL=$_SESSION['codeliv'];
          $temps=time();
          //echo date("Y-m-d H:i:s",$temps); 
          $recupTemps=date("Y-m-d H:i:s",$temps);

          //echo date("Y-m-d H:i:s",$temps); 
          
          
          $_SESSION['temps']=date('Y-m-d H:i:s',strtotime("+4 minutes"));
       
       
         if 
        ($requete->execute()) 
         {
         echo"ok";
         header('location:admin_livreur.php');   
        }


}

//quand on clique sur le bouton livré
if(isset($_POST['livree'])){

  $stat = $bdd -> prepare("UPDATE livraison
  set
  Statut=:Statut
  WHERE IDCOLIS=:IDCOLIS ");

  $stat->bindParam(':Statut', $Statut);
  $stat->bindParam(':IDCOLIS', $ID_COLIS);
     
  $Statut="Livré";
  $ID_COLIS=$_POST['livree'];

  if ($stat->execute()) 
          {
          echo "ok";
         }
         
  $statem = $bdd -> prepare("UPDATE Temps
  set
  temps_colis_livre=:temps_colis_livre
  WHERE IDCOLIS=:IDCOLIS and IDLIV=:IDLIV");

  
  $statem->bindParam(':temps_colis_livre', $temps_colis_livre);
  $statem->bindParam(':IDCOLIS', $_ID_COLIS);
  $statem->bindParam(':IDLIV', $_ID_LIV);

  $temps=time();
  $temps_colis_livre=date("Y-m-d H:i:s",$temps);
        //session qui enregistre le temps
  $_ID_COLIS=$_POST['livree'];
  $_ID_LIV=$_SESSION['codeliv'];

  if ($statem->execute()) 
          {
          echo "ok";
          header('location:admin_livreur.php'); 
         }


}
//gestion des dates 


function dateDifference($temps1 , $temps2 , $differenceFormat = '%h %i %s' )
{
    $datetime1 = date_create($temps1);
    $datetime2 = date_create($temps2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
   
}

$temp=time();
//echo date("Y-m-d H:i:s",$temps); 

$temps_colis_livr=date("Y-m-d H:i:s",$temps);
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
        <div class="profile-photo-container">
          <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">  
          <div class="profile-photo-overlay"></div>
        </div>    
        
        <!-- Search box -->
       
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
          </div>
        <nav class="templatemo-left-nav">          
           <ul>
           <li><a href="admin_livreur.php" ><i class="fa fa-bar-chart fa-fw" class="active"></i>Livraison(s) disponible(s)</a></li>
           <li><a href="" class=""><i class="fa fa-home fa-fw"></i>Droit et obligation</a></li>
            
            <li><a href=""><i class="fa fa-database fa-fw"></i>menu2</a></li>
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
                <li><a href="admin_liv_info.php"  class="active">Voir mes infos</a></li>
                <li><a href="admin_liv_historique.php">historique</a></li>
                <li><a href="">m'abonner</a></li>
                <li><a href="deconnect.php">Deconnexion</a></li>
                
              </ul>  
            </nav> 
          </div>
        </div>
       <?php
        if($compt<1){

      ?>
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Info Livreur "<?php echo $_SESSION["id"]; ?>"</h2></center>
            <hr>
          
             
            <table class="table table-striped table-bordered templatemo-user-table text-center">
                  <thead>
                    <tr>
                      <td><a  class="white-text templatemo-sort-by">Type Colis<span class="caret"></span></a></td>

                      <td><a  class="white-text templatemo-sort-by">Poids<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Volume<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Description<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">prendre une commande<span class="caret"></span></a></td>
                      
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        while($var->fetch()){ ?>
                    <tr>
                        <td><?php echo $typescolis ?></td>
                        <td><?php echo $poids ?></td>
                        <td><?php echo $volume ?></td>
                        <td><?php echo $Description ?></td>
                        <td><form method="POST" >
                        <button type="submit" name="prendre" value="<?php echo $IDCOLIS ?>" class="templatemo-edit-btn">prendre</button>
                        </form>
                        </td>

                       
                    
        
                        
                    </tr>
                    <?php  }?>
                  </tbody>
                </table>   
                
          
          </div>
          <?php
        }else{
        ?>

<div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Info Livreur "<?php echo $_SESSION["id"]; ?>"</h2></center>
            <?php
            $recupdate=$bdd->query("select temps_accept_liv from Temps where IDLIV=".$_SESSION['codeliv']." and IDCOLIS=".$ID ." ");
            //$recupdate->bindColumn('temps_accept_liv',$tem);
            $aff=$recupdate->fetch();

            $temps=time(); 
            $temps2=date("Y-m-d H:i:s",$temps);
            //$recupdate->bindColumn('temps_accept_liv',$temps1);

            //echo date('Y-m-d H:i:s',strtotime("+30 minutes"));  //comming year o/p 11.23.2013

            echo $_SESSION['temps'];


            ?>
            <hr>
            <p class="text-center text-uppercase">Vous avez pris en charge la commande N° <?php echo $ID ?> à <?php echo $aff['temps_accept_liv']; //echo date('Y-m-d H:i:s',strtotime("+30 minute 00 seconde")); ?>, vous avez 30min pour livré le colis <br> 

            Veuillez indiquer que la livraison a été bien faite en cliquant ici</p>
            <center><form method="POST" >
                        <button type="submit" name="livree" value="<?php echo $ID ?>" class="templatemo-edit-btn">Livré</button>
                        </form></center>
<hr>
                        <center><p class="text-center text-uppercase"> Temps écroulé : <?php echo dateDifference($temps2 , $aff['temps_accept_liv'], $differenceFormat = '%i minutes %s secondes' ); ?><br>
                        Réactualiser pour connaitre le nouveau temps.
            </p></center>

            <?php 

            if(strtotime($_SESSION['temps'])<srttotime($temps_colis_livr)){
            ?>
            <center><p class="text-center text-uppercase"> Vous avez depassé le delai , il est actuellement <?php echo $temps_colis_livr ?><br>
            </p></center>
             <?php }else{
               }?>
              <hr>
         
          </div>
            
                                       
        <?php }?>
          <footer class="text-right">
            <p>Copyright &copy; 2084 Company Name 
            | Design: Template Mo</p>
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