<?php

require_once('./classes/Database.php');
require_once('./classes/Sanitizing.php');
$sanitizing = new Sanitizing();

if(isset($_GET['salaire']) and !empty($_GET['salaire']) and
   isset($_GET['annee']) and !empty($_GET['annee']) and
   isset($_GET['mois']) and !empty($_GET['mois']) and
   isset($_GET['employe']) and !empty($_GET['employe'])){

    $salaire = $sanitizing->sanitizeString($_GET['salaire']);
    $difference = $sanitizing->sanitizeString($_GET['differenceSalaire']);
    $annee = $sanitizing->sanitizeString($_GET['annee']);
    $mois = $sanitizing->sanitizeString($_GET['mois']);
    $employeId = $sanitizing->sanitizeString($_GET['employe']);

    $ajoutSalaire = (array) Database::query("INSERT INTO salaire (id,salaire,differenceSalaire,annee,mois_id,employe_id) VALUES 
    (NULL,(:salaire),(:differenceSalaire),(:annee),(:moisId),(:employeId));", 
    [
        ':salaire' => $salaire,
        ':differenceSalaire' => $difference,
        ':annee' => $annee,
        ':moisId' => $mois,
        ':employeId' => $employeId 
    ]);

    $recupereLajout = (array) Database::query("SELECT id FROM salaire WHERE annee = (:annee) AND mois_id = (:moisId) AND employe_id = (:employeId) ", 
    [
        ':annee' => $annee,
        ':moisId' => $mois,
        ':employeId' => $employeId 
    ]);

    echo json_encode($recupereLajout);
}

if( isset($_GET['choixMois']) and !empty($_GET['choixMois']) and
    isset($_GET['choixEmploye']) and !empty($_GET['choixEmploye']) and
    isset($_GET['choixAnnee']) and !empty($_GET['choixAnnee'])){

    $recupereSalaire = (array) Database::query("SELECT * FROM salaire WHERE mois_id = (:moisId) AND employe_id=(:employeId) AND annee = (:annee)", 
    [
       ':moisId' => $_GET['choixMois'],
       ':employeId' => $_GET['choixEmploye'],
       ':annee' => $_GET['choixAnnee']
    ]);

    echo json_encode($recupereSalaire);
}

if( isset($_GET['idSalaire']) and !empty($_GET['idSalaire']) and
    isset($_GET['salaireMois']) and !empty($_GET['salaireMois']) and
    isset($_GET['changeDifference']) and !empty($_GET['changeDifference']) || $_GET['changeDifference'] == 0){

    $idSalaire = $sanitizing->sanitizeString($_GET['idSalaire']);
    $salaireMois = $sanitizing->sanitizeString($_GET['salaireMois']);
    $changeDifference = $sanitizing->sanitizeString($_GET['changeDifference']);
    
    $modifieSalaire = (array) Database::query("UPDATE salaire SET salaire = (:salaire), differenceSalaire=(:differenceSalaire) WHERE id = (:id)", 
    [
      ':salaire' => $salaireMois,
      ':differenceSalaire' => $changeDifference,
      ':id' => $idSalaire
    ]);
}

if(isset($_GET['employeId']) and !empty($_GET['employeId'])){
    $recupereSalaireComplet = (array) Database::query("SELECT * FROM salaire WHERE employe_id=(:employeId)", 
    [
       ':employeId' => $_GET['employeId']
    ]);

    echo json_encode($recupereSalaireComplet);
}

?>