# MeetWashing Test
Mini projet pour Meet Washing

## récupértion du projet
Pour récupérer le projet :
- Ouvrez un terminal,
- Placez vous dans le répertoire désiré puis lancez la ligne de commande suivante :

        git clone https://github.com/TualSeb37/meet_washing_test.git

- Se placer ensuite dans le répertoire meet_washing_test, et lancer la ligne de commande :

        composer install

## Lancer le projet :
- Dans un terminal, lancer

        symfony server:start

Il est maintenant possible d'utiliser l'application

## Lancer les tests
- depuis un terminal, lancer la ligne de commande  suivante :

        php bin/phpunit

## Documentation
Elle est accessible depuis l'url :

        https://127.0.0.1:8000/api

## Lancement des Docker
EN ligne de commade, lancer :

        docker compose up -d

# documentation technique

## getAllCars
Permet de récupérer toutes les voitures présentent dans l’application
  - Retourne :  un résultat au format Json.
  - Méthode : ‘GET’
  - Url : ‘/cars’
  - Paramètre : Elle ne demande aucun paramètre.

## getCar
  - Permet de récupérer une voiture présentent dans l’application en fonction de son id
  - Retourne : un résultat au format Json.
  - Méthode : ‘GET’
  - Url : ‘/cars/{id}’ :
  - Paramètre : Id de la voiture.

## addCar
  - Permet d’ajouter une nouvelle voiture dans l’application
  - Retourne :  un résultat au format Json.
  - Méthode : ‘POST’
  - Url : ‘/cars’
  - Paramètre : Elle ne demande aucun paramètre.

## editCar
  - Permet de modifier une voiture présentent dans l’application en fonction de son id
  - Retourne : un résultat au format Json.
  - Méthode : ‘PUT’
  - Url : ‘/cars/{id}’ :
  - Paramètre : Id de la voiture.

## delete
  - Permet de supprimer une voiture présentent dans l’application en fonction de son id
  - Retourne : un résultat au format Json.
  - Méthode : ‘DELETE’
  - Url : ‘/cars/{id}’ :
  - Paramètre : Id de la voiture.
