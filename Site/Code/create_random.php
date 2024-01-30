<?php
	include('connexion.php');
	session_start();
	$nbrvoiture = $_GET["nbrVoiture"];
	$nbrCamion = $_GET["nbrCamion"];
	$total=$nbrCamion+$nbrvoiture;
	if(($nbrvoiture==0) and ($nbrCamion==0)){
		header('Location:transition_create.php');
		die();
	}
	else if(($nbrvoiture + $nbrCamion) > 12){
		header('Location:transition_create.php');
		die();
	}
	else if(($nbrvoiture + $nbrCamion) < 5){
		header('Location:transition_create.php');
		die();
	}
	else{
		$nomNiv = $_GET["nomniv"];
		$file = fopen("generateur.txt", "w+");
		fwrite($file, "$nbrvoiture\n");
		fwrite($file, "$nbrCamion");
		fclose($file);
		exec('ConcepteurAleatorie.exe');
		$file = fopen("generateur.txt", "r");
		fgets($file);
		fgets($file);

		$solution = fgets($file);		// récupération du code du placement final des véhicules dans le parking
		$tab = array(array());
		for ($u = 0; $u < 6; $u++)
		{
			$h = $u *6;
			for ($v = 0; $v < 6; $v++)
			{
				$tab[$u][$v] = $solution[$h+$v];		// transformation du code en tableau pour différencier les véhicules
			}
		}

		$coupjoue = fgets($file);
		fclose($file);
		$requete2 = "SELECT ref FROM jeu";
		$result2 = mysqli_query($link,$requete2);
		if ( $result2 == FALSE )		// en cas d'erreur 2
		{
			echo "Erreur d'exécution de la requete 2" ;
			die();
		}
		$compte = mysqli_num_rows($result2)+1;
		
		$requete7 = "INSERT INTO jeu VALUES ($compte,'created',$coupjoue)";
		$result7 = mysqli_query($link,$requete7);
		if ( $result7 == FALSE )		// en cas d'erreur 7
		{
			echo "Erreur d'exécution de la requete 7" ;
			die();
		}
		
		
		for ($u = 0; $u < 6; $u++)
		{
			for ($v = 0; $v < 6; $v++)
			{
				if($tab[$u][$v] != 'W')
				{
					if($tab[$u][$v] == 'O' || $tab[$u][$v] == 'P' || $tab[$u][$v] == 'Q' || $tab[$u][$v] == 'R')
					{
						if($u<6 && $v<4)
						{
							if($tab[$u][$v] == $tab[$u][$v+2])
							{
								$requete3 = "SELECT idNIveau, lettre_vehicule FROM niveau_cree WHERE idNiveau = $compte AND lettre_vehicule='".$tab[$u][$v]."'";
								$result3 = mysqli_query($link,$requete3);
								if ( $result3 == FALSE )		// en cas d'erreur 3
								{
									echo "Erreur d'exécution de la requete 3" ;
									die();
								}
								if(mysqli_num_rows($result3)==0)
								{
									$requete = "INSERT INTO niveau_cree VALUES ($compte,'$nomNiv','created','".$_SESSION['pseudo']."','".$tab[$u][$v]."',3,$u,$v,'R')";
									$result = mysqli_query($link,$requete);
									if ( $result == FALSE )		// en cas d'erreur 
									{
										echo "Erreur d'exécution de la requete" ;
										die();
									}
								}
							}
						}
						if($u<4 && $v<6)
						{
							if($tab[$u][$v] == $tab[$u+2][$v])
							{
								$requete3 = "SELECT idNIveau, lettre_vehicule FROM niveau_cree WHERE idNiveau = $compte AND lettre_vehicule='".$tab[$u][$v]."'";
								$result3 = mysqli_query($link,$requete3);
								if ( $result3 == FALSE )		// en cas d'erreur 3
								{
									echo "Erreur d'exécution de la requete 3" ;
									die();
								}
								if(mysqli_num_rows($result3)==0)
								{
									$requete6 = "INSERT INTO niveau_cree VALUES ($compte,'$nomNiv','created','".$_SESSION['pseudo']."','".$tab[$u][$v]."',3,$u,$v,'D')";
									$result6 = mysqli_query($link,$requete6);
									if ( $result6 == FALSE )		// en cas d'erreur 6
									{
										echo "Erreur d'exécution de la requete 6" ;
										die();
									}
								}
							}
						}
					}
					else
					{
						if($u<6 && $v>0)
						{
							if($tab[$u][$v] == $tab[$u][$v-1])
							{
								$requete3 = "SELECT idNIveau, lettre_vehicule FROM niveau_cree WHERE idNiveau = $compte AND lettre_vehicule='".$tab[$u][$v]."'";
								$result3 = mysqli_query($link,$requete3);
								if ( $result3 == FALSE )		// en cas d'erreur 3
								{
									echo "Erreur d'exécution de la requete 3" ;
									die();
								}
								if(mysqli_num_rows($result3)==0)
								{
									$requete5 = "INSERT INTO niveau_cree VALUES ($compte,'$nomNiv','created','".$_SESSION['pseudo']."','".$tab[$u][$v]."',2,$u,$v,'L')";
									$result5 = mysqli_query($link,$requete5);
									if ( $result5 == FALSE )		// en cas d'erreur 5
									{
										echo "Erreur d'exécution de la requete 5" ;
										die();
									}
								}
							}
						}
						if($u<5 && $v<6)
						{
							if($tab[$u][$v] == $tab[$u+1][$v])
							{
								$requete3 = "SELECT idNIveau, lettre_vehicule FROM niveau_cree WHERE idNiveau = $compte AND lettre_vehicule='".$tab[$u][$v]."'";
								$result3 = mysqli_query($link,$requete3);
								if ( $result3 == FALSE )		// en cas d'erreur 3
								{
									echo "Erreur d'exécution de la requete 3" ;
									die();
								}
								if(mysqli_num_rows($result3)==0)
								{
									$requete4 = "INSERT INTO niveau_cree VALUES ($compte,'$nomNiv','created','".$_SESSION['pseudo']."','".$tab[$u][$v]."',2,$u,$v,'D')";
									$result4 = mysqli_query($link,$requete4);
									if ( $result4 == FALSE )		// en cas d'erreur 4
									{
										echo "Erreur d'exécution de la requete 4" ;
										die();
									}
								}
							}
						}
					}
				}
			}
		}
		$_SESSION['newniv']=1;
		$_SESSION['numnewniv']=$compte;
		header('location:all_levels.php');
	}
?>