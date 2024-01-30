<?php include('entete.php'); ?>
<html>
<head>
	<title>Play</title>
	<meta name="viewport" content="wicth-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="play.css">
</head>

<body style='background-color: #eeeeee;'>
	<?php
			// permet d'avoir la connexion au serveur et le menu du haut de page
		if (isset($_SESSION['error'])) { $_SESSION['error']=0; }
		if(isset($_POST['reset']))		// suppression des données du jeu si la partie a été quitté avant la fin
		{
			$requete4 = "DELETE FROM niveau_en_cours";
			$result4 = mysqli_query($link,$requete4);
			if ( $result4 == FALSE )		// en cas d'erreur 4
			{
				echo "Erreur d'exécution de la requete 4" ;
				die();
			}
			if(isset($_SESSION['vehi'])) { unset($_SESSION['vehi']); }
			if(isset($_SESSION['nbreCoup'])) { unset($_SESSION['nbreCoup']); }
			if(isset($_SESSION['copie'])) { unset($_SESSION['copie']); }
		}
		if(isset($_POST['resteafaire']))
		{
			$requete4 = "DELETE FROM niveau_en_cours";		// suppression des données du jeu avant la nouvelle partie
			$result4 = mysqli_query($link,$requete4);
			if ( $result4 == FALSE )		// en cas d'erreur 4
			{
				echo "Erreur d'exécution de la requete 4" ;
				die();
			}
			$_SESSION['numero']=$_POST['resteafaire'];
			if(isset($_SESSION['copie'])) { unset($_SESSION['copie']); }
			if(isset($_SESSION['vehi'])) { unset($_SESSION['vehi']); }
			if(isset($_SESSION['nbreCoup'])) { unset($_SESSION['nbreCoup']); }
		}
		if(isset($_POST['here']))
		{
			$requete4 = "DELETE FROM niveau_en_cours";		// suppression des données du jeu avant la nouvelle partie
			$result4 = mysqli_query($link,$requete4);
			if ( $result4 == FALSE )		// en cas d'erreur 4
			{
				echo "Erreur d'exécution de la requete 4" ;
				die();
			}
			$_SESSION['numero']=$_POST['here'];
			if(isset($_SESSION['copie'])) { unset($_SESSION['copie']); }
			if(isset($_SESSION['vehi'])) { unset($_SESSION['vehi']); }
			if(isset($_SESSION['nbreCoup'])) { unset($_SESSION['nbreCoup']); }
		}
		include('requete.php');		// permet d'avoir les requetes et les variables de SESSION
	?>
<!--_____________________________________________________PAGE QUI POSE LE CADRE DU JEU____________________________________________________-->

<div>
<div class='jeu' id='ici'>
		<ul class="nav nav-pills" role="tablist">		<!-- création de deux onglets dans la page -->
			<li class="nav-item">		<!-- onglet pour jouer -->
				<a class="nav-link active" style='background:0;border:none;' data-toggle="tab" href="#home">
					<h6 class='jeu2'>LET'S PLAY !!</h6>
				</a>
			</li>
			<li class="nav-item">		<!-- onglet pour donnner les accès clavier au jeu -->
				<a class="nav-link" style='background:0;border:none;color:black;position:absolute;right:0;' data-toggle="tab" href="#menu1">
					<img src='image/ampoule.png'>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="home" class="container tab-pane active"><br>		<!-- contenu de l'onglet création -->
				<div class='carre rules'>
					<h6 class='titre'>Rules</h6>		<!-- carré qui affiche les règles du jeu -->
					<p class='paragraphe'>
						<strong>The target:</strong> You goal is to drive the red car to the exit. <br><br>
						Move the vehicules up and down, right and left… but stay in the grid. <br><br>
						<strong>How to play:</strong> You just have to click on the vehicle you want to move and then click on the arrow in the direction you want to  move. If you want to play with the keyboard, click on the light bulb.<br><br>
						<strong>If you're stuck:</strong> If you find yourself hopelessly gridlocked, just reset. You can also ask for a hint in order to try to unlock yourself. <br><br>
						<strong>If your brain stalls:</strong> The complete solution for each challenge is available.
					</p>
				</div>
				<div class='carre help'>
					<h6 class='titre'>Help</h6>		<!-- carré qui affiche les aides si le joueur est bloqué -->
					<p class='paragraphe'>
						Are you stuck? We can give you a hint if you need it, click here to get the next move to execute! <br><br>
						You prefer to see the whole solution... we can give it to you too.<br><br><br>
						If you want to restart the level
					</p>
					<form action='cadre.php' method='post'>
						<input type='submit' name='jsp' class='bout pr' value='The clue is waiting for you'>		<!-- bouton indice relié au solveur -->
						<input type='submit' name='jsp' class='bout de' value='The solution'>		<!-- bouton solution relié au solveur -->
					</form>
					<form method='post' action='nivorien.php'>
						<input type='submit' name='reset' class='bout tr' value='Reset'>		<!-- bouton qui recommence le jeu -->
					</form>
				</div>
				
			</div>
			<div id="menu1" class="container tab-pane fade" style='margin:8% 2%;width:96%;font-family: Georgia, serif;'><br>
				<div class='dico'>
					<p style='padding:3%'>If you want to play with the keys of your keyboard, you can! but <b>WARNING</b> only the capital keys work. Use the arrows to move the vehicles and here are the codes to select the vehicle of your choice :</p>
					<h6 class='titre'>The Vehicle Dictionary</h6>
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
									<p class='article'>A : <img class='vh' src='image/A.L.png'/>B : <img class='vh' src='image/B.L.png'></p>
									<p class='article'>C : <img class='vh' src='image/C.L.png'/>D : <img class='vh' src='image/D.L.png'/></p>
									<p class='article'>E : <img class='vh' src='image/E.L.png'/>F : <img class='vh' src='image/F.L.png'/></p>
									<p class='article'>G : <img class='vh' src='image/G.L.png'/>H : <img class='vh' src='image/H.L.png'/></p>
									<p class='article'>I : <img class='vh' src='image/I.L.png'/></p>
								</div>
							</div>
						</div>
						<div class="card">
							<div class="card-header" style='background-color: #4E4E4E;'>
								<a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">Trucks</a>		<!-- Les camions -->
							</div>
							<div id="collapseThree" class="collapse" data-parent="#accordion">
								<div class="card-body" style='padding:2% 7%;'>
									<p class='article'>O : <img class='ch' src='image/O.L.png'/></p>
									<p class='article'> P : <img class='ch' src='image/P.L.png'/></p>
									<p class='article'>Q : <img class='ch' src='image/Q.L.png'/></p>
									<p class='article'> R : <img class='ch' src='image/R.L.png'/></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php
			if(!isset($_SESSION['sound'])) { $_SESSION['sound'] = 'on'; }
			if(isset($_SESSION['sound']))
			{
				if(isset($_POST['sound'])) { $_SESSION['sound'] = $_POST['sound']; }
				echo "<form method='POST' action='nivorien.php#ici'>";
				if($_SESSION['sound']=='on')
				{ 
					echo "<button type='submit' class='btn bout btn-sound' name='sound' value='off'><i class='fa fa-volume-up' aria-hidden='true'></i></button>";
				}
				else
				{
					echo "<button type='submit' class='btn bout btn-sound' name='sound' value='on'><i class='fa fa-volume-off' aria-hidden='true'></i></button>";
				}
			}
			echo "</form>";
			echo "<table class='fond'>";
				echo "<tbody>";		// création du fond gris derrière le jeu
					for($i=0;$i<6;$i++)
					{
						echo "<tr>";
						for($j=0;$j<6;$j++)
						{
							echo "<th></th>"; 
						}
						echo "</tr>";
					}
				echo "</tbody>";
			echo "</table>";
			
			echo "<table class='sol'>";
				echo "<div style='z-index:6;color: white;font-family: Georgia, serif;position:absolute;top:15%;left:44%;font-size:200%;'>Level : ".$_SESSION['numero']."</div>";
				echo "<div style='z-index:6;color: white;font-family: Georgia, serif;position:absolute;top:83%;left:69%;'>Moves : ".$_SESSION['nbreCoup']."</div>";
				echo "<tbody>";		// création du parking avec les carrés aux bords blancs
					for($i=0;$i<3;$i++)
					{
						echo "<tr>";
						echo "<th class='parking hg'></th><th class='parking hg'></th><th class='parking hg'></th>";
						echo "<th class='parking hd'></th><th class='parking hd'></th><th class='parking hd'></th>";
						echo "</tr>";
					}
					for($i=3;$i<6;$i++)
					{
						echo "<tr>";
						echo "<th class='parking bg'></th><th class='parking bg'></th><th class='parking bg'></th>";
						echo "<th class='parking bd'></th><th class='parking bd'></th><th class='parking bd'></th>";
						echo "</tr>";
					}
				echo "</tbody>";
			echo "</table>";
			
			echo "<table class='sortie'></table>";		// création de la sortie au milieu à droite
			echo "<table class='point'></table>";
		?>
</div>

</body>
</html>