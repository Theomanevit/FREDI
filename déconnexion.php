<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>déconnexion</title>
</head>

<body>
    <div>
        <table>
            <tr>
                <td>
                    <h2>Déconnexion</h2>
                    <?php
                    if (isset($_SESSION['id_util'])) {
                        $id_uti = $_SESSION['id_util'];
                        session_unset();
                        session_destroy();
                        setcookie(session_name(), '', -1, '/');
                    }
                    ?>
                </td>
            </tr>
        </table>
        <a href="index.php"><input type="submit" value="accueil" /></a>
    </div>
</body>

</html>