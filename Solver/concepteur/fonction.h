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

//Fonction Qui initialise le tableaux
int initGrille(char grille[6][6]);

//Fonction Qui place aleatoire des voitures
int Gene(char grille[6][6], int nbvoiture, int nbcamion);

int display(CARTE carte);

//fonction qui récupère les infos voitures !!
int recupInfoCar(CARTE* carte);

//Verifie les cas impossibles faciles à trouver
int VerifyCasBasiques(CARTE* carte);

//---------------------------BFS

//verifit si la voiture rouge peut sortir si c'est le cas elle la sort
int JeuFinit(struct Noeud* pere, LISTEMOUV* listeMouv); 

//Initialise l'arbre
int initialisationArbre(CARTE* carte, struct Arbre* monArbre);

//créer un fils si la grille de ce fils n'a jamais été déjà etudié
struct maillonFils* creeUnFils(struct Noeud* pere, struct Arbre* monarbre, char deplacement, char voiture, LISTEGRILLE* listeGrille, int i);

// Permet d'effectuer tout les mouvements possibles de chaque voitures
int AnalyseLaCarte(struct Noeud* pere, struct Arbre* monarbre, LISTEBFS* listebfs, LISTEGRILLE* listeGrille, LISTEMOUV* listeMouv);

//Déplace une voiture dans la grille et change ses coordonnées
int bougeVoiture(CARTE* carte, char orientation, int k);

//Verifie si une voiture peut se déplacer dans une direction donnée
int verifMur(int indice, CARTE carte, char orientation);

//Initialise la liste pour la recherche en largeur
int initialisationBFS(LISTEBFS* liste);

//Ajoute un maillon à la liste BFS
int AjoutMaillonBFS(LISTEBFS* liste, struct Noeud* Noeud);

//Parcours de l'arbre en largeur
int BFS(LISTEBFS* liste, struct Arbre* monarbre, LISTEGRILLE* listeGrille, LISTEMOUV* listeMouv);

//Verifie si une grille existe deja
int existedeja(char grille[6][6], LISTEGRILLE* liste);

//Ajoute une grille à la liste de grille
int ajouterGrille(LISTEGRILLE* liste, char grille[6][6]);

//Initialise la liste de grille
int initialisationListeGrilles(LISTEGRILLE* liste);

//Compare deux tableaux
int compareTab(char grille[6][6], MAILLONGRILLE* maillon);

//Ajoute un mouvement d'un vehicule à la liste de mouvements
int ajouterMouv(struct Noeud* pere, LISTEMOUV* listemouv);

//Ajoute les mouvements permettant à la voiture 'X' de sortir et change la grille finale
int ajouteDemouvAlaFin(struct Noeud* pere, LISTEMOUV* listeMouv);

//Ajoute les mouvements de la liste dans le fichier .txt
int ChargeFile(FILE* fichier, LISTEMOUV listemouv);

int creationStr(CARTE carte, FILE* fichier);
