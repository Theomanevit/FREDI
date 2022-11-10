<header role="header">
    <nav class="menu" role="navigation">
        <div class="botton">
            <?php
            if (isset($_SESSION['id_util'])) {
                echo '<section class="portfolio-experiment gauche"><a href="index.php">';
                echo '<span class="text">Accueil</span>';
                echo '<span class="line -right"></span>';
                echo '<span class="line -top"></span>';
                echo '<span class="line -left"></span>';
                echo '<span class="line -bottom"></span></a></section>';

                echo '<section class="portfolio-experiment droite"><a href="confirm_deconnexion.php">';
                echo '<span class="text">Déconnexion</span>';
                echo '<span class="line -right"></span>';
                echo '<span class="line -top"></span>';
                echo '<span class="line -left"></span>';
                echo '<span class="line -bottom"></span></a></section>';

                if (isset($_SESSION['isadmin'])) {
                    echo '<section class="portfolio-experiment droite"><a href="list_util.php">';
                    echo '<span class="text">Liste utilisateur</span>';
                    echo '<span class="line -right"></span>';
                    echo '<span class="line -top"></span>';
                    echo '<span class="line -left"></span>';
                    echo '<span class="line -bottom"></span></a></section>';
                } else {
                    echo '<section class="portfolio-experiment droite"><a href="note_util.php">';
                    echo '<span class="text">Notes de frais</span>';
                    echo '<span class="line -right"></span>';
                    echo '<span class="line -top"></span>';
                    echo '<span class="line -left"></span>';
                    echo '<span class="line -bottom"></span></a></section>';
                }
            } else {
                echo '<section class="portfolio-experiment gauche"><a href="index.php">';
                echo '<span class="text">Accueil</span>';
                echo '<span class="line -right"></span>';
                echo '<span class="line -top"></span>';
                echo '<span class="line -left"></span>';
                echo '<span class="line -bottom"></span></a></section>';

                echo '<section class="portfolio-experiment droite"><a href="connexion.php">';
                echo '<span class="text">Connexion</span>';
                echo '<span class="line -right"></span>';
                echo '<span class="line -top"></span>';
                echo '<span class="line -left"></span>';
                echo '<span class="line -bottom"></span></a></section>';

                echo '<section class="portfolio-experiment droite"><a href="inscription.php">';
                echo '<span class="text">Inscription</span>';
                echo '<span class="line -right"></span>';
                echo '<span class="line -top"></span>';
                echo '<span class="line -left"></span>';
                echo '<span class="line -bottom"></span></a></section>';
            }
            ?>
        </div>
    </nav>
</header>