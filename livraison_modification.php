<?php
session_start();


if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}
/*
include_once "../programers/program.confenv.php";


  if(isset($_POST['valider']))  
  {
    Include_once "../programers/program.identity.php";

    $veri= new Identifiant();

  if(!$veri->verifieChaine($_POST['nom'],'Nom'))
  {
    $nom=input($_POST['nom']);
  }else {
    $veri->verifieChaine($_POST['nom'],'Nom');
  }

  if(!$veri->verifieChaine($_POST['prenom'],'Prenom'))
  {
    $prenom=input($_POST['prenom']);
  }else {
    $veri->verifieChaine($_POST['prenom'],'Prenom');
  }

  if(!$veri->verifieChaine($_POST['societe'],'Societe'))
  {
    $societe=input($_POST['societe']);
  }else {
    $veri->verifieChaine($_POST['societe'],'Societe');
  
  if(!$veri->verifieChaine($_POST['cni'],'Cni'))
  {
    $cni=input($_POST['cni']);
  }else {
    $veri->verifieChaine($_POST['cni'],'Cni');
  }
  if(!$veri->verifieChaine($_POST['tel'],'Tel'))
  {
    $tel=input($_POST['tel']);
  }else {
    $veri->verifieChaine($_POST['tel'],'Tel');
  }
  if(!$veri->verifieChaine($_POST['adresse'],'adresse'))
  {
    $adresse=input($_POST['adresse']);
  }else {
    $veri->verifieChaine($_POST['adresse'],'adresse');
  }
  if(!$veri->verifieChaine($_POST['mail'],'Mail'))
  {
    $mail=input($_POST['mail']);
  }else {
    $veri->verifieChaine($_POST['mail'],'Mail');
  }
  if(!$veri->verifieChaine($_POST['date'],'Date'))
  {
    $date=input($_POST['date']);
  }else {
    $veri->verifieChaine($_POST['date'],'Date');
  }

 
  if (!$veri->verifieChaine($_POST['nom'],'Nom') && !$veri->verifieChaine($_POST['prenom'],'Prenom')  && !$veri->verifieChaine($_POST['email'],'Email')
    &&  !$veri->verifieChaine($_POST['societe'],'Societe') && !$veri->verifieChaine($_POST['cni'],'Cni') && !$veri->verifieChaine($_POST['tel'],'Tel') && !$veri->verifieChaine($_POST['adresse'],'Adresse') && !$veri->verifieChaine($_POST['mail'],'Mail') && !$veri->verifieChaine($_POST['date'],'Date'))
  {
    $sess=$_SESSION['Pseudo'];
    $con = new PDO ("mysql:host=localhost;dbname=neldam","root","");
    $rete=$con->query("DELETE FROM  confirmenvoie WHERE Client='$sess'");
    serializecon();
    header("loacation:confirmenvoie.php");
  }

}
*/

/* 

if (isset($_POST["okay"]))
{
    serializeInsc();
    header("location:../view/client.php");

} */

include('connection.php');
$bdd = connect();
$requ=$bdd->query( "SELECT *  FROM livraison WHERE IDCOLIS='".$_GET['IDCOLIS']."' ");
$aff=$requ->fetch();
if(isset($_POST["envoi"]))
{
/*
if(!empty($_POST["REGLEMENT"])){*/

   
        $stmt = $bdd -> prepare("UPDATE livraison 
        set
        IDCLI=:IDCLI 
        ,IDLIV=:IDLIV 
        ,typescolis=:typescolis
        ,poids=:poids 
        ,volume=:volume 
        ,adresseOrig=:adresseOrig 
        ,adresseLivraison=:adresseLivraison 
        ,nbColis=:nbColis 
        ,Description=:Description 
        ,TypeVehicule=:TypeVehicule 
        
         WHERE IDCOLIS=:IDCOLIS  ");
        
        $stmt->bindParam(':IDCOLIS', $IDCOLIS);
        $stmt->bindParam(':IDCLI', $IDCLI);
        $stmt->bindParam(':IDLIV', $IDLIV);
        $stmt->bindParam(':typescolis', $typescolis);
        $stmt->bindParam(':poids', $poids);
        $stmt->bindParam(':volume', $volume);
        $stmt->bindParam(':adresseOrig', $adresseOrig);
        $stmt->bindParam(':adresseLivraison', $adresseLivraison);
        $stmt->bindParam(':nbColis', $nbColis);
        $stmt->bindParam(':Description', $Description);
        $stmt->bindParam(':TypeVehicule', $TypeVehicule);
        
        
                
        // $IDCLI=$_SESSION['id_pers_conn'];
        $IDCOLIS=$_GET['IDCOLIS'];
        if(isset($_POST["IDCLI"])) $IDCLI=strtoupper(htmlspecialchars($_POST["IDCLI"]));
        $IDLIV=null;
        if(isset($_POST["typescolis"]))  $typescolis=strtoupper(htmlspecialchars($_POST["typescolis"]));
        if(isset($_POST["poids"])) $poids=strtoupper(htmlspecialchars($_POST["poids"]));  
        if(isset($_POST["volume"])) $volume=strtoupper(htmlspecialchars($_POST["volume"]));
        if(isset($_POST["adresseOrig"])) $adresseOrig=strtoupper(htmlspecialchars($_POST["adresseOrig"]));
        if(isset($_POST["adresseLivraison"]))  $adresseLivraison=strtoupper(htmlspecialchars($_POST["adresseLivraison"]));
        if(isset($_POST["nbColis"])) $nbColis=strtoupper(htmlspecialchars($_POST["nbColis"]));  
        if(isset($_POST["Description"])) $Description=strtoupper(htmlspecialchars($_POST["Description"]));
        if(isset($_POST["TypeVehicule"]))  $TypeVehicule=strtoupper(htmlspecialchars($_POST["TypeVehicule"]));




              if 
              ($stmt->execute()) 
              {
              echo"ok";
              header('location:livraison_liste.php'); 
              }
            }

            if(isset($_POST["Annuler"]))
            {
                $_POST["nomliv"]="";
                $_POST["prenomliv"]="";
                $_POST["cni"]="";
                $_POST["telliv"]="";
                $_POST["capacite"]="";
                $_POST["numero_assurance"]="";
                $_POST["numero_permis"]=""; 
                $_POST["imatVehicule"]="";
                $_POST["photo_permis"]="";
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
                <li><a href="livraison.php"  class="active">Ajout livraison</a></li>
                <li><a href="livraison_liste_livree.php">livraison(s) effectuée(s)</a></li>
                <li><a href="livraison_liste_all.php">Toutes livraisons</a></li>
                
                
                
              </ul>  
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Modification d'une livraison</h2></center>
            <hr>

             <form action="" method="post">
              <div class="row form-group">
              

              <div class="col-sm-12 form-group">                  
                    <label for="inputUsername">CLIENT</label> 
                    <select id="inputState" name="IDCLI" class="form-control">
                    <?php
                    $requ=$bdd->query( "SELECT IDCLI,nom,prenom  FROM client where IDCLI=".$aff['IDCLI']." ");
	                while($affi=$requ->fetch()){?>
                    <option selected value="<?php echo $aff['IDCLI'];?>"><?php echo $affi['nom'];?></option>
                    <?php }?>
                    <?php 
                    
                    $requ=$bdd->query( "SELECT IDCLI,nom,prenom  FROM client where IDCLI!=".$aff['IDCLI']." ");
                    while($af=$requ->fetch()){?>
                      
                      <option 
                      value="<?php echo $af['IDCLI'];?>"><?php  echo $af['nom']; ?>

                  </option>
                  <?php }?>
                    </select>               
                </div>
              

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputEmail">TYPE DE COLIS</label>
                    <input type="text" name="typescolis" value="<?php  echo $aff['typescolis'];?>" class="form-control" id="inputEmail" placeholder="votre societe" >                  
                </div> 
       
             
                <div class=" col-md-6 form-group">                  
                    <label for="inputCurrentPassword">POIDS</label>
                    <select id="inputState" name="poids" class="form-control">
                    <option selected><?php  echo $aff['poids'];?></option>

                    <?php
                
                    $tab = array(
                        "inferieur à 1 kg",
                        "entre 1kg et 5kg",
                           "5kg et 10kg",
                        "entre 10kg et 20kg",
                        "entre 20kg et 30kg",
                        "entre 30kg et 50kg",
                        "entre 50kg et 100kg",
                        "entre 100kg et 500kg",
                        "entre 500kg et 1t",
                        "entre 1t et 10t",
                        "superieur à 10t"
                        
                    );
                   foreach ($tab as $val){
                    if(strtoupper($val)!=$aff['poids']){

                    ?>
                      <option><?php echo $val ;?></option>
                     
                      <?php }} ?>
                    </select>

                   <!--  <select id="inputState" name="poids" class="form-control">

                      <option selected>inferieur à 1 kg</option>
                      <option>entre 1kg et 5kg</option>
                      <option>entre 5kg et 10kg</option>
                      <option>entre 10kg et 20kg</option>
                      <option>entre 20kg et 30kg</option>
                      <option>entre 30kg et 50kg</option>
                      <option>entre 50kg et 100kg</option>
                      <option>entre 100kg et 500kg</option>
                      <option>entre 500kg et 1t</option>
                      <option>entre 1t et 10t</option>
                      <option>superieur à 10t</option>
                      
                    
                    </select>             -->      
                      
                </div>                
            
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">VOLUME</label>
                    <select id="inputState" name="volume" class="form-control">
                    <option selected><?php  echo $aff['volume'];?></option>

                    <?php
                
                    $tab = array(
                        "Volume 1","Volume 2","Volume 3","Volume 4"
                        
                    );
                   foreach ($tab as $val){
                    if(strtoupper($val)!=$aff['volume']){

                    ?>
                      <option><?php echo $val ;?></option>
                     
                      <?php }} ?>
                    </select>
                    <!-- <select id="inputState" name="volume" class="form-control">

                      <option selected>Volume 1</option>
                      <option>Volume 2</option>
                      <option>Volume 3</option>
                      <option>Volume 4</option>
                    
                    </select>   -->                
                </div>

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">ADRESSE D'ORIGINE</label>
                    <input type="text" name="adresseOrig" value="<?php  echo $aff['adresseOrig'];?>" class="form-control" placeholder="" id="inputConfirmNewPassword">
                </div> 
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">ADRESSE DE LIVRAISON</label>
                    <input type="text" name="adresseLivraison" value="<?php  echo $aff['adresseLivraison'];?>" class="form-control" placeholder="Ex:Rue 22 ..." id="inputNewPassword">
                </div>

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">NOMBRE DE COLIS</label>
                    <input type="text" name="nbColis" value="<?php  echo $aff['nbColis'];?>" class="form-control" placeholder="" id="inputConfirmNewPassword">
                </div> 
              

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">DESCRIPTION</label>
                    <input type="text" name="Description" value="<?php  echo $aff['Description'];?>" class="form-control" placeholder="" id="inputConfirmNewPassword">
                </div> 

                <div class=" col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">TYPE DE VEHICULE DEMANDER POUR VOTRE LIVRAISON</label>
                    
                    <select id="inputState" name="TypeVehicule" class="form-control">
                    <option selected><?php  echo $aff['TypeVehicule'];?></option>

                    <?php
                
                    $tab = array(
                        "Velo","Charette","Moto","Fourgonnette","Pickup","Camionnette"
                                ,"Petit camion","Grand fourgon","Camion Poids Lourd 5T","Camion Poids Lourd 10T"
                                ,"Camion Poids Lourd (semi-remorque)"
                        
                    );
                   foreach ($tab as $val){
                    if(strtoupper($val)!=$aff['TypeVehicule']){

                    ?>
                      <option><?php echo $val ;?></option>
                     
                      <?php }} ?>
                    </select>
                </div>

                
                  <br>
                  <hr> 

                  <div class=" form-group" style="float:center;">  
                  <br>
                  <hr>            
                  <center>  <input type="submit" value="Envoyer" name="envoi" class="btn btn-primary" style="padding: 7px 50px; border-radius:4px; margin-right:10px;"  />
                    <input type="submit" value="Annuler"  class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:10px; " />    </center> 
              </div>
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