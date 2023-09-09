<?php

require_once('./classes/Database.php');

$heureEmployeMois = (array) Database::query("SELECT * FROM heure WHERE MONTH(date) = (:dateMois) AND employe_id =(:employeId) AND YEAR(date) = (:dateAnnee)",
[
    ':dateMois' => $_GET['dateMois'],
    ':employeId' => $_GET['employeId'],
    ':dateAnnee' => $_GET['annee']
]);

$heureEmployeDansMois = (array) Database::query("SELECT * FROM heureMois WHERE mois_id = (:dateMois) AND employe_id =(:employeId) AND annee = (:annee)",
[
    ':dateMois' => $_GET['dateMois'],
    ':employeId' => $_GET['employeId'],
    ':annee' => $_GET['annee']
]);

echo json_encode([$heureEmployeMois,$heureEmployeDansMois]);

?>