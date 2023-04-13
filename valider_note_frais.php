<?php
session_start();

if (isset($_GET['id_nfrais'])) {
    $id_nfrais = isset($_GET['id_nfrais']) ? $_GET['id_nfrais'] : '';
} else {
    $id_nfrais = isset($_POST['id_nfrais']) ? $_POST['id_nfrais'] : '';
}

$isvalid = isset($_POST['isvalid']) ? $_POST['isvalid'] : '';

$submit = isset($_POST['submit']);
require('backend/connectionBdd.php');

if ($submit) {

    try {
        $sql = "UPDATE notefrais set isvalid = :isvalid where id_nfrais=:id_nfrais";
        $params = array(
            ":isvalid" => $isvalid,
            ":id_nfrais" => $id_nfrais,
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    header("location: note_util.php");
}
?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation note de frais</title>
    <link rel="stylesheet" href="css/valid_note.css">
</head>

<body>
    <?php include('header.php') ?>
    <h1>Valider note de frais</h1>
    <p>Je souhaites valider la note de frais n°<?php echo $id_nfrais ?></p>
    <div class="formbg-outer">
        <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
                <form action="<?php echo $_SERVER['PHP_SELF'].'?id_nfrais='.$id_nfrais.'';?>" method="post">
                    <div>
                        <input type="hidden" name="id_nfrais" value=<?php $id_nfrais?>>
                        <input type="hidden" name="isvalid" value="1">
                    </div>    
                    <div class="field padding-bottom--24">
                        <input type="submit" name="submit" value="Oui" />
                        <button type="button" class="btn cancel" onclick="document.location.href='note_util.php'">Non</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>