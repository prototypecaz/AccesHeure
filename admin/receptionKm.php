<?php

if(
    isset($_POST['date']) and !empty($_POST['date']) and 
    isset($_POST['client']) and !empty($_POST['client']) and 
    isset($_POST['lieu']) and !empty($_POST['lieu']) and
    isset($_POST['kilometre']) and !empty($_POST['kilometre']) 
){
    require_once('../classes/Database.php');

    $tableauEnvoyer = [];
    $texteUnique = [];

    for($i = 0; $i < count($_POST['date']); $i++){

        if(empty($_POST['date'][$i]) || empty($_POST['client'][$i]) || empty($_POST['lieu'][$i]) || empty($_POST['kilometre'][$i])){
          
        }else{

            $texteUnique[$i]['date'] = $_POST['date'][$i];
            $texteUnique[$i]['client'] = $_POST['client'][$i];
            $texteUnique[$i]['lieu'] = $_POST['lieu'][$i];
            $texteUnique[$i]['frais'] = $_POST['frais'][$i];
            $texteUnique[$i]['kilometre'] = $_POST['kilometre'][$i];
            $texteUnique[$i]['repas'] = $_POST['repas'][$i];

            $dateEnvoie = date_parse($_POST['date'][$i]);

            if(in_array($dateEnvoie["year"]."-".$dateEnvoie["month"],$tableauEnvoyer)){

            }else{
                $tableauEnvoyer[$i] = $dateEnvoie["year"]."-".$dateEnvoie["month"];
            }   
        }
    }

    $elementRequete = "";

    foreach ($texteUnique as $value){
        $elementRequete.="(NULL,"."'".$value['date']."','".$value['client']."','".$value['lieu']."','".$value['frais']."','".$value['kilometre']."','".$value['repas']."'),";
    }
    $newElementRequete = rtrim($elementRequete,",");

    $ajoutKilometre = (array) Database::query("INSERT INTO kilometres (id,date,client,lieu,frais,kilometre,repas) VALUES $newElementRequete", 
    [
      
    ]);

    http_response_code(302);
    header('Location: ./impression.php?result='.implode(",",$tableauEnvoyer));
    exit();
}

?>