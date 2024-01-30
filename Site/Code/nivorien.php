<?php include('play.php'); ?>
<!DOCTYPE html>
<html lang="fr">
 
<head>
</head>
 
<body>
	<?php 
			// permet d'avoir le cadre esthétique de la page + la connexion + les requêtes
	echo "<form method='post' style='position: absolute;top: 68%;left: 17%;' action='nivorien.php#ici'>";
//______________________________________________AFFICHAGE DES VEHICULES DANS LE PARKING_______________________________________________
	
		for($i=0;$i<6;$i++)
		{
			for($j=0;$j<6;$j++)
			{
				if($niv2[$i][$j] != 'WW')		// on parcours le tableau rempli des véhicules
				{
					$caracteristique = explode('.',$niv2[$i][$j]);		// séparer la lettre du véhicule de l'orientation
					$pos = explode('.',$position[$i][$j]);		// séparer la ligne de la colonne
					if( $caracteristique[0] == 'O' || $caracteristique[0] == 'P' || $caracteristique[0] == 'Q' || $caracteristique[0] == 'R' )
					{		// si c'est un camion
						if( $caracteristique[1] == 'U' || $caracteristique[1] == 'D' )		// s'il est à la vertical
						{
							if(!isset($_POST['vehicule']))		// si actuellement aucun véhicule n'est sélectionné
							{		// création de bouton pour pouvoir le sélectionner
								echo "<button type='submit' name='vehicule' id='".$caracteristique[0]."' value=$caracteristique[0] class='cvertical image' style='padding: 0; position: absolute; top: $pos[0]px; left: $pos[1]px;'><img class='cvertical image' src='image/".$niv2[$i][$j].".png'></button>";
							}
							else		// sinon affichage d'image pour ne plus pouvoir le sélectionner
							{
								echo "<img class='cvertical image' style='position: absolute; top: $pos[0]px; left: $pos[1]px;' src='image/".$niv2[$i][$j].".png'>";
							}
						}
						else		// s'il est à l'horizontale
						{
							if(!isset($_POST['vehicule']))		// si actuellement aucun véhicule n'est sélectionné
							{		// création de bouton pour pouvoir le sélectionner
								echo "<button type='submit' name='vehicule' id='".$caracteristique[0]."' value=$caracteristique[0] class='chorizontal image' style='padding: 0; position: absolute; top: $pos[0]px; left: $pos[1]px;'><img class='chorizontal image' src='image/".$niv2[$i][$j].".png'></button>";
							}
							else		// sinon affichage d'image pour ne plus pouvoir le sélectionner
							{
								echo "<img class='chorizontal image' style='position: absolute; top: $pos[0]px; left: $pos[1]px;' src='image/".$niv2[$i][$j].".png'>";
							}
						}
					}
					else		// si c'est une voiture
					{
						if( $caracteristique[1] == 'U' || $caracteristique[1] == 'D' )		// à la verticale
						{
							if(!isset($_POST['vehicule']))		// si actuellement aucun véhicule n'est sélectionné
							{		// création de bouton pour pouvoir le sélectionner
								echo "<button type='submit' name='vehicule' id='".$caracteristique[0]."' value=$caracteristique[0] class='vvertical image' style='padding: 0; position: absolute; top: $pos[0]px; left: $pos[1]px;'><img class='vvertical image' src='image/".$niv2[$i][$j].".png'></button>";
							}
							else		// sinon affichage d'image pour ne plus pouvoir le sélectionner
							{
								echo "<img class='vvertical image' style='position: absolute; top: $pos[0]px; left: $pos[1]px;' src='image/".$niv2[$i][$j].".png'>";
							}
						}
						else		// à l'horizontale
						{
							if(!isset($_POST['vehicule']))		// si actuellement aucun véhicule n'est sélectionné
							{		// création de bouton pour pouvoir le sélectionner
								if($caracteristique[0] == 'X')
								{
									if(isset($_SESSION['pseudo']))
									{
										$requete = "SELECT voitureRouge FROM joueurs WHERE pseudo = '".$_SESSION['pseudo']."'";
										$result = mysqli_query($link,$requete);
										if ( $result == FALSE )		// en cas d'erreur
										{
											echo "Erreur d'exécution de la requete" ;
											die();
										}
										$row = mysqli_fetch_assoc($result);
										$debloc = $row['voitureRouge'];
										echo "<button type='submit' name='vehicule' id='".$caracteristique[0]."' value=$caracteristique[0] class='vhorizontal image' style='padding: 0; position: absolute; top: $pos[0]px; left: $pos[1]px;'><img class='vhorizontal image' src='image/".$debloc.".png'></button>";
									}
									else
									{
										echo "<button type='submit' name='vehicule' id='".$caracteristique[0]."' value=$caracteristique[0] class='vhorizontal image' style='padding: 0; position: absolute; top: $pos[0]px; left: $pos[1]px;'><img class='vhorizontal image' src='image/1X.L.png'></button>";
									}
								}
								else
								{
									echo "<button type='submit' name='vehicule' id='".$caracteristique[0]."' value=$caracteristique[0] class='vhorizontal image' style='padding: 0; position: absolute; top: $pos[0]px; left: $pos[1]px;'><img class='vhorizontal image' src='image/".$niv2[$i][$j].".png'></button>";
								}
							}
							else		// sinon affichage d'image pour ne plus pouvoir le sélectionner
							{
								if($caracteristique[0] == 'X')
								{
									if(isset($_SESSION['pseudo']))
									{
										$requete = "SELECT voitureRouge FROM joueurs WHERE pseudo = '".$_SESSION['pseudo']."'";
										$result = mysqli_query($link,$requete);
										if ( $result == FALSE )		// en cas d'erreur
										{
											echo "Erreur d'exécution de la requete" ;
											die();
										}
										$row = mysqli_fetch_assoc($result);
										$debloc = $row['voitureRouge'];
										echo "<img class='vhorizontal image' style='position: absolute; top: $pos[0]px; left: $pos[1]px;' src='image/".$debloc.".png'>";
									}
									else
									{
										echo "<img class='vhorizontal image' style='position: absolute; top: $pos[0]px; left: $pos[1]px;' src='image/1X.L.png'>";
									}
								}
								else
								{
									echo "<img class='vhorizontal image' style='position: absolute; top: $pos[0]px; left: $pos[1]px;' src='image/".$niv2[$i][$j].".png'>";
								}
							}
						}
					}
				}
			}
		}
	echo "</form>";	
//___________________________________________AFFICHAGE DE 2 BOUTONS SUR LE VEHICULE SELECTIONNE__________________________________________________

	if(isset($_POST['vehicule']))		// si un véhicule est sélectionné
	{
		if($_POST['vehicule'] == 'E')
		{
			if(isset($_SESSION['sound']))
			{
				if($_SESSION['sound']=='on')
				{
				echo "<audio title='barbie girl' autoplay><source src='son/barbie-girl.mp3' type='audio/mp3'></audio>"; // son
				}
			}
		}
		if($_POST['vehicule'] == 'A')
		{
			if(isset($_SESSION['sound']))
			{
				if($_SESSION['sound']=='on')
				{
					echo "<audio title='police car sound' autoplay><source src='son/police-car-sound.mp3' type='audio/mp3'></audio>"; // son
				}
			}
		}
		echo "<form method='post' action='nivorien.php#ici'>";
//__________________________________REQUETE POUR OBTENIR LES INFORMATIONS DU NIVEAU EN COURS_____________________________________________		
		
			$requete3 = "SELECT lettre_vehicule, coord_ligne, coord_colonne, orientation FROM niveau_en_cours";
			$result3 = mysqli_query($link,$requete3);
			if ( $result3 == FALSE )		// en cas d'erreur 3
			{
				echo "Erreur d'exécution de la requete 3" ;
				die();
			}
			while($row3 = mysqli_fetch_assoc($result3))		// récupération des résultats de la requête
			{
				if($_SESSION['vehi'] == $row3['lettre_vehicule'])		// si le véhicule de la requête est celui sélectionné
				{
					$li = $row3['coord_ligne']*61;
					$col = $row3['coord_colonne']*60;
					$ori = $row3['orientation'];
					if( $_SESSION['vehi'] == 'O' || $_SESSION['vehi'] == 'P' || $_SESSION['vehi'] == 'Q' || $_SESSION['vehi'] == 'R' )
					{		// si c'est un camion
						if($ori == 'U')		// vers le haut (tete en bas)
						{
							$pos1 = 0; $pos1 = $li+330;		// variable pour le placement précis des boutons au milieu du camion
							$pos2 = 0; $pos2 = $li+380;
							$pos3 = 0; $pos3 = $col+225;
							// bouton vers le haut ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowUp' name='boutoncamion' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos3."px;' value='∧'>";
							// bouton vers le bas ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowDown' name='boutoncamion' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos2."px; left:".$pos3."px;' value='∨'>";
						}
						if($ori == 'D')		// vers le bas (tete en haut)
						{
							$pos1 = 0; $pos1 = $li+460;		// variable pour le placement précis des boutons au milieu du camion
							$pos2 = 0; $pos2 = $li+510;
							$pos3 = 0; $pos3 = $col+225;
							// bouton vers le haut ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowUp' name='boutoncamion' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos3."px;' value='∧'>";
							// bouton vers le bas ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowDown' name='boutoncamion' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos2."px; left:".$pos3."px;' value='∨'>";
						}
						if($ori == 'L')		// vers la gauche (tete à droite)
						{
							$pos1 = 0; $pos1 = $li+420;		// variable pour le placement précis des boutons au milieu du camion
							$pos2 = 0; $pos2 = $col+140;
							$pos3 = 0; $pos3 = $col+190;
							// bouton vers la gauche ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowLeft' name='boutoncamion' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos2."px;' value='<' accesskey='q'>";
							// bouton vers la droite ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowRight' name='boutoncamion' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos3."px;' value='>'>";
						}
						if($ori == 'R')		// vers la droite (tete à gauche)
						{
							$pos1 = 0; $pos1 = $li+420;		// variable pour le placement précis des boutons au milieu du camion
							$pos2 = 0; $pos2 = $col+260;
							$pos3 = 0; $pos3 = $col+310;
							// bouton vers la gauche ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowLeft' name='boutoncamion' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos2."px;' value='<'>";
							// bouton vers la droite ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowRight' name='boutoncamion' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos3."px;' value='>'>";
						}
					}
					else		// si c'est une voiture
					{
						if($ori == 'U')		// vers le haut
						{
							$pos1 = 0; $pos1 = $li+370;		// variable pour le placement précis des boutons au milieu de la voiture
							$pos2 = 0; $pos2 = $li+410;
							$pos3 = 0; $pos3 = $col+225;
							// bouton vers le haut ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowUp' name='boutonvoiture' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos3."px;' value='∧'>";
							// bouton vers le bas ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowDown' name='boutonvoiture' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos2."px; left:".$pos3."px;' value='∨'>";
						}
						if($ori == 'D')		// vers le bas
						{
							$pos1 = 0; $pos1 = $li+429;		// variable pour le placement précis des boutons au milieu de la voiture
							$pos2 = 0; $pos2 = $li+469;
							$pos3 = 0; $pos3 = $col+225;
							// bouton vers le haut ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowUp' name='boutonvoiture' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos3."px;' value='∧'>";
							// bouton vers le bas ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowDown' name='boutonvoiture' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos2."px; left:".$pos3."px;' value='∨'>";
						}
						if($ori == 'L')		// vers la gauche
						{
							$pos1 = 0; $pos1 = $li+420;		// variable pour le placement précis des boutons au milieu de la voiture
							$pos2 = 0; $pos2 = $col+175;
							$pos3 = 0; $pos3 = $col+215;
							// bouton vers la gauche ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowLeft' name='boutonvoiture' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos2."px;' value='<'>";
							// bouton vers la droite ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowRight' name='boutonvoiture' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos3."px;' value='>'>";
						}
						if($ori == 'R')		// vers la droite
						{
							$pos1 = 0; $pos1 = $li+420;		// variable pour le placement précis des boutons au milieu de la voiture
							$pos2 = 0; $pos2 = $col+235;
							$pos3 = 0; $pos3 = $col+275;
							// bouton vers la gauche ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowLeft' name='boutonvoiture' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos2."px;' value='<'>";
							// bouton vers la droite ou accessible avec la flèche du clavier correspondante
							echo "<input type='submit' id='ArrowRight' name='boutonvoiture' class='text' style='padding: 3px 10px 7px 10px;border: none;border-radius: 10px;position: absolute; top: ".$pos1."px; left:".$pos3."px;' value='>'>";
						}
					}
				}
			}
		echo "</form>";
	}		
	?>
	
 <!-- _______________________________________________ LIEN AVEC LE CLAVIER ET LE FORMULAIRE___________________________________________________ -->

    <script type="text/javascript">
        // se charge de simuler un clic sur le bon bouton submit en fonction de la bonne touche du clavier
        let body = document.body;

        body.addEventListener('keydown', (e) => {		// si on appuie sur une touche

            if (!e.repeat) 		// et seulelement si on vient d'appuyer dessus
			{
                // formule magique pour tromper le navigateur et lui faire croire que quelqu'un a cliqué sur un bouton
                let evt = document.createEvent("MouseEvents");
                evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
                if (e.key === 'ArrowUp' || e.key === 'ArrowLeft' || e.key === 'ArrowDown' || e.key === 'ArrowRight' || e.key === 'A' || e.key === 'B' || e.key === 'C' || e.key === 'D' || e.key === 'E' || e.key === 'F' || e.key === 'G' || e.key === 'H' || e.key === 'I' || e.key === 'J' || e.key === 'K' || e.key === 'O' || e.key === 'P' || e.key === 'Q' || e.key === 'R' || e.key === 'X')
				{		// si une des touches préssées nous intéresse

                    document.getElementById(e.key).dispatchEvent(evt);
					// simulation du clic sur le bouton ayant un id correspondant à la touche préssée
                }
            }
        });
    </script>
	
</body>
</html>