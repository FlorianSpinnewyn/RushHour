var grille = new Array();		//on créé un tableau de 36 cases (6*6) qui contiendra pour chaque case la lettre du véhicule qui a été déposé à cet endroit du parking
for(var i=0; i<6; i++)
{
	grille[i] = new Array();
}
for(var i=0; i<6; i++)
{
	for(var j=0; j<6; j++)
	{
		grille[i][j] = 'W';		//on l'initialize avec des 'W' qui correspond à une case vide
	}
}
var nbvehicule = 0;		//variable qui sert à compter le nombre de véhicule déposé sur le parking (on ne compte pas la voiture rouge)
//_________________________________________ON ENVOIE LE NIVEAU AU SOLVEUR_______________________________________________________
$('#test').click(function(e){		//quand on clique sur le bouton 'Test the level'
	var chaine='';
	e.preventDefault();
	var valeur = document.querySelector('#test');
	valeur.value = 'Loading...';		//on écrit loading sur le bouton pour faire comprendre à l'utilisateur qu'il doit patienter
	var namelevel = document.querySelector('#pseudo').value;		//on récupére ce que l'utilisateur à écrit pour le nom du niveau
	for(var s=0; s<6; s++)
	{
		for(var t=0; t<6; t++)
		{
			chaine = chaine+grille[s][t];		//on fait une chaine de caractère avec les lettres qui sont écrites dans le tableau
		}
	}
	$.post('niveau_cree.php', {	info: chaine, levelname: namelevel, vehicule: nbvehicule })		//requête post avec Ajax, on exécute la page niveau_cree.php en lui donnant : $_POST['info'] (la chaine de caractère représentant le niveau), $_POST['levelname'] (le nom du niveau), $_POST['vehicule'] (le nombre de véhicules)
		.done(function(data, text, jqxhr) {		//s'il n'y a pas eu d'erreur lors de la requête
			if(jqxhr.responseText === 'name')		//si la page niveau_cree.php a renvoyé 'name'
			{
				alert('You must enter a name for the created level.');
			}
			else		//sinon (le nom du niveau a bien été entré)
			{
				if(jqxhr.responseText === 'solvent')		//si la page a renvoyé 'solvent' (le niveau est solvable et il a bien été intégré dans la bas de données
				{
					document.location.href="all_levels.php";		//on redirige sur la page 'all_levels'
				}
				else		//sinon, le niveau n'est pas solvable
				{
					alert('Your level is impossible to solve. Please try with another configuration.');
				}
			}
		})
		.fail(function(jqxhr){		//s'il y a eu une erreur lors de la requête
			alert(jqxhr.responseText);
		})
		.always(function(jqxhr){		//quand la requête est finie, on enlève le 'Loading' sur le bouton
			valeur.value = 'Test the level';
		})
});
//______________________________________________INITIALISATION DES VEHICULES DEPLACABLES________________________________________
voiturerouge = document.querySelector('.voiturerouge');		//on sélectionne l'image de la voiture rouge
voiturerouge.addEventListener('dragstart', DragStart);		//on lui ajoute les evenement dragstart et dragend pour qu'elle puisse se déplacer, ces événements déclencheront les fonctions DragStart et DragEnd
voiturerouge.addEventListener('dragend', DragEnd);
[].forEach.call(document.querySelectorAll('.vh'), Draggable); 		//on créer une liste avec toutes le voitures horizontales et pour chaque élément de la liste on fait la fonction Draggable
[].forEach.call(document.querySelectorAll('.vv'), Draggable);		//même chose avec les voitures verticales
[].forEach.call(document.querySelectorAll('.ch'), Draggable);		//même chose avec les camions horizontaux
[].forEach.call(document.querySelectorAll('.cv'), Draggable);		//même chose avec les camions verticaux

//__________________________________________________FONCTION DRAGGABLE__________________________________________________________
function Draggable(elem)		//fonction qui ajoute les deux événements permettant de déplacer une image
{
	elem.addEventListener('dragstart', DragStart, false);		//quand on commence à déplacer un véhicule
	elem.addEventListener('dragend', DragEnd, false);		//quand on lache le véhicule (qu'il soit déposer dans une zone ou non)
}	
//__________________________________________________FONCTION DROPPABLE__________________________________________________________
function Droppable(elem) {		//fonction qui ajoute les quatre événements liés aux zones où l'on peut déposer un véhicule
	if(!(elem.parentElement.classList.contains('drop')) && !(elem.parentElement.classList.contains('tmpbloque')) && !(elem.parentElement.classList.contains('impossible'))) //s'il y a un véhicule sur la case ou que déposer un véhicule entraînerait une superposition ou une sortie du parking, alors on ne peut pas déposer dans cette zone
	{
		elem.parentElement.parentElement.classList.add('devant');
		elem.addEventListener('dragover', DragOver);		//quand on survole la zone
		elem.addEventListener('dragenter', DragEnter);		//quand on entre dans la zone
		elem.addEventListener('dragleave', DragLeave);		//quand on sort de la zone
		elem.addEventListener('drop', Drop);		//quand on dépose quelque chose dans la zone
	}
}
//___________________________________________________FONCTION DRAGSTART_________________________________________________________
function DragStart(event)		//fonction qui se déclenche quand un élément déplaçable commence à être déplacé
{
	var id = event.target.id;		//on récupère l'id de l'élément que l'on déplace
	var idelem = '#'+id;
	[].forEach.call(document.querySelectorAll(idelem), function(e)		//pour chaque élément qui a le même id que l'élément qu'on déplace
	{
		if(e.classList.contains('place'))		//si c'est un élément qui est déjà placé, on est donc en train de reprendre un élément déjà placé, on veut donc le replacer
		{
			e.parentElement.classList.remove('drop');		//on enlève les classes qui permettaient de dire que l'élément avait été déplacé
			e.parentElement.nextElementSibling.classList.remove('drop');
			e.remove();		//on supprime l'élément lui-même
			for(var i=0; i<6; i++)		//on va ensuite enlever toutes les traces de cet élément (dans les autres zones de dépôt, dans le tableau,...
			{
				for(var j=0; j<6; j++)
				{
					if(grille[i][j] === id)
					{
						grille[i][j] = 'W';
						var ligne1 = '.ligne'+(i+1);
						var ligne2 = 'lign'+(i+1);
						var ligne3 = '.lig'+(i+1);
						var ligne4 = 'li'+(i+1);
						var colonne1 = 'colonne'+(j+1);
						var colonne2 = '.colonn'+(j+1);
						var colonne3 = 'col'+(j+1);
						var colonne4 = '.co'+(j+1);
						var vh = document.querySelector(ligne1);
						for(var m=0; m<vh.childElementCount; m++)
						{
							vhfils = vh.children[m];
							if(vhfils.classList.contains(colonne1))
							{
								if(vhfils.classList.contains('drop'))
								{
									vhfils.classList.remove('drop');
								}
							}
						}
						var vv = document.querySelector(colonne2);
						for(var m=0; m<vv.childElementCount; m++)
						{
							vvfils = vv.children[m];
							if(vvfils.classList.contains(ligne2))
							{
								if(vvfils.classList.contains('drop'))
								{
									vvfils.classList.remove('drop');
								}
							}
						}
						var ch = document.querySelector(ligne3);
						for(var m=0; m<ch.childElementCount; m++)
						{
							chfils = ch.children[m];
							if(chfils.classList.contains(colonne3))
							{
								if(chfils.classList.contains('drop'))
								{
									chfils.classList.remove('drop');
								}
							}
						}
						var cv = document.querySelector(colonne4);
						for(var m=0; m<cv.childElementCount; m++)
						{
							cvfils = cv.children[m];
							if(cvfils.classList.contains(ligne4))
							{
								if(cvfils.classList.contains('drop'))
								{
									cvfils.classList.remove('drop');
								}
							}
						}
					}
				}
			}
		}
	});
	if(event.target.classList.contains('voiturerouge'))		//si l'élément que l'on déplace est la voiture rouge
	{
		for(var i=0; i<6; i++)
		{
			for(var j=0; j<6; j++)
			{
				if(grille[i][j] != 'W')		//on se référe au tableau pour savoir quelles cases doivent être bloqués
				{
					var ligne = '.ligne'+(i+1);
					var colonne = 'colonne'+(j+1);
					var casebloque = document.querySelector(ligne);
					for(var k=0; k<casebloque.childElementCount; k++)
					{
						if(casebloque.children[k].classList.contains(colonne))
						{
							if(casebloque.children[k].previousElementSibling != null)
							{
								avant = casebloque.children[k].previousElementSibling;
								if(!(avant.classList.contains('drop')))
								{
									avant.classList.add('tmpbloque');
									for(var l=0; l<avant.childElementCount; l++)
									{
										avant1 = avant.children[l];
										if(avant1.classList.contains('zonedropvh'))
										{//pour les cases où il n'y a pas de véhicule mais qui vont entraîner une superposition si l'on dépose un véhicule, on enlève les événements et on leur met la class 'tmpbloque'
											avant1.removeEventListener('dragover', DragOver);		
											avant1.removeEventListener('dragenter', DragEnter);
											avant1.removeEventListener('dragleave', DragLeave);
											avant1.removeEventListener('drop', Drop);
										}
									}
								}
							}
						}
					}
				}
			}
		}
		lignevr = document.querySelector('.ligne3'); //pour la voiture rouge, seule la troisième ligne n'est pas bloqué
		for(var h=0; h<lignevr.childElementCount-2; h++)
		{
			enfant = lignevr.children[h];
			if(!(enfant.classList.contains('drop')) && !(enfant.classList.contains('tmpbloque')) && !(enfant.classList.contains('impossible')))
			{
				enfant.parentElement.classList.add('devant');		//la classe 'devant rajoute un z-index pour que les zones où l'on peut déposer le véhicule soit bien au-dessus du reste
				for(var g=0; g<enfant.childElementCount; g++)
				{
					enfant2 = enfant.children[g];
					enfant2.addEventListener('dragover', DragOver);
					enfant2.addEventListener('dragenter', DragEnter);
					enfant2.addEventListener('dragleave', DragLeave);
					enfant2.addEventListener('drop', Drop);
				}
			}
		}
		event.dataTransfer.setData('text/class2', 'voiturerouge');		//lors du déplacement du véhicule on garde la classe de l'élément déplacé en mémoire
	}
	if(event.target.classList.contains('vh'))		//même chose si l'élément déplacé est une voiture horizontale
	{
		
		for(var i=0; i<6; i++)
		{
			for(var j=0; j<6; j++)
			{
				if(grille[i][j] != 'W')
				{
					var ligne = '.ligne'+(i+1);
					var colonne = 'colonne'+(j+1);
					var casebloque = document.querySelector(ligne);
					for(var k=0; k<casebloque.childElementCount; k++)
					{
						if(casebloque.children[k].classList.contains(colonne))
						{
							if(casebloque.children[k].previousElementSibling != null)
							{
								avant = casebloque.children[k].previousElementSibling;
								if(!(avant.classList.contains('drop')))
								{
									avant.classList.add('tmpbloque');
									for(var l=0; l<avant.childElementCount; l++)
									{
										avant1 = avant.children[l];
										if(avant1.classList.contains('zonedropvh'))
										{
											avant1.removeEventListener('dragover', DragOver);
											avant1.removeEventListener('dragenter', DragEnter);
											avant1.removeEventListener('dragleave', DragLeave);
											avant1.removeEventListener('drop', Drop);
										}
									}
								}
							}
						}
					}
				}
			}
		}
		[].forEach.call(document.querySelectorAll('.zonedropvh'), Droppable); //on fait la fonction Doppable pour toutes les zones où l'on peut déposer l'élément sélectionné
		event.dataTransfer.setData('text/class2', 'vh');
	}
	if(event.target.classList.contains('vv'))	//même chose si l'élément déplacé est une voiture verticale
	{
		for(var i=0; i<6; i++)
		{
			for(var j=0; j<6; j++)
			{
				if(grille[i][j] != 'W')
				{
					var ligne = 'lign'+(i+1);
					var colonne = '.colonn'+(j+1);
					var casebloque = document.querySelector(colonne);
					for(var k=0; k<casebloque.childElementCount; k++)
					{
						if(casebloque.children[k].classList.contains(ligne))
						{
							
							if(casebloque.children[k].previousElementSibling != null)
							{
								avant = casebloque.children[k].previousElementSibling;
								if(!(avant.classList.contains('drop')))
								{
									avant.classList.add('tmpbloque');
									for(var l=0; l<avant.childElementCount; l++)
									{
										avant1 = avant.children[l];
										if(avant1.classList.contains('zonedropvv'))
										{
											avant1.removeEventListener('dragover', DragOver);
											avant1.removeEventListener('dragenter', DragEnter);
											avant1.removeEventListener('dragleave', DragLeave);
											avant1.removeEventListener('drop', Drop);
										}
									}
								}
							}
						}
					}
				}
			}
		}
		[].forEach.call(document.querySelectorAll('.zonedropvv'), Droppable);
		event.dataTransfer.setData('text/class2', 'vv');
	}
	if(event.target.classList.contains('ch'))		//même chose si l'élément déplacé est un camion horizontal
	{
		for(var i=0; i<6; i++)
		{
			for(var j=0; j<6; j++)
			{
				if(grille[i][j] != 'W')
				{
					var ligne = '.lig'+(i+1);
					var colonne = 'col'+(j+1);
					var casebloque = document.querySelector(ligne);
					for(var k=0; k<casebloque.childElementCount; k++)
					{
						if(casebloque.children[k].classList.contains(colonne))
						{
							if(casebloque.children[k].previousElementSibling != null)
							{
								avant = casebloque.children[k].previousElementSibling;
								if(!(avant.classList.contains('drop')))
								{
									avant.classList.add('tmpbloque');
									for(var l=0; l<avant.childElementCount; l++)
									{
										avant1 = avant.children[l];
										if(avant1.classList.contains('zonedropch'))
										{
											avant1.removeEventListener('dragover', DragOver);
											avant1.removeEventListener('dragenter', DragEnter);
											avant1.removeEventListener('dragleave', DragLeave);
											avant1.removeEventListener('drop', Drop);
										}
									}
								}
								if(avant.previousElementSibling != null)
								{
									avant2 = avant.previousElementSibling;
									if(!(avant2.classList.contains('drop')))
									{
										avant2.classList.add('tmpbloque');
										for(var l=0; l<avant2.childElementCount; l++)
										{
											avant3 = avant2.children[l];
											if(avant3.classList.contains('zonedropch'))
											{
												avant3.removeEventListener('dragover', DragOver);
												avant3.removeEventListener('dragenter', DragEnter);
												avant3.removeEventListener('dragleave', DragLeave);
												avant3.removeEventListener('drop', Drop);
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		[].forEach.call(document.querySelectorAll('.zonedropch'), Droppable);
		event.dataTransfer.setData('text/class2', 'ch');
	}
	if(event.target.classList.contains('cv'))		//même chose si l'élément déplacé est un camion vertical
	{
		for(var i=0; i<6; i++)
		{
			for(var j=0; j<6; j++)
			{
				if(grille[i][j] != 'W')
				{
					var ligne = 'li'+(i+1);
					var colonne = '.co'+(j+1);
					var casebloque = document.querySelector(colonne);
					for(var k=0; k<casebloque.childElementCount; k++)
					{
						if(casebloque.children[k].classList.contains(ligne))
						{
							
							if(casebloque.children[k].previousElementSibling != null)
							{
								avant = casebloque.children[k].previousElementSibling;
								if(!(avant.classList.contains('drop')))
								{
									avant.classList.add('tmpbloque');
									for(var l=0; l<avant.childElementCount; l++)
									{
										avant1 = avant.children[l];
										if(avant1.classList.contains('zonedropcv'))
										{
											avant1.removeEventListener('dragover', DragOver);
											avant1.removeEventListener('dragenter', DragEnter);
											avant1.removeEventListener('dragleave', DragLeave);
											avant1.removeEventListener('drop', Drop);
										}
									}
								}
								if(avant.previousElementSibling != null)
								{
									avant2 = avant.previousElementSibling;
									if(!(avant2.classList.contains('drop')))
									{
										avant2.classList.add('tmpbloque');
										for(var l=0; l<avant2.childElementCount; l++)
										{
											avant3 = avant2.children[l];
											if(avant3.classList.contains('zonedropcv'))
											{
												avant3.removeEventListener('dragover', DragOver);
												avant3.removeEventListener('dragenter', DragEnter);
												avant3.removeEventListener('dragleave', DragLeave);
												avant3.removeEventListener('drop', Drop);
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		[].forEach.call(document.querySelectorAll('.zonedropcv'), Droppable);
		event.dataTransfer.setData('text/class2', 'cv');
	}
	event.dataTransfer.setData('text/id', this.id);		//lors du déplacement du véhicule on garde l'id de l'élément déplacé en mémoire
	event.dataTransfer.setData('text/src', this.src);		//lors du déplacement du véhicule on garde la source de l'image de l'élément déplacé en mémoire
	event.dataTransfer.setData('text/class',this.className);		//lors du déplacement du véhicule on garde les classes de l'élément déplacé en mémoire
}	
//_____________________________________________FONCTION DRAGEND_________________________________________________________________
function DragEnd(elem) {		//fonction qui se déclenche quand un déplacement se termine
	[].forEach.call(document.querySelectorAll('.zoneentierevh'),Supprtmp); //pour chacune des quatres zones de dépôts on fait la fonction Supprtmp
	[].forEach.call(document.querySelectorAll('.zoneentierevv'),Supprtmp);
	[].forEach.call(document.querySelectorAll('.zoneentierech'),Supprtmp);
	[].forEach.call(document.querySelectorAll('.zoneentierecv'),Supprtmp);
}
//_____________________________________________FONCTION SUPPRTMP________________________________________________________________
function Supprtmp(elem)		//fonction qui se déclenche quand un déplacement est terminé et qui supprime tous les éléments qu'on ajoute quand on commence à déplacer un élément
{
	elem.classList.remove('devant');
	for(var m=0; m<elem.childElementCount; m++)
	{
		var enfant = elem.children[m];
		if(enfant.classList.contains('tmpbloque'))
		{
			enfant.classList.remove('tmpbloque');
		}
		for(var n=0; n<enfant.childElementCount; n++)
		{
			var enfant2 = enfant.children[n];
			if(enfant2.classList.contains('zonedropvh') || enfant2.classList.contains('zonedropvv') || enfant2.classList.contains('zonedropch') || enfant2.classList.contains('zonedropcv'))
			{
				enfant2.removeEventListener('dragover', DragOver);
				enfant2.removeEventListener('dragenter', DragEnter);
				enfant2.removeEventListener('dragleave', DragLeave);
				enfant2.removeEventListener('drop', Drop);
			}
		}
	}
}
//___________________________________________FONCTION DRAGOVER__________________________________________________________________
function DragOver(event)		//fonction qui se déclenche quand une zone de dépôt est survolé par un élément déplaçable
{
	event.preventDefault(); 
}
//___________________________________________FONCTION DRAGENTER__________________________________________________________________
function DragEnter(event)		//fonction qui se déclenche quand un élément déplaçable entre dans une zone de dépôt
{
	event.preventDefault(); 
	var nvimage = new Image();		//on créé une nouvelle image
	nvimage.src = event.dataTransfer.getData('text/src');		//on lui donne comme source la même que l'élément que l'on déplace
	nvimage.opacity = 0.5;
	nvimage.className = event.dataTransfer.getData('text/class2');		//on lui donne les mêmes classes
	nvimage.classList.add('place');
	nvimage.id = event.dataTransfer.getData('text/id');		//on lui donne aussi le même id
	
	var parent1 = event.target.parentElement;
	parent1.insertAdjacentElement("afterbegin", nvimage);		//on rajoute l'image dans la zone
	parent1.classList.add("zonesurvole");
}
//__________________________________________FONCTION DRAGLEAVE__________________________________________________________________
function DragLeave(event) //fonction qui se déclenche lorsque l'on quitte la zone de dépôt
{
	var parent1 = event.target.parentElement;
	parent1.classList.remove("zonesurvole");   //on supprime ce qu'on a ajouté en entrant dans la zone
	parent1.removeChild(parent1.childNodes[0]); 
}
//_______________________________________________FONCTION DROP__________________________________________________________________
function Drop(event)		//fonction qui se déclenche quand on dépose un élément dans une zone
{
	event.preventDefault();
	var classname = event.dataTransfer.getData('text/class');
	var id = event.dataTransfer.getData('text/id');
	
	//on fait comme si on sortait de la zone :		
	var parent1 = event.target.parentElement;
	parent1.classList.remove("zonesurvole");
	
	var image1 = parent1.childNodes[0];
	image1.style.opacity = 1;
	
	//On bloque la case pour qu'on ne puisse plus y déposer de véhicule :
	event.target.removeEventListener('dragover', DragOver);
	event.target.removeEventListener('dragenter', DragEnter);
	event.target.removeEventListener('dragleave', DragLeave);
	event.target.removeEventListener('drop', Drop);
	event.target.parentElement.classList.add('drop');
	
	// on bloque la ou les autres cases à côté où l'on ne peut plus déposer de véhicule :
	if(classname === 'vh' || classname === 'vv' || classname === 'voiturerouge') //si c'est une voiture
	{
		if(parent1.nextElementSibling != null)
		{
			const voisin1 = parent1.nextElementSibling;
			var childs=voisin1.childNodes;
			for(var i=0;i<childs.length;i++)
			{
				childs[i].removeEventListener('dragover', DragOver);
				childs[i].removeEventListener('dragenter', DragEnter);
				childs[i].removeEventListener('dragleave', DragLeave);
				childs[i].removeEventListener('drop', Drop);
			}
			voisin1.classList.add('drop');
		}
	}
	else //si c'est un camion
	{
		if(parent1.nextElementSibling != null)
		{
			const voisin1 = parent1.nextElementSibling;
			var childs=voisin1.childNodes;
			for(var i=0;i<childs.length;i++)
			{
				childs[i].removeEventListener('dragover', DragOver);
				childs[i].removeEventListener('dragenter', DragEnter);
				childs[i].removeEventListener('dragleave', DragLeave);
				childs[i].removeEventListener('drop', Drop);
			}
			voisin1.classList.add('drop');
			
			if(voisin1.nextElementSibling != null)
			{
				const voisin2 = voisin1.nextElementSibling;
				var childs=voisin2.childNodes;
				for(var i=0;i<childs.length;i++)
				{
					childs[i].removeEventListener('dragover', DragOver);
					childs[i].removeEventListener('dragenter', DragEnter);
					childs[i].removeEventListener('dragleave', DragLeave);
					childs[i].removeEventListener('drop', Drop);
				}
				voisin2.classList.add('drop');
			}	
		}			
	}
	//on remplit le tableau avec la lettre du véhicule que l'on vient de déposer :
	if(classname === 'vh' || classname === 'voiturerouge')
	{
		for(var i=1; i<7; i++)
		{
			for(var j=1; j<7; j++)
			{
				var ligne = 'ligne'+i;
				var colonne = 'colonne'+j;
				if(parent1.parentElement.classList.contains(ligne) && parent1.classList.contains(colonne))
				{
					grille[i-1][j-1] = id;
					grille[i-1][j] = id;
				}
			}
		}
		if(classname === 'vh') { nbvehicule++; }
	}
	if(classname === 'vv')
	{
		for(var i=1; i<7; i++)
		{
			for(var j=1; j<7; j++)
			{
				var ligne = 'lign'+i;
				var colonne = 'colonn'+j;
				if(parent1.parentElement.classList.contains(colonne) && parent1.classList.contains(ligne))
				{
					grille[i-1][j-1] = id;
					grille[i][j-1] = id;
				}
			}
		}
		nbvehicule++; 
	}
	if(classname === 'ch')
	{
		for(var i=1; i<7; i++)
		{
			for(var j=1; j<7; j++)
			{
				var ligne = 'lig'+i;
				var colonne = 'col'+j;
				if(parent1.parentElement.classList.contains(ligne) && parent1.classList.contains(colonne))
				{
					grille[i-1][j-1] = id;
					grille[i-1][j] = id;
					grille[i-1][j+1] = id;
				}
			}
		}
		nbvehicule++; 
	}
	if(classname === 'cv')
	{
		for(var i=1; i<7; i++)
		{
			for(var j=1; j<7; j++)
			{
				var ligne = 'li'+i;
				var colonne = 'co'+j;
				if(parent1.parentElement.classList.contains(colonne) && parent1.classList.contains(ligne))
				{
					grille[i-1][j-1] = id;
					grille[i][j-1] = id;
					grille[i+1][j-1] = id;
				}
			}
		}
		nbvehicule++; 
	}
	console.log(grille);
	
	//il faut mettre la classe 'drop' aux zones de chaque grille (vh,vv,ch,cv) :
	for(var i=0; i<6; i++)
	{
		for(var j=0; j<6; j++)
		{
			if(grille[i][j] != 'W')
			{
				var ligne1 = '.ligne'+(i+1);
				var ligne2 = 'lign'+(i+1);
				var ligne3 = '.lig'+(i+1);
				var ligne4 = 'li'+(i+1);
				var colonne1 = 'colonne'+(j+1);
				var colonne2 = '.colonn'+(j+1);
				var colonne3 = 'col'+(j+1);
				var colonne4 = '.co'+(j+1);
				var vh = document.querySelector(ligne1);
				for(var m=0; m<vh.childElementCount; m++)
				{
					vhfils = vh.children[m];
					if(vhfils.classList.contains(colonne1))
					{
						if(!(vhfils.classList.contains('drop')))
						{
							vhfils.classList.add('drop');
							for(var o=0; o<vhfils.childElementCount; o++)
							{
								vhfils2 = vhfils.children[o];
								if(vhfils2.classList.contains('zonedropvh'))
								{
									vhfils2.removeEventListener('dragover', DragOver);
									vhfils2.removeEventListener('dragenter', DragEnter);
									vhfils2.removeEventListener('dragleave', DragLeave);
									vhfils2.removeEventListener('drop', Drop);
								}
							}
						}
					}
				}
				var vv = document.querySelector(colonne2);
				for(var m=0; m<vv.childElementCount; m++)
				{
					vvfils = vv.children[m];
					if(vvfils.classList.contains(ligne2))
					{
						if(!(vvfils.classList.contains('drop')))
						{
							vvfils.classList.add('drop');
							for(var o=0; o<vvfils.childElementCount; o++)
							{
								vvfils2 = vvfils.children[o];
								if(vvfils2.classList.contains('zonedropvv'))
								{
									vvfils2.removeEventListener('dragover', DragOver);
									vvfils2.removeEventListener('dragenter', DragEnter);
									vvfils2.removeEventListener('dragleave', DragLeave);
									vvfils2.removeEventListener('drop', Drop);
								}
							}
						}
					}
				}
				var ch = document.querySelector(ligne3);
				for(var m=0; m<ch.childElementCount; m++)
				{
					chfils = ch.children[m];
					if(chfils.classList.contains(colonne3))
					{
						if(!(chfils.classList.contains('drop')))
						{
							chfils.classList.add('drop');
							for(var o=0; o<chfils.childElementCount; o++)
							{
								chfils2 = chfils.children[o];
								if(chfils2.classList.contains('zonedropch'))
								{
									chfils2.removeEventListener('dragover', DragOver);
									chfils2.removeEventListener('dragenter', DragEnter);
									chfils2.removeEventListener('dragleave', DragLeave);
									chfils2.removeEventListener('drop', Drop);
								}
							}
						}
					}
				}
				var cv = document.querySelector(colonne4);
				for(var m=0; m<cv.childElementCount; m++)
				{
					cvfils = cv.children[m];
					if(cvfils.classList.contains(ligne4))
					{
						if(!(cvfils.classList.contains('drop')))
						{
							cvfils.classList.add('drop');
							for(var o=0; o<cvfils.childElementCount; o++)
							{
								cvfils2 = cvfils.children[o];
								if(cvfils2.classList.contains('zonedropcv'))
								{
									cvfils2.removeEventListener('dragover', DragOver);
									cvfils2.removeEventListener('dragenter', DragEnter);
									cvfils2.removeEventListener('dragleave', DragLeave);
									cvfils2.removeEventListener('drop', Drop);
								}
							}
						}
					}
				}
			}
		}
	}
}