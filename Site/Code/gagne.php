<!DOCTYPE html>
<html lang="fr"> 
<head>
	<title>Play</title>
	<meta name="viewport" content="wicth-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="profile.css">
</head>

<body>
	<?php
		include('entete.php');		// permet d'avoir la connexion au serveur et le menu du haut de page
		if(isset($_SESSION['sound']))
		{
			if($_SESSION['sound']=='on')
			{
				echo "<audio title='What You Know' autoplay><source src='son/what-you-know.mp3' type='audio/mp3'></audio>"; // son
			}
		}
	?>
	<div class="wrapper">	
		<div class="confetti"></div><div class="confetti"></div><div class="confetti"></div><div class="confetti"></div><div class="confetti"></div><div class="confetti"></div><div class="confetti"></div><div class="confetti"></div><div class="confetti"></div><div class="confetti"></div>
		<div class="confetti2"></div><div class="confetti2"></div><div class="confetti2"></div><div class="confetti2"></div><div class="confetti2"></div><div class="confetti2"></div><div class="confetti2"></div><div class="confetti2"></div><div class="confetti2"></div><div class="confetti2"></div>
		<div class="confetti3"></div><div class="confetti3"></div><div class="confetti3"></div><div class="confetti3"></div><div class="confetti3"></div><div class="confetti3"></div><div class="confetti3"></div><div class="confetti3"></div><div class="confetti3"></div><div class="confetti3"></div>
	</div>
	<div class='welcome2'>		<!-- fond dégradé -->
		<div class='square'>
			<ul>
				<li></li><li></li><li></li><li></li><li></li>		<!-- carrés qui tournent et s'agradissent -->
			</ul>
		</div>
		<div class='circle'>
			<ul>
				<li></li><li></li><li></li><li></li><li></li>		<!-- cercle qui s'élèvent et s'agrandissent -->
			</ul>
		</div>
	</div>
	<?php
//_____________________________________________________PAGE QUI S'AFFICHE SI LE JOUEUR GAGNE_______________________________________________

		$nivo = $_SESSION['numero'];		// variable pour le numéro de niveau
		if(isset($_SESSION['pseudo'])) { $pseudo = $_SESSION['pseudo']; }		// si on est connecté on retient le pseydo
		else { $pseudo = 'Unknown'; }		// si on n'est pas connecté on est Inconnu
		
		if($pseudo != 'Unknown')		// si on n'est pas Inconnu
		{
//______________________________REQUETE POUR SELECTIONNER LE NOMBRE DE COUP SI LE JOUEUR A DEJA JOUE AVANT LE MEME NIVEAU____________________________

			$requete6 = "SELECT nbreCoup FROM classement WHERE nomJoueur = '".$pseudo."' AND idNiveau = $nivo";
			$result6 = mysqli_query($link,$requete6);
			if ( $result6 == FALSE )		// en cas d'erreur 6
			{
				echo "Erreur d'exécution de la requete 6" ;
				die();
			}
			
			if(mysqli_num_rows($result6) == 0)		// si aucune ligne n'a été sélectionnée : le joueur jouait pour la 1e fois ce niveau
			{
				$new = 1;		// si le joueur est premier alors on écrira 'New Record'
//______________________________REQUETE POUR SELECTIONNER LES INFORMATIONS DES AUTRES JOUEURS AYANT DEJA FAIT LE NIVEAU_____________________________

				$requete2 = "SELECT placeJoueur, nomJoueur, nbreCoup FROM classement WHERE idNiveau = $nivo ORDER BY placeJoueur";
				$result2 = mysqli_query($link,$requete2);
				if ( $result2 == FALSE )		// en cas d'erreur 2
				{
					echo "Erreur d'exécution de la requete 2" ;
					die();
				}
				$tempo = 10;		// variable temporaire de la place du joueur
				if(mysqli_num_rows($result2) == 0) $tempo = 1;		// s'il n'y a aucun autre joueur alors il sera 1e
				while($row2 = mysqli_fetch_assoc($result2))
				{
					if($_SESSION['nbreCoup'] == $row2['nbreCoup'])
					{
						$egalite = 1;		// si un autre joueur a le même nombre de coups que lui alors il y aura une égalité
					}
					if($_SESSION['nbreCoup'] <= $row2['nbreCoup'])		// si le joueur a fait moins de coups que d'autre(s)
					{
						if($tempo >= $row2['placeJoueur'])		// et si la place temporaire est supérieure à ce(s) joueur(s)
						{
							$tempo = $row2['placeJoueur'];		// alors on décale la place temporaire
						}
					}
					else
					{
						$tempo = mysqli_num_rows($result2) +1;
					}
				}				
				$coup = $_SESSION['nbreCoup'];
				
//______________________________________REQUETE POUR DONNER LE NOMBRE D'ETOILE EN FONCTION DU NOMBRE DE COUPS________________________________________

				$requete30000 = "SELECT Minimum FROM jeu WHERE ref = $nivo";
				$result30000 = mysqli_query($link,$requete30000);
				if ( $result30000 == FALSE )		// en cas d'erreur 30000
				{
					echo "Erreur d'exécution de la requete 30000" ;
					die();
				}
				$row30000 = mysqli_fetch_assoc($result30000);
				if($coup < $row30000['Minimum']+10) { $star = 3; }
				if($coup >= $row30000['Minimum']+10 && $coup < $row30000['Minimum']+20) { $star = 2; }
				if($coup >= $row30000['Minimum']+20 && $coup < $row30000['Minimum']+30) { $star = 1; }
				if($coup >= $row30000['Minimum']+30) { $star = 0; }

				if($tempo != 10)		// si la variable temporaire a changé alors le joueur entre dans le classement
				{
					$requete40 = "SELECT placeJoueur FROM classement WHERE idNiveau=$nivo ORDER BY placeJoueur";
					$result40 = mysqli_query($link,$requete40);
					if ( $result40 == FALSE )		// en cas d'erreur 40
					{
						echo "Erreur d'exécution de la requete 40" ;
						die();
					}
					$tmp=0;
					while($row40 = mysqli_fetch_assoc($result40))
					{
						if($row40['placeJoueur']==$tmp) $oldegalite = $tmp;
						$tmp = $row40['placeJoueur'];
					}
					if(isset($oldegalite))
					{
						if($oldegalite >= $tempo)
						{
//______________________________________________REQUETE POUR INSERER LE JOUEUR DANS LE TOP 5 DU NIVEAU_________________________________________

							$requete3 = "INSERT INTO classement(idNiveau, placeJoueur, nomJoueur, nbreCoup, nbreEtoile) VALUES ($nivo,$tempo,'".$pseudo."',$coup,$star)";
							$result3 = mysqli_query($link,$requete3);
							if ( $result3 == FALSE )		// en cas d'erreur 3
							{
								echo "Erreur d'exécution de la requete 3" ;
								die();
							}
							if(isset($egalite))		// s'il y a une égalité alors on modifie la place des joueurs qui ne font pas parti de l'égalité
							{
								for($i=5; $i>$tempo; $i--)
								{
//______________________________REQUETE POUR MODIFIER LA PLACE DES JOUEURS QUI NE FONT PAS PARTIS DE L'EGALITE_________________________________
		
									$requete4 = "UPDATE classement SET placeJoueur = placeJoueur +1 WHERE placeJoueur = $i AND nomJoueur != '".$pseudo."' AND idNiveau = $nivo";
									$result4 = mysqli_query($link,$requete4);
									if ( $result4 == FALSE )		// en cas d'erreur 4
									{
										echo "Erreur d'exécution de la requete 4" ;
										die();
									}
								}
							}
							else		// s'il n'y a pas d'égaité alors on modifie la place de tous les joueurs qui ont plus de coups joués
							{
								for($i=5; $i>=$tempo; $i--)
								{
//______________________________REQUETE POUR MODIFIER LA PLACE DES JOUEURS QUI ONT FAIT PLUS DE COUPS QUE LE JOUEUR_____________________________
		
									$requete4 = "UPDATE classement SET placeJoueur = placeJoueur +1 WHERE placeJoueur = $i AND nomJoueur != '".$pseudo."' AND idNiveau=$nivo";
									$result4 = mysqli_query($link,$requete4);
									if ( $result4 == FALSE )		// en cas d'erreur 4
									{
										echo "Erreur d'exécution de la requete 4" ;
										die();
									}
								}
							}
						}
						if($oldegalite < $tempo)
						{
//______________________________________________REQUETE POUR INSERER LE JOUEUR DANS LE TOP 5 DU NIVEAU_________________________________________

							$requete3 = "INSERT INTO classement(idNiveau, placeJoueur, nomJoueur, nbreCoup, nbreEtoile) VALUES ($nivo,$tempo,'".$pseudo."',$coup,$star)";
							$result3 = mysqli_query($link,$requete3);
							if ( $result3 == FALSE )		// en cas d'erreur 3
							{
								echo "Erreur d'exécution de la requete 3" ;
								die();
							}
						}
					}
					else
					{
//______________________________________________REQUETE POUR INSERER LE JOUEUR DANS LE TOP 5 DU NIVEAU_________________________________________

						$requete3 = "INSERT INTO classement(idNiveau, placeJoueur, nomJoueur, nbreCoup, nbreEtoile) VALUES ($nivo,$tempo,'".$pseudo."',$coup,$star)";
						$result3 = mysqli_query($link,$requete3);
						if ( $result3 == FALSE )		// en cas d'erreur 3
						{
							echo "Erreur d'exécution de la requete 3" ;
							die();
						}
						if(isset($egalite))		// s'il y a une égalité alors on modifie la place des joueurs qui ne font pas parti de l'égalité
						{
							for($i=5; $i>$tempo; $i--)
							{
//__________________	____________REQUETE POUR MODIFIER LA PLACE DES JOUEURS QUI NE FONT PAS PARTIS DE L'EGALITE_________________________________
	
								$requete4 = "UPDATE classement SET placeJoueur = placeJoueur +1 WHERE placeJoueur = $i AND nomJoueur != '".$pseudo."' AND idNiveau = $nivo";
								$result4 = mysqli_query($link,$requete4);
								if ( $result4 == FALSE )		// en cas d'erreur 4
								{
									echo "Erreur d'exécution de la requete 4" ;
									die();
								}
							}
						}
						else		// s'il n'y a pas d'égaité alors on modifie la place de tous les joueurs qui ont plus de coups joués
						{
							for($i=5; $i>=$tempo; $i--)
							{
//__________________	____________REQUETE POUR MODIFIER LA PLACE DES JOUEURS QUI ONT FAIT PLUS DE COUPS QUE LE JOUEUR_____________________________
	
								$requete4 = "UPDATE classement SET placeJoueur = placeJoueur +1 WHERE placeJoueur = $i AND nomJoueur != '".$pseudo."' AND idNiveau=$nivo";
								$result4 = mysqli_query($link,$requete4);
								if ( $result4 == FALSE )		// en cas d'erreur 4
								{
									echo "Erreur d'exécution de la requete 4" ;
									die();
								}
							}
						}
					}
//____________________________________________REQUETE POUR SUPPRIMER LE(S) JOUEUR(S) QUI QUITTENT LE TOP 5________________________________________

					$requete5 = "DELETE FROM classement WHERE idNiveau=$nivo AND placeJoueur > 5";
					$result5 = mysqli_query($link,$requete5);
					if ( $result5 == FALSE )		// en cas d'erreur 5
					{
						echo "Erreur d'exécution de la requete 5" ;
						die();
					}
				}
			}
			else		// si le joueur avait déjà fini ce niveau avant et qu'il était dans le TOP 5
			{
				$row6 = mysqli_fetch_assoc($result6);
				if($_SESSION['nbreCoup'] < $row6['nbreCoup'])		// s'il a fait un meilleur score
				{
//_________________________________________________REQUETE POUR SELECTIONNER LES AUTRES JOUEURS DU TOP 5_______________________________________

					$requete2 = "SELECT placeJoueur, nomJoueur, nbreCoup FROM classement WHERE idNiveau = $nivo ORDER BY placeJoueur";
					$result2 = mysqli_query($link,$requete2);
					if ( $result2 == FALSE )		// en cas d'erreur 2
					{
						echo "Erreur d'exécution de la requete 2" ;
						die();
					}
					
					$tempo = 10;		// variable de la place temporaire du joueur
					if(mysqli_num_rows($result2) == 0) $tempo = 1;		// s'il n'y a pas d'autres joueurs alors il sera premier
					while($row2 = mysqli_fetch_assoc($result2))		// s'il y a des autres joueurs
					{
						if($_SESSION['nbreCoup'] == $row2['nbreCoup'])		// si quelqu'un a le même nombre de coup que le joueur
						{
							$egalite = 1;		// alors il y a égalité
						}
						if($_SESSION['nbreCoup'] <= $row2['nbreCoup'])		// si le joueur a un nombre de coups inférieur de quelqu'un
						{
							if($tempo >= $row2['placeJoueur'])		// et si sa place temporaire est supérieure à l'autre
							{
								$tempo = $row2['placeJoueur'];		// alors on décale la place temporaire du joueur
							}
						}
					}
					$coup = $_SESSION['nbreCoup'];
//______________________________________REQUETE POUR DONNER LE NOMBRE D'ETOILE EN FONCTION DU NOMBRE DE COUPS________________________________________

					$requete30000 = "SELECT Minimum FROM jeu WHERE ref = $nivo";
					$result30000 = mysqli_query($link,$requete30000);
					if ( $result30000 == FALSE )		// en cas d'erreur 30000
					{
						echo "Erreur d'exécution de la requete 30000" ;
						die();
					}
					$row30000 = mysqli_fetch_assoc($result30000);
					if($coup < $row30000['Minimum']+10) { $star = 3; }
					if($coup >= $row30000['Minimum']+10 && $coup < $row30000['Minimum']+20) { $star = 2; }
					if($coup >= $row30000['Minimum']+20 && $coup < $row30000['Minimum']+30) { $star = 1; }
					if($coup >= $row30000['Minimum']+30) { $star = 0; }
					
					if($tempo != 10)		// si la place temporaire du joueur a été modifiée
					{
						$requete40 = "SELECT placeJoueur FROM classement WHERE idNiveau=$nivo ORDER BY placeJoueur";
						$result40 = mysqli_query($link,$requete40);
						if ( $result40 == FALSE )		// en cas d'erreur 40
						{
							echo "Erreur d'exécution de la requete 40" ;
							die();
						}
						$tmp=0;
						while($row40 = mysqli_fetch_assoc($result40))
						{
							if($row40['placeJoueur']==$tmp) $oldegalite = $tmp;
							$tmp = $row40['placeJoueur'];
						}
						if(isset($oldegalite))
						{
							if($oldegalite >= $tempo)
							{
//________________________________________REQUETE POUR MODIFIER LA PLACE, LE NOMBRE DE COUP ET D'ETOILE DU JOUEUR____________________________________
	
								$requete3 = "UPDATE classement SET placeJoueur = $tempo, nbreCoup = $coup, nbreEtoile = $star WHERE nomJoueur = '".$pseudo."' AND idNiveau=$nivo";
								$result3 = mysqli_query($link,$requete3);
								if ( $result3 == FALSE )		// en cas d'erreur 3
								{
									echo "Erreur d'exécution de la requete 3" ;
									die();
								}
								$new = 1;
								if(isset($egalite))		// s'il y a une égalité alors on modifie la place des joueurs qui ne font pas parti de l'égalité
								{
									for($i=5; $i>$tempo; $i--)
									{
//______________________________REQUETE POUR MODIFIER LA PLACE DES JOUEURS QUI NE FONT PAS PARTIS DE L'EGALITE_________________________________
			
										$requete4 = "UPDATE classement SET placeJoueur = placeJoueur +1 WHERE placeJoueur = $i AND nomJoueur != '".$pseudo."' AND idNiveau = $nivo";
										$result4 = mysqli_query($link,$requete4);
										if ( $result4 == FALSE )		// en cas d'erreur 4
										{
											echo "Erreur d'exécution de la requete 4" ;
											die();
										}
									}
								}
								else		// s'il n'y a pas d'égaité alors on modifie la place de tous les joueurs qui ont plus de coups joués
								{
									for($i=5; $i>=$tempo; $i--)
									{
//______________________________REQUETE POUR MODIFIER LA PLACE DES JOUEURS QUI ONT FAIT PLUS DE COUPS QUE LE JOUEUR_____________________________
			
										$requete4 = "UPDATE classement SET placeJoueur = placeJoueur +1 WHERE placeJoueur = $i AND nomJoueur != '".$pseudo."' AND idNiveau=$nivo";
										$result4 = mysqli_query($link,$requete4);
										if ( $result4 == FALSE )		// en cas d'erreur 4
										{
											echo "Erreur d'exécution de la requete 4" ;
											die();
										}
									}
								}
							}
							if($oldegalite < $tempo)
							{
//______________________________________________REQUETE POUR INSERER LE JOUEUR DANS LE TOP 5 DU NIVEAU_________________________________________
	
								$requete3 = "INSERT INTO classement(idNiveau, placeJoueur, nomJoueur, nbreCoup, nbreEtoile) VALUES ($nivo,$tempo,'".$pseudo."',$coup,$star)";
								$result3 = mysqli_query($link,$requete3);
								if ( $result3 == FALSE )		// en cas d'erreur 3
								{
									echo "Erreur d'exécution de la requete 3" ;
									die();
								}
							}
						}
						else
						{
//________________________________________REQUETE POUR MODIFIER LA PLACE, LE NOMBRE DE COUP ET D'ETOILE DU JOUEUR____________________________________
	
							$requete3 = "UPDATE classement SET placeJoueur = $tempo, nbreCoup = $coup, nbreEtoile = $star WHERE nomJoueur = '".$pseudo."' AND idNiveau=$nivo";
							$result3 = mysqli_query($link,$requete3);
							if ( $result3 == FALSE )		// en cas d'erreur 3
							{
								echo "Erreur d'exécution de la requete 3" ;
								die();
							}
							$new = 1;
							if(isset($egalite))		// s'il y a une égalité alors on modifie la place des joueurs qui ne font pas parti de l'égalité
							{
								for($i=5; $i>$tempo; $i--)
								{
//_____________________________REQUETE POUR MODIFIER LA PLACE DES JOUEURS QUI NE FONT PAS PARTIS DE L'EGALITE_________________________________
			
									$requete4 = "UPDATE classement SET placeJoueur = placeJoueur +1 WHERE placeJoueur = $i AND nomJoueur != '".$pseudo."' AND idNiveau = $nivo";
									$result4 = mysqli_query($link,$requete4);
									if ( $result4 == FALSE )		// en cas d'erreur 4
									{
										echo "Erreur d'exécution de la requete 4" ;
										die();
									}
								}
							}
							else		// s'il n'y a pas d'égaité alors on modifie la place de tous les joueurs qui ont plus de coups joués
							{
								for($i=5; $i>=$tempo; $i--)
								{
//_____________________________REQUETE POUR MODIFIER LA PLACE DES JOUEURS QUI ONT FAIT PLUS DE COUPS QUE LE JOUEUR_____________________________
			
									$requete4 = "UPDATE classement SET placeJoueur = placeJoueur +1 WHERE placeJoueur = $i AND nomJoueur != '".$pseudo."' AND idNiveau=$nivo";
									$result4 = mysqli_query($link,$requete4);
									if ( $result4 == FALSE )		// en cas d'erreur 4
									{
										echo "Erreur d'exécution de la requete 4" ;
										die();
									}
								}
							}
						}
//____________________________________________REQUETE POUR SUPPRIMER LE(S) JOUEUR(S) QUI QUITTENT LE TOP 5________________________________________
	
							$requete5 = "DELETE FROM classement WHERE idNiveau=$nivo AND placeJoueur > 5";
							$result5 = mysqli_query($link,$requete5);
							if ( $result5 == FALSE )		// en cas d'erreur 5
							{
								echo "Erreur d'exécution de la requete 5" ;
								die();
							}
					}
				}
			}
		}
//___________________________________________________________AFFICHAGE DU MESSAGE DE FELICITATION_______________________________________________

		echo "<div class='plouf' style='padding:30px 50px;'>";
			if(isset($_SESSION['pseudo']))		// s'il est connecté
			{
				echo "<div style='color: white;font-family: Georgia, serif;font-size: 300%;'>CONGRATULATIONS ".$_SESSION['pseudo']." !!</div><div style='color: white;font-family: Georgia, serif;font-size: 150%;'> You solved level ".$_SESSION['numero']." in ".$_SESSION['nbreCoup']." moves !!! <br></div>";
			}
			else		// s'il n'est pas connecté
			{
				echo "<div style='color: white;font-family: Georgia, serif;font-size: 350%;'>CONGRATULATIONS !!</div>
				<div style='color: white;font-family: Georgia, serif;font-size: 150%;'> You solved level ".$_SESSION['numero']." in ".$_SESSION['nbreCoup']." moves !!! <br></div>
				<div style='color: white;font-family: Georgia, serif;font-size: 120%;'>You will not be registered because you are not log in... If want to save your score in your name next time, sign up (or log in).<br></div>";
			}
//________________________________________REQUETE POUR CLASSER SELON LA PLACE LES JOUEURS DU TOP 5 DE CE NIVEAU___________________________________

			$requete = "SELECT placeJoueur, nomJoueur, nbreCoup, nbreEtoile FROM classement WHERE idNiveau = $nivo ORDER BY placeJoueur";
			$result = mysqli_query($link,$requete);
			if ( $result == FALSE )		// en cas d'erreur
			{
				echo "Erreur d'exécution de la requete" ;
				die();
			}
//__________________________________________________AFFICHAGE DU TOP 5 DU NIVEAU DANS UN TABLEAU______________________________________________

			echo "<div style='color: white;font-family: Georgia, serif;font-size: 120%;'>Here are the TOP 5 :</div>";
			echo "<table border='1' style='width:80%; margin-left:10%;margin-top:3%;color:white;font-family: Georgia, serif;'>";
			// 1e ligne du tableau
			echo "<tr style='background-color:white;color:#4E4E4E;font-size: 140%;'>
				<td  style='padding: 2% 3% 2%;'>Player's rank</td>
				<td  style='padding: 2% 2% 2%;'>Pseudo</td>
				<td  style='padding: 2% 5% 2%;'>Moves</td>
				<td ></td>
			</tr>";
			while($row = mysqli_fetch_assoc($result))		// résultat de la requête : différentes informations des joueurs du TOP 5
			{
				if(isset($new) && $new == 1)
				{
					if($row['placeJoueur'] == 1 && $row['nomJoueur'] == $pseudo) echo "<div style='background-color: #4E4E4E;position: absolute;right:12%;transform: rotate(14deg);color: #05A693;font-family: Georgia, serif;font-size: 200%;'>New Record !!</div>";
				}
				if($row['nomJoueur'] == $pseudo)		// si c'est la ligne du joueur alors l'afficher en turquoise
				{
					echo "<tr style='background-color:#05A693;color:white;'>";
						echo "<td style='padding-left: 5%';>" . $row["placeJoueur"] . "</td>" ;
						echo "<td style='padding-left: 5%';>" . $row["nomJoueur"] . "</td>" ;
						echo "<td style='padding-left: 5%';>" . $row["nbreCoup"] . "</td>" ;
						echo "<td style='padding-left: 5%';>";
							for($j=0; $j<$row["nbreEtoile"]; $j++)
							{
								echo"<img style='width:30px;height:30px;' src='image/star.png'>";		// affichage des étoiles
							}
							for($j=0; $j<(3-$row["nbreEtoile"]); $j++)
							{
								echo"<img style='width:30px;height:30px;' src='image/empty_star.png'>";		// affichage des étoiles vides
							}
						echo "</td>";
					echo "</tr>";
				}
				else		// sinon afficher normalement
				{
					echo "<tr>";
						echo "<td style='padding-left: 5%';>" . $row["placeJoueur"] . "</td>" ;
						echo "<td style='padding-left: 5%';>" . $row["nomJoueur"] . "</td>" ;
						echo "<td style='padding-left: 5%';>" . $row["nbreCoup"] . "</td>" ;
						echo "<td style='padding-left: 5%';>";
							for($j=0; $j<$row["nbreEtoile"]; $j++)
							{
								echo"<img style='width:30px;height:30px;' src='image/star.png'>";		// affichage des étoiles
							}
							for($j=0; $j<(3-$row["nbreEtoile"]); $j++)
							{
								echo"<img style='width:30px;height:30px;' src='image/empty_star.png'>";		// affichage des étoiles vides
							}
						echo "</td>";
					echo "</tr>";
				}
			}
			echo "</table>";
		echo "</div>";
	?>
	
</body>
</html>