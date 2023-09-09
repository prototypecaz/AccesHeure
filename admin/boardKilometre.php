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
        <link href="../assets/css/styleBoardKm.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link media="print" href="../assets/css/print.css" rel="stylesheet"/>
    </head>
    <body>
        <header></header>
        <main>
            <div class="container">
                <div class="containeSelect">
                    <div>
                        <a href="./board.php"><i class="fa-solid fa-arrow-left-long"></i></a>
                    </div>
                    <div>
                        <label>Sélectionner le mois:</label>
                        <select id="selectMois">
                            <option selected></option>
                            <option value="1" data-mois="Janvier">Janvier</option>
                            <option value="2" data-mois="">Fevrier</option>
                            <option value="3" data-mois="">Mars</option>
                            <option value="4" data-mois="">Avril</option>
                            <option value="5" data-mois="">Mai</option>
                            <option value="6" data-mois="">Juin</option>
                            <option value="7" data-mois="">Juillet</option>
                            <option value="8" data-mois="">Aout</option>
                            <option value="9" data-mois="">Septembre</option>
                            <option value="10" data-mois="">Octobre</option>
                            <option value="11" data-mois="">Novembre</option>
                            <option value="12" data-mois="">Decembre</option>
                        </select>

                        <label>Sélectionner l'année:</label>
                        <select id="selectAnnee">
                            <option selected></option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                
                    <div>
                        <div class="btnImprime">
                            <a href="./entrerKilometre.php"><i class="fa-regular fa-calendar"></i></a>
                        </div>
                        <div id="btnImprime" class="btnImprime">
                            <i class="fa-solid fa-print"></i>
                        </div>
                    </div>

                    <div class="road">
                        <img src="../assets/img/pngfind.com-white-line-png-544440.png">
                    </div>
                </div>
                <div class="containeTable">
                    <div class="infoImprime">
                        <img src="../assets/img/logo.webp"> 
                        <span class="spanPeriode">Période: <span id="moisChoisis"></span></span>
                    </div>
                    <div class="containeMoisFournis">
                        <span>Aucune données fournis pour ce mois</span>
                    </div>
                    <table class="tablePrint">
                        
                        <thead>
                                <th>Date</th>
                                <th>Client ou Fournisseur</th>
                                <th>Lieu ou Motif</th>
                                <th>Autre <br> frais</th>
                                <th>Nombre <br> de Km</th>
                                <th>Repas/<br>Reception</th>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="total">Total Kilometre:</th>
                                <td id="kilometreTotal"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="4" class="total indemnite">Indemnités km véhicules 6cv - de 5000</th>
                                <td>0.574e</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="4" class="total">Total en euros:</th>
                                <td id="totalEuros"></td>  
                                <td></td>     
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </main>
        <script src="../assets/js/scriptBoardKilometre.js"></script>
    </body>
</html>