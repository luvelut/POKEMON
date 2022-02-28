# POKEMON
[SYMFONY] Test technique PHP/API

## CONTEXTE

Création d'une base de données avec une entité Pokemon et une entité Type. Un Pokemon peut avoir un ou plusieurs type (relation __manyToMany__ ).

### API Get One

Il faut ici créer un controller d'API qui permet de récupérer une seule données de votre BDD.

Exemple: un pokémon avec ses types ou un jeu vidéo avec ses genres.

L'URL pour obtenir un Pokemon à partir de son nom (contrainte pas d'ID donc on passe le nom en paramètre) est le suivant :

``` http://127.0.0.1:8000/pokemon?name=Pikachu

```

### API Get All

Il s'agit maintenant de récupérer la liste de tous les éléments.

Exemple: tous les pokémons avec leurs types ou tous les jeux vidéo avec leurs genre.

* L'URL pour obtenir tous les pokemons :

``` http://127.0.0.1:8000/pokemons

```

* L'URL pour obtenir la liste des pokemons filtrée par type :

``` http://127.0.0.1:8000/pokemons?type=Feu

```

* L'URL pour obtenir la liste des pokemons filtrée par type et paginée :

``` http://127.0.0.1:8000/pokemons?type=Feu&page=2

```
 

## INSTALLATION EN LOCAL

Pour installer le projet en local sur votre machine, veuillez suivre les différentes étapes : 

### 1. Cloner le repository

### 2. Configurer le [.env](./.env)

Pour cela, renseignez les informations de la base de données (DATA_URL)

⚠️ Vous devez avoir au préalable créer votre base de données.

### 3. Installer les dependances php : `composer i`

### 4. Installer les dépendances js : `yarn` **ou** `npm i`

### 5. Lancer le serveur *Symfony* : `symfony serve`

### 6. Utiliser la commande pour loader les fixtures dans la base de données
