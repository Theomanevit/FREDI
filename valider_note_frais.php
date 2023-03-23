<?php
$isvalid = isset($_POST['isvalid']) ? $_POST['isvalid'] : '';
$id_nfrais = isset($_POST['id_nfrais']) ? $_POST['id_nfrais'] : '';
$tot_nfrais = isset($_POST['tot_nfrais']) ? $_POST['tot_nfrais'] : '';
$date_ordre = isset($_POST['date_ordre']) ? $_POST['date_ordre'] : '';
$num_ordre = isset($_POST['num_ordre']) ? $_POST['num_ordre'] : '';

if (isset($_GET['isvalid'])) {
    $isvalid = isset($_GET['isvalid']) ? $_GET['isvalid'] : '';
} else {
    $isvalid = isset($_POST['isvalid']) ? $_POST['isvalid'] : '';
}

if (isset($_GET['id_nfrais'])) {
    $id_nfrais = isset($_GET['id_nfrais']) ? $_GET['id_nfrais'] : '';
} else {
    $id_nfrais = isset($_POST['id_nfrais']) ? $_POST['id_nfrais'] : '';
}

if (isset($_GET['tot_nfrais'])) {
    $tot_nfrais = isset($_GET['tot_nfrais']) ? $_GET['tot_nfrais'] : '';
} else {
    $tot_nfrais = isset($_POST['tot_nfrais']) ? $_POST['tot_nfrais'] : '';
}

if (isset($_GET['date_ordre'])) {
    $date_ordre = isset($_GET['date_ordre']) ? $_GET['date_ordre'] : '';
} else {
    $date_ordre = isset($_POST['date_ordre']) ? $_POST['date_ordre'] : '';
}

if (isset($_GET['num_ordre'])) {
    $num_ordre = isset($_GET['num_ordre']) ? $_GET['num_ordre'] : '';
} else {
    $num_ordre = isset($_POST['num_ordre']) ? $_POST['num_ordre'] : '';
}


$submit = isset($_POST['submit']);
require('backend/connectionBdd.php');


try {
    $sql = "SELECT isvalid, id_nfrais, tot_nfrais, tot_nfrais, date_ordre, num_ordre FROM notefrais WHERE id_nfrais=:id_nfrais ";
    $params = array(
        "id_nfrais" => $id_nfrais
    );
    $sth = $dbh->prepare($sql);
    $sth->execute($params);
    $row = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL : " . $e->getMessage() . "</p>");
}

if ($submit) {

    try {
        $sql = "UPDATE notefrais set isvalid = :isvalid where id_lfrais=:id_lfrais";
        $params = array(
            ":isvalid" => $isvalid,
            ":id_lfrais" => $id_lfrais,
        );
        $sth = $dbh->prepare($sql);
        $sth->execute($params);
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
}
?>





<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation note de frais</title>
</head>

<body>
    <?php include('header.php') ?>
    <h1>Valider note de frais</h1>
    <div class="formbg-outer">
        <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
                <form action="<?php echo $_SERVER['PHP_SELF'].'?id_nfrais='.$id_nfrais.'';?>" method="post">
                    <div class="field padding-bottom--24">
                        <label>Note de frais validé ?</label>
                        <input type="text" name="isvalid" id="isvalid" value="<?php echo $isvalid ?>" required>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>id note de frais</label>
                        <input type="text" name="id_nfrais" id="id_nfrais" value="<?php echo $id_nfrais ?>" disabled>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Frais total</label>
                        <input type="text" name="tot_nfrais" id="tot_nfrais" value="<?php echo $tot_nfrais ?>" disabled>
                    </div>
                    <div class="field padding-bottom--24">
                        <label>Numéro ordre</label>
                        <input type="text" name="num_ordre" id="num_ordre" value="<?php echo $num_ordre ?>" disabled>
                    </div>
                    <div class="field padding-bottom--24">
                        <input type="submit" name="submit" value="Validée" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>