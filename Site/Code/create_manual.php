<?php 
		include('entete.php');		// permet d'avoir la connexion au serveur et le menu du haut de page
	?>
<html>
<head>
	<title>Create</title>
	<meta name="viewport" content="wicth-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="create.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
<!-- _____________________________________________PAGE POUR CREER UN NIVEAU DE MANIERE MANUELLE__________________________________________-->

<div style='height:880px; background-color: #eeeeee;'>
	<div class='jeu' id='ici'>
		<ul class="nav nav-pills" role="tablist">		<!-- création de deux onglets dans la page -->
			<li class="nav-item">		<!-- onglet pour créer le niveau -->
				<a class="nav-link active" style='background:0;border:none;' data-toggle="tab" href="#home">
					<h6 class='jeu1'>LET'S CREATE !!</h6>
				</a>
			</li>
			<li class="nav-item">		<!-- onglet pour donnner des conseils : les cas basiques refusés pour le solver car impossibles -->
				<a class="nav-link" style='background:0;border:none;color:black;position:absolute;right:0;' data-toggle="tab" href="#menu1">
					<img src='image/ampoule.png'>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="home" class="container tab-pane active"><br>		<!-- contenu de l'onglet création -->
				<form>		<!-- demande du nom du nouveau niveau -->
					<input type="text" placeholder="Name of your level" style='box-shadow: 0 17px 21px 0 rgba(0,0,0,0.24), 0 22px 55px 0 rgba(0,0,0,0.19);font-family: Georgia, serif; position: absolute; top:15%;left:31%;z-index:7;width:39%;height:6%;' class="form-control" id="pseudo" name="pseudo" value="" required>
				</form>
				<?php
					include('drag_and_drop.php');		// fichier contenant le js pour glisser et déposer les véhicules
					
					echo "<table class='fond'>";
						echo "<tbody>";		// création du fond gris derriere le jeu
							for($i=0;$i<6;$i++)
							{
								echo "<tr>";
								for($j=0;$j<6;$j++) { echo "<th></th>";	}
								echo "</tr>";
							}
						echo "</tbody>";
					echo "</table>";
					
					echo "<table class='sol'>";
						echo "<tbody>";		// création du parking avec les places aux bords blancs
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
					
					echo "<table class='sortie'></table>";		// création de la sortie au milieu a droitee
					echo "<table class='point'></table>";
				?>
				<p style='color:#606060;font-family: Georgia, serif;font-size:0.9rem;margin-top:86%;text-align:center;'>When you have finished,<br>and only if you are satisfied with yourself,<br>click here :</p>
				<form method='post' action=''>
					<input type="submit" name="test" id="test" class="bout" value="Test the level">
				</form>
			</div>
			<div id="menu1" class="container tab-pane fade" style='margin:8% 2%;width:96%;font-family:Georgia, serif;'><br>
				<h3>A few recommendations...</h3>		<!-- le contenu de l'onglet conseil -->
				<p>You can try to create your custom level but <b>BE CAREFUL</b> : some are impossible to solve. We will let you know.<br><br>
				Here are some combinations to avoid:<br></p>
				<p style='width:80%;'>First of all, the most important thing: <b>DON'T FORGET YOUR RED CAR !</b>
				And place it on the 3rd line from the top.<br></p>
				<img src='image/1X.L.png' style='position:absolute;top:29%;right:4%'>
				<img src='image/cas1.png' style='width:110px;height:110px;position:absolute;top:43%;left:4%'>
				<p style='position:absolute;top:44%;right:2%;width:76%'>In addition, do not position a vehicle horizontally between your red car and the exit.<br></p>
				<p style='position:absolute;top:52%;left:22%;width:58%'>Also do not create a column with 2 vertical trucks, 3 cars or 1 truck and then underneath a car between your red car and the exit.<br></p>
				<img src='image/cas2.png' style='width:110px;height:110px;position:absolute;top:49%;right:4%;'>
				<img src='image/cas3.png' style='width:110px;height:110px;position:absolute;top:62%;left:4%;'>
				<p style='position:absolute;top:64%;right:2%;width:76%'>Another slightly more complex malfunction is if you position a vertical truck in the upper 
				part of the car park and fill a line in the lower part (2 trucks, 3 cars or even 1 car and 1 truck depending on their positioning). 
				This would also block the game.</p>
				<h3 style='position:absolute;top:74%;left:4%;'><br>A last point...</h3>
				<p style='position:absolute;top:84%;left:4%;width:92%;'>If you want to change the position of an already positioned vehicle, simply select it again in the car bank and replace it. The old position will be deleted automatically.<br>
				Be also careful because when you select a vehicle your mouse represents the <b>TOP LEFT CORNER</b> of the vehicle so you have to place the vehicle with this in mind.</p>
			</div>
		</div>
	</div>
</div>
<script src="drag_and_drop.js"></script>

</body>
</html>