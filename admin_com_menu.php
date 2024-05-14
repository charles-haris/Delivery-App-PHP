<?php
$link=$_SERVER['REQUEST_URI'];
$tab=array("/admin_commercial.php","/admin_com_insert_cli.php","/admin_com_cli.php","/admin_com_insert_liv.php","/admin_com_liv.php","/admin_com_info.php");
$link_actif='class="active"';



?>
 <!-- Search box -->
        
        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
          </div>
        <nav class="templatemo-left-nav">          
           <ul>
                <li><a href="https://t.me/joinchat/SAKrk-AzDHlhMWI0" style="color:red;"><i class="fa fa-telegram fa-fw"></i>Acceder a la communaute</a></li>
               <li><a href="admin_commercial.php" <?php if($tab[0]==$link)echo $link_actif; ?> ><i class="fa fa-home fa-fw"></i>Accueil</a></li>
            <li><a href="admin_com_insert_cli.php" <?php if($tab[1]==$link)echo $link_actif; ?> ><i class="fa fa-database fa-fw"></i>Nouveau Client</a></li>
            <li><a href="admin_com_cli.php" <?php if($tab[2]==$link)echo $link_actif; ?> ><i class="fa fa-database fa-fw"></i>Partenaires Clients</a></li>
            <li><a href="admin_com_insert_liv.php" <?php if($tab[3]==$link)echo $link_actif; ?> ><i class="fa fa-bar-chart fa-fw"></i>Nouveau Livreur</a></li>
            <li><a href="admin_com_liv.php" <?php if($tab[4]==$link)echo $link_actif; ?> ><i class="fa fa-bar-chart fa-fw"></i>Partenaires Livreurs</a></li>
            <li><a href="tableau_prix.php"><i class="fa fa-money fa-fw"></i>Prix Livraison
            </a></li> 
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
                <li><a href="admin_com_info.php" <?php if($tab[5]==$link)echo $link_actif; ?> >Voir mon profil</a></li>
                <!--<li><a href="admin_com_modification.php">Modifier mon profil</a></li> -->
                
    <?php// if($nbr<1){ ?><li><a href="deconnect.php">Deconnexion</a></li><?php //} ?>
    <?php// if($decompt>=1){ ?>
    <!--<span class="badge"><?php// echo $decompt;  ?>+</span> -->
    <?php// } ?>
                
              </ul>  
            </nav> 
          </div>
        </div>