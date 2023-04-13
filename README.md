# FREDI
 
# trello
https://trello.com/b/JX7kWf7S/projet-fredi

 
## les comptes utilisateurs de test
 
  rôle - utilisateur - mot de passe - adresse mail :
 
  - adhérent - test - test - test@gmail.com
  - admin - test1 - test1 - test1@gmail.com
  - contrôleur - test2 - test2 - test2@gmail.com
 
# installation FREDI
 
Le dossier FREDI doit être installé dans le dossier “projets” de XAMPP pour l’adresse suivante : http://localhost/projets/FREDI/index.php .
 

# installation base de donnée et utilisateur :

aller dans le dossier db et copier integrallement le fichier fredi.sql dans l'onglet SQL de phpmyadmin
 
# installation des données :

allez dans l'accueil avec le compte test1 ( admin ) et cliquez sur base de données : charger   
 
# accès des utilisateurs :
l'adhérent a accès à :
- la liste de ses notes de frais
- le détail de ses notes de frais pour la période active et peut modifier ou supprimer des lignes de frais d'une note
 
le contrôleur a accès à :
- la liste de toutes les notes de frais uniquement pour la période active
- il ne peut pas modifier ou supprimer des lignes de frais d'une note
 
l' administrateur a accès à :
- la liste des utilisateur
- peut modifier le rôle d'un utilisateur

# API JSON :

URL pour appeler l'API JSON de FREDI (controleur): http://localhost/projets/FREDI/api/note_json.php?email=test2@gmail.com&password=test2

URL pour appeler l'API JSON de FREDI (admin): http://localhost/projets/FREDI/api/note_json.php?email=test1@gmail.com&password=test1

URL pour appeler l'API JSON de FREDI (adhérent): http://localhost/projets/FREDI/api/note_json.php?email=test@gmail.com&password=test



