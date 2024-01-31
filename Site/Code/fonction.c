#include "fonction.h"
#include <stdio.h>
#include <string.h>  
#include <stdlib.h>
#include <locale.h>

FILE* recupfichier(char nomfichier[]) {
    FILE* fic_rep = fopen(nomfichier, "a+");

    if (fic_rep == NULL) {
        perror("Erreur lors de l'ouverture du fichier");
        // Gestion de l'erreur, par exemple, exit(EXIT_FAILURE);
        return NULL;
    }

    return fic_rep;
}

CARTE recupInfo(FILE* fichier) {
	CARTE carte;											//declaration d'une variable carte de type CARTE
	char buffer[50];
	carte.nbVoiture = atoi(fgets(buffer, 50, fichier));		//Qui est ensuite rempli avec les informations du fichier texte
	for (int i = 0; i < 6; i++) {							//On parcours la chaine du fichier
		for (int j = 0; j < 6; j++) {						//Afin de remplir un tableau qui nous servira de grille de notre jeu par la suite
			carte.Grille[i][j] = fgetc(fichier);
		}
	}
	return carte;
}



int display(CARTE carte) {
	for (int i = 0; i < 6; i++) {							//On parcours le tableau grille
		for (int j = 0; j < 6; j++) {						//et on affiche chaque valeur
			printf("%c ", carte.Grille[i][j]);
		}
		printf("\n");
	}
	return 0;
}

int recupInfoCar(CARTE* carte) {

	if (carte->nbVoiture < 0) {								// On verifie que le fichier texte n'ai pas d'erreurs
		return -1;
	}
	else {

		for (int k = 0; k < 16; k++) {						//On prepare le tableau de vehicules en initialisant avec les differentes lettre pour chacun
			carte->vehicule[k].coord->x = 10;
			carte->vehicule[k].coord->y = 10;
			carte->vehicule[k].taille = 0;
			carte->vehicule[k].nom = k + 65;
		}
		for (int p = 11; p <= 14; p++) {					// On differencie les camions des voitures( Les voitures allant de A � L et les camions de O � R)
			carte->vehicule[p].nom = p + 68;
		}
		carte->vehicule[15].nom = 88;						// et pour finir la voiture X qui represente celle qui doit sortir

		int a;
		int i = 0;

		for (int x = 0; x < 6; x++) {						//On parcours ensuite la grille afin de trouver quelles sont les voitures pr�sentes dans la grille
			for (int y = 0; y < 6; y++) {					//Et on affecte � chaque vehicule sa taille et ses coordonn�es
				if (carte->Grille[x][y] == 'X') {
					a = 15;
				}
				else if (carte->Grille[x][y] >= 'O') {
					a = carte->Grille[x][y] - 68;
				}
				else {
					a = carte->Grille[x][y] - 65;
				}
				carte->vehicule[a].taille++;
				if (carte->vehicule[a].taille == 1) {
					carte->vehicule[a].coord[0].x = y;
					carte->vehicule[a].coord[0].y = x;
				}
				if (carte->vehicule[a].taille == 2) {
					carte->vehicule[a].coord[1].x = y;
					carte->vehicule[a].coord[1].y = x;
				}
				if (carte->vehicule[a].taille == 3) {
					carte->vehicule[a].coord[2].x = y;
					carte->vehicule[a].coord[2].y = x;
				}
			}
		}
		for (int u = 0; u < 16; u++) {														//Enfin, on donne la direction pour chaque vehicule
			if (carte->vehicule[u].taille != 0) {											//une direction de 1 veut dire horizontale
				if (carte->vehicule[u].coord[0].x == carte->vehicule[u].coord[1].x) {		//et une direction de 0 signifie que la voiture est verticale
					carte->vehicule[u].direction = 0;
				}
				else {
					carte->vehicule[u].direction = 1;
				}
			}
		}
		return 0;
	}
}



int VerifyCasBasiques(CARTE* carte) {
	//Verification des nombre de voitures
	if (carte->nbVoiture > 14) {
		return -1;
	}
	//Verification des nombre de vide
	int i = 0;
	for (int x = 0; x < 6; x++) {
		for (int y = 0; y < 6; y++) {
			if (carte->Grille[x][y] == 'W') {
				i++;
			}
		}
	}
	if (i <= 6) {
		return -1;
	}
	//verification de la direction de la redCar
	if (carte->vehicule[15].direction == 0) {
		return -1;
	}
	//verification de la position de la redcar
	if (carte->vehicule[15].coord[0].y == carte->vehicule[15].coord[1].y) {
		int tmp = carte->vehicule[15].coord[1].y;
		if (tmp != 2) {
			return -1;
		}
	}
	//verification de la taille de toutes les voitures
	int n = 0;
	for (n = 0; n < 16; n++) {
		if ((carte->vehicule[n].taille > 3) || ((carte->vehicule[n].taille < 2) && (carte->vehicule[n].taille != 0))) {
			return -1;
		}
	}
	//verification si il n'y a pas de voiture honrizontal dans l'axe de sortit
	int a = 0;
	for (int o = 0; o < 6; o++) {
		if ((carte->Grille[2][o] != 'X') && (carte->Grille[2][o] != 'W')) {
			a = 0;
			while (carte->vehicule[a].nom != carte->Grille[2][o]) {
				if (a == 16) {
					break;
				}
				a++;
			}
			if (carte->vehicule[a].direction == 1) {
				return -1;
			}
		}
	}
	//verification si une ligne n'est pas pleine de voiture honrizontal
	int t = 0;
	int continu = 1;
	for (int z = 0; z < 6; z++) {
		if (z != 2) {
			t = 0;
			for (int c = 0; c < 6; c++) {
				if (carte->Grille[z][c] == 'W') {
					t++;
				}
			}
			a = 0;
			continu = 1;
			if (t == 0) {
				for (int l = 0; l < 6; l++) {
					if (carte->Grille[z][l] == 'X') {
						a = 15;
					}
					else if (carte->Grille[z][l] >= 'O') {
						a = carte->Grille[z][l] - 68;
					}
					else {
						a = carte->Grille[z][l] - 65;
					}
					if (carte->vehicule[a].direction == 0) {
						return 0;
					}
				}
				return -1;
			}
		}
	}
	return 0;
}

//--------------BFS--------------
int JeuFinit(struct Noeud* pere, LISTEMOUV* listeMouv) {
	int i = pere->data.vehicule[15].coord->x;
	while (i < 6) {
		if ((pere->data.Grille[2][i] != 'X') && (pere->data.Grille[2][i] != 'W')) {				//On verifie si la voiture rouge peut sortir
			return 0; // il y a un v�hicule devant
		}
		i++;
	}
	ajouterMouv(pere, listeMouv);																//On ajoute alors les mouvements a une liste en remontant l'arbre
	ajouteDemouvAlaFin(pere, listeMouv);
	return 1;//il y a rien
}

int initialisationArbre(CARTE* carte, struct Arbre* monArbre) {
	monArbre->nbDeNoeud = 1;
	monArbre->origine.data = *carte;
	monArbre->origine.parent = NULL;
	monArbre->origine.fils = NULL;
	monArbre->origine.nbFils = 0;
	return 1;
}

struct maillonFils* creeUnFils(struct Noeud* pere, struct Arbre* monarbre, char deplacement, char voiture, LISTEGRILLE* listeGrille, int i) {
	//Allocation de la memoire
	struct maillonFils* tmp = (struct maillonFils*)malloc(sizeof(struct maillonFils));
	if (tmp == NULL) {
		return NULL;
	}
	tmp->noeud.Deplacement = deplacement;					//On initialise le nouveau maillon en reprenant les informations de son pere
	tmp->noeud.voiture = voiture;
	tmp->noeud.data = pere->data;
	tmp->noeud.fils = NULL;
	tmp->noeud.nbFils = 0;
	tmp->noeud.parent = pere;
	tmp->suivant = NULL;
	bougeVoiture(&tmp->noeud.data, deplacement, i);			// On change ensuite la grille et les coordonn�es de la voiture qu'on souhaite bouger
	if (existedeja(tmp->noeud.data.Grille, listeGrille) == 1) {		//On verifie si la grille existe deja(afin de ne pas multiplier des branches inutilement)
		if (pere->fils == NULL) {
			pere->fils = tmp;											//si oui, on donne alors l'adresse du maillon cr�e au pere->fils si c'est son premier fils
		}
		else {																//sinon, on parcours la liste de fils, et on rajoute le nouveau � la fin
			struct maillonFils* tmp1 = pere->fils;
			for (int i = 0; i < (pere->nbFils - 1); i++) {
				tmp1 = tmp1->suivant;
			}
			tmp1->suivant = tmp;
		}
		pere->nbFils++;														//on incr�mente ensuite le nombre de fils du pere et le nombre total de noeud de l'arbre
		monarbre->nbDeNoeud++;
		return tmp;
	}
	else {																//si la grille exite deja, ce fils est alors inutile et par consequent on ne fais rien
		return NULL;
	}
}

int AnalyseLaCarte(struct Noeud* pere, struct Arbre* monarbre, LISTEBFS* listebfs, LISTEGRILLE* listeGrille, LISTEMOUV* listeMouv) {
	char voitureMove;
	CARTE tmp;
	struct maillonFils* fils = NULL;
	if (JeuFinit(pere, listeMouv) == 1) {													// On verifie que le jeu ne soit fini ou non
		return 1;
	}
	for (int i = 0; i < 16; i++) {															// si le jeu n'est pas fini, on parcours alors le tableau de vehicules
		voitureMove = pere->data.vehicule[i].nom;
		if (pere->data.vehicule[i].taille != 0) {											//et si le vehicule est pr�sent dans la grille(ie taille != 0)
			if (pere->data.vehicule[i].direction == 0) {									// Alors selon la direction(0 ou 1) on va verifi� si la voiture peut se d�placer 
				if (verifMur(i, pere->data, 'h') == 1) {									//i�i en haut par exemple		
					tmp = pere->data;														// alors on va appeler la fonction cr�er un fils
					fils = creeUnFils(pere, monarbre, 'h', voitureMove, listeGrille, i);	// Qui nous retourne soit un pointeur vers un fils soit NULL selon si le cas �tudi� existe d�j�
					if (fils != NULL) {														// Et si la fonction ne renvoie pas nul, alors on l'ajoute a la liste des noeuds � �tudier
						AjoutMaillonBFS(listebfs, &fils->noeud);							// Selon la fonction BFS(parcours d'un arbre en largeur)
					}
				}
				if (verifMur(i, pere->data, 'b') == 1) {
					tmp = pere->data;
					fils = creeUnFils(pere, monarbre, 'b', voitureMove, listeGrille, i);
					if (fils != NULL) {
						AjoutMaillonBFS(listebfs, &fils->noeud);
					}
				}
			}
			else {
				if (verifMur(i, pere->data, 'g') == 1) {
					tmp = pere->data;
					fils = creeUnFils(pere, monarbre, 'g', voitureMove, listeGrille, i);
					if (fils != NULL) {
						AjoutMaillonBFS(listebfs, &fils->noeud);
					}
				}
				if (verifMur(i, pere->data, 'd') == 1) {
					tmp = pere->data;
					fils = creeUnFils(pere, monarbre, 'd', voitureMove, listeGrille, i);
					if (fils != NULL) {
						AjoutMaillonBFS(listebfs, &fils->noeud);
					}
				}
			}
		}
	}
	return 0;
}

int bougeVoiture(CARTE* carte, char sens, int k) {
	//selon le sens(haut/bas/gauche/droite) de la voiture et selon la voiture(obtenu grace a l'indice k), on va d�placer une voiture dans la grille mais aussi modifier ses coordonn�es
	switch (sens) {
	case 'h':																												//on verifie le sens
		if (carte->vehicule[k].taille == 2) {																				//puis la taille de la voiture et on modifie la grille
			carte->Grille[carte->vehicule[k].coord[0].y - 1][carte->vehicule[k].coord[0].x] = carte->vehicule[k].nom;		//i�i on remplace la case au dessus de la voiture initiale par la lettre de la voiture
			carte->Grille[carte->vehicule[k].coord[1].y][carte->vehicule[k].coord[0].x] = 'W';								//i�i on remplace la case en dessous contenant pr�c�demment la voiture par du vide
		}
		if (carte->vehicule[k].taille == 3) {																				//pareil pour un vehicule de taille 3
			if (carte->vehicule[k].coord[0].y != 0) {
				carte->Grille[carte->vehicule[k].coord[0].y - 1][carte->vehicule[k].coord[0].x] = carte->vehicule[k].nom;
				carte->Grille[carte->vehicule[k].coord[2].y][carte->vehicule[k].coord[2].x] = 'W';
				carte->vehicule[k].coord[2].y--;
			}
		}
		carte->vehicule[k].coord[1].y--;																					//et on modifie au final les coordonn�es
		carte->vehicule[k].coord[0].y--;
		break;
	case 'b':
		if (carte->vehicule[k].taille == 2) {
			if (carte->vehicule[k].coord[1].y < 5) {
				carte->Grille[carte->vehicule[k].coord[1].y + 1][carte->vehicule[k].coord[1].x] = carte->vehicule[k].nom;
				carte->Grille[carte->vehicule[k].coord[0].y][carte->vehicule[k].coord[0].x] = 'W';
			}
		}
		if (carte->vehicule[k].taille == 3) {
			carte->Grille[carte->vehicule[k].coord[2].y + 1][carte->vehicule[k].coord[0].x] = carte->vehicule[k].nom;
			carte->Grille[carte->vehicule[k].coord[0].y][carte->vehicule[k].coord[0].x] = 'W';
			carte->vehicule[k].coord[2].y++;
		}
		carte->vehicule[k].coord[0].y++;
		carte->vehicule[k].coord[1].y++;
		break;
	case 'g':
		if (carte->vehicule[k].taille == 2) {
			if (carte->vehicule[k].coord[0].x < 5) {
				carte->Grille[carte->vehicule[k].coord[0].y][carte->vehicule[k].coord[0].x - 1] = carte->vehicule[k].nom;
				carte->Grille[carte->vehicule[k].coord[1].y][carte->vehicule[k].coord[1].x] = 'W';
			}
		}
		if (carte->vehicule[k].taille == 3) {
			carte->Grille[carte->vehicule[k].coord[0].y][carte->vehicule[k].coord[0].x - 1] = carte->vehicule[k].nom;
			carte->Grille[carte->vehicule[k].coord[2].y][carte->vehicule[k].coord[2].x] = 'W';
			carte->vehicule[k].coord[2].x--;
		}
		carte->vehicule[k].coord[0].x--;
		carte->vehicule[k].coord[1].x--;
		break;
	case 'd':
		if (carte->vehicule[k].taille == 2) {
			carte->Grille[carte->vehicule[k].coord[1].y][carte->vehicule[k].coord[1].x + 1] = carte->vehicule[k].nom;
			carte->Grille[carte->vehicule[k].coord[0].y][carte->vehicule[k].coord[0].x] = 'W';
		}
		if (carte->vehicule[k].taille == 3) {
			carte->Grille[carte->vehicule[k].coord[2].y][carte->vehicule[k].coord[2].x + 1] = carte->vehicule[k].nom;
			carte->Grille[carte->vehicule[k].coord[0].y][carte->vehicule[k].coord[0].x] = 'W';
			carte->vehicule[k].coord[2].x++;
		}
		carte->vehicule[k].coord[0].x++;
		carte->vehicule[k].coord[1].x++;
		break;
	}

	return 0;
}

int verifMur(int indice, CARTE carte, char sens) {
	//Selon le sens de la voiture, on regarde s'il y a du vide dans la direction o� la voiture veut se d�placer
	//la fonction retourne 1 si c'est le cas, et 0 sinon
	if ((sens == 'h' && carte.vehicule[indice].direction == 0)) {
		if (carte.vehicule[indice].coord[0].y != 0) {
			if (carte.Grille[carte.vehicule[indice].coord[0].y - 1][carte.vehicule[indice].coord[0].x] == 'W') {
				return 1;
			}
		}
	}
	if (sens == 'b' && carte.vehicule[indice].direction == 0) {
		if (carte.vehicule[indice].taille == 2) {
			if (carte.vehicule[indice].coord[1].y != 5) {
				if (carte.Grille[carte.vehicule[indice].coord[1].y + 1][carte.vehicule[indice].coord[1].x] == 'W') {
					return 1;
				}
			}
		}
		if (carte.vehicule[indice].taille == 3) {
			if (carte.vehicule[indice].coord[2].y != 5) {
				if (carte.Grille[carte.vehicule[indice].coord[2].y + 1][carte.vehicule[indice].coord[2].x] == 'W') {
					return 1;
				}
			}
		}
	}
	if (sens == 'g' && carte.vehicule[indice].direction == 1) {
		if (carte.vehicule[indice].coord[0].x != 0) {
			if (carte.Grille[carte.vehicule[indice].coord[0].y][carte.vehicule[indice].coord[0].x - 1] == 'W') {
				return 1;
			}
		}
	}
	if (sens == 'd' && carte.vehicule[indice].direction == 1) {
		if (carte.vehicule[indice].taille == 2) {
			if (carte.vehicule[indice].coord[1].x != 5) {
				if (carte.Grille[carte.vehicule[indice].coord[1].y][carte.vehicule[indice].coord[1].x + 1] == 'W') {
					return 1;
				}
			}
		}
		if (carte.vehicule[indice].taille == 3) {
			if (carte.vehicule[indice].coord[2].x != 5) {
				if (carte.Grille[carte.vehicule[indice].coord[2].y][carte.vehicule[indice].coord[2].x + 1] == 'W') {
					return 1;
				}
			}
		}
	}
	return 0;
}

int initialisationBFS(LISTEBFS* liste) {
	liste->head = NULL;
	liste->tail = NULL;
	liste->nb = 0;
	return 1;
}

int AjoutMaillonBFS(LISTEBFS* liste, struct Noeud* Noeud) {
	MaillonBFS* tmp = (MaillonBFS*)malloc(sizeof(MaillonBFS));			//allocation de memoire pour un Maillon Temporaire
	if (tmp == NULL) {													//on verifie si le malloc a fonctionn�
		return -1;
	}
	tmp->noeud = Noeud;													//on se place au debut de la file de noeud
	if (liste->head == NULL) {											//Si le debut n'a pas �t� intialis�( NULL), on affecte le debut avec l'adresse de tmp
		liste->head = tmp;
	}
	else {																//sinon, on affecte au noeud qui suit le (anciennement) dernier noeud
		liste->tail->suivant = tmp;
	}
	tmp->suivant = NULL;
	liste->tail = tmp;													//on change alors la fin par l'adresse de tmp
	liste->nb++;														//et on incr�mente le nombre de noeud
	return 0;
}

int BFS(LISTEBFS* liste, struct Arbre* monarbre, LISTEGRILLE* listeGrille, LISTEMOUV* listeMouv) {
	MaillonBFS* tmp = liste->head;
	while (tmp != NULL) {
		if (AnalyseLaCarte(tmp->noeud, monarbre, liste, listeGrille, listeMouv) == 1) { // on appelle la fonction AnalyseLaCarte jusqu'� ce qu'elle retourne 1 , qui signifie que le jeu est fini
			printf("\njeu finis\n");
			display(tmp->noeud->data);													//On affiche la grille finale
			return 1; // jeu fini
		}
		else {
			tmp = tmp->suivant;															//sinon on passe au maillon suivant
		}
	}
	printf("%d", monarbre->nbDeNoeud);	
	return 0;
}

int existedeja(char grille[6][6], LISTEGRILLE* liste) {
	MAILLONGRILLE* tmp;
	tmp = liste->head;
	if (tmp == NULL) {																	//on verifie si la liste est nul
		if (ajouterGrille(liste, grille) == -1) {
			return -1;
		}
	}
	else {
		while (tmp != NULL) {
			if (compareTab(grille, tmp) == 0) {											//On compare la grille avec celles de la liste de grille
				tmp = tmp->suivant;
			}
			else {
				return 0; //Le tableaux est deja dans la liste
			}
		}
		if (ajouterGrille(liste, grille) == -1) {
			return -1;
		}
		return 1; // le tableux est cree
	}
	return 1;
}

int compareTab(char grille[6][6], MAILLONGRILLE* maillon) {
	for (int i = 0; i < 6; i++) {
		for (int j = 0; j < 6; j++) {
			if (grille[i][j] != maillon->grille[i][j]) {
				return 0;
			}
		}
	}
	return -1;
}

int ajouterGrille(LISTEGRILLE* liste, char grille[6][6]) {
	MAILLONGRILLE* tmp = (MAILLONGRILLE*)malloc(sizeof(MAILLONGRILLE));				//allocation de m�moire pour une nouvelle grille
	if (tmp == NULL) {																//On verifie si l'allocation a bien fonctionn�
		return -1;
	}
	for (int i = 0; i < 6; i++) {													//on copie la nouvelle grille dans la grille du maillon
		for (int j = 0; j < 6; j++) {
			tmp->grille[i][j] = grille[i][j];
		}
	}
	if (liste->head == NULL) {														//Si le debut n'a pas �t� intialis�( NULL), on affecte le debut avec l'adresse de tmp
		liste->head = tmp;
	}
	else {																			//sinon on parcours la liste jusqu'a la fin afin d'y ajouter le maillon
		MAILLONGRILLE* ptr = liste->head;
		while (ptr->suivant != NULL) {
			ptr = ptr->suivant;
		}
		ptr->suivant = tmp;															//On ajoute en remplacant l'adresse du maillon suivant par tmp
	}
	tmp->suivant = NULL;
	liste->tail = tmp;
	liste->nb++;																	//on incr�mente le nombre de grilles
	return 0;
}

int initialisationListeGrilles(LISTEGRILLE* liste) {
	liste->head = NULL;
	liste->nb = 0;
	liste->tail = NULL;
	return 0;
}

int ajouterMouv(struct Noeud* pere, LISTEMOUV* listemouv) {
	struct Noeud* tmp = pere;

	while (tmp->parent != NULL)
	{
		MAILLON* tmp2 = (MAILLON*)malloc(sizeof(MAILLON*));							//allocation de m�moire pour un nouveau mouvement
		if (tmp2 == NULL) {															//On verifie si l'allocation a bien fonctionn�
			return -1;
		}
		if (listemouv->mouvfin == NULL)
			listemouv->mouvfin = tmp2;
		tmp2->direction = tmp->Deplacement;											//on ajoute le maillon cr�� au d�but de la liste						
		tmp2->voiture = tmp->voiture;												//Et on lui affecte une direction ainsi qu'une voiture provenant du noeud
		tmp2->suiv = listemouv->mouv;
		listemouv->nbMouv++;														//on incr�mente le nombre de mouvements
		listemouv->mouv = tmp2;
		tmp = tmp->parent;
	}
	return 0;
}

int ajouteDemouvAlaFin(struct Noeud* pere, LISTEMOUV* listeMouv) {
	while (verifMur(15, pere->data, 'd') == 1) {				//tant que la voiture 'X' ne soit pas au bout on la deplace et on ajoute les mouvements
		bougeVoiture(&pere->data, 'd', 15);						//Deplace la voiture dans la grille et change ses coordonn�es
		MAILLON* tmp2 = (MAILLON*)malloc(sizeof(MAILLON*));		//allocation de m�moire pour un nouveau mouvement
		if (tmp2 == NULL) {										//On verifie si l'allocation a bien fonctionn�
			return -1;
		}
		tmp2->direction = 'd';									//On affecte au maillon une direction ainsi qu'une voiture provenant du noeud
		tmp2->voiture = 'X';									//Et on ajoute le maillon a la fin de la liste
		tmp2->suiv = NULL;
		listeMouv->mouvfin->suiv = tmp2;
		listeMouv->mouvfin = tmp2;
		listeMouv->nbMouv++;									//on incr�mente le nombre de mouvements
	}
	return 0;
}

int ChargeFile(FILE* fichier, LISTEMOUV listemouv) {
	fprintf(fichier, "\n%d", listemouv.nbMouv);
	if (fichier == NULL)
		return -1;
	MAILLON* tmp = listemouv.mouv;
	while (tmp != NULL) {													//On parcours la liste de mouvements
		fprintf(fichier, "\n%c%c", tmp->direction, tmp->voiture);			//Et on les ajoute uns � uns dans le fichier
		tmp = tmp->suiv;
	}
	return 0;
}