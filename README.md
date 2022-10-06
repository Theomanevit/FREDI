# FREDI


## les comptes utilisateurs de test

    utilisateur     mot de passe
    test            test
    test1           test1
    test2           test2

# installation 
Décompresser le dossier FREDI dans le répertoire "xampp\htdocs\projets" puis créer la base de données fredi en utf8_general_ci dans mysql puis exécuter le script sql dans le fichier "fredi.sql".

ajouter les utilisateurs de test dans la base de donné grace à la commande suivante :

INSERT INTO `utilisateur` (`id_util`, `pseudo_util`, `mdp_util`, `nom_util`, `prenom_util`, `mail_util`, `is_controleur`, `is_admin`, `is_adherant`) VALUES
(1, 'test2', '$2y$11$KDJ76jdYS7M0kNGqldtCTulaoQv/ta1sWBc7fxSOjpcSX0jwnwDzG', 'test2', 'test2', 'test2@gmail.com', 1, 0, 0),
(2, 'test1', '$2y$11$u9.T/1YiFIwAbqFKLhpo1.fIIbjj65RvVUhPtEyuUdP64/VNvOBxm', 'test1', 'test1', 'test1@gmail.com', 0, 1, 0),
(3, 'test', '$2y$11$jfM1gOjNyCswau92JPwA2uDqKcR8fajn8mdtIHxY5C4HnREIxaYy2', 'test', 'test', 'test@gmail.com', 0, 0, 1);



# trello
https://trello.com/b/JX7kWf7S/projet-fredi