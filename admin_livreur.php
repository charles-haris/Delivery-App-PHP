<?php
session_start();
//error_reporting(-1);
//ini_set('display_errors',false);
if(!isset($_SESSION['id'])){
  header("location:deconnect.php");
}


    $compt="";
    $reponse="";
    $reponse_bonus="";
    //connexion a la base de donnée
    $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');
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

    //verification des livraisons non faite appartenant au livreur connecté abonné
    $verif =$bdd->query("select IDCOLIS,typescolis,poids,volume,adresseOrig,adresseLivraison,nbColis,Description,TypeVehicule,tel from livraison,client where livraison.IDCLI=client.IDCLI and Statut!='Livré' and Annuler='non' and IDLIV=".$IDLIV);
    //decompte 
    $compt=$verif->rowCount();

    //verification des livraisons non faite appartenant au livreur connecté non abonné
    $verification =$bdd->query("select * from validation_com where IDLIV=".$IDLIV);
    //decompte 
    $compteur=$verification->rowCount();

    $veri =$bdd->query("select * from livraison,livreur where livraison.IDLIV=livreur.IDLIV and Abonne='non' and Statut!='Livré' and Annuler='non' and livraison.IDLIV=".$IDLIV);
    //decompte 
    $cpt=$veri->rowCount();


    /* if($result=$verif->fetchObject()){
      //var_dump($result);
      $ID=$result->IDCOLIS;
      
    } */
    $verificat =$bdd->query("select * from validation_com ");

    $nbre1=$verificat->rowCount();



    //recuperation dans la base de donnée des livraisons disponibles des clients abonnés
    if($nbre1>0){
    $var =$bdd->query("select livraison.IDCOLIS,typescolis,poids,volume,Description,prix_comm,  adresseOrig,adresseLivraison,nbColis,TypeVehicule from livraison,client,validation_com,prix_commande where prix_commande.ID_COLIS=livraison.IDCOLIS and livraison.IDCOLIS!=validation_com.IDCOLIS and client.IDCLI=livraison.IDCLI and Annuler='non' and client.Abonne='oui' and Statut!='Livré' and livraison.IDLIV is null");
    }else{
    $var =$bdd->query("select livraison.IDCOLIS,typescolis,poids,volume,Description,prix_comm,adresseOrig,adresseLivraison,nbColis,TypeVehicule from livraison,client,prix_commande where prix_commande.ID_COLIS=livraison.IDCOLIS and client.IDCLI=livraison.IDCLI and client.Abonne='oui' and Statut!='Livré' and Annuler='non' and livraison.IDLIV is null");
    }

    //decompte des lignes recensées 
    $n1=$var->rowCount();
    //selection des champs et attribution a des variables
    $var->bindColumn('IDCOLIS',$IDCOLIS);
    $var->bindColumn('typescolis',$typescolis);
    $var->bindColumn('poids',$poids);
    $var->bindColumn('volume',$volume);
    $var->bindColumn('Description',$Description);
    $var->bindColumn('prix_comm',$prix_comm);
    
     $var->bindColumn('adresseOrig',$adresseOrig);
    $var->bindColumn('adresseLivraison',$adresseLivraison);
    $var->bindColumn('nbColis',$nbColis);
    $var->bindColumn('TypeVehicule',$TypeVehicule);


       //recuperation dans la base de donnée des livraisons disponibles des clients non abonnés
    if($nbre1>0){
    $var1 =$bdd->query("select livraison.IDCOLIS,typescolis,poids,volume,Description,prix_comm,adresseOrig,adresseLivraison,nbColis,TypeVehicule from livraison,client,validation_com,prix_commande where prix_commande.ID_COLIS=livraison.IDCOLIS and livraison.IDCOLIS!=validation_com.IDCOLIS and client.IDCLI=livraison.IDCLI and client.Abonne='non' and Statut!='Livré' and Annuler='non' and livraison.IDLIV is null ");
    }else{
    $var1 =$bdd->query("select livraison.IDCOLIS,typescolis,poids,volume,Description,prix_comm,adresseOrig,adresseLivraison,nbColis,TypeVehicule from livraison,client,prix_commande where prix_commande.ID_COLIS=livraison.IDCOLIS and client.IDCLI=livraison.IDCLI and client.Abonne='non' and Statut!='Livré' and Annuler='non' and livraison.IDLIV is null ");
    }
    $n2=$var->rowCount();
    //selection des champs et attribution a des variables
    $var1->bindColumn('IDCOLIS',$_IDCOLIS);
    $var1->bindColumn('typescolis',$_typescolis);
    $var1->bindColumn('poids',$_poids);
    $var1->bindColumn('volume',$_volume);
    $var1->bindColumn('Description',$_Description);
    $var1->bindColumn('prix_comm',$_prix_comm);
    
    $var1->bindColumn('adresseOrig',$_adresseOrig);
    $var1->bindColumn('adresseLivraison',$_adresseLivraison);
    $var1->bindColumn('nbColis',$_nbColis);
    $var1->bindColumn('TypeVehicule',$_TypeVehicule);


    //total des livraisons
    $total=$n1+$n2;

    //abonné ou non
    $variable =$bdd->query("select * from abonnement where id_liv=".$_SESSION['codeliv']." and actif='oui' ");
    //SELECT * FROM abonnement WHERE id_liv=4 and actif='oui'
    $nbr=$variable->rowCount();

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
      $req=$bdd->query("SELECT sum(prix) as credit FROM reglement WHERE id_livreur='".$_SESSION['codeliv']."' and type='credit' and id_abonn is null ");
      $req->bindColumn('credit',$credit);

      while($req->fetch()){
        $credit=$credit;
      }


      //recuperation du des frais de depences de la table depence
      $req=$bdd->query("SELECT sum(frais_commande) as depense FROM Depense WHERE id_liv='".$_SESSION['codeliv']."' ");
      $req->bindColumn('depense',$depense);
      $nombre=$req->rowCount();

      if($nombre>0){

      while($req->fetch()){
        $depense=$depense;
      }

      $credit=$credit-$depense;
      }
      $_SESSION['credit']=$credit;


    
    //lorsqu'on clique sur le bouton prendre
if(isset($_POST['prendre'])){


if($nbr>0){
  //recuperation du prix de la commande demander par le livreur
  $prix=$bdd->query("select prix_comm from prix_commande where ID_COLIS=".$_POST['prendre']);
  $prix->bindColumn('prix_comm',$price);

  while($prix->fetch()){
    $price=$price;
  }
  $revenu_ecode=(10*$price)/100;

  if($credit>$revenu_ecode){
    $time=time();
    //echo date("Y-m-d H:i:s",$temps); 
    $recup_time=date("Y-m-d H:i:s",$time);
 $insertDepense=$bdd->query("INSERT INTO Depense (id_liv,frais_commande,date_depense) values (".$_SESSION['codeliv'].",'".$revenu_ecode."','".$recup_time."')");

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
          //echo "ok";
         }
         
         $requete = $bdd->prepare('INSERT INTO Temps (IDCOLIS,IDLIV,temps_accept_liv,btn_innactif)
         values(:IDCOLIS,:IDLIV,:temps_accept_liv,:btn_innactif)');
             
         $requete->bindParam(':IDCOLIS', $IDCOLI);
         $requete->bindParam(':IDLIV', $IDL);
         $requete->bindParam(':temps_accept_liv', $recupTemps);
         $requete->bindParam(':btn_innactif', $btn_innactif);
        
          $IDCOLI=$_POST['prendre'];
          $IDL=$_SESSION['codeliv'];
          $temps=time();
          //echo date("Y-m-d H:i:s",$temps); 
          $recupTemps=date("Y-m-d H:i:s",$temps);

          

          //echo date("Y-m-d H:i:s",$temps); 
          
          
          $_SESSION['temps']=date('Y-m-d H:i:s',strtotime("+15 minutes"));
          $btn_innactif=$_SESSION['temps'];
       
         if 
        ($requete->execute()) 
         {
         //echo"ok";
         header('location:admin_livreur.php');   
        }
      }else{

        $reponse='Votre crédit est insuffisant pour prendre cette commande.';

      }


}else{
  //insertion faite par le livreur non abonné

   //recuperation du prix de la commande demander par le livreur
   $prix=$bdd->query("select prix_comm from prix_commande where ID_COLIS=".$_POST['prendre']);
   $prix->bindColumn('prix_comm',$price);
 
   while($prix->fetch()){
     $price=$price;
   }
   $revenu_ecode=(10*$price)/100;
 
   if($credit>$revenu_ecode){
     $time=time();
     //echo date("Y-m-d H:i:s",$temps); 
     $recup_time=date("Y-m-d H:i:s",$time);
  $insertDepense=$bdd->query("INSERT INTO Depense (id_liv,frais_commande,date_depense) values (".$_SESSION['codeliv'].",'".$revenu_ecode."','".$recup_time."')");

  $requete = $bdd->prepare('INSERT INTO validation_com (IDCOLIS,IDLIV)
         values(:IDCOLIS,:IDLIV)');
             
         $requete->bindParam(':IDCOLIS', $IDCOLI);
         $requete->bindParam(':IDLIV', $IDL);
         
        
          $IDCOLI=$_POST['prendre'];
          $IDL=$_SESSION['codeliv'];

          if 
          ($requete->execute()) 
           {
           //echo"ok";
           header('location:admin_livreur.php');   
          }

          //commande prise par un livreur non abonné
          $del1 =$bdd->query("UPDATE livraison set IDLIV=".$IDL." where IDCOLIS=".$IDCOLI." ");

          $del3 =$bdd->query("delete from validation_com where IDCOLIS=".$IDCOLI." ");
  
          $requet = $bdd->prepare('INSERT INTO Temps (IDCOLIS,IDLIV,temps_accept_liv,btn_innactif)
           values(:IDCOLIS,:IDLIV,:temps_accept_liv,:btn_innactif)');
               
           $requet->bindParam(':IDCOLIS', $IDCOLI);
           $requet->bindParam(':IDLIV', $IDL);
           $requet->bindParam(':temps_accept_liv', $recupTemps);
           $requet->bindParam(':btn_innactif', $btn_innactif);
          
           $IDCOLI=$_POST['prendre'];
           $IDL=$_SESSION['codeliv'];
            $temps=time();
            //echo date("Y-m-d H:i:s",$temps); 
            $recupTemps=date("Y-m-d H:i:s",$temps);
  
            $_SESSION['tem']=date('Y-m-d H:i:s',strtotime("+15 minutes"));
            $btn_innactif=$_SESSION['tem'];
          
       
       
         if 
        ($requet->execute()) 
         {
         //echo"ok";
         header('location:admin_livreur.php');   
        }
      }else{
        $reponse='Votre crédit est insuffisant pour prendre cette commande.';
      }


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
          //echo "ok";
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
          //echo "ok";
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

$temps_colis_livr=date("Y-m-d H:i:s",$temp);



$verifier=$bdd->query("SELECT * from reglement_inter where id_livreur='".$_SESSION['codeliv']."' ");

$nbre=$verifier->rowCount();

$verif_reg_bonus=$bdd->query("SELECT * from reglement where id_livreur='".$_SESSION['codeliv']."' ");

$nbre_bonus=$verif_reg_bonus->rowCount();
if($nbre_bonus==0){
    
     $requet = $bdd->prepare('INSERT INTO reglement (id_livreur,type,prix,tel_transf)
           values(:id_livreur,:type,:prix,:tel_transf)');
               
           $requet->bindParam(':id_livreur', $IDL);
           $requet->bindParam(':type', $type_reg);
           $requet->bindParam(':prix', $prix_reg);
           $requet->bindParam(':tel_transf', $tel_offre);


           $type_reg="credit";
           $IDL=$_SESSION['codeliv'];
           $prix_reg=400;
           $tel_offre="tel_ecode";
          
         if 
        ($requet->execute()) 
         {
         $reponse_bonus="bonus";
         header('location:admin_livreur.php');   
        }
}

$voir="non";

if(isset($_POST['voir'])){
    
     $var11 =$bdd->query("select typescolis,poids,volume,Description,prix_comm,adresseOrig,adresseLivraison,nbColis,TypeVehicule from livraison,client,prix_commande where prix_commande.ID_COLIS=livraison.IDCOLIS and client.IDCLI=livraison.IDCLI and client.Abonne='non' and Statut!='Livré' and Annuler='non' and livraison.IDLIV is null and livraison.IDCOLIS=".$_POST['voir']);
    
    //$n2=$var11->rowCount();
    //selection des champs et attribution a des variables
    
    $var11->bindColumn('typescolis',$_typescolis1);
    $var11->bindColumn('poids',$_poids1);
    $var11->bindColumn('volume',$_volume1);
    $var11->bindColumn('Description',$_Description1);
    $var11->bindColumn('prix_comm',$_prix_comm1);
    
    $var11->bindColumn('adresseOrig',$_adresseOrig1);
    $var11->bindColumn('adresseLivraison',$_adresseLivraison1);
    $var11->bindColumn('nbColis',$_nbColis1);
    $var11->bindColumn('TypeVehicule',$_TypeVehicule1);
    
    while($var11->fetch()){
    $id_commande_1=$_POST['voir'];
    $_typescolis1=$_typescolis1;
    $_poids1=$_poids1;
    $_volume1=$_volume1;
    $_Description1=$_Description1;
    $_prix_comm1=$_prix_comm1;
    $_adresseOrig1=$_adresseOrig1;
    $_adresseLivraison1=$_adresseLivraison1;
    $_nbColis1=$_nbColis1;
    $_TypeVehicule1=$_TypeVehicule1;
  }
  
  //$tous="Type(s) de colis: ".$_typescolis1."\nNombre de colis : ".$_nbColis1."  \nPoid: ".$_poids1."\nAdresse dorigine: ".$_adresseOrig1."\nAdresse de destination: ".$_adresseLivraison1."\nPrix de la commande: ".$_prix_comm1." fcfa";
  
  $tous="Type(s) de colis: ".$_typescolis1;
  
  
    
    $voir="oui";

    
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
    <meta http-equiv="Refresh" content="60"; url="admin_livreur.php">

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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" > </script> 
    


    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <style>
 


</style>
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
           <li>
           
           <div class="container-fluid">
         <!-- <img src="images/profile-photo.jpg" alt="Profile Photo" class="img-responsive"> -->
          <div class="templatemo-flex-row flex-content-row">
           <div class="templatemo-content-widget white-bg col-1 templatemo-position-relative ">
             <!--<img src="images/sunset-big.jpg" alt="Sunset" class="img-responsive content-bg-img">-->  
             <h3 class="templatemo-position-relative black-text text-center"> credit : <?php echo $credit; ?></h3>
           </div>
         </div>  
        </div>   

           </li>
                       <li><a href="https://t.me/joinchat/SAKrk-AzDHlhMWI0" style="color:red;"><i class="fa fa-telegram fa-fw"></i>Acceder a la communaute</a></li>

           <li><a href="admin_livreur.php" class="active"><i class="fa fa-bar-chart fa-fw"></i>Mes livraisons<?php if($compt>=1){ ?>
                  <span class="badge"><?php echo $compt;  ?>+</span>
                <?php }elseif($compteur>=1){ ?>
                  <span class="badge"><?php echo $compteur;  ?>+</span>
                <?php }?></a></li>
                            <li><a href="tableau_prix.php"><i class="fa fa-money fa-fw"></i>
            Table Prix Livraison</a></li>
           <li><a href="" class=""><i class="fa fa-home fa-fw"></i>Droit et obligation</a></li>
            
            <li>
            <?php if($nbre>0){ ?>
            <a href="admin_liv_credit_attente.php"><i class="fa fa-database fa-fw"></i>En Attente</a>

            <?php }else{ ?>
            <a href="admin_liv_crediter.php"><i class="fa fa-database fa-fw"></i>crediter compte</a>
            <?php } ?>
            </li>

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
                <li><a href="admin_liv_info.php" >profil</a></li>
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

                
              </ul>  
            </nav> 
          </div>
        </div>
       <?php
       if($nbr<1){
        if($compteur<1 && $cpt<1){

      ?>
        <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Commande(s) disponible(s) "<?php //echo $_SESSION["id"]; ?>"</h2></center>
            <hr>
          
             
            <table class="table table-striped table-bordered templatemo-user-table text-center">
                  <thead>
                               <tr>
                      <td><a  class="white-text templatemo-sort-by">Type Colis<span class="caret"></span></a></td>

                      <!--<td><a  class="white-text templatemo-sort-by">Poids<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Volume<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Description<span class="caret"></span></a></td>-->
                       <td><a class="white-text templatemo-sort-by">Détail sur la commande<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Prendre la commande <span class="caret"></span></a></td>
                      
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        while($var->fetch()){ ?>
                     <tr>
                        
                        
                        
                        
                        <td><?php echo $typescolis ?>
                         <input type="hidden" id="td1" name="custId" value="<?php echo $typescolis ?>">
                        
                        </td>
                        
                    
                        
                       <!-- <td id="me"><?php //echo $_poids ?></td>
                        <td><?php //echo $_volume ?></td>
                        <td ><?php //echo $_Description ?></td> -->
                        
                        
                        
                         
                         <form method="POST" >
                             <?php   $_prix_demande=(10*$prix_comm)/100;
 ?>
                             <td>
                           
                                 <input type="button" name="view" value="Voir" id="<?php echo "Type(s) de colis: ".$typescolis." \n Nombre de colis : ".$nbColis." \n Poid: ".$poids." \n Adresse dorigine: ".$adresseOrig." \n Adresse de destination: ".$adresseLivraison." \n Prix de la commande: ".$prix_comm." fcfa \n Crédit demandé : ".$prix_demande." fcfa"; ?>" class="templatemo-edit-btn view_data"  > 

                        
                       <!-- <form method="POST" >
                        <button type="submit" name="voir" value="<?php //echo $_IDCOLIS ?>" class="templatemo-edit-btn" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></button>
                        </form> -->
                        
                        </td>

                        <td>
                        <button type="submit" name="prendre" value="<?php echo $IDCOLIS ?>" class="templatemo-edit-btn" >
                            <i class="fa fa-cart-arrow-down fa-fw" aria-hidden="false" style="color:black;"></i>
                        </button>
                        </form>
                        </td>

                       
                    
        
                        
                    </tr>
                    <?php  }?>

                   <?php while($var1->fetch()){ ?>
                   
  <tr>
                        
                        
                        
                        
                        <td><?php echo $_typescolis ?>
                         <input type="hidden" id="td1" name="custId" value="<?php echo $_typescolis ?>">
                        
                        </td>
                        
                    
                        
                       <!-- <td id="me"><?php //echo $_poids ?></td>
                        <td><?php //echo $_volume ?></td>
                        <td ><?php //echo $_Description ?></td> -->
                        
                        
                        
                         
                         <form method="POST" >
                             <?php   $_prix_demande=(10*$_prix_comm)/100;
 ?>
                             <td>
                           
                                 <input type="button" name="view" value="Voir" id="<?php echo "Type(s) de coliss: ".$_typescolis." \n Nombre de colis : ".$_nbColis." \n Poid: ".$_poids." \n Adresse dorigine: ".$_adresseOrig." \n Adresse de destination: ".$_adresseLivraison." \n Prix de la commande: ".$_prix_comm." fcfa \n Crédit demandé : ".$_prix_demande." fcfa"; ?>" class="templatemo-edit-btn view_data"  > 

                        
                       <!-- <form method="POST" >
                        <button type="submit" name="voir" value="<?php //echo $_IDCOLIS ?>" class="templatemo-edit-btn" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></button>
                        </form> -->
                        
                        </td>

                        <td>
                        <button type="submit" name="prendre" value="<?php echo $_IDCOLIS ?>" class="templatemo-edit-btn" >
                            <i class="fa fa-cart-arrow-down fa-fw" aria-hidden="false" style="color:black;"></i>
                        </button>
                        </form>
                        </td>

                       
                    
        
                        
                    </tr>
                   
                   
                    <?php  }?>
                  </tbody>
                </table>   
                
          
          </div>
          <?php
        }else{
          if($compt<1){
        ?>

<div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Info Livreur "<?php echo $_SESSION["id"]; ?>"</h2></center>
            <?php
            
            $aff=$verification->fetch();
        
            ?>
            <hr>
            <p class="text-center text-uppercase">
              Vous avez fait une demande de prise en charge de la commande N° <?php echo $aff['IDCOLIS'] ?>  <?php //echo $aff['temps_accept_liv']; //echo date('Y-m-d H:i:s',strtotime("+30 minute 00 seconde")); ?>, veuillez attendre que votre demande soit validé<br> 

            patienté quelques instants , Merci</p>
            <!-- <center><form method="POST" >
                        <button type="submit" name="livree" value="<?php //echo $ID ?>" class="templatemo-edit-btn">Livré</button> 
                        </form></center> -->


           
              <hr>

         
          </div>
            
          <?php }else{
            ?>

<div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Info Livreur "<?php echo $_SESSION["id"]; ?>"</h2></center>
            <?php
            $tableau=$verif->fetch();
            $recupdate=$bdd->query("select temps_accept_liv,btn_innactif from Temps where IDLIV=".$_SESSION['codeliv']." and IDCOLIS=".$tableau['IDCOLIS'] ." ");
            //$recupdate->bindColumn('temps_accept_liv',$tem);
            $aff=$recupdate->fetch();
            

            $temps=time(); 
            $temps2=date("Y-m-d H:i:s",$temps);
            //$recupdate->bindColumn('temps_accept_liv',$temps1);

            //echo date('Y-m-d H:i:s',strtotime("+30 minutes"));  //comming year o/p 11.23.2013

            //echo $_SESSION['temps'];

            
            if (strtotime($aff['btn_innactif'])>strtotime(date("Y-m-d H:i:s",$temps))){
              $bouton='<i class="fa fa-ban" aria-hidden="true"></i> Livré <i class="fa fa-ban" aria-hidden="true"></i>';
              $disabled="disabled";
            }else{
              $bouton="Livré";
              $disabled="";
            }


            ?>
            <hr>
            <p class="text-center text-uppercase">Vous avez pris en charge <strong style="color:green">la commande N° <?php echo $tableau['IDCOLIS'] ?></strong> à <strong style="color:green"><?php echo $aff['temps_accept_liv']; //echo date('Y-m-d H:i:s',strtotime("+30 minute 00 seconde")); ?></strong>, vous avez <strong style="color:green">30min</strong> pour liver le colis de <strong style="color:green"><?php echo $tableau['adresseOrig']; ?></strong> à <strong style="color:green"><?php echo $tableau['adresseLivraison'];?></strong>,<br> Le numero du client concerné est <strong style="color:green"><?php echo $tableau['tel']; ?></strong>  <br> 

            Veuillez indiquer que la livraison a été bien faite en cliquant ici</p>
            <center><form method="POST" >
                        <button type="submit" name="livree" value="<?php echo $tableau['IDCOLIS'] ?>" <?php echo $disabled; ?>  class="templatemo-edit-btn"><?php echo $bouton; ?></button>
                        </form></center>
<hr>
                    
         
          </div>

        <?php } }}else{

          if($compt!=0){

           

          ?>
<div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Info Livreur "<?php echo $_SESSION["id"]; ?>"</h2></center>
            <?php while($tab=$verif->fetch()){ ?>
            <?php
             
            //$tableau=$verif->fetch();
            $recupdate=$bdd->query("select temps_accept_liv,btn_innactif from Temps where IDLIV=".$_SESSION['codeliv']." and IDCOLIS=".$tab['IDCOLIS'] ." ");
            //$recupdate->bindColumn('temps_accept_liv',$tem);
            $aff=$recupdate->fetch();

            $temps=time(); 
            $temps2=date("Y-m-d H:i:s",$temps);
            //$recupdate->bindColumn('temps_accept_liv',$temps1);

            //echo date('Y-m-d H:i:s',strtotime("+30 minutes"));  //comming year o/p 11.23.2013

            //echo $_SESSION['temps'];

            
            if (strtotime($aff['btn_innactif'])>strtotime(date("Y-m-d H:i:s",$temps))){
              $bouton='<i class="fa fa-ban" aria-hidden="true"></i> Livré <i class="fa fa-ban" aria-hidden="true"></i>';
              $disabled="disabled";
            }else{
              $bouton="Livré";
              $disabled="";
            }


            ?>
            <hr>
            <p class="text-center text-uppercase">Vous avez pris en charge <strong style="color:green">la commande N° <?php echo $tab['IDCOLIS'] ?> </strong> à  <strong style="color:green"> <?php echo $aff['temps_accept_liv']; //echo date('Y-m-d H:i:s',strtotime("+30 minute 00 seconde")); ?></strong>, vous avez  <strong style="color:green"> 30min</strong> pour livré le colis de  <strong style="color:green"> <?php echo $tab['adresseOrig']; ?></strong> à  <strong style="color:green"> <?php echo $tab['adresseLivraison'];?></strong>,<br> Le numero du client concerné est  <strong style="color:green"> <?php echo $tab['tel']; ?></strong>  <br> 

            Veuillez indiquer que la livraison a été bien faite en cliquant ici</p>
            <center><form method="POST" >
                        <button type="submit" name="livree" value="<?php echo $tab['IDCOLIS']; ?>" <?php  echo $disabled;  ?>  class="templatemo-edit-btn"><?php echo $bouton; ?></button>
                        </form></center>
<hr>
                     

             <?php }?>
         
          </div>

          
          <?php }
          if($compt<3){ ?>
          <div class="templatemo-content-container">
          <div class="templatemo-content-widget white-bg">
            <center><h2 class="margin-bottom-10">Commande(s) disponible(s) <?php //echo $_SESSION["id"]; ?></h2></center>
            <hr>
          
             
            <table class="table table-striped table-bordered templatemo-user-table text-center">
                  <thead>
                    <tr>
                      <td><a  class="white-text templatemo-sort-by">Type Colis<span class="caret"></span></a></td>

                      <!--<td><a  class="white-text templatemo-sort-by">Poids<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Volume<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Description<span class="caret"></span></a></td>-->
                       <td><a class="white-text templatemo-sort-by">Détail sur la commande<span class="caret"></span></a></td>
                      <td><a class="white-text templatemo-sort-by">Prendre la commande <span class="caret"></span></a></td>
                      
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        while($var->fetch()){ ?>
                        
                        

                    <tr>

                        <td><?php echo $typescolis ?></td>
                        <!--<td><?php //echo $poids ?></td>
                        <td><?php //echo $volume ?></td>
                        <td ><?php// echo $Description ?></td>-->
                        
                       
                        
                        <td onclick="affiche_prix()"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></td>
                        
                          <!--<td onclick="affiche_prix(<?php // echo $_IDCOLIS ?>)">
                        <i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></td>-->

                        <td><form method="POST" >
                        <button type="submit" name="prendre" value="<?php echo $IDCOLIS ?>"  alt="prendre" class="templatemo-edit-btn" data-toggle="modal" data-target="#exampleModal"> 
                                                    <i class="fa fa-cart-arrow-down fa-fw" ></i>
                        </button>
                        </form>
                        </td>

                       
                    
        
                        <!--onmouseover="affiche_prix()-->
                    </tr>
                    </div>
                    <?php  }?>
                    <?php while($var1->fetch()){ ?>
                     <?php //$tous="Type(s) de colis: ".$_typescolis."  Nombre de colis : ".$_nbColis."  Poid: ".$_poids."  Adresse dorigine: ".$_adresseOrig."  Adresse de destination: ".$_adresseLivraison."  Prix de la commande: ".$_prix_comm." fcfa";
                     
                
                     
                     ?>
                     
                     
                    <tr>
                        
                        
                        
                        
                        <td><?php echo $_typescolis ?>
                         <input type="hidden" id="td1" name="custId" value="<?php echo $_typescolis ?>">
                        
                        </td>
                        
                    
                        
                       <!-- <td id="me"><?php //echo $_poids ?></td>
                        <td><?php //echo $_volume ?></td>
                        <td ><?php //echo $_Description ?></td> -->
                        
                        
                        
                         
                         <form method="POST" >
                             <?php   $_prix_demande=(10*$_prix_comm)/100;
 ?>
                             <td>
                           
                                 <input type="button" name="view" value="Voir" id="<?php echo "Type(s) de colis: ".$_typescolis." \n Nombre de colis : ".$_nbColis." \n Poid: ".$_poids." \n Adresse dorigine: ".$_adresseOrig." \n Adresse de destination: ".$_adresseLivraison." \n Prix de la commande: ".$_prix_comm." fcfa \n Crédit demandé : ".$_prix_demande." fcfa"; ?>" class="templatemo-edit-btn view_data"  > 

                        
                       <!-- <form method="POST" >
                        <button type="submit" name="voir" value="<?php //echo $_IDCOLIS ?>" class="templatemo-edit-btn" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></button>
                        </form> -->
                        
                        </td>

                        <td>
                        <button type="submit" name="prendre" value="<?php echo $_IDCOLIS ?>" class="templatemo-edit-btn" >
                            <i class="fa fa-cart-arrow-down fa-fw" aria-hidden="false" style="color:black;"></i>
                        </button>
                        </form>
                        </td>

                       
                    
        
                        
                    </tr>
                    <?php  }?>

                  </tbody>
                </table>   
                
          
          </div>


        <?php }}?>

        
           
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

 

      var timeoutID;

function delayedAlert() {
  timeoutID = window.setTimeout(slowAlert, 2000);
}

function slowAlert() {
  alert("C'était long…");
}

function clearAlert() {
  window.clearTimeout(timeoutID);
}



    </script>
    <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
  </body>
</html>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <?php echo $reponse; ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      <?php if($reponse!=""){?>
        
<?php
echo '<script type="text/javascript">

swal(" Crédit insuffisant."," La commande vaut: '.$revenu_ecode.' FcFA", "warning");

</script>';
?>

      <?php } ?>

      <?php
      $date_fin=$bdd->query("select fin from abonnement where id_liv='".$_SESSION['codeliv']."' and actif='oui' ");
      $date_fin->bindColumn('fin',$date_final);
      $nbr_date=$date_fin->rowCount();
      while($date_fin->fetch()){
        $date_final=$date_final;
      }
      

      $tps=time(); 
      if($nbr_date>0){
        if (strtotime($date_final)<strtotime(date("Y-m-d H:i:s",$tps))){
            

            
          $majAbonnliv=$bdd->query("UPDATE livreur SET Abonne='non' where  IDLIV='".$_SESSION['codeliv']."' ");
          $majAbonnlivreur=$bdd->query("UPDATE abonnement SET actif='non' where  id_liv='".$_SESSION['codeliv']."' ");
          
                      ?>
            
            <script type="text/javascript">




swal(" INFORMATION ","Votre abonnement vient de finir","info");
 setTimeout(rediriger, 5000);

</script>
            <?php
            
            
              header("location:admin_livreur.php");




        }
      }



      ?>
      
<script type="text/javascript">

function affiche_prix(){
    


swal("Information commande",a,"info");


setTimeout(rediriger, 10000);


function rediriger(){
  swal.close();
}

}



</script>

<?php

if($voir=="oui"){
    echo '
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
        '.$tout.'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    ';
}


if($reponse_bonus!=""){
  echo '<script type="text/javascript">

swal(" Bienvenue sur votre compte."," vous avez recu: 400 FcFA", "warning");

swal("Information commande n°"+var1,"Type(s) de colis: "+var2+" \n Nombre de colis : "+var3+" \n Poid: "+var4+" \n Adresse dorigine: "+var5+" \n Adresse de destination: "+var6+" \n Prix de la commande: "+var7+" fcfa","info");

</script>';
}


?>

<div id="dataModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Employee Details</h4>
   </div>
   <div class="modal-body" id="commande_detail">
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
<!--1 -->
<div id="dataModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Employee Details</h4>
   </div>
   <div class="modal-body" id="employee_detail">
    
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>

<script>  
$(document).ready(function(){
 $('#insert_form').on("submit", function(event){  
  event.preventDefault();  
  if($('#name').val() == "")  
  {  
   alert("Name is required");  
  }  
  else if($('#address').val() == '')  
  {  
   alert("Address is required");  
  }  
  else if($('#designation').val() == '')
  {  
   alert("Designation is required");  
  }
   
  else  
  {  
   $.ajax({  
    url:"insert.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),  
    beforeSend:function(){  
     $('#insert').val("Inserting");  
    },  
    success:function(data){  
     $('#insert_form')[0].reset();  
     $('#add_data_Modal').modal('hide');  
     $('#employee_table').html(data);  
    }  
   });  
  }  
 });


 <!--2-->


 $(document).on('click', '.view_data', function(){
  //$('#dataModal').modal();
  var employee_id = $(this).attr("id");
  
 
    swal(" Détail de la commande.",employee_id, "warning");
    

    setTimeout(rediriger, 5000);


    function rediriger(){
        swal.close();
    }

  
 });
});  
 </script>
 <style>
     .swal-text {

  text-align: center;
 
}
 </style>