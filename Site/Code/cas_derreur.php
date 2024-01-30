<?php
//____________________________________TRAITEMENT DE TOUS LES CAS D'ERREUR LIES AU DEPLACEMENT D'UN VEHICULE____________________________________

	if(isset($_POST['boutonvoiture']))		// si une voiture a été sélectionnée
	{
		$boutonvoit=$_POST['boutonvoiture'];
		if($boutonvoit == '∧')		// si elle va vers le haut
		{
			if(!($ord - 1 < 0) && $niv3[$ord - 1][$abs]=='W')		// si la case au-dessus n'est pas en dehors du parking et si elle est libre
			{
				if($ord - 2 >= 0)		//si la case encore au-dessus n'est pas en dehors du parking
				{
					if($niv3[$ord - 2][$abs] != 'W')		// s'il y a un véhicule sur cette case
					{
						$voithaut1 = explode('.',$niv3[$ord - 2][$abs]);
						if($voithaut1[1] == 'R' || $voithaut1[1] == 'L')		// s'il est horizontal
						{
							$var = 1;		// le déplacement est envisageable
						}
						else
						{
							$var = 0;		// la voiture restera bloquée
						}
					}
				}
				if($ord - 3 >= 0)		// si la case encore plus au-dessus n'est pas en dehors du parking
					{
						if($niv3[$ord - 3][$abs] != 'W')		// s'il y a un véhicule sur cette case
						{
							$voithaut3 = explode('.',$niv3[$ord - 3][$abs]);
							if($voithaut3[0] == 'O' || $voithaut3[0] == 'P' || $voithaut3[0] == 'Q' || $voithaut3[0] == 'R')	// si c'est un camion
							{
								if($voithaut3[1] == 'U' || $voithaut3[1] == 'D') // s'il est vertical
								{
									$var = 0;		// la voiture restera bloquée
								}
							}
						}
					}
					if($abs - 1 >= 0)		// si la case de la ligne à gauche n'est pas en dehors du parking
					{
						if($niv3[$ord - 1][$abs - 1] != 'W')		// s'il y a un véhicule sur la case à gauche
						{
							$voithaut2 = explode('.',$niv3[$ord - 1][$abs - 1]);
							if($voithaut2[1]=='U' || $voithaut2[1]=='D')		//si ce véhicule est vertical
							{
								if(!isset($var))
								{
									$var = 1;		// le déplacement est envisageable
								}
							}
							else		// si il est horizontal
							{
								$var = 0;		// la voiture restera bloquée
							}
						}
						else		// s'il n'y a pas de véhicule sur la case à gauche
						{
							if(!isset($var))
							{
								$var = 1;		// le déplacement est envisageable
							}
						}
						if($abs - 2 >= 0)		// si la case de la ligne encore à gauche n'est pas en dehors du parking
						{
							if($niv3[$ord - 1][$abs - 2] != 'W')		// s'il y a un véhicule sur cette case
							{
								$voithaut4 = explode('.',$niv3[$ord - 1][$abs - 2]);
								if($voithaut4[0] == 'O' || $voithaut4[0] == 'P' || $voithaut4[0] == 'Q' || $voithaut4[0] == 'R') // si c'est un camion
								{
									if($voithaut4[1] == 'R' || $voithaut4[1] == 'L')		// si ce camion est horizontal
									{
										$var = 0;		// la voiture restera bloquée
									}
								}
							}
						}
					}
					else		// si la case de la ligne a gauche est en dehors du parking
					{
						if(!isset($var))
						{
							$var = 1;		// le déplacement est envisageable
						}
					}	
			}
			else		// si la case au dessus est en dehors du parking ou si elle n'est pas libre
			{
				$var = 0;		// la voiture restera bloquée
			}			
						
			if($var == 1)		// si le déplacement est envisageable on l'exécute
			{
//____________________________________REQUETE POUR MODIFIER LA LIGNE DE LA VOITURE QUI VA VERS LE HAUT____________________________________

				$requete5 = "UPDATE niveau_en_cours SET coord_ligne = coord_ligne - 1 WHERE lettre_vehicule ='".$vehi."'";
				$result5 = mysqli_query($link,$requete5);
				if ( $result5 == FALSE )		// en cas d'erreur 5
				{
					echo "Erreur d'exécution de la requete 5" ;
					die();
				}
				$_SESSION['nbreCoup']++;		// on incrémente le nombre de coups car un déplacement a eu lieu
			}
		}
		if($boutonvoit == '∨')		// si elle va vers le bas
		{
			if(!($ord + 2 > 5) && $niv3[$ord + 2][$abs]=='W')		// si la case en-dessous n'est pas en dehors du parking et si elle est libre
			{
				if($abs - 1 >= 0)		//si la case de la ligne à gauche n'est pas en dehors du parking
				{
					if($niv3[$ord + 2][$abs - 1] != 'W')		// s'il y a un véhicule sur la case à gauche
					{
						$voitbas1 = explode('.',$niv3[$ord + 2][$abs - 1]);
						if($voitbas1[1]=='U' || $voitbas1[1]=='D')		//si ce véhicule est vertical
						{
							$var = 1;		// le déplacement est envisageable
						}
						else		//si il est horizontal
						{
							$var = 0;		// la voiure restera bloquée
						}
					}
					else		//s'il n'y a pas de véhicule sur la case à gauche
					{
						$var = 1;		// le déplacement est envisageable
					}
					if($abs - 2 >= 0)		// si la case de la ligne encore à gauche n'est pas en dehors du parking
					{
						if($niv3[$ord + 2][$abs - 2] != 'W')		// s'il y a un véhicule sur cette case
						{
							$voitbas2 = explode('.',$niv3[$ord + 2][$abs - 2]);
							if($voitbas2[0] == 'O' || $voitbas2[0] == 'P' || $voitbas2[0] == 'Q' || $voitbas2[0] == 'R')	// si c'est un camion
							{
								if($voitbas2[1] == 'R' || $voitbas2[1] == 'L')		// si ce camion est horizontal
								{
									$var = 0;		// la voiture restera bloquée
								}
							}
						}
					}
				}
				else		// si la case de la ligne à gauche est en dehors du parking
				{
					$var = 1;		// le déplacement est envisageable
				}	
			}
			else		// si la case en dessous est en dehors du parking ou si elle n'est pas libre
			{
				$var = 0;		// la voiture restera bloquée
			}	
			if($var == 1)		// si le déplacement est envisageable alors on l'exécute
			{
//____________________________________REQUETE POUR MODIFIER LA LIGNE DE LA VOITURE QUI VA VERS LE BAS____________________________________

				$requete5 = "UPDATE niveau_en_cours SET coord_ligne = coord_ligne + 1 WHERE lettre_vehicule ='".$vehi."'";
				$result5 = mysqli_query($link,$requete5);
				if ( $result5 == FALSE )		// en cas d'erreur 5
				{
					echo "Erreur d'exécution de la requete 5" ;
					die();
				}
				$_SESSION['nbreCoup']++;		// on incrémente le nombre de coup car un déplacement a été réalisé
			}
		}
		if($boutonvoit == '>')		// si elle va vers la droite
		{
			$locali = $_SESSION['vehi'];
			if($niv3[2][4] == 'X.L')		// si la voiture rouge est devant la sortie
			{
				echo "<audio title='victory horn' autoplay><source src='son/victory-horn.mp3' type='audio/mp3'></audio>"; // son
				echo "<script type='text/javascript'>document.location.replace('gagne.php');</script>";		// alors c'est ... GAGNE !!
			}
			if(!($abs + 2 > 5) && $niv3[$ord][$abs+2]=='W')		// si la case à côté n'est pas en dehors du parking et si elle est libre
			{
				if($ord - 1 >= 0)		// si la case de la ligne au-dessus n'est pas en dehors du parking
				{
					if($niv3[$ord - 1][$abs + 2] != 'W')		// s'il y a un véhicule sur la case au-dessus
					{
						$voitdroite1 = explode('.',$niv3[$ord -1][$abs + 2]);
						if($voitdroite1[1]=='R' || $voitdroite1[1]=='L')		// si ce véhicule est horizontal
						{
							$var = 1;		// le déplacement est envisageable
						}
						else		// si il est vertical
						{
							$var = 0;		// la voiture restera bloquée
						}
					}
					else		// s'il n'y a pas de véhicule sur la case au-dessus
					{
						$var = 1;		// le déplacement est envisageable
					}
					if($ord - 2 >= 0)		// si la case de la ligne encore au-dessus n'est pas en dehors du parking
					{
						if($niv3[$ord - 2][$abs + 2] != 'W')		// s'il y a un véhicule sur cette case
						{
							$voitdroite2 = explode('.',$niv3[$ord -2][$abs + 2]);
							if($voitdroite2[0] == 'O' || $voitdroite2[0] == 'P' || $voitdroite2[0] == 'Q' || $voitdroite2[0] == 'R')	// si c'est un camion
							{
								if($voitdroite2[1] == 'U' || $voitdroite2[1] == 'D')		// si ce camion est vertical
								{
									$var = 0;		// la voiture restera bloquée
								}
							}
						}
					}
				}
				else		// si la case de la ligne au dessus en en dehors du parking
				{
					$var = 1;		// le déplacement est envisageable
				}	
			}
			else		// si la case à côté est en dehors du parking ou si elle n'est pas libre
			{
				$var = 0;		// la voiture restera bloquée
			}	
			if($var == 1)		// si le déplacement est envisageable alors on l'exécute
			{
//____________________________________REQUETE POUR MODIFIER LA COLONNE DE LA VOITURE QUI VA VERS LA DROITE____________________________________

				$requete5 = "UPDATE niveau_en_cours SET coord_colonne = coord_colonne + 1 WHERE lettre_vehicule ='".$vehi."'";
				$result5 = mysqli_query($link,$requete5);
				if ( $result5 == FALSE )		// en cas d'erreur 5
				{
					echo "Erreur d'exécution de la requete 5" ;
					die();
				}
				$_SESSION['nbreCoup']++;		// on incrémente le nombre de coup car la voiture a été déplacée
			}
		}
		if($boutonvoit == '<')		// si elle va vers la gauche
		{
			if(!($abs - 1 < 0) && $niv3[$ord][$abs-1]=='W')		// si la case à côté n'est pas en dehors du parking et si elle est libre
			{
				if($abs - 2 >= 0)		// si la case de la ligne encore à côté n'est pas en dehors du parking
				{
					if($niv3[$ord][$abs - 2] != 'W')		// s'il y a un véhicule sur cette case
					{
						$voitgauche2 = explode('.',$niv3[$ord][$abs - 2]);
						if($voitgauche2[1] == 'U' || $voitgauche2[1] == 'D')		// si ce véhicule est vertical
						{
							$var = 1;		// le déplacement est envisageable
						}
						else
						{
							$var = 0;		// la voiture restera bloquée
						}
					}
				}
				if($abs - 3 >= 0)		// si la case de la ligne encore encore à côté n'est pas en dehors du parking
				{
					if($niv3[$ord][$abs - 3] != 'W') 		// s'il y a un véhicule sur cette case
					{
						$voitgauche3 = explode('.',$niv3[$ord][$abs -3]);
						if($voitgauche3[0] == 'O' || $voitgauche3[0] == 'P' || $voitgauche3[0] == 'Q' || $voitgauche3[0] == 'R')		// si c'est un camion
						{
							if($voitgauche3[1] == 'R' || $voitgauche3[1] == 'L')		// si ce camion est à l'horizontal
							{
								$var = 0;		// la voiture restera bloquée
							}
						}
					}
				}
				if($ord - 1 >= 0)		// si la case de la ligne au-dessus n'est pas en dehors du parking
				{
					if($niv3[$ord - 1][$abs - 1] != 'W')		// s'il y a un véhicule sur la case au-dessus
					{
						$voitgauche1 = explode('.',$niv3[$ord -1][$abs - 1]);
						if($voitgauche1[1]=='R' || $voitgauche1[1]=='L')		// si ce véhicule est horizontal
						{
							if(!isset($var))
							{
								$var = 1;		// le déplacement est envisageable
							}
						}
						else		// si il est vertical
						{
							$var = 0;		// la voiture restera bloquée
						}
					}
					else		// s'il n'y a pas de véhicule sur la case au-dessus
					{
						if(!isset($var))
						{
							$var = 1;		// le déplacement est envisageable
						}
					}
					if($ord - 2 >= 0)		// si la case de la ligne encore au-dessus n'est pas en dehors du parking
					{
						if($niv3[$ord - 2][$abs - 1] != 'W')		// s'il y a un véhicule sur cette case
						{
							$voitgauche4 = explode('.',$niv3[$ord -2][$abs - 1]);
							if($voitgauche4[0] == 'O' || $voitgauche4[0] == 'P' || $voitgauche4[0] == 'Q' || $voitgauche4[0] == 'R') //si c'est un camion
							{
								if($voitgauche4[1] == 'U' || $voitgauche4[1] == 'D')		// si ce camion est vertical
								{
									$var = 0;		// la voiture restera bloquée
								}
							}
						}
					}
				}
				else		// si la case de la ligne au dessus est en dehors du parking
				{
					if(!isset($var))
					{
						$var = 1;		// le déplacement est envisageable
					}
				}	
			}
			else		// si la case à côté est en dehors du parking ou si elle n'est pas libre
			{
				$var = 0;		// la voiture restera bloquée
			}		
						
			if($var == 1)		// si le déplacement est envisageable alors on l'exécute
			{
//____________________________________REQUETE POUR MODIFIER LA COLONNE DE LA VOITURE QUI VA VERS LA GAUCHE____________________________________

				$requete5 = "UPDATE niveau_en_cours SET coord_colonne = coord_colonne - 1 WHERE lettre_vehicule ='".$vehi."'";
				$result5 = mysqli_query($link,$requete5);
				if ( $result5 == FALSE )		// en cas d'erreur 5
				{
					echo "Erreur d'exécution de la requete 5" ;
					die();
				}
				$_SESSION['nbreCoup']++;		// on incrémente le nombre de coup car la voiture a avancé
			}
		}
//_________________________AJOUT D'UN BRUIT DE KLAXON SI LA VOITURE ESSAYE D'AVANCER ALORS QU'ELLE NE PEUT PAS__________________________________
		if($var == 0)
		{
			if(isset($_SESSION['sound']))		// son
			{
				if($_SESSION['sound']=='on')
				{
				?>
				<script type="text/javascript">
                    var num = Math.floor(Math.random() * 6) + 1;  // Nombre aléatoire entre 1 et 10
					if (num == 1)		// Si 1, alors il y a un bruit de klaxon
					{
						var audio = new Audio('son/car-horn1.mp3');
						audio.play();
					}
					if (num == 2)		// Si 2, alors il y aura un autre bruit de klaxon
					{
						var audio = new Audio('son/car-horn2.mp3');
						audio.play();
					}
					if (num == 3)
					{
						var audio = new Audio('son/car-horn3.mp3');
						audio.play();
					}
					if (num == 4)
					{
						var audio = new Audio('son/car-horn4.mp3');
						audio.play();
					}
					if (num == 5)
					{
						var audio = new Audio('son/car-horn5.mp3');
						audio.play();
					}
					if (num == 6)
					{
						var audio = new Audio('son/car-horn6.mp3');
						audio.play();
					}
                </script>
				<?php
				}
			}
		}
	}
	if(isset($_POST['boutoncamion']))		// si le véhicule sélectionné est un camion
	{
		$boutoncam=$_POST['boutoncamion'];
		if($boutoncam == '∧')		// s'il va vers la haut
		{
			if(!($ord - 1 < 0) && $niv3[$ord - 1][$abs]=='W')		// si la case au-dessus n'est pas en dehors du parking et si elle est libre
			{
				if($ord - 2 >= 0)		// si la case encore au-dessus n'est pas en dehors du parking
				{
					if($niv3[$ord - 2][$abs] != 'W')		// s'il y a un véhicule
					{
						$camhaut1 = explode('.',$niv3[$ord - 2][$abs]);
						if($camhaut1[1] == 'R' || $camhaut1[1] == 'L')		// si ce véhicule est à l'horizontal
						{
							$var = 1;		// le déplacement est envisageable
						}
						else		// si ce véhicule est à la vertical
						{
							$var = 0;		// le camion restera bloqué
						}
					}
				}
				if($ord - 3 >= 0)		// si la case encore encore au d=au-dessus n'est pas en dehors du parking
				{
					if($niv3[$ord - 3][$abs] != 'W')		// s'il y a un véhicule
					{
						$camhaut3 = explode('.',$niv3[$ord - 3][$abs]);
						if($camhaut3[0] == 'O' || $camhaut3[0] == 'P' || $camhaut3[0] == 'Q' || $camhaut3[0] == 'R')		// si c'est un camion
						{
							if($camhaut3[1] == 'U' || $camhaut3[1] == 'D')		// s'il est à la vertical
							{
								$var = 0;		// le camion restera bloqué
							}
						}
					}
				}
				if($abs - 1 >= 0)		// si la case de la ligne à gauche n'est pas en dehors du parking
				{
					if($niv3[$ord - 1][$abs - 1] != 'W')		// s'il y a un véhicule sur la case à gauche
					{
						$camhaut2 = explode('.',$niv3[$ord - 1][$abs - 1]);
						if($camhaut2[1]=='U' || $camhaut2[1]=='D')		// si ce véhicule est vertical
						{
							if(!isset($var))
							{
								$var = 1;		// le déplacement est envisageable
							}
						}
						else		// si il est horizontal
						{
							$var = 0;		// le camion restera bloqué
						}
					}
					else		// s'il n'y a pas de véhicule sur la case à gauche
					{
						if(!isset($var))
						{
							$var = 1;		// le déplacement est envisageable
						}
					}
					if($abs - 2 >= 0)		// si la case de la ligne encore à gauche n'est pas en dehors du parking
					{
						if($niv3[$ord - 1][$abs - 2] != 'W')		// s'il y a un véhicule sur cette case
						{
							$camhaut4 = explode('.',$niv3[$ord - 1][$abs - 2]);
							if($camhaut4[0] == 'O' || $camhaut4[0] == 'P' || $camhaut4[0] == 'Q' || $camhaut4[0] == 'R')		// si c'est un camion
							{
								if($camhaut4[1] == 'R' || $camhaut4[1] == 'L')		// si ce camion est horizontal
								{
									$var = 0;		// le camion restera bloqué
								}
							}
						}
					}
				}
				else		// si la case de la ligne à gauche est en dehors du parking
				{
					if(!isset($var))
					{
						$var = 1;		// le déplacement est envisageable
					}
				}	
			}
			else		// si la case au dessus est en dehors du parking ou si elle n'est pas libre
			{
				$var = 0;		// le camion restera bloqué
			}			
						
			if($var == 1)		// si le déplacement est envisageable alors on l'exécute
			{
//_________________________________________REQUETE POUR MODIFIER LA LIGNE DU CAMION QUI VA VERS LE HAUT__________________________________________

				$requete5 = "UPDATE niveau_en_cours SET coord_ligne = coord_ligne - 1 WHERE lettre_vehicule ='".$vehi."'";
				$result5 = mysqli_query($link,$requete5);
				if ( $result5 == FALSE )		// en cas d'erreur 5
				{
					echo "Erreur d'exécution de la requete 5" ;
					die();
				}
				$_SESSION['nbreCoup']++;		// on incrémente le nombre de coup car un déplacement a eu lieu
			}
		}
		if($boutoncam == '∨')		// s'il va vers le bas
		{
			if(!($ord + 3 > 5) && $niv3[$ord + 3][$abs]=='W')		// si la case en-dessous n'est pas en dehors du parking et si elle est libre
			{
				if($abs - 1 >= 0)		// si la case de la ligne à gauche n'est pas en dehors du parking
				{
					if($niv3[$ord + 3][$abs - 1] != 'W')		// s'il y a un véhicule sur la case à gauche
					{
						$cambas1 = explode('.',$niv3[$ord + 3][$abs - 1]);
						if($cambas1[1]=='U' || $cambas1[1]=='D')		// si ce véhicule est vertical
						{
							$var = 1;		// le déplacement est envisageable
						}
						else		// s'il est horizontal
						{
							$var = 0;		// le camion restera bloqué
						}
					}
					else		// s'il n'y a pas de véhicule sur la case à gauche
					{
						$var = 1;		// le déplacement est envisageable
					}
					if($abs - 2 >= 0)		// si la case de la ligne encore à gauche n'est pas en dehors du parking
					{
						if($niv3[$ord + 3][$abs - 2] != 'W')		// s'il y a un véhicule sur cette case
						{
							$cambas2 = explode('.',$niv3[$ord + 3][$abs - 2]);
							if($cambas2[0] == 'O' || $cambas2[0] == 'P' || $cambas2[0] == 'Q' || $cambas2[0] == 'R')		// si c'est un camion
							{
								if($cambas2[1] == 'R' || $cambas2[1] == 'L')		// si ce camion est horizontal
								{
									$var = 0;		// le camion restera bloqué
								}
							}
						}
					}
				}
				else		// si la case de la ligne à gauche est en dehors du parking
				{
					$var = 1;		// le déplacement est envisageable
				}	
			}
			else		// si la case en dessous est en dehors du parking ou si elle n'est pas libre
			{
				$var = 0;		// le camion restera bloqué
			}	
			if($var == 1)		// si le déplacement est envisageable alors on l'exécute
			{
//_________________________________________REQUETE POUR MODIFIER LA LIGNE DU CAMION QUI VA VERS LE BAS__________________________________________

				$requete5 = "UPDATE niveau_en_cours SET coord_ligne = coord_ligne + 1 WHERE lettre_vehicule ='".$vehi."'";
				$result5 = mysqli_query($link,$requete5);
				if ( $result5 == FALSE )		// en cas d'erreur 5
				{
					echo "Erreur d'exécution de la requete 5" ;
					die();
				}
				$_SESSION['nbreCoup']++;		// on incrémente le nombre de coup car un déplacement a été réalisé
			}
		}
		if($boutoncam == '>')		// s'il va vers la droite
		{
			if(!($abs + 3 > 5) && $niv3[$ord][$abs+3]=='W')		// si la case à côté n'est pas en dehors du parking et si elle est libre
			{
				if($ord - 1 >= 0)		// si la case de la ligne au-dessus n'est pas en dehors du parking
				{
					if($niv3[$ord - 1][$abs + 3] != 'W')		// s'il y a un véhicule sur la case au-dessus
					{
						$camdroite1 = explode('.',$niv3[$ord -1][$abs + 3]);
						if($camdroite1[1]=='R' || $camdroite1[1]=='L')		// si ce véhicule est horizontal
						{
							$var = 1;		// le déplacement est envisageable
						}
						else		// si il est vertical
						{
							$var = 0;		// le camion restera bloqué
						}
					}
					else		// s'il n'y a pas de véhicule sur la case au-dessus
					{
						$var = 1;		// le déplacement est envisageable
					}
					if($ord - 2 >= 0)		// si la case de la ligne encore au-dessus n'est pas en dehors du parking
					{
						if($niv3[$ord - 2][$abs + 3] != 'W')		// s'il y a un véhicule sur cette case
						{
							$camdroite2 = explode('.',$niv3[$ord -2][$abs + 3]);
							if($camdroite2[0] == 'O' || $camdroite2[0] == 'P' || $camdroite2[0] == 'Q' || $camdroite2[0] == 'R') // si c'est un camion
							{
								if($camdroite2[1] == 'U' || $camdroite2[1] == 'D')		// si ce camion est vertical
								{
									$var = 0;		// le camion restera bloqué
								}
							}
						}
					}
				}
				else		// si la case de la ligne au-desu=sus est en dehors du parking
				{
					$var = 1;		// le déplacement est envisageable
				}	
			}
			else		// si la case à côté est en dehors du parking ou si elle n'est pas libre
			{
				$var = 0;		// le camion restera bloqué
			}						
			if($var == 1)		// si le déplacement est envisageable alors on l'exécute
			{
//_________________________________________REQUETE POUR MODIFIER LA COLONNE DU CAMION QUI VA VERS LA DROITE__________________________________________

				$requete5 = "UPDATE niveau_en_cours SET coord_colonne = coord_colonne + 1 WHERE lettre_vehicule ='".$vehi."'";
				$result5 = mysqli_query($link,$requete5);
				if ( $result5 == FALSE )		// en cas d'erreur 5
				{
					echo "Erreur d'exécution de la requete 5" ;
					die();
				}
				$_SESSION['nbreCoup']++;		// on incrémente le nombre de coups car le camion a été déplacé
			}
		}
		if($boutoncam == '<')		// s'il va vers la gauche
		{
			if(!($abs - 1 < 0) && $niv3[$ord][$abs-1]=='W')		// si la case à côté n'est pas en dehors du parking et si elle est libre
			{
				if($abs - 2 >= 0)		// si la case encore à côté n'est pas en dehors du parking
				{
					if($niv3[$ord][$abs - 2] != 'W')		// s'il y a un véhicule
					{
						$camgauche2 = explode('.',$niv3[$ord][$abs - 2]);
						if($camgauche2[1] == 'U' || $camgauche2[1] == 'D')		// s'il est vertical
						{
							$var = 1;		// le déplacement est envisageable
						}									
						else		// s'il est horizontable
						{
							$var = 0;		// le camion restera bloqué
						}
					}
				}
				if($abs - 3 >= 0)		// si la case encore encore à côté n'est pas en dehors du parking
				{
					if($niv3[$ord][$abs - 3] != 'W')		// s'il y a un véhicule
					{
						$camgauche3 = explode('.',$niv3[$ord][$abs -3]);
						if($camgauche3[0] == 'O' || $camgauche3[0] == 'P' || $camgauche3[0] == 'Q' || $camgauche3[0] == 'R')	// si c'est un camion
						{
							if($camgauche3[1] == 'R' || $camgauche3[1] == 'L')		// si ce camion est horizontal
							{
								$var = 0;		// le camion restera bloqué
							}
						}
					}
				}
				if($ord - 1 >= 0)		// si la case de la ligne au-dessus n'est pas en dehors du parking
				{
					if($niv3[$ord - 1][$abs - 1] != 'W')		// s'il y a un véhicule sur la case au-dessus
					{
						$camgauche1 = explode('.',$niv3[$ord -1][$abs - 1]);
						if($camgauche1[1]=='R' || $camgauche1[1]=='L')		// si ce véhicule est horizontal
						{
							if(!isset($var))
							{
								$var = 1;		// le déplacement est envisageable
							}
						}
						else		// s'il est vertical
						{
							$var = 0;		// le camion restera bloqué
						}
					}
					else		// s'il n'y a pas de véhicule sur la case au-dessus
					{
						if(!isset($var))
						{
							$var = 1;		// le déplacement est envisageable
						}
					}
					if($ord - 2 >= 0)		// si la case de la ligne encore au-dessus n'est pas en dehors du parking
					{
						if($niv3[$ord - 2][$abs - 1] != 'W')		// s'il y a un véhicule sur cette case
						{
							$camgauche4 = explode('.',$niv3[$ord -2][$abs - 1]);
							if($camgauche4[0] == 'O' || $camgauche4[0] == 'P' || $camgauche4[0] == 'Q' || $camgauche4[0] == 'R') // si c'est un camion
							{
								if($camgauche4[1] == 'U' || $camgauche4[1] == 'D')		// si ce camion est vertical
								{
									$var = 0;		// le camion restera bloqué
								}
							}
						}
					}
				}
				else		//  si la case de la ligne au-dessus est en dehors du parking
				{
					if(!isset($var))
					{
						$var = 1; 		// le déplacement est envisageable
					}
				}	
			}
			else		// si la case à côté en dehors du parking ou si elle n'est pas libre
			{
				$var = 0;		// le camion restera bloqué
			}				
			if($var == 1)		// si le déplacement est envisageable alors on l'exécute
			{
//_________________________________________REQUETE POUR MODIFIER LA COLONNE DU CAMION QUI VA VERS LA DROITE__________________________________________

				$requete5 = "UPDATE niveau_en_cours SET coord_colonne = coord_colonne - 1 WHERE lettre_vehicule ='".$vehi."'";
				$result5 = mysqli_query($link,$requete5);
				if ( $result5 == FALSE )		// en cas d'erreur 5
				{
					echo "Erreur d'exécution de la requete 5" ;
					die();
				}
				$_SESSION['nbreCoup']++;		// on incrémente le nombre de coup car le camion a avancé
			}
		}
//_____________________________AJOUT D'UN BRUIT DE KLAXON SI LE CAMION ESSAYE D'AVANCER ALORS QU'IL NE PEUT PAS__________________________________
		if($var == 0)
		{
			if(isset($_SESSION['sound']))
			{
				if($_SESSION['sound']=='on')
				{
					?>
					<script type="text/javascript">
						var num = Math.floor(Math.random() * 4) + 1;  // Nombre aléatoire entre 1 et 3
						if (num == 1)		// Si 1, alors il y a un bruit de klaxon
						{
							var audio = new Audio('son/truck-horn1.mp3');
							audio.play();
						}
						if (num == 2)		// Si 2, alors il y aura un autre bruit de klaxon
						{
							var audio = new Audio('son/truck-horn2.mp3');
							audio.play();
						}
						if (num == 3)
						{
							var audio = new Audio('son/truck-horn3.mp3');
							audio.play();
						}
						if (num == 4)
						{
							var audio = new Audio('son/truck-horn4.mp3');
							audio.play();
						}
					</script>
					<?php
				}
			}
		}
	}
?>