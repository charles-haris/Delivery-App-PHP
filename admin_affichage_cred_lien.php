<?php 
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
  $credit=$_SESSION['credit'];



?>