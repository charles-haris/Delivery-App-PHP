<?php
session_start();

	  include_once "../controler/controlerlivreur.php";
	  if(isset($_POST['okay']))
	  {
      serializeInsc();
  }


if (isset($_POST['connect']))
{
 $pseudo = $_POST['pseudo'];
 $motpass = $_POST['modepass'];	
 $con = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');
 $final= crypter($motpass);
  $select = $con->prepare("SELECT a.pseudo , a.password, b.bloquer FROM login as a, session as b WHERE (a.id=b.id) AND a.pseudo='$pseudo' and password='$final'");
 $select->setFetchMode(PDO::FETCH_ASSOC);
 $select->execute();
 $data=$select->fetch();
 $passe =$data['password'];

/*
$motpas = "souleu";
$code = strlen($motpas);
$code = ($code * 4)*($code/3);
$sel = strlen($motpas);
$sel2 = strlen($code.$motpas);
$texte_hash = sha1($sel.$motpas.$sel2);
$texte_hash_2 = md5($texte_hash.$sel2);
$final = $texte_hash.$texte_hash_2;
substr($final , 7, 8);*/
$final = strtoupper($final);
 if($data['pseudo']!=$pseudo && $data['password']!=$final && $data['bloquer']=='oui')
 {
  echo "<script>alert('invalid email or pass ou bloque')</script>";
 }
 elseif($data['pseudo']==$pseudo &&  $data['password']==$final && $data['bloquer']=='non')
 {
  $con = new PDO ("mysql:host=localhost;dbname=bd_livraison","root","");
$select = $con->query("UPDATE session set  allocation=1 ");
$select->execute();

    $_SESSION['Pseudo']=$data['pseudo'];
header("location:connection.php"); 
 }
 if ( $data['password'] == $final)
 {
 	 echo "<script>alert('vrai')</script>";
 }else
 {
 	 echo "<script>alert('faut')</script>";
 }
}
?>

<?php  
class MaClasse
{
  private $unAttributPrive;
  
  public function __set($nom, $valeur)
  {
    echo 'Ah, on a tenté d\'assigner à l\'attribut <strong>', $nom, '</strong> la valeur <strong>', $valeur, '</strong> mais c\'est pas possible !<br />';
  }
}



?>
<link rel="stylesheet" type="text/css" href="style.css">
	<div class= "entete">
	
<div class="conte">
<form method="post">
<input type="text" name="pseudo" placeholder="pseudo">
<input type="text" name="modepass" placeholder="**********">
<input type="submit" name="connect" value="Connect">
</form>
</div>
</div>
<h1>Create Account Here</h1>
<div class="for">
<form   method="post">
<input type="text" name="prenom" placeholder="prenom">
<input type="text" name="nom" placeholder="Nom">
<input type="text" name="contact" placeholder="Contact">
<input type="text"  name="post"  placeholder="Post">
<input type="text"  name="entreprise"  placeholder="Entreprise">
<input type="text"  name="pseudo"  placeholder="Pseudo">
<input type="text"  name="motpass"  placeholder="Mot de Pass">
<input type="text"  name="repet"  placeholder="Repeter le mot de passe">
<input type="text"  name="adresse"  placeholder="Adresse">
<br/>
<input type="submit" name="okay"   value="valider">

</form>
<?php 
$obj = new MaClasse;

$obj->attribut = 'Simple test';
$obj->unAttributPrive = 'Autre simple test';
?>
</div>
</div>
</div>

<?php

$first = new DateTime("now");
// 4:29:11 am on November 20, 1962
$second = new DateTime("2019-09-26 6:4:11pm");
$diff = $first->diff($second);
printf("The two dates have %d weeks, %s days, " .
"%d hours, %d minutes, and %d seconds " .
"elapsed between them.",
floor($diff->format('%a') / 7),
$diff->format('%a') % 7,
$diff->format('%h'),
$diff->format('%i'),
$diff->format('%s'));

if($diff->format('%i')==0)
{

$con = new PDO ("mysql:host=localhost;dbname=bd_livraison","root","");
$select = $con->query("UPDATE session set  bloquer='oui' where Id=1");
$select->execute();

}
?>