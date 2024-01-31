<?php
//__________________________CREATION D'UN FICHIER TEST.TXT POUR TRANSMETTRE LES O£INFORMATIONS DU NIVEAU AU SOLVEUR________________________

	if(isset($_POST['jsp']))		// si on a demandé un indice/la solution
	{
		if($_SESSION['nbreCoup'] == 0)		// si nous n'avons pas bougé de véhicule
		{
			$file = fopen("solveur.txt", "w");
			fwrite($file, "$nbvoiture\n");
			$chaine = "";
			for($l=0; $l<6; $l++) {
				for($c=0; $c<6; $c++) {
					$chaine = $chaine.$niv[$l][$c];		// code de 36 lettres correspondant au parking
				}
			}
			fwrite($file, $chaine);		// écriture dans le fichier generateur.txt
			fclose($file);
		}
		else		// autre : si au moins un véhicule a bougé
		{
			$file2 = fopen("test.txt", "w");
			fwrite($file2, "$nbvoiture\n");
			$chaine2 = "";
			$niv4 = array(array());
			for($l=0; $l<6; $l++) 
			{
				for($c=0; $c<6; $c++) 
				{
					$niv4[$l][$c] = "W";		// initialisation du code avec 36 W (repésantant les cases vides)
				}
			}
			for($l=0; $l<6; $l++) 
			{
				for($c=0; $c<6; $c++) 
				{
					if($niv3[$l][$c] != 'W')
					{
						$tab = explode('.',$niv3[$l][$c]);
						$niv4[$l][$c] = $tab[0];
						if($tab[0] == 'O' || $tab[0] == 'P' || $tab[0] == 'Q' || $tab[0] == 'R')		// si c'est un camion
						{
							if($tab[1] == 'U' || $tab[1] == 'D')		// si il est vertical
							{
								$niv4[$l + 1][$c] = $tab[0];		// il faut 2 fois supplémentaires la lettre pour représenter le camion entier
								$niv4[$l + 2][$c] = $tab[0];
							}
							else		// si il est horizontal
							{
								$niv4[$l][$c + 1] = $tab[0];
								$niv4[$l][$c + 2] = $tab[0];
							}
						}
						else		// si c'est un voiture
						{
							if($tab[1] == 'U' || $tab[1] == 'D')
							{
								$niv4[$l + 1][$c] = $tab[0];		// il faut 1 fois supplémentaire la lettre pour représenter la voiture entière
							}
							else
							{
								$niv4[$l][$c + 1] = $tab[0];
							}
						}
					}
				}	
			}
			
			for($l=0; $l<6; $l++) 
			{
				for($c=0; $c<6; $c++) 
				{
					$chaine2 = $chaine2.$niv4[$l][$c];
				}
			}	
			fwrite($file2, $chaine2);		// écriture dans le fichier test.txt
			fclose($file2);
		}
	}
	
//_________________________________________________________FONCTION POUR DEBOGUER LE C_____________________________________________________
	$output = shell_exec('gcc fonction.c main.c -o mon_programme');
	$output2 = shell_exec('./mon_programme');	

//_________________________________________________DECODAGE DU FICHIER RENVOYE PAR LE SOLVEUR_____________________________________________

	$source4="solveur.txt";		// récupération du fichier test.txt modifié par le solveur
	$fichier4=fopen($source4,"r+");
	if ($fichier4)
	{
		$recup=array();
		$i=0;
		while (!feof($fichier4))
		{
			$recup[$i] = fgets($fichier4);		// récupération ligne par ligne des données dans le fichier
			$i++;
		}
	}
	$nbrevehi = $recup[0];		// variable pour le nombre de véhicules
	$solution = str_split($recup[1]);		// récupération du code du placement final des véhicules dans le parking
	$tab = array(array());
	for ($u = 0; $u < 6; $u++)
	{
		$h = $u *6;
		for ($v = 0; $v < 6; $v++)
		{
			$tab[$u][$v] = $solution[$h+$v];		// transformation du code en tableau pour différencier les véhicules
		}
	}
	$coupjoue = $recup[2];		// variable pour le nombre de coups joués
	$enchainementmouv = array();
	$o = 0;
	for ($j = $i - $coupjoue; $j < $i; $j++)
	{
		$enchainementmouv[$o]=$recup[$j];		// tableau pour récupérer chaque coup à faire pour arriver à la fin
		$o++;
	}
	fclose($fichier4);
?>