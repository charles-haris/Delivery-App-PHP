
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

