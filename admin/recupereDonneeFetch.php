<?php

if(
    isset($_GET['selectMois']) and !empty($_GET['selectMois']) and
    isset($_GET['selectAnnee']) and !empty($_GET['selectAnnee'])
){
    require_once('../classes/Database.php');

    $kilometres = (array) Database::query("SELECT * FROM kilometres WHERE MONTH(date) = (:dateMois) AND YEAR(date) = (:dateAnnee)",
    [
        ':dateMois' => $_GET['selectMois'],
        ':dateAnnee' => $_GET['selectAnnee']
    ]);

    $kilometresTotal = 0;

    foreach($kilometres as $value){
        $kilometresTotal += intval($value['kilometre']);
    }

    echo json_encode([$kilometres,$kilometresTotal]);

}

?>