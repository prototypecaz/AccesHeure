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
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="../assets/css/styleDonnee.css" rel="stylesheet">
        <link media="print" href="../assets/css/print.css" rel="stylesheet"/>
    </head>
    <body>

        <header class="infoImprime">
            <img src="../assets/img/logo.webp"> 

            <?php

            $t = '';
            switch($_GET['selectMois']){
                case 1:
                    $t="Janvier";
                    break;
                case 2:
                    $t="Février";
                    break;
                case 3:
                    $t="Mars";
                    break;
                case 4:
                    $t="Avril";
                    break;
                case 5:
                    $t="Mai";
                    break;
                case 6:
                    $t="Juin";
                    break;
                case 7:
                    $t="Juillet";
                    break;
                case 8:
                    $t="Aout";
                    break;
                case 9:
                    $t="Septembre";
                    break;
                case 10:
                    $t="Octobre";
                    break;
                case 11:
                    $t="Novembre";
                    break;
                case 12:
                    $t="Décembre";
                    break;
            }
    
            echo '<span class="spanPeriode">Période: '.$t." ".$_GET['selectAnnee'].'</span>'
            ?>
            
        </header>
        <table>
            <thead>
                <th>Date</th>
                <th>Client ou Fournisseur</th>
                <th>Lieu ou Motif</th>
                <th>Autre frais</th>
                <th>Nombre de Km</th>
                <th>Repas/Reception</th>
            </thead>
            <tbody>
                <?php 
                    foreach($kilometres as $value){
                        echo 
                        "<tr>
                            <td>".$value['date']."</td>
                            <td>".$value['client']."</td>
                            <td>".$value['lieu']."</td>
                            <td>".$value['frais']."</td>
                            <td>".$value['kilometre']."</td>
                            <td>".$value['repas']."</td>
                        </tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="total">Total Kilometre: </th>
                    <td class="donneeKm"><?php echo $kilometresTotal." km"?></td>
                    <td></td>
                </tr>
                <tr>      
                        <th colspan="4" class="total indemnite">Indemnités km véhicules 6cv - de 5000</th>
                        <td id="kilometreTotal">0.574e</td>
                        <td></td>
                    </tr>
                <tr>
                        <th colspan="4" class="total">Total en euros:</th>
                        <td class="donneeKm"><?php echo round($kilometresTotal * 0.574,2)."e" ?></td> 
                        <td></td>
                </tr>
            </tfoot>
        </table>


        <script src="../assets/js/scriptDonnees.js"></script>
    </body>
</html>
