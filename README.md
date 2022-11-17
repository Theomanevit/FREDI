# FREDI


## les comptes utilisateurs de test

  
  rôle  utilisateur     mot de passe    adresse mail
  - adhérant  test            test            test@gmail.com
  - admin     test1           test1           test1@gmail.com
  - controleur    test2           test2           test2@gmail.com

# installation 
Décompresser le dossier FREDI dans le répertoire "xampp\htdocs\projets" puis exécuter le script sql dans le fichier "fredi.sql".

ajouter les utilisateurs de test dans la base de donné grace à la commande suivante :

INSERT INTO utilisateur (id_util, pseudo_util, mdp_util, nom_util, prenom_util, mail_util, iscontrol, isadmin)
VALUES
(1, 'test2', '$2y$11$KDJ76jdYS7M0kNGqldtCTulaoQv/ta1sWBc7fxSOjpcSX0jwnwDzG', 'test2', 'test2', 'test2@gmail.com', 1, 0),
(2, 'test1', '$2y$11$u9.T/1YiFIwAbqFKLhpo1.fIIbjj65RvVUhPtEyuUdP64/VNvOBxm', 'test1', 'test1', 'test1@gmail.com', 0, 1),
(3, 'test', '$2y$11$jfM1gOjNyCswau92JPwA2uDqKcR8fajn8mdtIHxY5C4HnREIxaYy2', 'test', 'test', 'test@gmail.com', 0, 0);

# acces des utilisateur :
l'adhérent a acces à :
- la liste de ses notes de frais 
- le detail de ses notes de frais pour la période active et peut modifier ou supprimer des lignes de frais d'une note

le controleur a acces à :
- la liste de toutes les notes de frais uniquement pour la péroiode active
- il ne peut pas modifier ou supprimer des lignes de frais d'une note

l' administrateur a acces à :
- la liste des utilisateur 
- peut modifier le rôle d'un utilisateur

# trello
https://trello.com/b/JX7kWf7S/projet-fredi