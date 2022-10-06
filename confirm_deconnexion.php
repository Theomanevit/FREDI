<?php
session_start();

$submit = isset($_POST['submit']);

if ($submit) {
    header("location: deconnexion.php");
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirm_déconnexion</title>
</head>

<body>
    <div>
        <table>
            <tr>
                <td>
                    <h2>Voulez-vous vous déconecté ?</h2>
                    <form action="confirm_deconnexion.php" method="POST">
                        <button>
                            <a href="index.php">retour</a>
                        </button>
                        <input type="submit" name="submit" value="confirmer">
                    </form>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>