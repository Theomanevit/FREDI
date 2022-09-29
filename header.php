<header role="header">
    <nav class="menu" role="navigation">
        <div class="inner">
            <div class="m-left">
                <a href="index.php" class="m-link">Accueil</a>
            </div>
            <div class="m-right">
                <?php
                if(isset($_SESSION['username'])) {
                    echo "<a href='#' class='m-link'>Mon compte</a>";
                    echo "<a href='deconnexion.php' class='m-link'>Se déconnecter</a>";
                } else {
                    echo "<a href='connexion.php' class='m-link'>Se connecter</a>";
                    echo "<a href='inscription.php' class='m-link'>S'inscrire</a>";
                }
                ?>
            </div>
    </nav>
</header>