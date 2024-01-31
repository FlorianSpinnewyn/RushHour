#include "fonction.h"
#include <stdio.h>
#include <string.h>  
#include <stdlib.h>
#include <locale.h>
#include <time.h>

FILE* recupfichier(char nomfichier[]) {
	FILE* fic_rep;
	int err = fopen_s(&fic_rep, nomfichier, "a+");
	if (err == -1) {
		return NULL;
	}
	if (fic_rep == NULL)
		return NULL;
	return fic_rep;
}

int initGrille(char grille[6][6]) {
	for (int i = 0; i < 6; i++) {
		for (int j = 0; j < 6; j++) {
			grille[i][j] = 87;
		}
	}
	return 0;
}


int Gene(char grille[6][6],int nbvoiture,int nbcamion) {
	int direction = 0;
	int ligne = 0;
	int colonne = 0;
	int stop = 0;
	grille[2][0] = 'X';
	grille[2][1] = 'X';
	for (int c = 0; c < nbcamion; c++) {
		direction = rand() % 2 + 0;
		if (direction == 1) {
			stop = 0;
			while (stop == 0) {
				do {
					ligne = rand() % 6 + 0;
					colonne = rand() % 4 + 0;
				} while (ligne == 2);
				if (grille[ligne][colonne] == 'W' && grille[ligne][colonne + 1] == 'W' && grille[ligne][colonne + 2]) {
					grille[ligne][colonne] = c + 79;
					grille[ligne][colonne + 1] = c + 79;
					grille[ligne][colonne + 2] = c + 79;
					stop = 1;
				}
				else {
					stop = 0;
				}
			}
		}
		else {
			stop = 0;
			while (stop == 0) {
				ligne = rand() % 5 + 0;
				colonne = rand() % 6 + 0;
				if (grille[ligne][colonne] == 'W' && grille[ligne + 1][colonne] == 'W' && grille[ligne + 2][colonne] == 'W') {
					grille[ligne][colonne] = c + 79;
					grille[ligne + 1][colonne] = c + 79;
					grille[ligne + 2][colonne] = c + 79;
					stop = 1;
				}
				else {
					stop = 0;
				}
			}
		}
	}
	for (int v = 0; v < nbvoiture; v++) {
		direction = rand() % 2 + 0;
		if (direction == 1) {
			stop = 0;
			while (stop == 0) {
				do {
					ligne = rand() % 6 + 0;
					colonne = rand() % 5 + 0;
				} while (ligne == 2);
				if (grille[ligne][colonne] == 'W' && grille[ligne][colonne + 1] == 'W') {
					grille[ligne][colonne] = v + 65;
					grille[ligne][colonne + 1] = v + 65;
					stop = 1;
				}
				else {
					stop = 0;
				}
			}
		}
		else {
			stop = 0;
			while (stop == 0) {
				ligne = rand() % 5 + 0;
				colonne = rand() % 6 + 0;
				if (grille[ligne][colonne] == 'W' && grille[ligne+1][colonne] == 'W') {
					grille[ligne][colonne] = v + 65;
					grille[ligne+1][colonne] = v + 65;
					stop = 1;
				}
				else {
					stop = 0;
				}
			}
		}
	}
	return 0;
}



int display(CARTE carte) {
	for (int i = 0; i < 6; i++) {
		for (int j = 0; j < 6; j++) {
			printf("%c ", carte.Grille[i][j]);
		}
		printf("\n");
	}
	return 0;
}

int recupInfoCar(CARTE* carte) {

	if (carte->nbVoiture < 0) {
		return -1;
	}
	else {

		for (int k = 0; k < 16; k++) {
			carte->vehicule[k].coord->x = 10;
			carte->vehicule[k].coord->y = 10;
			carte->vehicule[k].taille = 0;
			carte->vehicule[k].nom = k + 65;
		}
		for (int p = 11; p <= 14; p++) {
			carte->vehicule[p].nom = p + 68;
		}
		carte->vehicule[15].nom = 88;

		int a;
		int i = 0;

		for (int x = 0; x < 6; x++) {
			for (int y = 0; y < 6; y++) {
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
		for (int u = 0; u < 16; u++) {
			if (carte->vehicule[u].taille != 0) {
				if (carte->vehicule[u].coord[0].x == carte->vehicule[u].coord[1].x) {
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
		if ((pere->data.Grille[2][i] != 'X') && (pere->data.Grille[2][i] != 'W')) {
			return 0; // il y a un véhicule devant
		}
		i++;
	}
	ajouterMouv(pere, listeMouv);
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
	tmp->noeud.Deplacement = deplacement;
	tmp->noeud.voiture = voiture;
	tmp->noeud.data = pere->data;
	tmp->noeud.fils = NULL;
	tmp->noeud.nbFils = 0;
	tmp->noeud.parent = pere;
	tmp->suivant = NULL;
	bougeVoiture(&tmp->noeud.data, deplacement, i);
	if (existedeja(tmp->noeud.data.Grille, listeGrille) == 1) {
		if (pere->fils == NULL) {
			pere->fils = tmp;
		}
		else {
			struct maillonFils* tmp1 = pere->fils;
			for (int i = 0; i < (pere->nbFils - 1); i++) {
				tmp1 = tmp1->suivant;
			}
			tmp1->suivant = tmp;
		}
		pere->nbFils++;
		monarbre->nbDeNoeud++;
		return tmp;
	}
	else {
		return NULL;
	}
}

int AnalyseLaCarte(struct Noeud* pere, struct Arbre* monarbre, LISTEBFS* listebfs, LISTEGRILLE* listeGrille, LISTEMOUV* listeMouv) {
	char voitureMove;
	CARTE tmp;
	struct maillonFils* fils = NULL;
	if (JeuFinit(pere, listeMouv) == 1) {
		return 1; //jeu fini
	}
	for (int i = 0; i < 16; i++) {
		voitureMove = pere->data.vehicule[i].nom;
		if (pere->data.vehicule[i].taille != 0) {
			if (pere->data.vehicule[i].direction == 0) {
				if (verifMur(i, pere->data, 'h') == 1) {
					tmp = pere->data;
					fils = creeUnFils(pere, monarbre, 'h', voitureMove, listeGrille, i);
					if (fils != NULL) {
						AjoutMaillonBFS(listebfs, &fils->noeud);
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

int bougeVoiture(CARTE* carte, char orientation, int k) {

	switch (orientation) {
	case 'h':
		if (carte->vehicule[k].taille == 2) {
			carte->Grille[carte->vehicule[k].coord[0].y - 1][carte->vehicule[k].coord[0].x] = carte->vehicule[k].nom;
			carte->Grille[carte->vehicule[k].coord[1].y][carte->vehicule[k].coord[0].x] = 'W';
		}
		if (carte->vehicule[k].taille == 3) {
			if (carte->vehicule[k].coord[0].y != 0) {
				carte->Grille[carte->vehicule[k].coord[0].y - 1][carte->vehicule[k].coord[0].x] = carte->vehicule[k].nom;
				carte->Grille[carte->vehicule[k].coord[2].y][carte->vehicule[k].coord[2].x] = 'W';
				carte->vehicule[k].coord[2].y--;
			}
		}
		carte->vehicule[k].coord[1].y--;
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

int verifMur(int indice, CARTE carte, char orientation) {

	if ((orientation == 'h' && carte.vehicule[indice].direction == 0)) {
		if (carte.vehicule[indice].coord[0].y != 0) {
			if (carte.Grille[carte.vehicule[indice].coord[0].y - 1][carte.vehicule[indice].coord[0].x] == 'W') {
				return 1;
			}
		}
	}
	if (orientation == 'b' && carte.vehicule[indice].direction == 0) {
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
	if (orientation == 'g' && carte.vehicule[indice].direction == 1) {
		if (carte.vehicule[indice].coord[0].x != 0) {
			if (carte.Grille[carte.vehicule[indice].coord[0].y][carte.vehicule[indice].coord[0].x - 1] == 'W') {
				return 1;
			}
		}
	}
	if (orientation == 'd' && carte.vehicule[indice].direction == 1) {
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
	MaillonBFS* tmp = (MaillonBFS*)malloc(sizeof(MaillonBFS));
	if (tmp == NULL) {
		return -1;
	}
	tmp->noeud = Noeud;
	if (liste->head == NULL) {
		liste->head = tmp;
	}
	else {
		liste->tail->suivant = tmp;
	}
	tmp->suivant = NULL;
	liste->tail = tmp;
	liste->nb++;
	return 0;
}

int BFS(LISTEBFS* liste, struct Arbre* monarbre, LISTEGRILLE* listeGrille, LISTEMOUV* listeMouv) {
	MaillonBFS* tmp = liste->head;
	while (tmp != NULL) {
		if (AnalyseLaCarte(tmp->noeud, monarbre, liste, listeGrille, listeMouv) == 1) {
			printf("\njeu finis\n");
			display(tmp->noeud->data);
			return 1; // je fini
		}
		else {
			//printf("\nLes fils :\n");
			//display(tmp->noeud->data);
			//printf("\nenfant\n");
			//displayliste(*tmp->noeud);
			//printf("\n\n----------------------------------\n\n\n");
			tmp = tmp->suivant;
		}
	}
	printf("%d", monarbre->nbDeNoeud);
	return 0;
}



void displayliste(struct Noeud noeud) {
	struct maillonFils* tmp = noeud.fils;
	if (tmp == NULL) {
		printf("\nPas de liste\n");
		return;
	}
	printf("Liste taille = %d", noeud.nbFils);
	int i = 1;
	while (tmp != NULL) {
		printf("\n Fils %d\n", i);
		display(tmp->noeud.data);
		printf("\n");
		printf("\n");
		tmp = tmp->suivant;
		i++;
	};
	return;
}


int displayListeGrille(LISTEGRILLE* liste) {
	MAILLONGRILLE* tmp = liste->head;
	if (tmp == NULL) {
		printf("\nPas de grille\n");
		return 0;
	}
	printf("Liste taille = %d", liste->nb);
	while (tmp != NULL) {
		for (int i = 0; i < 6; i++) {
			for (int j = 0; j < 6; j++) {
				printf("%c ", tmp->grille[i][j]);
			}
			printf("\n");
		}
		return 0;
		tmp = tmp->suivant;
	};
	return 0;
}

int existedeja(char grille[6][6], LISTEGRILLE* liste) {
	MAILLONGRILLE* tmp;
	tmp = liste->head;
	if (tmp == NULL) {
		if (ajouterGrille(liste, grille) == -1) {
			return -1;
		}
	}
	else {
		while (tmp != NULL) {
			if (compareTab(grille, tmp) == 0) {
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
	MAILLONGRILLE* tmp = (MAILLONGRILLE*)malloc(sizeof(MAILLONGRILLE));
	if (tmp == NULL) {
		return -1;
	}
	for (int i = 0; i < 6; i++) {
		for (int j = 0; j < 6; j++) {
			tmp->grille[i][j] = grille[i][j];
		}
	}
	if (liste->head == NULL) {
		liste->head = tmp;
	}
	else {
		MAILLONGRILLE* ptr = liste->head;
		while (ptr->suivant != NULL) {
			ptr = ptr->suivant;
		}
		ptr->suivant = tmp;
	}
	tmp->suivant = NULL;
	liste->tail = tmp;
	liste->nb++;
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
		MAILLON* tmp2 = (MAILLON*)malloc(sizeof(MAILLON*));
		if (tmp2 == NULL) {
			return -1;
		}
		if (listemouv->mouvfin == NULL)
			listemouv->mouvfin = tmp2;
		tmp2->direction = tmp->Deplacement;
		tmp2->voiture = tmp->voiture;
		tmp2->suiv = listemouv->mouv;
		listemouv->nbMouv++;
		listemouv->mouv = tmp2;
		tmp = tmp->parent;
	}
	return 0;
}

int ajouteDemouvAlaFin(struct Noeud* pere, LISTEMOUV* listeMouv) {
	while (verifMur(15, pere->data, 'd') == 1) {
		bougeVoiture(&pere->data, 'd', 15);
		MAILLON* tmp2 = (MAILLON*)malloc(sizeof(MAILLON*));
		if (tmp2 == NULL) {
			return -1;
		}
		tmp2->direction = 'd';
		tmp2->voiture = 'X';
		tmp2->suiv = NULL;
		if (listeMouv->mouv == NULL) {
			listeMouv->mouv = tmp2;
		}
		else {
			listeMouv->mouvfin->suiv = tmp2;
		}
		listeMouv->mouvfin = tmp2;
		listeMouv->nbMouv++;
	}
	return 0;
}

int ChargeFile(FILE* fichier, LISTEMOUV listemouv) {
	fprintf(fichier, "\n%d", listemouv.nbMouv);
	if (fichier == NULL)
		return -1;
	MAILLON* tmp = listemouv.mouv;
	while (tmp != NULL) {
		fprintf(fichier, "\n%c%c", tmp->direction, tmp->voiture);
		tmp = tmp->suiv;
	}
	return 0;
}

int creationStr(CARTE carte, FILE* fichier) {
	fprintf(fichier, "\n");
	int k = 0;
	for (int i = 0; i < 6; i++) {
		for (int j = 0; j < 6;j++) {
			fprintf(fichier,"%c",carte.Grille[i][j]);
			k++;
		}
	}
	return 0;
}
