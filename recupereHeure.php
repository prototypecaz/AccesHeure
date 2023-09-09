<?php

require_once('./classes/Database.php');

$nombreEmployer = (array) Database::query("SELECT * FROM employes",[]);
$dateDuJour = date("Y");
$tableauEmployer = [];

$requete = Database::query("SELECT * FROM heureMois WHERE annee = (:dateAnnee)",
[
    ':dateAnnee' => $dateDuJour
]);

echo json_encode([$requete,$nombreEmployer]);

?>