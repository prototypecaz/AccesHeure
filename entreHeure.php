<?php

if(
    isset($_POST['date']) and !empty($_POST['date']) and
    isset($_POST['firstHeureMatin']) and !empty($_POST['firstHeureMatin']) and 
    isset($_POST['secondHeureMatin']) and !empty($_POST['secondHeureMatin']) and 
    isset($_POST['firstHeureAprem']) and !empty($_POST['firstHeureAprem']) and 
    isset($_POST['secondHeureAprem']) and !empty($_POST['secondHeureAprem'])
)
{
    session_start();

    require_once('./classes/Sanitizing.php');
    $sanitizing = new Sanitizing();
    $information = $sanitizing->sanitizeString($_POST['information']);
    $chantier = $sanitizing->sanitizeString($_POST['chantier']);
    $fHM = preg_replace("([^0-9:])", "", $_POST['firstHeureMatin']);
    $sHM = preg_replace("([^0-9:])", "", $_POST['secondHeureMatin']);
    $fHA = preg_replace("([^0-9:])", "", $_POST['firstHeureAprem']);
    $sHA = preg_replace("([^0-9:])", "", $_POST['secondHeureAprem']);
    $date = preg_replace("([^0-9-])", "", $_POST['date']);

    $date_explosee = explode("-",$date);
    $firstHeureMatin = new DateTime($fHM);
    $secondHeureMatin = new DateTime($sHM);
    $firstHeureAprem = new DateTime($fHA);
    $secondHeureAprem = new DateTime($sHA);
    
    $diffMatin = $secondHeureMatin->diff($firstHeureMatin);
    $diffAprem = $secondHeureAprem->diff($firstHeureAprem);
    
    $heureTotalMatin = explode(":",$diffMatin->format('%h:%i'));
    $heureTotalAprem = explode(":",$diffAprem->format('%h:%i'));
    $heureTotalJournee = date('H:i', mktime($heureTotalMatin[0]+$heureTotalAprem[0],$heureTotalMatin[1]+$heureTotalAprem[1]));
    
    require_once('./classes/Database.php');

    $heure = (array) Database::query("INSERT INTO heure (id,date,information,chantier,heureMatin,heureAprem,hTotalMatin,hTotalAprem,totalHeure,employe_id) VALUES 
    (NULL,(:date),(:information),(:chantier),(:heureMatin),(:heureAprem),(:hTotalMatin),(:hTotalAprem),(:totalHeure),(:employeId));", 
    [
        ':date'=>$date,
        ':information' => $information,
        ':chantier' => $chantier,
        ':heureMatin' => $fHM." - ".$sHM,
        ':heureAprem'=>$fHA." - ".$sHA,
        ':hTotalMatin'=>$diffMatin->format('%h:%i'),
        'hTotalAprem'=>$diffAprem->format('%h:%i'),
        ':totalHeure'=>$heureTotalJournee,
        ':employeId' => $_SESSION['user'][0]
    ]);

    $heureMoisVerife = (array) Database::query("SELECT * FROM heureMois WHERE employe_id = (:employeId) AND mois_id = (:moisId) AND annee = (:annee)",
    [
        ':employeId' => $_SESSION['user'][0],
        ':moisId'=> $date_explosee[1],
        ':annee' => $date_explosee[0]
    ]);


    if(empty($heureMoisVerife)){

        $heureMoisInsert = (array) Database::query("INSERT INTO heureMois (id,heureTotalMois,annee,employe_id,mois_id) VALUES (NULL,(:heureTotalMois),(:annee),(:employeId),(:moisId))",
        [
            ':heureTotalMois'=> $heureTotalJournee,
            ':annee'=>$date_explosee[0],
            ':employeId' => $_SESSION['user'][0],
            ':moisId'=> $date_explosee[1]

        ]);

    }else{
        $heureTotalJourneeExplode = explode(":",$heureTotalJournee);
        $heureMoisVerifie = explode(":",$heureMoisVerife[0]['heureTotalMois']);
    
        $totalmins = 0;
        $totalmins += $heureMoisVerifie[0] * 60;
        $totalmins += $heureMoisVerifie[1];
        $totalmins += $heureTotalJourneeExplode[0] * 60;
        $totalmins += $heureTotalJourneeExplode[1];
        
        $hours = intval($totalmins / 60);
        $minutes = $totalmins % 60;

        if($minutes < 10){
            $addHeureMois = "$hours:0$minutes";
        }else{
            $addHeureMois = "$hours:$minutes";
        }
    
       $modifeHeure = (array) Database::query("UPDATE heureMois SET heureTotalMois = (:heureTotal) WHERE mois_id = (:moisId) AND annee= (:annee) AND employe_id = (:employeId)",[
           ':heureTotal' =>   $addHeureMois ,
           ':employeId' => $_SESSION['user'][0],
           ':moisId' => $date_explosee[1],
           ':annee' => $date_explosee[0]
       ]);
    }

    http_response_code(302);
    header('Location: ./entreHeureBoard.php#success');
    exit();

}else{
    http_response_code(302);
    header('Location: ./entreHeureBoard.php#erreur');
    exit();
}
?>