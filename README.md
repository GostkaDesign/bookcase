# BookCase

### C'est quoi ?

bookcase - Gestionnaire de bibliotheque litteraire

________________________________________________________________

### Ca sert à quoi ?

Permet de chercher des livres et de les classer

________________________________________________________________


### Pour qui ?

Les gens qui aiment lire et qui aimerai gérer leur bibliotheque personnel

________________________________________________________________


### Les moyens de rechercher des livre**

	- isbn
	- code barre
	- auteur
	- titre
	- genre
	- photo du livre (mobile)
	- photo d'une rangée de livre sur le flanc (bibliotheque)

________________________________________________________________


### Technologie

	- [PHP]
	- [javascript]
	- [bdd]
	- [json] (sauvegarde de la liste )
	- [Ajax]

________________________________________________________________

### Support

Web + app mobil

________________________________________________________________


### Affichage


#### 3 Familles principale :
	- Les livres lu
	- Les livres que j'aimerai
	- Les coup de coeur

#### Classement
	- Liste horizontale simple (quantité)
	- Liste bloc image
	- Année de lecture
	- Année de parution
	- Alphabetique
	- Personnalisé
	- coup de coeur



### Notes

	- Chargement de page
	- Petit fichier discret appelé à distance pour trouver le nombre d'utilisateur
	- Liste des souhait, des livres lu, coup de coeur
	- Apres la recherche possibilite d'ajouter l'element à notre liste
	- Ajouter un commentaire après la lecture
	- Date du débute de la lecture et fin de la lecture
	- Graphe ?
	- Hebergement -> compte
	- Imprimer une page liste




### ROADMAP

> **V0.1**
> 
> Mise en place de l'api google book

> **V0.2**
> 
> Recherche possible via champs

### Feature

#### User Account v0.0.2

	- Création de compte utilisateur possible public/profil/register
	- Envoie d'un email de confirmation par token
	- Mise a jou de la BDD quand l'email est validé
	- Connection au compte après validation
	- Création de la page de confirmation d'email public/profil/confirm
	- Page de profile de l'utilisateur public/profil/account
	- Mise en place de la session et de messages $_SESSION['flash']