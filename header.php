


<header role="header">
    <nav class="menu" role="navigation">
        <!--<div class="inner">
            <div class="m-left">
                
            </div>
            <div class="m-right">-->
                <?php
                if(isset($_SESSION['username'])) {
                    echo "<button><a href='#' >Mon compte</a></button>";
                    echo "<button class='droite'><a href='deconnexion.php'>Se déconnecter</a></button>";
                } else {
                    echo "<button><a href='index.php'>Accueil</a></button>";
                    echo "<button class='droite'><a href='connexion.php'>Se connecter</a></button>";
                    echo "<button class='droite'><a href='inscription.php'>S'inscrire</a></button>";
                }
                ?>
            </div>
    </nav>
</header>