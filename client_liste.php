<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}

include('connection.php');
$bdd = connect();
if (isset($_GET['supp'])){
	$requ=$bdd->query("UPDATE client set active='non' WHERE IDCLI='".$_GET['IDCLI']."' ");
	
  }
  
  if (isset($_GET['bloq'])){
    $requ=$bdd->query("UPDATE client set bloque='oui' WHERE IDCLI='".$_GET['IDCLI']."' ");
    
    }

    $verif =$bdd->query("select validation_com.IDCOLIS,typescolis,poids,Description,adresseOrig,validation_com.IDLIV,adresseLivraison,Statut from validation_com,livraison where validation_com.IDCOLIS=livraison.IDCOLIS  ");
    //decompte 
    $compt=$verif->rowCount();

//nombre de livreur qui ont credité leur compte et qui veulent une validation
 $sql_credit="select nomliv,prenomliv,prix,IDLIV from reglement_inter,livreur where reglement_inter.id_livreur=livreur.IDLIV ";
 $requete=$bdd->query($sql_credit);

 $nbr_val=$requete->rowCount();

 $_SESSION['notification_credit']=$nbr_val;


 //nombre de livreur qui ont attesté avoir payer un abonnement

 $sql_abonn="select nomliv,prenomliv,duree,IDLIV from reglement,livreur,abonnement where abonnement.id_liv=livreur.IDLIV and reglement.id_livreur=livreur.IDLIV  and abonnement.id=reglement.id_abonn and actif='encours' and type='Abonnement' ";

 $requeteAb=$bdd->query($sql_abonn);

 $nbr_val_ab=$requeteAb->rowCount();
 $_SESSION['notification_abonnement']=$nbr_val_ab;

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
    <meta http-equiv="Refresh" content="60"; url="client_liste.php">
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
            <li><a href="client_liste.php" class="active"><i class="fa fa-bar-chart fa-fw"></i>Client</a></li>
            <li><a href="livraison_liste.php"><i class="fa fa-database fa-fw"></i>Livraison<?php if($compt>=1){ ?>
              <span class="badge"><?php echo $compt;  ?>+</span>
            <?php } ?></a>
            
             </li>
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
                <li><a href="client.php"  class="active">Ajout Client</a></li>
                <li><a href="client_liste_bloque.php">compte(s) bloqué(s)</a></li>
                <li><a href="">Privilégiés</a></li>
                <li><a href="client_liste_restore.php">Restaurer</a></li>
                
                
                
              </ul>  
            </nav> 
          </div>
        </div>
       
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Liste des clients</h2></center>
    </div>
              
              
           <?php


      
     
        $con = new PDO ('mysql:host=localhost;dbname=toutl2jw_bd_livraison', 'root', 'root');

        if(isset($_GET['page'])&& !empty($_GET['page'])){
          $currentPage=(int)strip_tags($_GET['page']);
        }else{
          $currentPage=1;
        }

        $total=$con->prepare("SELECT COUNT(*) as totaux FROM  client where active='oui' and bloque='non'");
        $total->execute();
        $t=$total->fetch();
        $nbr=(int)$t['totaux'];

        $parPage=5;

        $pages=ceil($nbr/$parPage);

        $premier=($currentPage*$parPage) -$parPage;

        $rete=$con->prepare("SELECT * FROM  client where active='oui' and bloque='non' limit :premier, :parpage");

        $rete->bindValue('premier',$premier,PDO::PARAM_INT);
        $rete->bindValue('parpage',$parPage,PDO::PARAM_INT);
      
        $rete->execute();
       $rete->bindColumn('IDCLI',$id);
       $rete->bindColumn('nom',$NOM);
       $rete->bindColumn('prenom',$PRENOM);
       $rete->bindColumn('societe',$SOCIETE);
       $rete->bindColumn('tel',$TEL);
       $rete->bindColumn('adresse',$ADRESS);
       $rete->bindColumn('IDCOM',$idcom);

       
       $rete->bindColumn('identifiant',$identi);  
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
                      <th><a href="" class="white-text templatemo-sort-by">#<span class="caret"></span></a></th>

                      <th><a href="" class="white-text templatemo-sort-by">Nom<span class="caret"></span></a></th>
                      <th><a href="" class="white-text templatemo-sort-by">Prenom<span class="caret"></span></a></th>
                      
                      <th><a href="" class="white-text templatemo-sort-by">Telephone<span class="caret"></span></a></th>
                      <th><a href="" class="white-text templatemo-sort-by">Adresse<span class="caret"></span></a></th>
                     
                      <th><a href="" class="white-text templatemo-sort-by">Identifiant<span class="caret"></span></a></th>
                      <th><a href="" class="white-text templatemo-sort-by">Commercial Parent<span class="caret"></span></a></th>


                      <th>Modification</th>
                      <th>Bloquer</th>
                      <th>Suppression</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php while ($rete->fetch()){ ?>
                    <tr>
                        <td class="td1"><?php print $id; ?></td>
                        <td class="td1"><?php print $NOM; ?></td>
                        <td class="td1"><?php print $PRENOM; ?></td>
                        
                        <td class="td1"><?php print $TEL; ?></td>
                        <td class="td1"><?php print $ADRESS; ?></td>
                        
                        <td class="td1"><?php print $identi; ?></td>
                        <td class="td1"><?php if($idcom!=""){ print $idcom;}else{print "Pas d'affiliation"; } ?></td>

                    
        
                        <td class="td1"><a href="client_modification.php?IDCLI=<?php  echo $id;?>" class="templatemo-edit-btn" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                        <td class="td1"><a href="client_liste.php?IDCLI=<?php  echo $id;?>&bloq=ok" class="templatemo-edit-btn btn-danger" ><i class="fa fa-ban" aria-hidden="true"></i></a></td>
                        <td class="td1"><a href="client_liste.php?IDCLI=<?php  echo $id;?>&supp=ok" class="templatemo-edit-btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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