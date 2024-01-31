#include <stdlib.h>
#include <stdio.h>
#include "fonction.h"

int main() {
	FILE* test;
	CARTE carte;
	struct Arbre monArbre;
	LISTEBFS listeBfs;
	LISTEGRILLE listeGrille;
	LISTEMOUV listeMouv;

	//Ouverture Fichier
	printf("\n-------------FICHIER RECUP INFO-------------\n\n\n");
	test = recupfichier("solveur.txt");
	if (test == NULL) {
		printf("\fichier pas OK\n");
		return 0;
	}
	if (test != NULL) {
		printf("\nfichier OK\n");
	}
	
	//Recup infos
	carte = recupInfo(test);
	recupInfoCar(&carte);
	printf("\nil y a %d voitures\n", carte.nbVoiture);
	printf("\nGrille de depart :\n");
	display(carte);
	printf("\n");
	printf("Code ERREUR des cas basique : %d\n", VerifyCasBasiques(&carte));
	if (VerifyCasBasiques(&carte) == -1) {
		fprintf(test,"\n-1");
		return 0;
	}
	printf("\n");
	printf("\n");

	//Initialisation des listes
	initialisationListeGrilles(&listeGrille);
	initialisationArbre(&carte, &monArbre);
	initialisationBFS(&listeBfs);
	AjoutMaillonBFS(&listeBfs, &monArbre.origine);
	listeMouv.mouv = NULL;
	listeMouv.mouvfin = NULL;
	listeMouv.nbMouv = 0;


	printf("\n-------------RESOLUTION-------------\n\n\n");
	int j=BFS(&listeBfs, &monArbre,&listeGrille, &listeMouv);
	if (j == 0) {
		fprintf(test, "\n-1");
	}
	else {
		MAILLON* tmp = listeMouv.mouv;

		while (tmp != NULL) {
			printf("\n%c %c\n", tmp->direction, tmp->voiture);
			tmp = tmp->suiv;
		}

		printf("\n%d", listeMouv.nbMouv);

		ChargeFile(test, listeMouv);
	}



	fclose(test);
	return 0;
}