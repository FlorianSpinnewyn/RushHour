<!DOCTYPE html>
<html lang="fr"> 
<head>
	<title>Bienvenue</title>
	<meta name="viewport" content="wicth-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="Code/bienvenue.css">
	<link rel="icon" href="image/icon.ico" />
</head>

<body>
	<?php
//__________________________________________________________PAGE D'ACCUEIL__________________________________________________________
	
	session_start();
	include('Code/connexion.php');		// permet la connexion au serveur

	if (isset($_SESSION['error'])){ $_SESSION['error']=0; }		// mise à jour du code erreur à 0

	if(isset($_POST['le_sauveur2']))		// suppression des données du jeu si la partie a été quitté avant la fin
	{
		$requete4 = "DELETE FROM niveau_en_cours";
		$result4 = mysqli_query($link,$requete4);
		if ( $result4 == FALSE )		// en cas d'erreur 4
		{
			echo "Erreur d'exécution de la requete 4" ;
			die();
		}
		if(isset($_SESSION['numero'])) { unset($_SESSION['numero']); }
		if(isset($_SESSION['copie'])) { unset($_SESSION['copie']); }
		if(isset($_SESSION['vehi'])) { unset($_SESSION['vehi']); }
		if(isset($_SESSION['nbreCoup'])) { unset($_SESSION['nbreCoup']); }
	}
	if(isset($_SESSION['pseudo']))
	{
		$pseudo = $_SESSION['pseudo'];
		$requete2 = "SELECT idNiveau FROM classement WHERE nomJoueur = '$pseudo' ORDER BY idNiveau";
		$result2 = mysqli_query($link,$requete2);
		if ( $result2 == FALSE )		// en cas d'erreur 2
		{
			echo "Erreur d'exécution de la requete 2";
			die();
		}
		$aie = array();
		if(mysqli_num_rows($result2) != 40)
		{
			while($row2 = mysqli_fetch_assoc($result2))
			{
				$aie[$row2['idNiveau']] = $row2['idNiveau'];
			}
			$f=1;
			while(isset($aie[$f])) { $f++ ; }
			$_SESSION['nonfait'] = $f;
		}
	}
	?>
	<div class="fond">
		<img class="jour" src="Code/image/ciel.png" alt="Ciel">
		<img class="nuit" src="Code/image/nuit.png" alt="Ciel">
	</div>
	<div class="ciel">
		<div class="rectangle">
			<img class="logo" src="Code/image/logo.png">
		</div>
		
		<ul>
			<li>
			<?php
//__________________________________________________OUVERTURE DU PREMIER NIVEAU DANS LA PAGE PLAY____________________________________________________

				if(!(isset($_SESSION['pseudo']))  || !(isset($_SESSION['nonfait'])))
				{
					echo "<form action='Code/nivorien.php' method='post'>";
					echo "<button class='menu bouton1 ecriture1' type='submit' name='acces' value=1>Play</button>";
					echo "</form>";
				}
				else
				{
					$coucou = $_SESSION['nonfait'];
					
					echo "<form action='Code/nivorien.php' method='post'>";
					echo "<button class='menu bouton1 ecriture1' type='submit' name='acces' value=$coucou >Play</button>";
					echo "</form>";
				}
			?>  
			</li>
			<li><a class='menu bouton2 ecriture2' href="Code/all_levels.php">See all levels</a></li>		<!-- lien vers le carrousel de niveau -->
			<li><a class='menu bouton3 ecriture3' href="Code/transition_create.php">Create your level</a></li>	<!-- lien pour créer son niveau -->
		</ul>
	
		<div class="route"></div>
		<div class="ville"></div>
		
		<div class="voiture">
			<img src="Code/image/voiture.png">
		</div>
		<div class="roue">
			<img src="Code/image/roue.png" class="roue-arriere">
			<img src="Code/image/roue.png" class="roue-avant">
		</div>
	</div>

</body>
</html>