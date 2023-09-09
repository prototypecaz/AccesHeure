<?php

if(
    isset($_GET['searchCity']) and !empty($_GET['searchCity'])
)
{
    require_once('../classes/Database.php');

    $ville = (array) Database::query("SELECT ville_id, ville_nom,`ville_longitude_deg`,`ville_latitude_deg`,`ville_code_postal`
    FROM villes_france_free
    WHERE ville_nom LIKE ? LIMIT 7 ",
    [
        $_GET['searchCity']."%"
    ]);

    echo json_encode($ville);

}

?>