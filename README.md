# FREDI


## les comptes utilisateurs de test

    utilisateur     mot de passe    adresse mail
    test            test            test@gmail.com
    test1           test1           test1@gmail.com
    test2           test2           test2@gmail.com

# installation 
Décompresser le dossier FREDI dans le répertoire "xampp\htdocs\projets" puis exécuter le script sql dans le fichier "fredi.sql".

ajouter les utilisateurs de test dans la base de donné grace à la commande suivante :

INSERT INTO utilisateur (id_util, pseudo_util, mdp_util, nom_util, prenom_util, mail_util, iscontrol, isadmin)
VALUES
(1, 'test2', '$2y$11$KDJ76jdYS7M0kNGqldtCTulaoQv/ta1sWBc7fxSOjpcSX0jwnwDzG', 'test2', 'test2', 'test2@gmail.com', 1, 0),
(2, 'test1', '$2y$11$u9.T/1YiFIwAbqFKLhpo1.fIIbjj65RvVUhPtEyuUdP64/VNvOBxm', 'test1', 'test1', 'test1@gmail.com', 0, 1),
(3, 'test', '$2y$11$jfM1gOjNyCswau92JPwA2uDqKcR8fajn8mdtIHxY5C4HnREIxaYy2', 'test', 'test', 'test@gmail.com', 0, 0);


# trello
https://trello.com/b/JX7kWf7S/projet-fredi