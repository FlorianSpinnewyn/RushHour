<?php include('entete.php'); ?>
<html>
<head>
	<title>All levels</title>
	<meta name="viewport" content="wicth-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="all_levels.css">
</head>

<body style='background-color: #eeeeee;'>
	<?php
		
		echo "<div style='height:30rem'>";
//______________________________________________TRAITEMENT DES ERREURS LIEES AU PSEUDO OU MOT DE PASSE____________________________________________
		
		if (isset($_SESSION['error'])){
			if ($_SESSION['error'] != 0)
			{
				if(isset($_SESSION['numero'])) { unset($_SESSION['numero']); }		// il faut supprimer les données du jeu en cours
				if(isset($_SESSION['copie'])) { unset($_SESSION['copie']); }
				if(isset($_SESSION['vehi'])) { unset($_SESSION['vehi']); }
				if(isset($_SESSION['nbreCoup'])) { unset($_SESSION['nbreCoup']); }
			}
			if ($_SESSION['error'] == 1)
			{
				echo "<p class='warning'>Wrong Password</p>";
				$requete4 = "DELETE FROM niveau_en_cours";
				$result4 = mysqli_query($link,$requete4);
				if ( $result4 == FALSE )		// en cas d'erreur 4
				{
					echo "Erreur d'exécution de la requete 4" ;
					die();
				}
			}
			if ($_SESSION['error'] == 2)
			{
				echo "<p class='warning'>Wrong Login</p>";
				$requete4 = "DELETE FROM niveau_en_cours";
				$result4 = mysqli_query($link,$requete4);
				if ( $result4 == FALSE )		// en cas d'erreur 4
				{
					echo "Erreur d'exécution de la requete 4" ;
					die();
				}
			}
			if ($_SESSION['error'] == 3)
			{
				echo "<p class='warning'>Wrong password"; 
				echo "<br>";
				echo "The password must be at least lowercase and uppercase, and be longer than 6 characters.</p> ";
				$requete4 = "DELETE FROM niveau_en_cours";
				$result4 = mysqli_query($link,$requete4);
				if ( $result4 == FALSE )		// en cas d'erreur 4
				{
					echo "Erreur d'exécution de la requete 4" ;
					die();
				}
			}
			if ($_SESSION['error'] == 4)
			{
				echo "<p class='warning'>This login is already used</p>";
				$requete4 = "DELETE FROM niveau_en_cours";
				$result4 = mysqli_query($link,$requete4);
				if ( $result4 == FALSE )		// en cas d'erreur 4
				{
					echo "Erreur d'exécution de la requete 4" ;
					die();
				}
			}
			if ($_SESSION['error'] == 5){
				echo "<p class='warning'>Passwords are different</p>";
				$requete4 = "DELETE FROM niveau_en_cours";
				$result4 = mysqli_query($link,$requete4);
				if ( $result4 == FALSE )		// en cas d'erreur 4
				{
					echo "Erreur d'exécution de la requete 4" ;
					die();
				}
			}
		}
		if(isset($_POST['le_sauveur3']))		// si on a appuyé sur le bouton LOGO
		{
			$requete4 = "DELETE FROM niveau_en_cours";
			$result4 = mysqli_query($link,$requete4);
			if ( $result4 == FALSE )		// en cas d'erreur 4
			{
				echo "Erreur d'exécution de la requete 4" ;
				die();
			}
			if(isset($_SESSION['numero'])) { unset($_SESSION['numero']); }		// il faut supprimer les données du jeu en cours
			if(isset($_SESSION['copie'])) { unset($_SESSION['copie']); }
			if(isset($_SESSION['vehi'])) { unset($_SESSION['vehi']); }
			if(isset($_SESSION['nbreCoup'])) { unset($_SESSION['nbreCoup']); }
		}
		if(isset($_SESSION['newniv']) && isset($_SESSION['numnewniv']))
		{
			$compte = $_SESSION['numnewniv'];
			echo "<form method='post' action='nivorien.php'><p class='warning' style='color:#76E7A6'><br>Your level has been created. If you wish, you can test it <button type='submit' name='here' value=$compte class='here'>here</button> !</p></form>";
			unset($_SESSION['newniv']);
			 unset($_SESSION['numnewniv']);
		}
	?>

<!--_____________________________________________PAGE POUR VOIR TOUS LES NIVEAUX PREDEFINIS OU DEJA CREE___________________________________________-->

	<div id="carousel" class="carousel slide ok" data-ride="carousel">
		<div class="carousel-inner" style='padding-right: 7%;'>
            <div class="carousel-item active">
				<h2 class='ok3'>Beginner</h2>		<!-- la page active est la page débutante -->
                <?php
//_____________________________________REQUETE POUR AFFICHER LA BONNE IMAGE DE NIVEAU ET DIRIGER VERS LE BON JEU__________________________________
				
					$requete = "SELECT ref, NiveauJeu AS NJ FROM jeu";
					$result = mysqli_query($link,$requete);
					if ( $result == FALSE )		// en cas d'erreur
					{
						echo "Erreur d'exécution de la requete" ;
						die();
					}
					echo "<div class='case'>";
					while ($row = mysqli_fetch_assoc($result))
					{
						$reference = $row['ref'];
						if($row['NJ']=='beginner')
						{
							echo "<form action='nivorien.php' method='post'>";
							echo "<button class='zoom carte' type='submit'name='acces' value=$reference><img src='image/pk".$reference.".png' width='100px;'/></button>";
							echo "</form>";
						}
					}
					echo "</div>";
                ?>   
			</div>
            <div class="carousel-item ">
				<h2 class='ok3'>Intermediate</h2>		<!-- la page 2e est la page intermédiaire -->
				<?php
//_____________________________________REQUETE POUR AFFICHER LA BONNE IMAGE DE NIVEAU ET DIRIGER VERS LE BON JEU__________________________________

					$requete = "SELECT ref, NiveauJeu AS NJ FROM jeu";
					$result = mysqli_query($link,$requete);
					if ( $result == FALSE )		// en cas d'erreur
					{
						echo "Erreur d'exécution de la requete" ;
						die();
					}
					echo "<div class='case'>";
					while ($row = mysqli_fetch_assoc($result))
					{
						$reference = $row['ref'];
						if($row['NJ']=='intermediate')
						{
							echo "<form action='nivorien.php' method='post'>";
							echo "<button class='zoom carte' type='submit' name='acces' value=$reference><img class='case' src='image/pk".$reference.".png' width='100px;'/></button>";
							echo "</form>";
						}
					}
					echo "</div>";
				?>  
			</div>
			<div class="carousel-item">
				<h2 class='ok3'>Advanced</h2>		<!-- la page 3e est la page avancé -->
				<?php
//_____________________________________REQUETE POUR AFFICHER LA BONNE IMAGE DE NIVEAU ET DIRIGER VERS LE BON JEU__________________________________

					$requete = "SELECT ref, NiveauJeu AS NJ FROM jeu";
					$result = mysqli_query($link,$requete);
					if ( $result == FALSE )		// en cas d'erreur
					{
						echo "Erreur d'exécution de la requete" ;
						die();
					}
					echo "<div class='case'>";
					while ($row = mysqli_fetch_assoc($result))
					{
						$reference = $row['ref'];
						if($row['NJ']=='advanced')
						{
							echo "<form action='nivorien.php' method='post'>";
							echo "<button class='zoom carte' type='submit' name='acces' value=$reference><img src='image/pk".$reference.".png' width='100px;'/></button>";
							echo "</form>";
						}
					}
					echo "</div>";
				?>	
			</div>
			<div class="carousel-item">
				<h2 class='ok3'>Expert</h2>		<!-- la page 4e est la page expert -->
				<?php
//_____________________________________REQUETE POUR AFFICHER LA BONNE IMAGE DE NIVEAU ET DIRIGER VERS LE BON JEU__________________________________

					$requete = "SELECT ref, NiveauJeu AS NJ FROM jeu";
					$result = mysqli_query($link,$requete);
					if ( $result == FALSE )		// en cas d'erreur
					{
						echo "Erreur d'exécution de la requete" ;
						die();
					}
					echo "<div class='case'>";
					while ($row = mysqli_fetch_assoc($result))
					{
						$reference = $row['ref'];
						if($row['NJ']=='expert')
						{
							echo "<form action='nivorien.php' method='post'>";
							echo "<button class='zoom carte' type='submit' name='acces' value=$reference><img src='image/pk".$reference.".png' width='100px;'/></button>";
							echo "</form>";
						}
					}
					echo "</div>";
				?>
			</div>
			<div class="carousel-item">
				<h2 class='ok3'>Created levels</h2>		<!-- la page 5e est la page avec les niveaux créés -->
				<?php
//_____________________________________REQUETE POUR AFFICHER LA BONNE IMAGE DE NIVEAU ET DIRIGER VERS LE BON JEU__________________________________

					$requete = "SELECT ref, NiveauJeu AS NJ FROM jeu";
					$result = mysqli_query($link,$requete);
					if ( $result == FALSE )		// en cas d'erreur
					{
						echo "Erreur d'exécution de la requete" ;
						die();
					}
					echo "<div class='case'>";
					while ($row = mysqli_fetch_assoc($result))
					{
						$reference = $row['ref'];
						if($row['NJ']=='created')
						{
							$requete2 = "SELECT nomNiveau, nomJoueur FROM niveau_cree WHERE idNiveau = $reference AND lettre_vehicule='X'";
							$result2 = mysqli_query($link,$requete2);
							if ( $result2 == FALSE )		// en cas d'erreur 2
							{
								echo "Erreur d'exécution de la requete 2" ;
								die();
							}
							$row2 = mysqli_fetch_assoc($result2);
							$game = $row2['nomNiveau'];
							$utilisateur = $row2['nomJoueur'];
							$requete3 = "SELECT avatar FROM joueurs WHERE pseudo = '".$utilisateur."'";
							$result3 = mysqli_query($link,$requete3);
							if ( $result3 == FALSE )		// en cas d'erreur 3
							{
								echo "Erreur d'exécution de la requete 3" ;
								die();
							}
							$row3 = mysqli_fetch_assoc($result3);
							$photo = $row3['avatar'];
							echo "<form action='nivorien.php' method='post'>";
							echo "<button class='zoom carte' type='submit' name='acces' value=$reference><img src='image/avatars/".$photo.".png' width='100px;'/><p style='font-family: Georgia, serif;color:#4E4E4E;'>$game</p></button>";
							echo "</form>";
						}
					}
					echo "</div>";
				?>
			</div>
		</div>
		<a class="carousel-control-prev" href="#carousel" data-slide="prev" style='width: 35px;margin-left: 3%;'>
			<span class="carousel-control-prev-icon fleche" style="margin-left:5%;"></span>		<!-- flèche gauche -->
		</a>
		<a class="carousel-control-next" href="#carousel" data-slide="next" style='width: 35px;margin-right: 3%;'>
			<span class="carousel-control-next-icon fleche"></span>		<!-- flèche droite -->
		</a>
    </div>
</div>

</body>
</html>