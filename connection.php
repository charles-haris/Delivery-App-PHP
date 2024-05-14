<?php
 function connect() {
	try
	{
		// $bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'toutl2jw', 'o1?4X5!2P%P7Kh9E');
		$bdd = new PDO('mysql:host=localhost; dbname=toutl2jw_bd_livraison', 'root', 'root');
		 $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	 	 return $bdd;
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
}

?>