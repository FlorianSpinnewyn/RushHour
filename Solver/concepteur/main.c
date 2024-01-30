
#include <stdlib.h>
#include <stdio.h>
#include <time.h>
#include "fonction.h"

int main() {
	FILE* test;
	CARTE carte;
	struct Arbre monArbre;
	LISTEBFS listeBfs;
	LISTEGRILLE listeGrille;
	LISTEMOUV listeMouv;
	int nbVoiture, nbCamion;

	srand(time(NULL));
	//Ouverture Fichier
	test = recupfichier("generateur.txt");
	char buffer[50];
	nbVoiture = atoi(fgets(buffer, 50, test));
	nbCamion = atoi(fgets(buffer, 50, test));	

	do {
		printf("\n\n----------------------\n\n");
		//printf("\n-------------Generateur-------------\n\n\n");
		initGrille(carte.Grille);
		Gene(carte.Grille, nbVoiture, nbCamion);

		carte.nbVoiture = nbVoiture + nbCamion + 1;
		recupInfoCar(&carte);

		display(carte);

		//Initialisation des listes
		initialisationListeGrilles(&listeGrille);
		initialisationArbre(&carte, &monArbre);
		initialisationBFS(&listeBfs);
		AjoutMaillonBFS(&listeBfs, &monArbre.origine);
		listeMouv.mouv = NULL;
		listeMouv.mouvfin = NULL;
		listeMouv.nbMouv = 0;


		printf("\n----RESOLUTION------\n\n\n");
		BFS(&listeBfs, &monArbre, &listeGrille, &listeMouv);

		MAILLON* tmp = listeMouv.mouv;

		while (tmp != NULL) {
			printf("\n%c %c\n", tmp->direction, tmp->voiture);
			tmp = tmp->suiv;
		}

		printf("\n%d", listeMouv.nbMouv);


	} while (listeMouv.nbMouv <= 15);

	creationStr(carte, test);


	fclose(test);
	return 0;
}