<?php
include('init.php');
?>
<header role="header">
    <link rel="stylesheet" href="css/index.css">
    <nav class="menu" role="navigation">
        <div class="botton">
            <?php
            if (isset($_SESSION['id_util'])) {
                echo '<section class="portfolio-experiment gauche"><a href="' . BASEURL . '\index.php">';
                echo '<span class="text">Accueil</span>';
                echo '<span class="line -right"></span>';
                echo '<span class="line -top"></span>';
                echo '<span class="line -left"></span>';
                echo '<span class="line -bottom"></span></a></section>';

                echo '<div class="open-btn">';
                echo '<section class="portfolio-experiment droite"><button onclick="openForm()">';
                echo '<span class="text">Déconnexion</span>';
                echo '<span class="line -right"></span>';
                echo '<span class="line -top"></span>';
                echo '<span class="line -left"></span>';
                echo '<span class="line -bottom"></span></button></section>';
                echo '</div>';

                if (!isset($_SESSION['iscontrol'])&&!isset($_SESSION['isadmin'])) {
                    echo '<div class="open-btn">';
                    echo '<section class="portfolio-experiment droite"><a href="' . FRONTEND_COMPTE . '\compte.php">';
                    echo '<span class="text">Compte</span>';
                    echo '<span class="line -right"></span>';
                    echo '<span class="line -top"></span>';
                    echo '<span class="line -left"></span>';
                    echo '<span class="line -bottom"></span></a></section>';
                    echo '</div>';
                }


                if (isset($_SESSION['isadmin'])) {
                    echo '<section class="portfolio-experiment droite"><a href="' . BASEURL . '\list_util.php">';
                    echo '<span class="text">Liste utilisateur</span>';
                    echo '<span class="line -right"></span>';
                    echo '<span class="line -top"></span>';
                    echo '<span class="line -left"></span>';
                    echo '<span class="line -bottom"></span></a></section>';
                } else {
                    echo '<section class="portfolio-experiment droite"><a href="' . BASEURL . '\note_util.php">';
                    echo '<span class="text">Notes de frais</span>';
                    echo '<span class="line -right"></span>';
                    echo '<span class="line -top"></span>';
                    echo '<span class="line -left"></span>';
                    echo '<span class="line -bottom"></span></a></section>';
                }
            } else {
                echo '<section class="portfolio-experiment gauche"><a href="' . BASEURL . '\index.php">';
                echo '<span class="text">Accueil</span>';
                echo '<span class="line -right"></span>';
                echo '<span class="line -top"></span>';
                echo '<span class="line -left"></span>';
                echo '<span class="line -bottom"></span></a></section>';

                echo '<section class="portfolio-experiment droite"><a href="' . BASEURL . '\connexion.php">';
                echo '<span class="text">Connexion</span>';
                echo '<span class="line -right"></span>';
                echo '<span class="line -top"></span>';
                echo '<span class="line -left"></span>';
                echo '<span class="line -bottom"></span></a></section>';

                echo '<section class="portfolio-experiment droite"><a href="' . BASEURL . '\inscription.php">';
                echo '<span class="text">Inscription</span>';
                echo '<span class="line -right"></span>';
                echo '<span class="line -top"></span>';
                echo '<span class="line -left"></span>';
                echo '<span class="line -bottom"></span></a></section>';
            }
            ?>
            <div class="login-popup">
                <div class="form-popup" id="popupDeco">
                    <?php
                        echo '<form action="'.BASEURL.'\deconnexion.php" class="form-container">';
                    ?>
                        <h1>Veuillez voulez-vous vous déconnecter ?</h1>
                        <button type="submit" class="btn">déconnexion</button>
                        <button type="button" class="btn cancel" onclick="closeForm()">Fermer</button>
                    </form>
                </div>
            </div>

            <script>
                function openForm() {
                    document.getElementById("popupDeco").style.display = "block";
                }

                function closeForm() {
                    document.getElementById("popupDeco").style.display = "none";
                }
            </script>

        </div>
    </nav>
</header>