<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Visual Admin Dashboard - Home</title>
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
          <h1>Visual Admin</h1>
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
            <li><a href="index.php" class="active"><i class="fa fa-home fa-fw"></i>Livreur</a></li>
            <li><a href="client.php"><i class="fa fa-bar-chart fa-fw"></i>Client</a></li>
            <li><a href="compte.php"><i class="fa fa-database fa-fw"></i>Compte</a></li>
            <li><a href="login.html"><i class="fa fa-eject fa-fw"></i>Sign Out</a></li>
          </ul>  
        </nav>
      </div>
      <!-- Main content --> 
      <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
          <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
              <ul class="text-uppercase">
                <li><a href="index.php" >Catégorie</a></li>
                <li><a href="sessionliv.php"  class="active">Controle</a></li>
                <li><a href="encoursliv.php">En cours</a></li>
                <li><a href="">Infos Livreur</a></li>
              </ul>  
            </nav> 
          </div>
        </div>
        
        <?php


$con = new PDO ("mysql:host=localhost;dbname=bd_livraison","root","");
$rete=$con->query("SELECT * FROM session",PDO::FETCH_BOUND);


  
        $rete->bindColumn('id',$id);
        $rete->bindColumn ('pseudo',$pseudo);
        $rete->bindColumn ('livreur',$livreur);
        $rete->bindColumn ('client',$client);
        $rete->bindColumn ('bloquer',$bloquer);
        $rete->bindColumn ('fonctionnalite',$fonctionnalite);
        $rete->bindColumn ('allocation',$allocation);
    ?>


        <div class="templatemo-content-container">
          <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
              <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                  <tr>
                     <td><a href="" class="white-text templatemo-sort-by">ID<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Pseudo<span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Livreur <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Client <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Bloquer <span class="caret"></span></a></td>
                    <td><a href="" class="white-text templatemo-sort-by">Allocation <span class="caret"></span></a></td>
                    <td>Edit</td>
                    <td>Action</td>
                    <td>Delete</td>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($rete->fetch()){?>

                  <tr>
                     <td><?php print $id;?></td>
                     <td><?php print $pseudo;?></td>
                     <td><?php print $client;?></td>
                     <td><?php print $bloquer;?></td>
                     <td><?php print $fonctionnalite;?></td>
                     <td><?php if($allocation==0){ print "<div style='color:red'>Deconnecte<div>";}else {print "<div style='color:green'>connecte<div>";}  ?></td>
                    <td><a href="sessionliv.php?id=<?php print $id ?>" class="templatemo-edit-btn">Edit</a></td>
                    <td><a href="" class="templatemo-link">Action</a></td>
                    <td><a href="" class="templatemo-link">Delete</a></td>
                  </tr>
                 <?php  } ?>
                </tbody>
              </table>    
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