<html>
<head>
	<title>Create</title>
	<meta name="viewport" content="wicth-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="create.css">
</head>

<body style='background-color: #eeeeee;'>
	<?php 
		include('entete.php');		// permet d'avoir la connexion au serveur, les liens bootstrap et le menu du haut de page
	?>
<!--____________________________PAGE QUI SERT DE TRANSITION AVANT DE CREER SON NIVEAU MANUEL OU ALEATOIRE______________________________________-->

<div>
	<div class='creation'>
		<ul class="nav nav-pills" role="tablist">		<!-- création de 2 onglets pour le choix -->
			<li class="nav-item">
				<a class="nav-link active" style='background:0;border:none;position:absolute;left:0;text-align:center;' data-toggle="tab" href="#home">
					<h6 class='create'>Manual Creation</h6>		<!-- onglet création manuelle -->
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" style='background:0;border:none;position:absolute;right:-8%;text-align:center;' data-toggle="tab" href="#menu1">
					<h6 class='create'>Random Creation</h6>		<!-- onglet création aléatoire -->
				</a>
			</li>
		</ul>
		<div class="tab-content">		<!-- contenu de l'onglet création manuelle -->
			<div id="home" class="container tab-pane active" style='margin:17% 2%;width:96%;font-family: Georgia, serif;'>
				<h4>Manual level creation allows you to express all your creativity!</h4><br>		<!-- explications de la creation manuelle -->
				<p>You will then have to <b>choose between all our models of trucks or cars and place them</b> one after the other in the location of your choice. However, some placement combinations are not playable... but don't worry, we're here to check that out!</p>
				<?php
					if(isset($_SESSION['pseudo']))		// si on est connecté un bouton d'accès s'affiche
					{
						echo "<a style='text-decoration:none;' href='create_manual.php'>
							<p style='text-decoration:none; margin-left:65%; color:white; background-color:#05A693; width:32%; padding-top:1%; padding-bottom:1%; border:none; border-radius:10px;'>
								<i style='padding-left:8%;'>Let your imagination run wild</i>
							</p>
						</a>";
					}
					else		// si on n'est pas connecté un texte s'affiche car il faut être connecté
					{
						echo "<p style='width: 250px;position:absolute;left:70%;bottom:2%;'>
							<i>Don't forget that level creation is only possible if you are logged in... so log in or register now!</i>
						</p>";
					}
				?>
			</div>		<!-- contenu de l'onglet création aléatoire -->
			<div id="menu1" class="container tab-pane fade" style='margin:17% 2%;width:96%;font-family: Georgia, serif;'>
				<h4>Equally efficient, random level creation is also faster.</h4>		<!-- explications de la création aléatoire -->
				<p>Simply <b>determine how many vehicles you want in your car park</b>, find a nice name for it and ... you're done! It can take some time so please wait a little. You may be redirected to this page because you don't have enough vehicles in your level: we ask for between 5 and 12 vehicles (cars and trucks combined).</p>
					<div class="row" style="display:inline-block;">
						<form action="create_random.php" style="width:100%" method="get">
							<div class="col-lg-12" style="display:inline-block;">
								<select name="nbrVoiture" class="form-control" style='margin-bottom:10px;' required>
									<option value="">--Please choose your number of cars--</option>
									<option value="0">0 car</option>
									<option value="1">1 car</option>
									<option value="2">2 cars</option>
									<option value="3">3 cars</option>
									<option value="4">4 cars</option>
									<option value="5">5 cars</option>
									<option value="6">6 cars</option>
									<option value="7">7 cars</option>
									<option value="8">8 cars</option>
									<option value="9">9 cars</option>
									<option value="10">10 cars</option>
									<option value="11">11 cars</option>
								</select>
								<select name="nbrCamion" class="form-control" style="padding-right:1.2rem;" required>
									<option value="">--Please choose your number of trucks--</option>
									<option value="0">0 truck</option>
									<option value="1">1 truck</option>
									<option value="2">2 trucks</option>
									<option value="3">3 trucks</option>
									<option value="4">4 trucks</option>
								</select>
							</div>
							<input type="text" class="form-control" id="nomniv" style='position:absolute; width: 43%; right: 4%;bottom:16.5%;' placeholder="Name of your level" name="nomniv" required>
							
				<?php
					if(isset($_SESSION['pseudo']))		// si on est connecté un bouton d'accès s'affiche
					{
						echo "<div style='margin-left:155%; color:white; background-color:#05A693; width:37%; padding-top:2%; padding-bottom:2%; border:none; border-radius:10px; margin-top:-9%;'>
						<button style='text-decoration:none; margin-left:8%; color:white; background-color:#05A693; border:none;' type='submit' onclick='EnAttente()' id='load'><i>May the chance be with you</i></button>
						</div>
						</form>";
					}
					else		// si on n'est pas connecté un texte s'affiche car il faut être connecté
					{

						echo "
						</form>
						<p style='width: 340px;position:absolute;left:55%;top:85%;'>
							<i>Don't forget that level creation is only possible if you are logged in... so log in or register now!</i>
						</p>";
					}
				?>
					</div>
			</div>
		</div>
	</div>
</div>
	
	<script>
		function EnAttente()
		{
			document.getElementById("load").innerHTML = "Loading...";
		}
	</script>

</body>
</html>