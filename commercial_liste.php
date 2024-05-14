<?php
session_start();


if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}
include('connection.php');
$bdd = connect();
if (isset($_GET['supp'])){
	$requ=$bdd->query("UPDATE commerciaux set active='non' WHERE IDCOM='".$_GET['IDCOM']."' ");
	
  }
  $modal="";
  if (isset($_GET['bloq'])){
    $requ=$bdd->query("UPDATE commerciaux set bloque='oui' WHERE IDCOM='".$_GET['IDCOM']."' ");

    $modal="";
    
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
    <meta http-equiv="Refresh" content="60"; url="livreur_liste.php">
    <!-- 
    Visual Admin Template
    https://templatemo.com/tm-455-visual-admin
    -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    
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
                <li><a href="commercial.php">Ajout Commercial</a></li>
                <li><a href="commercial_liste_bloque.php">Compte(s) bloqué(s)</a></li>
                <li><a href="commercial_liste_restore.php">Restaurer</a></li>
                
              </ul>  
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Liste des commercials</h2></center>
            
            </div>
              
           <?php

             




        $con = new PDO ('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');
        
        if(isset($_GET['page'])&& !empty($_GET['page'])){
          $currentPage=(int)strip_tags($_GET['page']);
        }else{
          $currentPage=1;
        }

        $total=$con->prepare("SELECT COUNT(*) as totaux FROM  commerciaux where active='oui' and bloque='non'");
        $total->execute();
        $t=$total->fetch();
        $nbr=(int)$t['totaux'];

        $parPage=5;

        $pages=ceil($nbr/$parPage);

        $premier=($currentPage*$parPage) -$parPage;

        $rete=$con->prepare("SELECT * FROM  commerciaux where active='oui' and bloque='non' limit :premier, :parpage");
        $rete->bindValue('premier',$premier,PDO::PARAM_INT);
        $rete->bindValue('parpage',$parPage,PDO::PARAM_INT);

      
        $rete->execute();
       $rete->bindColumn('IDCOM',$id);
       $rete->bindColumn('nom_com',$NOM);
       $rete->bindColumn('prenom_com',$PRENOM);
       $rete->bindColumn('tel_com',$TEL);
       $rete->bindColumn('adresse_com',$ADRESSE);
       
?>



          </div>
            <?php if($nbr>0){ ?>
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
                      

                      <td><a href="" class="white-text templatemo-sort-by">Nom<span class="caret"></span></a></td>
                      <td><a href="" class="white-text templatemo-sort-by">Prenom<span class="caret"></span></a></td>
                      <td><a href="" class="white-text templatemo-sort-by">Telephone<span class="caret"></span></a></td>
                      
                      <td><a href="" class="white-text templatemo-sort-by">Adresse<span class="caret"></span></a></td>
                  
                     
                     
                      <td>Modification</td>
                      <td>Bloquer</td>
                      <td>Suppression</td>
                    </tr>
                  </thead>
                  <tbody>
                     <?php while ($rete->fetch()){ ?>
                    <tr>
                        
                        <td><?php print $NOM; ?></td>
                        <td><?php print $PRENOM; ?></td>
                        
                        <td><?php print $TEL; ?></td>
                       
                        <td><?php print $ADRESSE; ?></td>

                        
                      
                        
                        
                        <form method="post">
        
                        <td><a href="commercial_modification.php?IDCOM=<?php  echo $id;?>" class="templatemo-edit-btn" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                        <td><a href="commercial_liste.php?IDCOM=<?php  echo $id;?>&bloq=ok" class="templatemo-edit-btn btn-danger "><i class="fa fa-ban" aria-hidden="true"></i> </a></td>
                        <td><a href="commercial_liste.php?IDCOM=<?php  echo $id;?>&supp=ok" class="templatemo-edit-btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </form>
                        
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
                
                 <?php }else{ ?>

                    <div class="templatemo-content-widget white-bg">



                    <hr>
                    <p class="text-center text-uppercase"> Aucun commercial n'a été créé.</p>

                    <hr>




                    </div>
                                
                <?php }?>
        
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

      

      function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
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
<!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> 

-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php //echo $_post['ident']; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>