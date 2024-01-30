<?php
//___________________________________________CONNEXION AU SERVEUR + VERIFICATION DES ACCENTS________________________________________________
include('connexion.php'); // permet la connexion au serveur
session_start();
?>
<!DOCTYPE html>
<html lang="fr"> 
<head>
	<meta name="viewport" content="wicth-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="entete.css">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- ____________________________________________________LES LIENS VERS BOOTSTRAP________________________________________________________-->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="image/icon.ico" />
</head>

<body>
	<?php
		function motdepasse($string)		// vérification si le mot de passe respecte les attentes
		{
			$taille = strlen($string);
			$majuscule = ctype_upper($string);
			$minuscule = ctype_lower($string);
			if ( $taille < 6 or $majuscule == TRUE or $minuscule == TRUE )	// s'il comporte minimum 1 majuscule et 1 minuscule et fait +6 caractères
			{
				$formulaire = TRUE;
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		if(isset($_POST['deconnexion']))		// si on se déconnecte
		{	
			$requete4 = "DELETE FROM niveau_en_cours";
			$result4 = mysqli_query($link,$requete4);
			if ( $result4 == FALSE )		// en cas d'erreur 4
			{
				echo "Erreur d'exécution de la requete 4" ;
				die();
			}
			if(isset($_SESSION['numero'])) { unset($_SESSION['numero']); }		// on supprime des données du jeu en cours
			if(isset($_SESSION['copie'])) { unset($_SESSION['copie']); }
			if(isset($_SESSION['vehi'])) { unset($_SESSION['vehi']); }
			if(isset($_SESSION['nbreCoup'])) { unset($_SESSION['nbreCoup']); }
			session_destroy();
			header('Location: all_levels.php');		// on est dirigé vers la page ALL LEVELS
			exit();
		}
	?>
	
	<img class="icone" src="image/iconevoit.png">		<!-- barre des voitures du haut -->
	<div class='top'>		<!-- bloc gris foncé -->
		<form method='post' style='height: 177px' action='all_levels.php'>		<!-- le logo est un bouton qui redirige vers la page ALL LEVELS -->
			<button type='submit' class='logo2' name='le_sauveur3'><img class='logo' src="image/logo.png"></button>
		</form>
		<form method='post' action='../bienvenue.php'>		<!-- la voiture en haut à gaauche (qui tourne) est un bouton vers la page d'accueil -->
			<button type='submit' class='vroum3' name='le_sauveur2'><img class='vroum2' src='image/vroumD.png'></button>
		</form>
	</div>
	<img class="vroum" src="image/vroumG.png">		<!-- 2 petites voitures qui font la course -->
	<img class="vroum" src="image/vroumG.png">
	
<!--_____________________________________________________________MENU LOG IN, SIGN UP_______________________________________________________-->

	<nav class="navbar navbar-expand-sm navbar row">		<!-- création de la barre de navigation -->
		<div class="col-6 nav-item dropdown-menu-center">
			<?php 
				if(isset($_SESSION['pseudo']))		// si on est connecté alors on afffiche le bouton MY PROFIL
				{
					echo "<a class='btn nav-btn' style='font-weight:bold;font-family: Georgia, serif;' href='profile.php'>My profile</a>";
				}
				else		// si on n'est pas connecté alors on affiche le bouton SIGN IN
				{
			?>
			<a class="nav-link"  href="#" id="navbardrop" data-toggle="dropdown" style='font-family: Georgia, serif;'>Log in</a>
			<form class="formu form-inline dropdown-menu cadre_formulaire" style="background-color:#05A693;" method='post' action='entete.php'>
				<div class="form-group">		<!-- menu déroulant contenant le formulaire de connexion -->
					<input type="text"  class="form-control remplir" id="login_in" style="padding-right:7.7rem;" placeholder="Login" name="login_in" required>
					<input type="password" class="form-control remplir" id="psw_in" style="padding-right:7.7rem;" placeholder="Password" name="psw_in" required>
					<button type="submit" class='submit nav-submit'>Log in</button>
				</div>
			</form>
			<?php } ?>
		</div>

		<div class="col-6 nav-item dropdown-menu-center">
			<?php
				if (isset($_SESSION['pseudo']))		// si on est connecté alors on affiche le bouton LOG OUT
				{
			?>
			<form method="post" action="entete.php">
				<button type="submit" class="btn nav-btn" style="font-weight:bold;font-family: Georgia, serif;" value="1" name="deconnexion" id="deconnexion">Log out</button>
			</form>
			<?php
				}
				else		// si on n'est pas connecté alors on affiche le bouton SIGN UP
				{
			?>
			<a class="nav-link" href="#" id="navbardrop" data-toggle="dropdown" style='font-family: Georgia, serif;'>Sign up</a>
			<form class="formu form-inline dropdown-menu cadre_formulaire" style="background-color:#05A693;" method='post' action='entete.php'>
				<div class="form-group">		<!-- menu déroulant contenant le formulaire d'insciption -->
					<input type="text" class="form-control remplir" id="login_up" style="padding-right:1.2rem;" placeholder="Login" name="login_up" required>
					<input type="password" class="form-control remplir" id="psw_up" style="padding-right:1.2rem;" placeholder="Password" name="psw_up" required>
					<input type="password" class="form-control remplir" id="psw2_up" style="padding-right:1.2rem;" placeholder="Confirm Password" name="psw2_up" required>
					<button type="submit" class='nav-submit'>Sign up</button>
				</div>
			</form>
			<?php } ?>
		</div>
	</nav>
<!--_______________________________________________________ACTION DU CHOIX DE L'AVATAR_______________________________________________________-->
	<?php
		if(isset($_SESSION['pseudo'])){ $pseudo = $_SESSION['pseudo'];}			
		if(isset($_POST['switch_avatar']))
		{
			$switch = $_POST['switch_avatar'];
			$update = "UPDATE joueurs SET avatar = '$switch' WHERE pseudo='$pseudo'";
			$result2 = mysqli_query($link,$update);
			if ( $result2 == FALSE )		// en cas d'erreur 2
			{
				echo "Erreur d'exécution de la requete 2" ;
				die();
			}
			header('Location: profile.php');
			exit();
		}
//____________________________________________________________ACTION DE SIGN UP_____________________________________________________________

		$formulaire = TRUE;
		if((isset( $_POST['login_up'] )) && (isset($_POST['psw_up'])) && (isset($_POST['psw2_up'])))		// si tout a été rempli
		{ 
			$_SESSION['error'] = 0;		// erreur initialisée à 0
			$requete = 'SELECT pseudo FROM joueurs';
			$result = mysqli_query($link,$requete);
			$i = 0;
			if ( $result == FALSE )		// en cas d'erreur
			{
				echo "<p>Erreur d'exécution de la requete</p>" ;
				echo mysqli_errno($conn) . ": " . mysqli_error($link). "\n";
				die();
			}
			if ( mysqli_num_rows($result) > 0)
			{
				while ($row = mysqli_fetch_assoc($result))
				{	
					if($row['pseudo'] == $_POST['login_up'])
					{
						$i = 1;
					}
				}
			}
			$pseudo = trim($_POST['login_up']);
			$mdp = sha1($_POST['psw_up']);
			
			if(($i == 0)&&($_POST['psw_up'] == $_POST['psw2_up']) && motdepasse($_POST['psw_up']))		// si tout va bien
			{
				$_SESSION['pseudo'] = $_POST['login_up'];
				$formulaire = FALSE;
				$insert = "INSERT INTO joueurs VALUES ('$pseudo','$mdp', 'horloge','1X.L')";
				$resultat2 = mysqli_query($link,$insert);
				if ($resultat2 == FALSE)
				{
        			echo "<p>Erreur d'execution de la requete insert</p>";
        			echo ":".mysqli_error($link)."" ;
        			die();
				}
				$_SESSION['error'] = 0;	
				header('Location: profile.php');		// redirection vers la page PROFILE
				exit();
			}
			else		// si quelque chose ne va pas 
			{
				if(!motdepasse($_POST['psw_up']))
				{
					motdepasse($_POST['psw_up']);
					$_SESSION['error'] = 3; // Wrong password, The password must be at least lowercase and uppercase, and be longer than 6 characters
				}
				if($i == 1)
				{
					$_SESSION['error'] = 4;		// This login is already used
				}
				if($_POST['psw_up'] != $_POST['psw2_up'])
				{
					$_SESSION['error'] = 5;		// Passwords are different
				}
				header("Location:all_levels.php");		// redirection vers la page ALL LEVELS avec le message d 'erreur
			}
		}
//_______________________________________________________________ACTION DE LOG IN________________________________________________________________
		$formulaire = TRUE;
		if((isset( $_POST['login_in'] )) && (isset($_POST['psw_in'])))
		{ 
			$_SESSION['error'] = 0;
			$requete = 'SELECT pseudo, mdp FROM joueurs';
			$result = mysqli_query($link,$requete);
			$y = 0;
			if ( $result == FALSE )		// en cas d'erreur
			{
				echo "<p>Erreur d'exécution de la requete</p>" ;
				echo mysqli_errno($conn) . ": " . mysqli_error($link). "\n";
				die();
			}
			if ( mysqli_num_rows($result) > 0)
			{
				while ($row = mysqli_fetch_assoc($result))
				{	
					if($row['pseudo'] == $_POST['login_in'])
					{
						$y = 1;
						if($row['mdp'] == sha1($_POST['psw_in']))
						{
							$formulaire= FALSE;
							$_SESSION['pseudo'] = $row['pseudo'];
							$_SESSION['error'] = 0;				// bonne connexion
							header('Location: profile.php');
							exit();
						}
						else
						{
							$_SESSION['error'] = 1;		// erreur mot de passe
							header('Location:all_levels.php');		
						}
					}
				}
			}
			if($y == 0)
			{
				$_SESSION['error'] = 2; 	// erreur Login
				header('Location:all_levels.php');		// redirection vers la page ALL LEVELS avec un message d'erreur
			}
		}
	?>

</body>
</html>