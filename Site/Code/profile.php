<!DOCTYPE html>
<html lang="fr"> 
<head>
<title>Profile</title>
	<meta name="viewport" content="wicth-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="profile.css">
	<meta charset="utf-8">
</head>

<body>
	<?php
		include ('entete.php');		// permet d'avoir la connexion au serveur et le menu du haut de page
		if (isset($_SESSION['error'])) { $_SESSION['error']=0; }		// remise à 0 des erreurs de connexion
		
		if(isset($_POST['idNiveau']))
		{
			$id = $_POST['idNiveau'] ;
			$requete ="DELETE FROM niveau_cree WHERE idNiveau='$id'";
			$r=mysqli_query($link,$requete);
			if ( $r == FALSE )
			{
				echo "c po bon";
				die();
			}
			$requete = "UPDATE niveau_cree SET  idNiveau = idNiveau - 1  WHERE idNiveau > '$id'";
			mysqli_query($link,$requete);
			$requetedeleteJeu = "DELETE FROM `jeu` WHERE ref='$id'" ;
			$resultdeleteJeu = mysqli_query($link,$requetedeleteJeu);
			if ( $resultdeleteJeu == FALSE )
			{
				echo "c po bon";
				die();
			}
			$requete = "UPDATE jeu SET  ref = ref - 1  WHERE ref > '$id'";
			mysqli_query($link,$requete);

			$requetedeleteJeu = "DELETE FROM `classement` WHERE idNiveau='$id'" ;
			$resultdeleteJeu = mysqli_query($link,$requetedeleteJeu);
			if ( $resultdeleteJeu == FALSE )
			{
				echo "c po bon";
				die();
			}
			$requete = "UPDATE classement SET  idNiveau = idNiveau - 1  WHERE idNiveau > '$id'";
			mysqli_query($link,$requete);
		}
	?>
<!--_____________________________________________PAGE QUI DONNE LES INFORMATIONS DU JOUEUR CONNECTE______________________________________________-->

	<div class="row">
		<div class='welcome col-12'>		<!-- fond dégradé -->
		<?php
			if(!isset($_POST['update_profile']) && !isset($_POST['form_avatar']))
			{
				echo "<div class='big-welcome'>";
			}
			else
			{
				echo "<div class='small-welcome'>";
			}
		?>
			<div class='square'>
				<ul>
					<li></li><li></li><li></li><li></li><li></li>		<!-- carrés qui tournent et s'agrandissent -->
				</ul>
			</div>
			<div class='circle'>
				<ul>
					<li></li><li></li><li></li><li></li><li></li>		<!-- cercles qui s'élèvent et s'agrandissent -->
				</ul>
			</div>
			<?php
				if(!isset($_POST['update_profile']) && !isset($_POST['form_avatar']))
				{ 
					echo "<div class='big-card'>";
				}
				else
				{
					echo "<div class='small-card'>";
				}
			?>
			<div class="card-body row">
				<div class="col-4">
					<div class="avatar">
					<?php
//________________________________________________AFFICHAGE DE L'AVATAR EN FONCTION DU PSEUDO_______________________________________________________

					if(isset($_SESSION['pseudo'])){ $pseudo = $_SESSION['pseudo']; }
					if(!isset($_POST['desinscription']) && !isset($_POST['deconnexion']) && isset($_SESSION['pseudo'])) // si on est connnecté
					{
//______________________________________REQUETE POUR TROUVER QUEL AVATAR EST ENREGISTRE AVEC CE PSEUDO______________________________________________

						$requet = "SELECT avatar FROM joueurs WHERE pseudo='$pseudo'";
						$result = $resultat = mysqli_query($link,$requet);
						if ($resultat == FALSE)		// en cas d'erreur
						{
							echo "<p>Erreur d'execution de la requete update</p>";
							echo ":".mysqli_error($link)."" ;
							die();
						}
						if ( mysqli_num_rows($result) > 0)
						{
							while ($row = mysqli_fetch_assoc($result))
							{
								$avatar = $row['avatar'];
								echo "<img src='image/avatars/$avatar.png' class='card-img zoom' alt='Card image'>";		// affichage de l'avatar
							}
						}
//__________________________________________ACTION DU FORMULAIRE POUR CHANGER DE MOT DE PASSE_______________________________________________________

						if(isset($_POST['old_psw']) && isset($_POST['new_psw']) && isset($_POST['conf_new_psw']) )	// si le form a bien été rempli
						{
//___________________________________________REQUETE POUR TROUVER L'ANCIEN MOT DE PASSE DU COMPTE___________________________________________________

							$requete2 = "SELECT mdp FROM joueurs WHERE pseudo ='$pseudo'";
							$result2 = mysqli_query($link,$requete2);
							if ( $result2 == FALSE )		// en cas d'erreur 2
							{
								echo "Erreur d'exécution de la requete 2" ;
								die();
							}
							$old_psw = sha1($_POST['old_psw']);
							while ($row = mysqli_fetch_assoc($result2))
							{
								$mdp =  $row['mdp'];
								if(!motdepasse($_POST['mdp']))		// si le nouveau mot de passe ne correspond pas aux attentes
								{
									motdepasse($_POST['mdp']);
									echo "Wrong password, The password must be at least lowercase and uppercase, and be longer than 6 characters";
									header('Location:profile.php');		// redirection vers le profil avec message d'erreur
								}
								if(($old_psw == $mdp))		// si le mot de passe actuel et l'ancien sont égaux
								{
									if(($_POST['new_psw'] == $_POST['conf_new_psw']))		// si le nouveau mot de passe est bien confirmé
									{
										$formulaire= FALSE;
										$new_psw = sha1($_POST['new_psw']);
//___________________________________________REQUETE POUR MODIFIER LE MOT DE PASSE DU COMPTE____________________________________________________

										$update2 = "UPDATE joueurs SET mdp='$new_psw' WHERE pseudo = '$pseudo'";
										$resulte3 = mysqli_query($link,$update2);
										header('Location: profile.php');		// redirection vers le profil : le mdp est bine changé
										if ( $resulte3 == FALSE )		// en cas d'erreur 3
										{
											echo "Erreur d'exécution de la requete 3" ;
											die();
										}
									}
									else		// si les mots de passe sont différents
									{
										echo "<p  style='color:red; text-align:center; font-size:1.5rem;'>Wrong old Password</p>";
										header('Location: profile.php');		// redirection vers le profil avec message d'erreur
										exit();
									}
								}
								else		// si le mot de passe n'est pas le bon
								{
									echo "<p  style='color:red; text-align:center; font-size:1.5rem;'>Wrong conf Password</p>";
									header('Location: profile.php');		// redirection vers le profil avec message d'erreur
								}
							}
					
						}
					?>

<!--_________________________________________________________ACCES A TOUS LES AVATARS_________________________________________________________-->

						<div class="overlay">
							<form method="post" action="profile.php">
								<button type="submit" name="form_avatar" class="text">Change your profile picture</button>
							</form>
						</div>

<!--________________________________________________ACTION DU FORMULAIRE POUR LE CHOIX D'AVATAR_________________________________________________-->

					<?php			
						if(isset($_POST['switch_avatar']))
						{
							$switch = $_POST['switch_avatar'];
//_______________________________________REQUETE POUR MODIFIER LE CODE POUR AFFICHER LE NOUVEAU AVATAR_______________________________________________

							$update = "UPDATE joueur SET avatars = '$switch' WHERE pseudo='$pseudo'";	
							$result2 = mysqli_query($link,$update);
							if ( $result2 == FALSE )		// en cas d'erreur 2
							{
								echo "Erreur d'exécution de la requete 2" ;
								die();
							}
							exit();
						}
					?>
				</div>
			</div>
			<div class="col-8">
					<?php
//___________________________________________AFFICHAGE DE TOUS LES AVATARS SOUS FORME DE BOUTON____________________________________________________

						if (isset($_POST['form_avatar']))		// si on a demandé de changer d'avatar
						{
//___________________________________________REQUETE POUR SELECTIONNER TOUS LES AVATARS EXISTANTS____________________________________________________

							$requete = "SELECT id, avatars FROM avatars ORDER BY id";
							$result = mysqli_query($link,$requete);
							if ( $result == FALSE )		// en cas d'erreur
							{
								echo "Erreur d'exécution de la requete" ;
								die();
							}
							echo "<div class='case'>";
							while ($row = mysqli_fetch_assoc($result))
							{
								$avatar = $row['avatars'];
								echo "<form action='profile.php' method='post'>";		// création du bouton
									echo "<button class='zoom carte' style='float:left;margin-left:7%;margin-top:12.5%;' type='submit' name='switch_avatar' value=$avatar><img src='image/avatars/$avatar.png' width='100px;'/></button>";
								echo "</form>";
							}
							echo "</div>";
						}
						else if (isset($_POST['update_profile']))		// si on a demandé de changé son mot de passe
						{
					?>
<!--__________________________________________________FORMULAIRE POUR CHANGER DE MOT DE PASSE____________________________________________________-->

					<form class='formu' method='post' action='profile.php'>
						<legend class="formu-title">Change your password</label>
						<div class="form-group">
							<input type="password" class="form-control formu-remplir" style="padding-right:7.7rem;" placeholder="Current Password" id="old_psw" name="old_psw" required>		<!-- demande de l'ancien mot de passe -->
						</div>
						<div class="form-group">
							<input type="password" class="form-control formu-remplir" style="padding-right:7.7rem;" placeholder="New Password" id="new_psw" name="new_psw" required>		<!-- demande du nouveau mot de passe -->
						</div>
						<div class="form-group">
							<input type="password" class="form-control formu-remplir" style="padding-right:7.7rem;" placeholder="Confirm New Password" id="conf_new_psw" name="conf_new_psw" required>		<!-- confirmation du nouveau mot de passe -->
						</div>
						<button type="submit" class='submit formu-submit'>Change</button>
					</form>
					<?php
						}	
						else		// si on veut juste accéder au profil
						{
							echo "<h1 class='card-title'>$pseudo</h1>";
							echo "<div class='card-text'>";
//_______________________________________REQUETE POUR SELECTIONNER LES INFORMATIONS DU JOUEUR CONNECTE_____________________________________________

								$requete = "SELECT idNiveau, placeJoueur, nbreCoup, nbreEtoile FROM classement WHERE nomJoueur = '$pseudo' ORDER BY idNiveau";
								$result = mysqli_query($link,$requete);
								if ( $result == FALSE )		// en cas d'erreur
								{
									echo "Erreur d'exécution de la requete";
									die();
								}
//___________________________________________AFFICHAGE DES RESULTATS DU JOUEUR SOUS FORME DE TABLEAU_________________________________________________
								
								if(mysqli_num_rows($result) == 0)		// si le joueur n'a aucun résultat
								{
									echo "<p style='color:white;font-family: Georgia, serif;'>Oh you don't have any results yet (in the TOP 5 of a level). Practise again and you'll make it !</p>";
								}
								else
								{
									if(mysqli_num_rows($result) > 0 && mysqli_num_rows($result) <= 10)
									{
										echo "<p style='color:white;font-family: Georgia, serif;'>You are a NOVICE DRIVER.<br>Here are your best scores :</p>";
									}
									if(mysqli_num_rows($result) > 10 && mysqli_num_rows($result) <= 20)
									{
										$requete31 = "UPDATE joueurs SET voitureRouge='2X.L' WHERE pseudo='$pseudo'";
										$result31 = mysqli_query($link,$requete31);
										if ( $result31 == FALSE )		// en cas d'erreur 31
										{
											echo "Erreur d'exécution de la requete 31" ;
											die();
										}
										echo "<p style='color:white;font-family: Georgia, serif;'>The road is YOUR DOMAIN and you have unlocked the upgraded red car.<br>Here are your best scores :</p>";
									}
									if(mysqli_num_rows($result) > 20 && mysqli_num_rows($result) <= 30)
									{
										$requete31 = "UPDATE joueurs SET voitureRouge='3X.L' WHERE pseudo='$pseudo'";
										$result31 = mysqli_query($link,$requete31);
										if ( $result31 == FALSE )		// en cas d'erreur 31
										{
											echo "Erreur d'exécution de la requete 31" ;
											die();
										}
										echo "<p style='color:white;font-family: Georgia, serif;'>You are a PROFESSIONAL DRIVER and you have unlocked the red top-level car.<br>Here are your best scores :</p>";
									}
									if(mysqli_num_rows($result) > 30)
									{
										$requete31 = "UPDATE joueurs SET voitureRouge='4X.L' WHERE pseudo='$pseudo'";
										$result31 = mysqli_query($link,$requete31);
										if ( $result31 == FALSE )		// en cas d'erreur 31
										{
											echo "Erreur d'exécution de la requete 31" ;
											die();
										}
										echo "<p style='color:white;font-family: Georgia, serif;'>You are an DRIVING ACE and you have unlocked the best red car.<br>Here are your best scores :</p>";
									}
									echo "<table border='1' style='width:95%; margin-left:3%;margin-top:3%;color:white;font-family: Georgia, serif;'>";
									echo "<tr style='background-color:white;color:#4E4E4E;font-size: 140%;'>
										<td  style='padding: 2% 3% 2%;'>Level</td>
										<td  style='padding: 2% 2% 2%;'>Your rank</td>
										<td  style='padding: 2% 5% 2%;'>Moves</td>
										<td  style='padding: 2% 5% 2%;'>Your stars</td>
									</tr>";
									while($row = mysqli_fetch_assoc($result))
									{
										echo "<tr>";
											echo "<td style='padding-left: 5%';>" . $row["idNiveau"] . "</td>" ;
											echo "<td style='padding-left: 5%';>" . $row["placeJoueur"] . "</td>" ;
											echo "<td style='padding-left: 5%';>" . $row["nbreCoup"] . "</td>" ;
											echo "<td style='padding-left: 5%';>";
											for($j=0; $j<$row["nbreEtoile"]; $j++)
											{
												echo"<img style='width:30px;height:30px;' src='image/star.png'>";		// affichage des étoiles
											}
											for($j=0; $j<(3-$row["nbreEtoile"]); $j++)
											{
												echo"<img style='width:30px;height:30px;' src='image/empty_star.png'>";	// affichage des étoiles vides
											}
											echo "</td>";
										echo "</tr>";
									}
									echo "</table>";
								}
//___________________________________________AFFICHAGE DES NIVEAUX DONT LE JOUEUR N'EST PAS DANS LE TOP 5____________________________________________
							
								$requete2 = "SELECT idNiveau FROM classement WHERE nomJoueur = '$pseudo' ORDER BY idNiveau";
								$result2 = mysqli_query($link,$requete2);
								if ( $result2 == FALSE )		// en cas d'erreur 2
								{
									echo "Erreur d'exécution de la requete 2";
									die();
								}
								$aie = array();
								if(mysqli_num_rows($result2) == 40)
								{
									echo "<p style='color:white;font-family: Georgia, serif;'><br>You are already in the TOP 5 of all levels! You're really exceptional !! Try to create your own levels or solve the ones created by other users...</p>";
								}
								else
								{
									echo "<div style='color: white;font-family: Georgia, serif;font-size: 110%;'><br>You can still improve your skills on these levels :</div>";
									while($row2 = mysqli_fetch_assoc($result2))
									{
										$aie[$row2['idNiveau']] = $row2['idNiveau'];
									}
									echo "<form method='post' action='nivorien.php'>";
									for($e=1;$e<41;$e++)
									{
										if(!(isset($aie[$e])))
										{ 
											echo "<button type='submit' name='resteafaire' class='resteafaire' value=$e>level ". $e ."</button><br>"; 
										}
									}
									echo "</form>";
								}
							?>
							</div>
							<form method="post" action="profile.php">
								<button type="submit" class="btn" style="float:right;margin-left:1rem;margin-top:2rem;font-family: Georgia, serif;" value="1" name="deconnexion" id="deconnexion">Log out</button>		<!-- bouton pour se déconnnecter -->
								<button type="submit" class="btn" style="float:right;margin-left:1rem;margin-top:2rem;font-family: Georgia, serif;" value="1" name="desinscription" id="desinscription">Unsubscribe</button>		<!-- bouton pour se désinscire -->
								<button type="submit" class="btn" style="float:right;margin-top:2rem;font-family: Georgia, serif;" value="1" name="update_profile" id="update_profile">Change your password</button>		<!-- bouton pour modifier son profil -->
							</form>
							<form method="post"  action="profile.php">
								</br>
								
								<?php	
									$requete2 = "SELECT * FROM niveau_cree WHERE nomJoueur = '$pseudo' AND lettre_vehicule = 'X'" ;
									$result2 = mysqli_query($link,$requete2);
									if ( $result2 == FALSE )
									{
										echo "Erreur d'exécution de la requete 2";
										die();
									}
									if ( mysqli_num_rows($result2) > 0)
									{
										echo "<p style='margin-left:-40%;margin-top:-10%;color:white;font-family:Georgia, serif;font-size:110%;'>Here, you can delete your levels :</p>";
										echo "<select name='idNiveau' style='margin-left:-38%;margin-top:-10%;font-family:Georgia, serif;padding:1%;border-radius:7px;border:none;'>";
											while ($row = mysqli_fetch_assoc($result2))
											{
												echo "<option value='".$row["idNiveau"]."'>".$row["idNiveau"]." - ".$row["nomNiveau"]."</option>" ;
											}
											echo "<input type='submit' name='formsend' id='formsend' value='Delete' style='font-family:Georgia, serif;margin-left:4%;font-family:Georgia, serif;padding:1%;border-radius:7px;border:none;' required>";
										echo "</select>";
									}
								?>
							</form>
					<?php 
						} 
					?>
			</div>
		</div>
	
				<?php 
				} 
//___________________________________________ACTION POUR LA DECONNEXION ET LA DESINSCRIPTION_________________________________________________

					else
					{
						if(isset($_POST['desinscription']))		// si on souhaite se désinscrire
						{
//______________________________________________REQUETE POUR SUPPRIMER LES DONNEES DU JOUEUR_________________________________________________

							$suppr = "DELETE from joueurs WHERE pseudo='$pseudo'";
							$resultat = mysqli_query($link,$suppr);
							if ($resultat == FALSE)		// en cas d'erreur
							{
								echo "<p>Erreur d'execution de la requete resultat</p>";
								echo ":".mysqli_error($link)."" ;
								die();
							}
							echo "<div class='alert alert-warning'>Your profile has been deleted.</div>";
						}
						if(isset($_POST['deconnexion']))		// si on souhaite se déconnecter
						{
							echo "<div class='alert alert-warning'>You have been disconnected.</div>";	
						}
						session_destroy();
						header('refresh:1;url=../bienvenue.php');		// retour à l'accueil
					}
					?>
				</div>
			</div>
		</div>
	</div>

</body>
</html>