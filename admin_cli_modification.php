<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}

include('connection.php');
$bdd = connect();
$ok="";
$requ=$bdd->query( "SELECT *  FROM client WHERE IDCLI=".$_SESSION['codecli']." ");
$aff=$requ->fetch();

if(isset($_POST["envoi"]))
{
/*
if(!empty($_POST["REGLEMENT"])){*/

if($_POST["password"]!=""){

 $stmt = $bdd -> prepare("UPDATE client 
 set nom=:nom ,prenom=:prenom ,societe=:societe
 ,tel=:tel ,adresse=:adresse ,mail=:mail 
  ,identifiant=:identifiant ,password=:password
			WHERE IDCLI=:IDCLI  ");
    $stmt->bindParam(':IDCLI', $IDCLI);
$stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':societe', $societe);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':mail', $mail);
       
        
        
        $stmt->bindParam(':identifiant', $identifiant);
        $stmt->bindParam(':password', $password);
        
        

    
         


 $IDCLI=htmlspecialchars($_SESSION['codecli']);
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
              $ok="ok";
              }
              
            }else{
               
               
 $stmt = $bdd -> prepare("UPDATE client 
 set nom=:nom ,prenom=:prenom ,societe=:societe
 ,tel=:tel ,adresse=:adresse ,mail=:mail 
  ,identifiant=:identifiant 
			WHERE IDCLI=:IDCLI  ");
    $stmt->bindParam(':IDCLI', $IDCLI);
$stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':societe', $societe);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':mail', $mail);
       
        
        
        $stmt->bindParam(':identifiant', $identifiant);

        

    
         


 $IDCLI=htmlspecialchars($_SESSION['codecli']);
if(isset($_POST["nom"])) $nom=strtoupper(htmlspecialchars($_POST["nom"]));
if(isset($_POST["prenom"])) $prenom=strtoupper(htmlspecialchars($_POST["prenom"]));
if(isset($_POST["societe"]))  $societe=strtoupper(htmlspecialchars($_POST["societe"]));
if(isset($_POST["tel"])) $tel=strtoupper(htmlspecialchars($_POST["tel"]));  
if(isset($_POST["adresse"])) $adresse=strtoupper(htmlspecialchars($_POST["adresse"]));
if(isset($_POST["mail"])) $mail=strtoupper(htmlspecialchars($_POST["mail"]));

if(isset($_POST["identifiant"])) $identifiant=htmlspecialchars($_POST["identifiant"]);




              if 
              ($stmt->execute()) 
              {
              $ok="ok";
              }
                
                
            }
            }

            if(isset($_POST["annuler"]))
            {
                

                header('location:admin_cli_info.php'); 

            }

            //abonné ou pas
    $abonn =$bdd->query("select * from client where identifiant='".$_SESSION['id']."' and Abonne='oui' ");
    $nbr=$abonn->rowCount();

    if($nbr<1){
      $Abonne="M'ABONNER";
      $href="";
    }else{
      $Abonne="SE DESABONNER";
      $href="";
    }

    $verifions =$bdd->query("select * from livraison where IDCLI=".$_SESSION['codecli']." and Statut='Non Livré' ");
    //decompte 
    $decompt=$verifions->rowCount();

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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script> 

    
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
          <div class="square"></div>
        </header>
          
        <!-- Search box -->
      
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
          </div>
        <nav class="templatemo-left-nav">          
        <ul>
                        <li><a href="https://t.me/joinchat/SAKrk-AzDHlhMWI0" style="color:red;"><i class="fa fa-telegram fa-fw"></i>Acceder a la communaute</a></li>

            <li><a href="admin_cli_com_en_cours.php" ><i class="fa fa-home fa-fw"></i>Commandes en cours</a></li>
            <li><a href="admin_client.php" class="active"><i class="fa fa-bar-chart fa-fw"></i>Mon historique</a></li>
                        <li><a href="tableau_prix.php"><i class="fa fa-money fa-fw"></i>
            Table Prix Livraison</a></li>
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
                <li><a href="page_livraison.php">Commander</a></li>
                
    <?php if($nbr<1){ ?><li><a href="deconnect.php">Deconnexion</a></li><?php } ?>
    <?php if($decompt>=1){ ?>
    <span class="badge"><?php echo $decompt;  ?>+</span>
    <?php } ?>
                
              </ul>   
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Modification de mon Profil</h2></center>
            <hr>
            <form action="" method="post">
              <div class="row form-group">
              <div class=" col-sm-12 form-group">                  
                    <label for="inputLastName">Code Client</label>
                    <input type="text" name="IDCLI" type="hidden" class="form-control" id="inputLastName" value="<?php  echo $aff['IDCLI'];?>" placeholder="votrte nom" required="" disabled>              
                </div> 
                <div class=" col-md-6 form-group">                  
                    <label for="inputLastName">NOM</label>
                    <input type="text" name="nom" class="form-control" id="inputLastName" placeholder="votrte nom"  value="<?php  echo $aff['nom'];?>" required="">                  
                </div> 
              
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputUsername">PRENOM</label>
                    <input type="text" name="prenom" class="form-control" id="inputUsername" placeholder="votre prenom"  value="<?php  echo $aff['prenom'];?>" required="">                  
                </div>
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputEmail">SOCIETE</label>
                    <input type="text" name="societe" class="form-control" id="inputEmail"  value="<?php  echo $aff['societe'];?>" placeholder="votre societe" >                  
                </div> 
       
             
                <div class=" col-md-6 form-group">                  
                    <label for="inputCurrentPassword">TEL</label>
                    <input type="text" name="tel" class="form-control " placeholder="Ex:78......." id="inputCurrentPassword"  value="<?php  echo $aff['tel'];?>" pattern="[0-9]{9}" required>                                   
                </div>                
            
             
                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputNewPassword">ADRESSE</label>
                    <input type="text" name="adresse" class="form-control"  value="<?php  echo $aff['adresse'];?>" placeholder="Ex:Rue 22 ..." id="inputNewPassword">
                </div>

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">E-MAIL</label>
                    <input type="text" name="mail" class="form-control" value="<?php  echo $aff['mail'];?>"  placeholder="Ex: exemple@gmail.com" id="inputConfirmNewPassword">
                </div> 

             <!--   <div class=" col-sm-12 form-group">                  
                    <label for="inputConfirmNewPassword">DATE DE NAISSANCE</label>
                    <input type="date" name="datenaiss"  value="<?php // echo $aff['datenaiss'];?>" class="form-control" id="inputConfirmNewPassword">
                </div> -->

                <div class=" col-lg-6 col-md-6  form-group">                  
                    <label for="inputConfirmNewPassword">Identifiant</label>
                    <input type="text" name="identifiant" class="form-control"  value="<?php  echo $aff['identifiant'];?>" placehorder="votre identifiant" id="inputConfirmNewPassword">
                </div> 

                <div class="col-lg-6 col-md-6 form-group">                  
                    <label for="inputConfirmNewPassword">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control"  value="" placeholder="votre mot de passe" id="password1" pattern=".{8,}" title="Eight or more characters">
                    <span style="position: absolute;right:13px;top:4px; margin-top:27px; margin-right:5px; padding:1px;" onclick="hideshow()" >
					    <i id="slash" class="fa fa-eye-slash"></i>
					    <i id="eye" class="fa fa-eye"></i>
					</span>
                </div> 

                
              <br>
              <br>
                  <hr> 

                  <div class=" form-group" style="float:center;">
                  <br>
                  <hr>            
                  <center>  <input type="submit" value="Envoyer" name="envoi" class="btn btn-primary" style="padding: 7px 50px; border-radius:4px; margin-right:10px;"  />
                    <input type="submit" value="Annuler" name="annuler" class="btn btn-danger" style="padding-left: 50px; padding-right: 50px; margin-left:10px; " />    </center> 
              </div>
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
<?php
if($ok!=""){
echo '<script type="text/javascript">

          swal(" Modification effectuée!", "cliquer sur ok!", "success");
          

          
          setTimeout(rediriger, 2000);
          
          function rediriger(){
            document.location.href="admin_cli_info.php";
          }

</script>';
        }
?>