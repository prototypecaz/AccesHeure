<?php
session_start();
if(empty($_SESSION['admin'])){
    http_response_code(302);
    header('Location: ../index.html');
    exit();
}
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        

        <link href="../assets/css/styleImpression.css" rel="stylesheet">
       
    </head>
    <body>

        <div class="containeIframe">
            <?php 
                $tab = explode(",",$_GET['result']);

                $t = '';
                
                foreach($tab as $value){
                    $y = explode("-",$value);

                    switch($y[1]){
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
                    
                    echo '<div>
                            <iframe id="ifr1" src="http://www.guillaume.com/StatisqueAccesHabitat/admin/recupereDonnee.php?selectMois='.$y[1].'&selectAnnee='.$y[0].'"></iframe>
                            <span class="spanMois">'.$t.'</span>
                        </div>';
                }
            ?>
        </div>
        
        <a href="./boardKilometre.php">Retour à l'accueil</a>
        <input type="submit" value="Tout imprimer" onclick="javascript:printall()">

        <script src="../assets/js/scriptImpression.js"></script>
    </body>
</html>