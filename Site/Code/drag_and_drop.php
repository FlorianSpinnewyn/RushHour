<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Drag and Drop</title>
	<link rel="stylesheet" href="drag_and_drop.css">
</head>

<body>
<!--______________________________________ACCORDEON AVEC TOUS LES VEHICULES_________________________________________________-->
	<div class='banque'>		
		<h6 class='titre'>Car bank</h6>
		<div id="accordion" style='margin: 4%;border:2px solid #4E4E4E;'>
		<div class="card">
				<div class="card-header" style='background-color: #4E4E4E;'>
					<a class="card-link" data-toggle="collapse" href="#collapseOne">Your red car</a>
				</div>
				<div id="collapseOne" class="collapse show" data-parent="#accordion">
					<div class="card-body">
						<?php
						$requete = "SELECT voitureRouge FROM joueurs WHERE pseudo = '".$_SESSION['pseudo']."'";
						$result = mysqli_query($link,$requete);
						if ( $result == FALSE )		// en cas d'erreur
						{
							echo "Erreur d'exécution de la requete" ;
							die();
						}
						$row = mysqli_fetch_assoc($result);
						$debloc = $row['voitureRouge'];
						echo "<img class='voiturerouge' draggable='true' id='X' src='image/".$debloc.".png'/>";
						?>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" style='background-color: #4E4E4E;'>
					<a class="card-link" data-toggle="collapse" href="#collapseTwo">Horizontal cars</a>
				</div>
				<div id="collapseTwo" class="collapse" data-parent="#accordion">
					<div class="card-body" style='padding:2% 8%;'>
						<img class='vh' draggable="true" id="A" src='image/A.L.png'/>
						<img class='vh' draggable="true" id="B" src='image/B.L.png'/>
						<img class='vh' draggable="true" id="C" src='image/C.L.png'/>
						<img class='vh' draggable="true" id="D" src='image/D.L.png'/>
						<img class='vh' draggable="true" id="E" src='image/E.L.png'/>
						<img class='vh' draggable="true" id="F" src='image/F.L.png'/>
						<img class='vh' draggable="true" id="G" src='image/G.L.png'/>
						<img class='vh' draggable="true" id="H" src='image/H.L.png'/>
						<img class='vh' draggable="true" id="I" src='image/I.L.png'/>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" style='background-color: #4E4E4E;'>
					<a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">Vertical cars</a>
				</div>
				<div id="collapseThree" class="collapse" data-parent="#accordion">
					<div class="card-body" style='padding:2% 15%;'>
						<img class='vv' draggable="true" id="A" src='image/A.U.png'/>
						<img class='vv' draggable="true" id="B" src='image/B.U.png'/>
						<img class='vv' draggable="true" id="C" src='image/C.U.png'/>
						<img class='vv' draggable="true" id="D" src='image/D.U.png'/>
						<img class='vv' draggable="true" id="E" src='image/E.U.png'/>
						<img class='vv' draggable="true" id="F" src='image/F.U.png'/>
						<img class='vv' draggable="true" id="G" src='image/G.U.png'/>
						<img class='vv' draggable="true" id="H" src='image/H.U.png'/>
						<img class='vv' draggable="true" id="I" src='image/I.U.png'/>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" style='background-color: #4E4E4E;'>
					<a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">Horizontal trucks</a>
				</div>
				<div id="collapseFour" class="collapse" data-parent="#accordion">
					<div class="card-body" style='padding:2% 7%;'>
						<img class='ch' draggable="true" id="O" src='image/O.R.png'/>
						<img class='ch' draggable="true" id="P" src='image/P.R.png'/>
						<img class='ch' draggable="true" id="Q" src='image/Q.R.png'/>
						<img class='ch' draggable="true" id="R" src='image/R.R.png'/>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header" style='background-color: #4E4E4E;'>
					<a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">Vertical trucks</a>
				</div>
				<div id="collapseFive" class="collapse" data-parent="#accordion">
					<div class="card-body" style='padding:2% 23%;'>
						<img class='cv' draggable="true" id="O" src='image/O.D.png'/>
						<img class='cv' draggable="true" id="P" src='image/P.D.png'/>
						<img class='cv' draggable="true" id="Q" src='image/Q.D.png'/>
						<img class='cv' draggable="true" id="R" src='image/R.D.png'/>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--___________________________________LES 4 ZONES DE DEPOTS DIFFERENTES_____________________________________________________-->
<!--_______________________________________VOITURE A L'HORIZONTALE___________________________________________________________-->
<div class="zoneentierevh ligne1">		<!--première ligne pour déposer des voitures horizontales-->
	<div class="zoneimagevh colonne1">		<!--première case de cette ligne, elle correspond à la taille que la voiture prendra (2 cases)-->
		<div class="zonedropvh"></div>		<!--la case où l'on peut déposer la voiture-->
	</div>
	<div class="zoneimagevh colonne2">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne3">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne4">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne5">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne6 impossible">		<!--sixième case de cette ligne où il est impossible de déposer une voiture horizontale car elle sortirait du parking-->
		<div class="zonedropvh"></div>
	</div>
</div>
<div class="zoneentierevh ligne2">		<!--deuxième ligne pour déposer des voitures horizontales-->
	<div class="zoneimagevh colonne1">		
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne2">		
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne3">		
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne4">		
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne5">		
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne6 impossible">
		<div class="zonedropvh"></div>
	</div>
</div>
<div class="zoneentierevh ligne3">		<!--troisième ligne pour déposer des voitures horizontales-->
	<div class="zoneimagevh colonne1">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne2">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne3">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne4">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne5">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne6 impossible">
		<div class="zonedropvh"></div>
	</div>
</div>
<div class="zoneentierevh ligne4">		<!--quatrième ligne pour déposer des voitures horizontales-->
	<div class="zoneimagevh colonne1">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne2">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne3">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne4">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne5">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne6 impossible">
		<div class="zonedropvh"></div>
	</div>
</div>
<div class="zoneentierevh ligne5">		<!--cinquième ligne pour déposer des voitures horizontales-->
	<div class="zoneimagevh colonne1">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne2">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne3">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne4">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne5">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne6 impossible">
		<div class="zonedropvh"></div>
	</div>
</div>
<div class="zoneentierevh ligne6">		<!--sixième ligne pour déposer des voitures horizontales-->
	<div class="zoneimagevh colonne1">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne2">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne3">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne4">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne5">
		<div class="zonedropvh"></div>
	</div>
	<div class="zoneimagevh colonne6 impossible">
		<div class="zonedropvh"></div>
	</div>
</div>
<!--_______________________________________VOITURE A LA VERTICALE___________________________________________________________-->
<div class="zoneentierevv colonn1">		<!--première colonne pour déposer des voitures verticales-->
	<div class="zoneimagevv lign1">		<!--première case de cette colonne, elle correspond à la taille que la voiture prendra (2 cases)-->
		<div class="zonedropvv"></div>		<!--la case où l'on peut déposer la voiture-->
	</div>
	<div class="zoneimagevv lign2">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign3">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign4">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign5">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign6 impossible">		<!--sixième case de cette colonne où il est impossible de déposer une voiture verticale car elle sortirait du parking-->
		<div class="zonedropvv"></div>
	</div>
</div>
<div class="zoneentierevv colonn2">		<!--deuxième colonne pour déposer des voitures verticales-->
	<div class="zoneimagevv lign1">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign2">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign3">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign4">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign5">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign6 impossible">
		<div class="zonedropvv"></div>
	</div>
</div>
<div class="zoneentierevv colonn3">		<!--troisième colonne pour déposer des voitures verticales-->
	<div class="zoneimagevv lign1">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign2">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign3">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign4">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign5">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign6 impossible">
		<div class="zonedropvv"></div>
	</div>
</div>
<div class="zoneentierevv colonn4">		<!--quatrième colonne pour déposer des voitures verticales-->
	<div class="zoneimagevv lign1">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign2">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign3">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign4">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign5">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign6 impossible">
		<div class="zonedropvv"></div>
	</div>
</div>
<div class="zoneentierevv colonn5">		<!--cinquième colonne pour déposer des voitures verticales-->
	<div class="zoneimagevv lign1">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign2">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign3">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign4">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign5">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign6 impossible">
		<div class="zonedropvv"></div>
	</div>
</div>
<div class="zoneentierevv colonn6">		<!--sixième colonne pour déposer des voitures verticales-->
	<div class="zoneimagevv lign1">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign2">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign3">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign4">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign5">
		<div class="zonedropvv"></div>
	</div>
	<div class="zoneimagevv lign6 impossible">
		<div class="zonedropvv"></div>
	</div>
</div>
<!--_______________________________________CAMION A L'HORIZONTALE___________________________________________________________-->
<div class="zoneentierech lig1">		<!--première ligne pour déposer des camions horizontaux-->
	<div class="zoneimagech col1">		<!--première case de cette ligne, elle correspond à la taille que le camion prendra (3 cases)-->
		<div class="zonedropch"></div>		<!--la case où l'on peut déposer le camion-->
	</div>
	<div class="zoneimagech col2">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col3">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col4">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col5 impossible">		<!--cinquième case de cette ligne où il est impossible de déposer un camion horizontal car il sortirait du parking-->
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col6 impossible">		<!--sixième case de cette ligne où il est impossible de déposer un camion horizontal car il sortirait du parking-->
		<div class="zonedropch"></div>
	</div>
</div>
<div class="zoneentierech lig2">		<!--deuxième ligne pour déposer des camions horizontaux-->
	<div class="zoneimagech col1">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col2">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col3">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col4">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col5 impossible">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col6 impossible">
		<div class="zonedropch"></div>
	</div>
</div>
<div class="zoneentierech lig3">		<!--troisième ligne pour déposer des camions horizontaux-->
	<div class="zoneimagech col1">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col2">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col3">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col4">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col5 impossible">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col6 impossible">
		<div class="zonedropch"></div>
	</div>
</div>
<div class="zoneentierech lig4">		<!--quatrième ligne pour déposer des camions horizontaux-->
	<div class="zoneimagech col1">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col2">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col3">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col4">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col5 impossible">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col6 impossible">
		<div class="zonedropch"></div>
	</div>
</div>
<div class="zoneentierech lig5">		<!--cinquième ligne pour déposer des camions horizontaux-->
	<div class="zoneimagech col1">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col2">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col3">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col4">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col5 impossible">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col6 impossible">
		<div class="zonedropch"></div>
	</div>
</div>
<div class="zoneentierech lig6">		<!--sixième ligne pour déposer des camions horizontaux-->
	<div class="zoneimagech col1">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col2">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col3">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col4">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col5 impossible">
		<div class="zonedropch"></div>
	</div>
	<div class="zoneimagech col6 impossible">
		<div class="zonedropch"></div>
	</div>
</div>
<!--_______________________________________CAMION A LA VERTICALE_____________________________________________________________-->
<div class="zoneentierecv co1">		<!--première colonne pour déposer des camions verticaux-->
	<div class="zoneimagecv li1">		<!--première case de cette colonne, elle correspond à la taille que le camion prendra (3 cases)-->
		<div class="zonedropcv"></div>		<!--la case où l'on peut déposer le camion-->
	</div>
	<div class="zoneimagecv li2">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li3">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li4">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li5 impossible">		<!--cinquième case de cette colonne où il est impossible de déposer un camion vertical car il sortirait du parking-->
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li6 impossible">		<!--sixième case de cette colonne où il est impossible de déposer un camion vertical car il sortirait du parking-->
		<div class="zonedropcv"></div>
	</div>
</div>
<div class="zoneentierecv co2">		<!--deuxième colonne pour déposer des camions verticaux-->
	<div class="zoneimagecv li1">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li2">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li3">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li4">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li5 impossible">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li6 impossible">
		<div class="zonedropcv"></div>
	</div>
</div>
<div class="zoneentierecv co3">		<!--troisième colonne pour déposer des camions verticaux-->
	<div class="zoneimagecv li1">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li2">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li3">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li4">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li5 impossible">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li6 impossible">
		<div class="zonedropcv"></div>
	</div>
</div>
<div class="zoneentierecv co4">		<!--quatrième colonne pour déposer des camions verticaux-->
	<div class="zoneimagecv li1">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li2">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li3">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li4">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li5 impossible">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li6 impossible">
		<div class="zonedropcv"></div>
	</div>
</div>
<div class="zoneentierecv co5">		<!--cinquième colonne pour déposer des camions verticaux-->
	<div class="zoneimagecv li1">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li2">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li3">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li4">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li5 impossible">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li6 impossible">
		<div class="zonedropcv"></div>
	</div>
</div>
<div class="zoneentierecv co6">		<!--sixième colonne pour déposer des camions verticaux-->
	<div class="zoneimagecv li1">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li2">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li3">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li4">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li5 impossible">
		<div class="zonedropcv"></div>
	</div>
	<div class="zoneimagecv li6 impossible">
		<div class="zonedropcv"></div>
	</div>
</div>
</body>
</html>