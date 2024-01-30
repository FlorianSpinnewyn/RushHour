#include <stdlib.h>
#include <stdio.h>

typedef struct coord {
	int x;
	int y;
}COORD;


typedef struct Vehicule {
	int taille; // 2 ou 1
	char nom;
	int direction; //0 vertical, 1 horizontal
	COORD coord[3];
}VEHICULE;


typedef struct ListeBFS {
	struct MaillonBFS* head;
	struct MaillonBFS* tail;
	int nb;
}LISTEBFS;

typedef struct MaillonBFS {
	struct Noeud* noeud;
	struct MaillonBFS* suivant;
}MaillonBFS;


typedef struct carte {
	int nbVoiture;
	VEHICULE vehicule[16];
	char Grille[6][6];
}CARTE;

struct Noeud {
	int nbFils;
	char Deplacement;
	char voiture;
	CARTE data;
	struct Noeud* parent;
	struct maillonFils* fils;
};

struct maillonFils {
	struct maillonFils* suivant;
	struct Noeud noeud;
};

struct Arbre {
	int nbDeNoeud;
	struct Noeud origine;
};

typedef struct listeGrille {
	struct maillongrille* head;
	struct maillongrille* tail;
	int nb;
}LISTEGRILLE;

typedef struct maillongrille {
	struct maillongrille* suivant;
	char grille[6][6];
}MAILLONGRILLE;

typedef struct maillon {
	char direction, voiture;
	struct maillon* suiv;
}MAILLON;

typedef struct listeMouv {
	MAILLON* mouv;
	int nbMouv;
	MAILLON* mouvfin;
}LISTEMOUV;

//fonction qui recup le fichier et qui verifie qu'il y ait toutes les infos !!
FILE* recupfichier(char nomfichier[]);

//fonction qui récupère les infos du fichier texte pour la carte (nbVoiture,nbMouv et CodeDeLaCarte) renvoit une variable CARTE !!
CARTE recupInfo(FILE* fichier);

int display(CARTE carte);

//fonction qui récupère les infos voitures !!
int recupInfoCar(CARTE* carte);

int VerifyCasBasiques(CARTE* carte);

//---------------------------BFS

int JeuFinit(struct Noeud* pere, LISTEMOUV *listeMouv); //qui verifit si la voiture rouge peut sortir si c'est le cas elle la sort

int initialisationArbre(CARTE* carte, struct Arbre* monArbre);

struct maillonFils* creeUnFils(struct Noeud* pere, struct Arbre* monarbre, char deplacement, char voiture, LISTEGRILLE* listeGrille, int i);

int AnalyseLaCarte(struct Noeud* pere, struct Arbre* monarbre, LISTEBFS* listebfs, LISTEGRILLE* listeGrille, LISTEMOUV* listeMouv);

int bougeVoiture(CARTE* carte, char orientation, int k);

int verifMur(int indice, CARTE carte, char orientation);

void displayliste(struct Noeud noeud);

int initialisationBFS(LISTEBFS* liste);

int AjoutMaillonBFS(LISTEBFS* liste, struct Noeud* Noeud);

int BFS(LISTEBFS* liste, struct Arbre* monarbre, LISTEGRILLE *listeGrille, LISTEMOUV* listeMouv);

int existedeja(char grille[6][6], LISTEGRILLE* liste);

int ajouterGrille(LISTEGRILLE* liste, char grille[6][6]);

int initialisationListeGrilles(LISTEGRILLE* liste);

int compareTab(char grille[6][6], MAILLONGRILLE* maillon);	

int ajouterMouv(struct Noeud* pere, LISTEMOUV* listemouv);

int ajouteDemouvAlaFin(struct Noeud* pere, LISTEMOUV* listeMouv);

int ChargeFile(FILE* fichier, LISTEMOUV listemouv);
