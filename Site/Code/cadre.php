<html>
<head>
	<title>Time* point(heure)</title>
	<meta name="viewport" content="wicth-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="play.css">
</head>

<body style='background-color: #eeeeee;'>
	<?php 	
		include('entete.php');		// permet d'avoir la connexion + les liens bootstrap + le menu du haut de page
		include('requete.php');		// permet d'avoir des variables de session et des requêtes
		include('test.php');		// permet d'avoir les données récupérées dans le fichier du solveur

echo "<div>";
	echo "<div class='soluce' id='ici'>";
		if(isset($_POST['jsp']))
		{
//_________________________________MISE EN FORME DE L'INDICE DONNE PAR LE SERVEUR__________________________________________________________

			if($_POST['jsp'] == 'The clue is waiting for you')		// si on a demandé un indice
			{
				echo "<h6 class='jeu1'>THIS IS YOUR CLUE !!</h6>";
				$faire = str_split($enchainementmouv[0]);		// récupération de la 1e ligne du tableau des coups à faire (page test)
				if ($faire[0]=='b'){ $indice = "The vehicle " . $faire[1] . " must go down."; }		// traduction du code vers anglais
				if ($faire[0]=='h'){ $indice = "The vehicle " . $faire[1] . " must go up."; }
				if ($faire[0]=='g'){ $indice = "The vehicle " . $faire[1] . " must go left."; }
				if ($faire[0]=='d'){ $indice = "The vehicle " . $faire[1] . " must go right."; }
				echo "<p class='olive'>" . $indice . "<br><br><br></p>";		// affichage de l'indice
				echo "<a class='bout quatro' href='nivorien.php'>Back to the game... GOOD LUCK</a>";		// bouton pour retourner au jeu
			}
//_________________________________MISE EN FORME DE LA SOLUTION DONNEE PAR LE SERVEUR__________________________________________________________

			else		// si on a demandé la solution entière
			{
				echo "<h6 class='jeu1'>SOLUTION</h6>";
				$liste = array();
				echo "<ol class='olive'>";
				for ($p = 0; $p < $coupjoue; $p++)
				{
					$faire = str_split($enchainementmouv[$p]);		// récupération de chaque mouvement
					if ($faire[0]=='b'){ $liste[$p] = "The vehicle " . $faire[1] . " must go down.";}		// traduction du code vers anglais
					if ($faire[0]=='h'){ $liste[$p] = "The vehicle " . $faire[1] . " must go up.";}
					if ($faire[0]=='g'){ $liste[$p] = "The vehicle " . $faire[1] . " must go left.";}
					if ($faire[0]=='d'){ $liste[$p] = "The vehicle " . $faire[1] . " must go right.";}
					echo "<li>" . $liste[$p] . "</li>";		// affichage de la liste d'indices (qui forment la solution entière)
				}
				echo "</ol><br><br>";
				echo "<a class='bout cinquo' href='nivorien.php'>Back to the game... GOOD LUCK</a>";	
			}
		}
		?>
	</div>
<!-- _________________________________MISE EN PLACE D'UN DICTIONNAIRE : UN VEHICULE = UNE LETTRE___________________________________________-->

	<div class='dictionnaire'>
		<h6 class='titre'>Vehicle Dictionary</h6>
		<div id="accordion" style='margin: 4%;border:2px solid #4E4E4E;'>
			<div class="card">
				<div class="card-header" style='background-color: #4E4E4E;'>
						<a class="card-link" data-toggle="collapse" href="#collapseOne">Your red car</a>		<!-- La voiture rouge -->
				</div>
				<div id="collapseOne" class="collapse show" data-parent="#accordion">
					<div class="card-body">
						<?php
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
							echo "<p class='article'>X : <img class='vehi' src='image/".$debloc.".png'/></p>";
						}
						else
						{
							echo "<p class='article'>X : <img class='vehi' src='image/1X.L.png'/></p>";
						}
						?>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" style='background-color: #4E4E4E;'>
					<a class="card-link" data-toggle="collapse" href="#collapseTwo">Cars</a>		<!-- Les voitures -->
				</div>
				<div id="collapseTwo" class="collapse" data-parent="#accordion">
					<div class="card-body" style='padding:2% 8%;'>
						<p class='article'>A : <img class='vh' src='image/A.L.png'/>
						B : <img class='vh' src='image/B.L.png'>
						C : <img class='vh' src='image/C.L.png'/></p>
						<p class='article'>D : <img class='vh' src='image/D.L.png'/>
						E : <img class='vh' src='image/E.L.png'/>
						F : <img class='vh' src='image/F.L.png'/></p>
						<p class='article'>G : <img class='vh' src='image/G.L.png'/>
						H : <img class='vh' src='image/H.L.png'/>
						I : <img class='vh' src='image/I.L.png'/></p>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" style='background-color: #4E4E4E;'>
					<a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">Trucks</a>		<!-- Les camions -->
				</div>
				<div id="collapseThree" class="collapse" data-parent="#accordion">
					<div class="card-body" style='padding:2% 7%;'>
						<p class='article'>O : <img class='ch' src='image/O.L.png'/> P : <img class='ch' src='image/P.L.png'/></p>
						<p class='article'>Q : <img class='ch' src='image/Q.L.png'/> R : <img class='ch' src='image/R.L.png'/></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
</body>
</html>