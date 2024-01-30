<?php session_start();

if(isset($_POST['info']) && isset($_POST['levelname']) && isset($_POST['vehicule']))
{
	if(empty($_POST['levelname']))
	{
		die('name');
	}
	else
	{
		$file = fopen('test.txt','w');
		fwrite($file, $_POST['vehicule']);
		fwrite($file, "\n");
		fwrite($file, $_POST['info']);
		fclose($file);
		
		include('connexion.php');

		exec('solveur.exe');
		$source4="test.txt";		// récupération du fichier test.txt modifié par le solveur
		$fichier4=fopen($source4,"r+");
		if ($fichier4)
		{
			$recup=array();
			$i=0;
			while (!feof($fichier4))
			{
				$recup[$i] = fgets($fichier4);		// récupération ligne par ligne des données dans le fichier
				$i++;
			}
		}
		fclose($fichier4);
		$solution = str_split($recup[1]);		// récupération du code du placement final des véhicules dans le parking
		
		$tab = array(array());
		for ($u = 0; $u < 6; $u++)
		{
			$h = $u *6;
			for ($v = 0; $v < 6; $v++)
			{
				$tab[$u][$v] = $solution[$h+$v];		// transformation du code en tableau pour différencier les véhicules
			}
		}
		if($recup[2] != 0)
		{
			$coupjoue = $recup[2];
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
			$pseudodo = $_SESSION['pseudo'];
			$namename = $_POST['levelname'];
			
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
									$requete3 = "SELECT idNiveau, lettre_vehicule FROM niveau_cree WHERE idNiveau = $compte AND lettre_vehicule='".$tab[$u][$v]."'";
									$result3 = mysqli_query($link,$requete3);
									if ( $result3 == FALSE )		// en cas d'erreur 3
									{
										echo "Erreur d'exécution de la requete 3" ;
										die();
									}
									if(mysqli_num_rows($result3)==0)
									{
										$requete = "INSERT INTO niveau_cree VALUES ($compte,'".$namename."','created','".$pseudodo."','".$tab[$u][$v]."',3,$u,$v,'R')";
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
									$requete3 = "SELECT idNiveau, lettre_vehicule FROM niveau_cree WHERE idNiveau = $compte AND lettre_vehicule='".$tab[$u][$v]."'";
									$result3 = mysqli_query($link,$requete3);
									if ( $result3 == FALSE )		// en cas d'erreur 3
									{
										echo "Erreur d'exécution de la requete 3" ;
										die();
									}
									if(mysqli_num_rows($result3)==0)
									{
										$requete6 = "INSERT INTO niveau_cree VALUES ($compte,'".$namename."','created','".$pseudodo."','".$tab[$u][$v]."',3,$u,$v,'D')";
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
									$requete3 = "SELECT idNiveau, lettre_vehicule FROM niveau_cree WHERE idNiveau = $compte AND lettre_vehicule='".$tab[$u][$v]."'";
									$result3 = mysqli_query($link,$requete3);
									if ( $result3 == FALSE )		// en cas d'erreur 3
									{
										echo "Erreur d'exécution de la requete 3" ;
										die();
									}
									if(mysqli_num_rows($result3)==0)
									{
										$requete5 = "INSERT INTO niveau_cree VALUES ($compte,'".$namename."','created','".$pseudodo."','".$tab[$u][$v]."',2,$u,$v,'L')";
										$result5 = mysqli_query($link,$requete5);
										if ( $result5 == FALSE )		// en cas d'erreur 5
										{
											echo "Erreur d'exécution de la requete 5" ;
											die();
										}
									}
								}
							}
							if($u>0 && $v<6)
							{
								if($tab[$u][$v] == $tab[$u-1][$v])
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
										$requete4 = "INSERT INTO niveau_cree VALUES ($compte,'".$namename."','created','".$pseudodo."','".$tab[$u][$v]."',2,$u,$v,'U')";
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
			$_SESSION['newniv'] = 1;
			$_SESSION['numnewniv'] = $compte;
			die('solvent');
		}
		else
		{
			die('not solvent');
		}
	}
}
else
{
	die('A mistake has been made.');
}
?>