<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}


 //connexion a la base de donnée
		 $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');
    
    $compt=0;
    //Abonne oui ou non
    $variable =$bdd->query("select * from abonnement where id_liv=".$_SESSION['codeliv']." and actif='oui' ");
    //SELECT * FROM abonnement WHERE id_liv=4 and actif='oui'
    $nbr=$variable->rowCount();

     //verification de l'action de l'admin (refus ou acceptation)
     $action =$bdd->query("select * from reglement_inter where type='credit' and id_livreur=".$_SESSION['codeliv']);
     $nbr_act=$action->rowCount();

     if($nbr_act<1){

       //echo 'bonjour';
       sleep(3);
       

       //header("location:admin_livreur.php");
       
                 ?>
  <script>
                document.location.href="admin_livreur.php";

  </script>

  <?php

     }

    //en cours d'abonnement ou non
    $variabl =$bdd->query("select * from abonnement where id_liv=".$_SESSION['codeliv']." and actif='encours' ");
    $variabl->bindColumn('id',$_ID_AB);
    $variabl->bindColumn('id_liv',$ID_li);
    $variabl->bindColumn('duree',$duree);
    $variabl->bindColumn('debut',$debut);
    $variabl->bindColumn('fin',$fin);
    $variabl->bindColumn('actif',$actif);
    $nbr_encours=$variabl->rowCount();

    $id_livreur="";
     while ($variabl->fetch()){
        $id_livreur=$_ID_AB;
     }

         //en cours de règlement ou non
         $variab =$bdd->query("select * from reglement where id_livreur=".$_SESSION['codeliv']." and id_abonn='".$id_livreur."' ");

          
         $nbr_encours_reg=$variab->rowCount();
    

    //recuperation du crédit de la table règlement
    $credit=$_SESSION['credit'];


    //recuperation dans la base de donnée
    $rete =$bdd->query("SELECT IDCOLIS,nom,typescolis,poids,volume,adresseOrig,adresseLivraison,nbColis,Statut,Description FROM livraison,client where livraison.IDCLI=client.IDCLI and IDLIV=".$_SESSION['codeliv']." ");
    $compt=$rete->rowCount();
    //selection des champs et attribution a des variables
        $rete->bindColumn('IDCOLIS',$id);
        $rete->bindColumn('nom',$NOM);
        $rete->bindColumn('typescolis',$TYPE);
        $rete->bindColumn('poids',$POIDS);
        $rete->bindColumn('volume',$VOLUME);
        $rete->bindColumn('adresseOrig',$ADRESS);
        $rete->bindColumn('adresseLivraison',$ADRESSLIV);
        $rete->bindColumn('nbColis',$NB);
        $rete->bindColumn('Statut',$STATUT);
        $rete->bindColumn('Description',$DESCR);

        $verif =$bdd->query("select * from livraison where Statut!='Livré' and Annuler='non' and IDLIV=".$_SESSION['codeliv']);
        //decompte 
        $compt1=$verif->rowCount();
    
        //verification des livraisons non faite appartenant au livreur connecté non abonné
        $verification =$bdd->query("select * from validation_com where IDLIV=".$_SESSION['codeliv']);
        //decompte 
        $compteur=$verification->rowCount();

       



       

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
    <meta http-equiv="Refresh" content="6"; url="admin_liv_credit_attente.php">

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
            <li><a href="admin_liv_credit_attente.php" class="active"><i class="fa fa-database fa-fw"></i>en attente</a></li>
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
                <li><a href="admin_liv_info.php"  >Voir mes infos</a></li>
                <li><a href="admin_liv_historique.php">historique</a></li>
                <li>
                  <?php if($nbr>=1){ ?>
                <a href="admin_liv_abonnement.php">me réabonner</a>
                  <?php  }elseif($nbr==0 && $nbr_encours==0){ ?>
                <a href="admin_liv_abonnement.php">m'abonner</a>

                  <?php  }else{?>

                      <?php if($nbr_encours_reg<1){ ?>

                        <a href="admin_liv_abonne_payer.php">règlement</a>
                      <?php  }else{?>

                        <a href="admin_liv_abonne_attente.php">En attente</a>

                
                  <?php }} ?>
              
              </li>

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
            <center><h2 class="margin-bottom-10">Attente de validation du paiement du crédit </h2></center>
            <hr>


            <div class="templatemo-flex-row flex-content-row">
           
          
           

            <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative templatemo-content-img-bg">
              <!--<img src="images/sunset-big.jpg" alt="Sunset" class="img-responsive content-bg-img">-->
              <h2 class="templatemo-position-relative black-text text-center">Plus de crédit pour plus de commande</h2>
              <hr>

              <br/>
              <br/>

              <h3 class="templatemo-position-relative black-text text-center">Veuillez attendre qu'un administrateur vérifie le montant et votre numéro de tranfert pour valider votre crédit.</h3>
              
                           
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