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
        <link href="../assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <header></header>
        <main>
            <div class="tableauBord">
                <div class="employes">
                    <div class="emploie">
                        <h3 class="titreEmploye">Employes</h3>
                    
                        <div class="spanEmployes">
                            
                        </div>
                        <div class="containeLienKm">
                            <a href="./boardKilometre.php">Basculer sur kilometrage</a>
                        </div>
                    </div>
                    <div id="containerInfoEmploye">
                        <div>
                            <i id="fermeEmploye" class="fa-solid fa-xmark"></i>
                        </div>
                        <div>
                            <img id="imgProfil" src="../assets/img/avatar.jpg">
                            <span id="identifiantEmploye"></span>
                        </div>
                        <div>
                            <span class="infoUnique"><i class="fa-solid fa-city"></i>Ville actuel: <span id="villeEmploye"></span></span>
                            <span class="infoUnique"><i class="fa-solid fa-cake-candles"></i>Date de naissance: <span id="dateDeNaissance"></span></span>
                            <span class="infoUnique"><i class="fa-solid fa-phone"></i>Téléphone: <span id="telephoneEmploye"></span></span>
                            <span class="infoUnique"><i class="fa-solid fa-clock"></i>Date d'entrer: <span id="dateEntrer"></span></span>
                            <span class="infoUnique"><i class="fa-solid fa-coins"></i><span id="salaireConfondu"></span></span>
                        </div>
                    </div>
                </div>
                <div class="statistique">
                    <div class="enfantStat">
                        <div id="firstEnfantStat">
                            <i id="fermeGraph" class="fa-solid fa-xmark"></i>
                            <h3 class="titreGraph"></h3>
                            <div id="containerChart">
                                <canvas id="myChart">
                                
                                </canvas>
                                <div id="gif">
                                    <img src="../assets/img/icons8-loading-circle.gif">
                                </div>
                            </div>
                        </div>
                        <div id="blockInfo">
                            <div id="firstEnInfo">
                                <div class="ligneSepare2"></div>
                                <h3 id="InfoCom">Information Complementaire</h3>
                                <div class="ligneSepare2"></div>
                            </div>
                            <div class="styleInfo">
                                <span>Heure effectuer: <span id="heureEffectuer" class="colorInfo"></span></span>
                                <div class="ligneSepare"></div>
                                <span>Total à payer: <span id="totalAPayer" class="colorInfo"></span></span>
                            </div>
                            <div class="ligneSepare"></div>
                            <div class="styleInfo">
                                <div id="divAjoutSalaire">
                                    <label>Ajouter salaire du mois : </label>
                                    <input id="salaireNet" type="text">
                                    <button id="btnSalaire">Envoyer</button>
                                </div>
                                <div id="divAfficheSalaire" style="display: none;">
                                    <span>Payer par l'entreprise: <span id="afficheSalaire" class="colorInfo"></span><input id="inputSalaire" type="text"></span>
                                    <button id="modifierSalaire">Modifier</button>
                                    <button id="envoieNewSalaire" style="display:none">Envoyer</button>
                                </div>
                                <div class="ligneSepare"></div>
                                <div>
                                    <span id="personnePayer"></span>
                                <span id="afficheDifference" class="colorInfo"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="enfantStatistique">
                        <div id="containerSelect">
                            <div class="containeSelect">
                                <label class="choixGlobal">Sélectionner un mois:</label><br>
                                <select id="selectMois">
                                    <option selected value="null">Choisir mois :</option>
                                    <option value="1">Janvier</option>
                                    <option value="2">Fevrier</option>
                                    <option value="3">Mars</option>
                                    <option value="4">Avril</option>
                                    <option value="5">Mai</option>
                                    <option value="6">Juin</option>
                                    <option value="7">Juillet</option>
                                    <option value="8">Aout</option>
                                    <option value="9">Septembre</option>
                                    <option value="10">Octobre</option>
                                    <option value="11">Novembre</option>
                                    <option value="12">Decembre</option>
                                </select>
                            </div>
                        <div class="containeSelect">
                                <label class="choixGlobal">Sélectionner une année:</label><br>
                                <select id="selectAnnee">
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022" selected>2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                </select>
                        </div>
                        </div>
                        <div class="blockTable">
                            <table>
                                <thead>
                                    <th>Date</th>
                                    <th>Chantier</th>
                                    <th>Heure Matin</th>
                                    <th>Heure Aprem</th>
                                    <th>Heure Total</th>
                                </thead>
                                <tbody id="tBodyTable">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="supplement">
                        <h3 id="titleSup">Informations Supplementaire:</h3>
                        <div id="containeSup">
                                
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer></footer>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
        <script src="../assets/js/scriptBoard.js"></script>
    </body>
</html>


