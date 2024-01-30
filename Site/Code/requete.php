<?php
//___________________________________INITIALISATION DE TABLEAU POUR STOCKER LES DONNEES DEDANS_____________________________________

	$niv = array(array());
	for($l=0; $l<6; $l++)
	{
		for($c=0; $c<6; $c++)
		{
			$niv[$l][$c]="W";		// pour stocker le placement initial des véhicules sur le parking (W = vide)
		}
	}
	
	$niv2 = array(array());
	for($l=0; $l<6; $l++) {
		for($c=0; $c<6; $c++) {
			$niv2[$l][$c]="WW";		// pour placer précisément les véhicules (WW = vide)
		}
	}

	$niv3 = array(array());
	for($l=0; $l<6; $l++) {
		for($c=0; $c<6; $c++) {
			$niv3[$l][$c]="W";		// pour supprimer les lettres "en trop" et ne laisser que celle de la tête (à laquelle on a ajouté l'orientation)
		}
	}
	
	$position = array(array());
	for($l=0; $l<6; $l++) {
		for($c=0; $c<6; $c++) {
			$position[$l][$c]="";		// pour récupérer les coordonnées des véhicules
		}
	}
	
	if(isset($_POST['vehicule']))		// si un véhicule a été sélectionné
	{
		if(isset($_SESSION['vehi'])) unset($_SESSION['vehi']);		// si la variable existe déjà (ancien véhicule) alors la supprimer
		$_SESSION['vehi']=$_POST['vehicule'];		// variable de SESSION pour retenir quel véhicule est sélectionné
	}
	
	if(isset($_SESSION['vehi']))		// si nous avons bien retenu le véhicule sélectionné
	{
		$vehi = $_SESSION['vehi'];		// on le place dans une variable car les requêtes n'acceptent pas les variables de SESSION
		
//___________________________________REQUETE POUR OBTENIR LES INFORMATIONS SUR LE NIVEAU EN COURS_____________________________________

		$requete7 = "SELECT lettre_vehicule, taille_vehicule, coord_ligne, coord_colonne, orientation FROM niveau_en_cours";
		$result7 = mysqli_query($link,$requete7);
		if ( $result7 == FALSE )		// en cas d'erreur 7
		{
			echo "Erreur d'exécution de la requete 7" ;
			die();
		}
//___________________________________REQUETE POUR OBTENIR LES INFORMATIONS SUR LE VEHICULE SELECTIONNE_____________________________________	
	
		$requete8 = "SELECT taille_vehicule, coord_ligne, coord_colonne, orientation FROM niveau_en_cours WHERE lettre_vehicule ='".$vehi."'";
		$result8 = mysqli_query($link,$requete8);
		if ( $result8 == FALSE )		// en cas d'erreur 8
		{
			echo "Erreur d'exécution de la requete 8" ;
			die();
		}
		$row8 = mysqli_fetch_assoc($result8);		// récupération de la ligne trouvée par la requête 8
		
		while($row7 = mysqli_fetch_assoc($result7))		// récupération de la ligne trouvée par la requête 7 pour remplir le tableau $niv3
		{
			if($row7['orientation'] == 'D' || $row7['orientation'] == 'R')		// changement de nom des véhicules pour ajouter l'orientation
			{
				$niv3[$row7['coord_ligne']][$row7['coord_colonne']] = $row7['lettre_vehicule'].'.'.$row7['orientation'];
			}
			if($row7['orientation'] == 'L')
			{
				$niv3[$row7['coord_ligne']][$row7['coord_colonne']-$row7['taille_vehicule']+1] = $row7['lettre_vehicule'].'.'.$row7['orientation'];
			}
			if($row7['orientation'] == 'U')
			{
				$niv3[$row7['coord_ligne']-$row7['taille_vehicule']+1][$row7['coord_colonne']] = $row7['lettre_vehicule'].'.'.$row7['orientation'];
			}
		}
		for($m=0; $m<6; $m++)
		{
			for($n=0; $n<6; $n++)
			{
				$aled = explode('.', $niv3[$m][$n]);
				if($aled[0] == $vehi)
				{
					$ord = $m;		// récupération de l'ordonnée (la ligne) et de l'abscisse (la colonne) de chaque véhicule
					$abs = $n;
				}
			}
		}
		include('cas_derreur.php');		// fichier contenant tous les cas d'erreur où le véhicule ne peut pas avancer
	}
	
	if(isset($_POST['acces']) || isset($_SESSION['numero']))		// si on commence un niveau
	{	
		if(!isset($_SESSION['numero'])) $_SESSION['numero']=$_POST['acces'];		// récupération du numéro du niveau
		if(!isset($_SESSION['nbreCoup'])) $_SESSION['nbreCoup']=0;		// variable pour retenir le nombre de coups joués
		$u = $_SESSION['numero'];
		if($u < 11)		// si c'est un niveau entre 1 et 10 alors c'est un niveau facile
		{
			$requete = "SELECT idNiveau, difficulté, lettre_vehicule, taille_vehicule, coord_ligne, coord_colonne, orientation
			FROM niveau_predefini_facile WHERE idNiveau = $u";
		}
		elseif($u < 21)		// si c'est un niveau entre 11 et 20 alors c'est un niveau intermédiaire
		{
			$requete = "SELECT idNiveau, difficulté, lettre_vehicule, taille_vehicule, coord_ligne, coord_colonne, orientation
			FROM niveau_predefini_intermediaire WHERE idNiveau = $u";
		}
		elseif($u <31)		// si c'est un niveau entre 21 et 30 alors c'est un niveau difficile
		{
			$requete = "SELECT idNiveau, difficulté, lettre_vehicule, taille_vehicule, coord_ligne, coord_colonne, orientation
			FROM niveau_predefini_difficile WHERE idNiveau = $u";
		}
		elseif($u <41)		// si c'est un niveau entre 31 et 40 alors c'est un niveau expert
		{
			$requete = "SELECT idNiveau, difficulté, lettre_vehicule, taille_vehicule, coord_ligne, coord_colonne, orientation
			FROM niveau_predefini_expert WHERE idNiveau = $u";
		}
		elseif($u >=41)		// si c'est un niveau au dessus de 41 alors c'est un niveau créé
		{
			$requete = "SELECT idNiveau, difficulté, lettre_vehicule, taille_vehicule, coord_ligne, coord_colonne, orientation
			FROM niveau_cree WHERE idNiveau = $u";
		}
	}
	$result = mysqli_query($link,$requete);
	if ( $result == FALSE )		// en cas d'erreur
	{
		echo "Erreur d'exécution de la requete" ;
		die();
	}
	$nbvoiture = 0;
	while($row = mysqli_fetch_assoc($result))		// récupération des données de la requête
	{	
		if(!isset($_POST['vehicule']) && !isset($_SESSION['copie']))		// si nous n'avons pas commencé à jouer
		{
			$idNivo=$row['idNiveau'];
			$difficult=$row['difficulté'];
			$lettre_vehi=$row['lettre_vehicule'];
			$taille_vehi=$row['taille_vehicule'];
			$coord_li=$row['coord_ligne'];
			$coord_col=$row['coord_colonne'];
			$orient=$row['orientation'];
//___________________________________REQUETE POUR METTRE DE COTE LES INFORMATIONS DU NIVEAU EN COURS_____________________________________	

			$requete2 = "INSERT INTO `niveau_en_cours`(`idNiveau`, `difficulté`, `lettre_vehicule`, `taille_vehicule`, `coord_ligne`, `coord_colonne`, `orientation`) VALUES ('$idNivo', '$difficult', '$lettre_vehi', '$taille_vehi', '$coord_li', '$coord_col', '$orient')";
			$result2 = mysqli_query($link,$requete2);
			if ( $result2 == FALSE )		// en cas d'erreur 2
			{
				echo "Erreur d'exécution de la requete 2" ;
				die();
			}
		}
		
		$requete6 = "SELECT lettre_vehicule, taille_vehicule, coord_ligne, coord_colonne, orientation FROM niveau_en_cours";
		$result6 = mysqli_query($link,$requete6);
		if ( $result6 == FALSE )		// en cas d'erreur 6
		{
			echo "Erreur d'exécution de la requete 6" ;
			die();
		}
		while($row6 = mysqli_fetch_assoc($result6))		// remplissage des tableaux avec l'orientation et la position
		{
			if($row6['orientation'] == 'D')
			{
				$niv2[$row6['coord_ligne']][$row6['coord_colonne']] = $row6['lettre_vehicule'].'.'.$row6['orientation'];
				$ligne = 61*$row6['coord_ligne'];		// calcul des positions en px par rapport aux coordonnées
				$colonne = 60*$row6['coord_colonne'];
				$position[$row6['coord_ligne']][$row6['coord_colonne']] = "$ligne.$colonne";
			}
			if($row6['orientation'] == 'R')
			{
				$niv2[$row6['coord_ligne']][$row6['coord_colonne']] = $row6['lettre_vehicule'].'.'.$row6['orientation'];
				$ligne = 61*$row6['coord_ligne'];
				$colonne = 60*$row6['coord_colonne'];
				$position[$row6['coord_ligne']][$row6['coord_colonne']] = "$ligne.$colonne";
			}
			if($row6['orientation'] == 'L')
			{
				$niv2[$row6['coord_ligne']][$row6['coord_colonne']-$row6['taille_vehicule']+1] = $row6['lettre_vehicule'].'.'.$row6['orientation'];
				$ligne = 61*$row6['coord_ligne'];
				$colonne = 60*($row6['coord_colonne']-$row6['taille_vehicule']+1);
				$position[$row6['coord_ligne']][$row6['coord_colonne']-$row6['taille_vehicule']+1] = "$ligne.$colonne";
			}
			if($row6['orientation'] == 'U')
			{
				$niv2[$row6['coord_ligne']-$row6['taille_vehicule']+1][$row6['coord_colonne']] = $row6['lettre_vehicule'].'.'.$row6['orientation'];
				$ligne = 61*($row6['coord_ligne']-$row6['taille_vehicule']+1);
				$colonne = 60*$row6['coord_colonne'];
				$position[$row6['coord_ligne']-$row6['taille_vehicule']+1][$row6['coord_colonne']] = "$ligne.$colonne";
			}
		}
		
		$niv[$row['coord_ligne']][$row['coord_colonne']] = $row['lettre_vehicule'];
		for($i=1;	$i<$row['taille_vehicule']; $i++)		// boucle pour que les camions bloquent 3 cases et les voiture 2 cases
		{
			if($row['orientation']=='U')		// si vers le haut
			{
				$niv[$row['coord_ligne']-$i][$row['coord_colonne']] = $row['lettre_vehicule'];
			}
			if($row['orientation']=='D')		// si vers le bas
			{
				$niv[$row['coord_ligne']+$i][$row['coord_colonne']] = $row['lettre_vehicule'];
			}
			if($row['orientation']=='R')		// si vers la droite
			{
				$niv[$row['coord_ligne']][$row['coord_colonne']+$i] = $row['lettre_vehicule'];
			}
			if($row['orientation']=='L')		// si vers la gauche
			{
				$niv[$row['coord_ligne']][$row['coord_colonne']-$i] = $row['lettre_vehicule'];
			}
		}
		$nbvoiture++;		// incrémentation du nombre de voiture (avant de tous recommencer pour le prochain)
	}
	$_SESSION['copie']=1;