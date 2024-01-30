<?php
//___________________________________________CONNEXION AU SERVEUR + VERIFICATION DES ACCENTS________________________________________________

	$host = "serveroo.fr";
	$port = 32011;
	$username = "root";
	$password = "kku3kw4m"; // Remplacez "votre_mot_de_passe" par votre mot de passe
	$database = "projet"; // Remplacez "votre_nom_de_database" par le nom de votre base de données

	$link = new mysqli($host, $username, $password, $database, $port);
	
	if ($link == false)		// en cas d'erreur
	{
		echo "Erreur de connexion : " . mysqli_connect_errno() ;
		die();
	}
	
	if (!mysqli_set_charset($link, "utf8"))
	{
    	printf("Erreur lors du chargement du jeu de caractères utf8 : %s\n", mysqli_error($link));
    	exit();
	} 
?>
