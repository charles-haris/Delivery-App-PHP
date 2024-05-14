<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
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
    <meta http-equiv="Refresh" content="60"; url="admin_com_liv.php">
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
           
         <?php include("admin_com_menu.php"); ?>

       

          
          
               <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Liste des livreurs partenaires</h2></center>
    </div>
              
              
           <?php


      
     
        $con = new PDO ('mysql:host=localhost;dbname=toutl2jw_bd_livraison', 'root', 'root');

        if(isset($_GET['page'])&& !empty($_GET['page'])){
          $currentPage=(int)strip_tags($_GET['page']);
        }else{
          $currentPage=1;
        }

        $total=$con->prepare("SELECT COUNT(*) as totaux FROM  livreur where IDCOM='".$_SESSION['codecom']."' ");
        $total->execute();
        $t=$total->fetch();
        $nbr=(int)$t['totaux'];

        $parPage=5;

        $pages=ceil($nbr/$parPage);

        $premier=($currentPage*$parPage) -$parPage;

        $rete=$con->prepare("SELECT * FROM  livreur where IDCOM='".$_SESSION['codecom']."' limit :premier, :parpage");

        $rete->bindValue('premier',$premier,PDO::PARAM_INT);
        $rete->bindValue('parpage',$parPage,PDO::PARAM_INT);
      
        $rete->execute();
       $rete->bindColumn('IDCLI',$id);
       $rete->bindColumn('nomliv',$NOM);
       $rete->bindColumn('prenomliv',$PRENOM);
       $rete->bindColumn('telliv',$TEL);
       $rete->bindColumn('cni',$CNI);
       
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

                      <th><a href="" class="white-text templatemo-sort-by">Nom<span class="caret"></span></a></th>
                      <th><a href="" class="white-text templatemo-sort-by">Prenom<span class="caret"></span></a></th>
                      
                      <th><a href="" class="white-text templatemo-sort-by">Telephone<span class="caret"></span></a></th>
                      <th><a href="" class="white-text templatemo-sort-by">Cni<span class="caret"></span></a></th>
                     


                    </tr>
                  </thead>
                  <tbody>
                     <?php while ($rete->fetch()){ ?>
                    <tr>
                        <td class="td1"><?php print $NOM; ?></td>
                        <td class="td1"><?php print $PRENOM; ?></td>
                        
                        <td class="td1"><?php print $TEL; ?></td>
                        <td class="td1"><?php print $CNI; ?></td>
                        

                       
                    </tr>
                    <?php  }?>
                  </tbody>
                </table>    
              </div> 
              <nav class="text-center">
                <ul class="pagination">
                      <li class="page-item <?= ($currentPage==1) ? "disabled" :"" ?>">
                        <a href="?page=<?=$currentPage-1?>" class="page-link">precedente</a>
                      </li>

                      <?php
                      for($page=1;$page<=$pages;$page++):
                        ?>

                      <li class="page-item <?= ($currentPage==$pages) ? "active" :"" ?>">
                        <a href="?page=<?=$page?>" class="page-link"><?=$page?></a>
                      </li>

                      <?php endfor; ?>

                      <li class="page-item <?= ($currentPage==$pages) ? "disabled" :"" ?>">
                        <a href="?page=<?=$currentPage+1?>" class="page-link">suivante</a>
                      </li>


                      </ul>
                </nav>  

                      

            

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

     

    </script>
    
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>