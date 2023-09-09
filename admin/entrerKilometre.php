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
        <link href="../assets/css/styleKm.css" rel="stylesheet">
        <META HTTP-EQUIV="Access-Control-Allow-Origin" CONTENT="https://www.amazon.com">
    </head>
    <body>
        <header></header>

        <main>
            <div class="containeTable">
                <form id="formKilometre" method="POST" action="./receptionKm.php">
                    <table id="table0">
                        <thead>
                            <th>Date</th>
                            <th>Client ou Fournisseur</th>
                            <th>Lieu ou Motif</th>
                            <th>Autre frais</th>
                            <th>Nombre de Km</th>
                            <th>Repas/Reception</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="inputDate" type="date" name="date[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputClient" type="text" name="client[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputVille" type="text" name="lieu[]" autocomplete="off" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="frais[]" placeholder="">
                                </td>
                                <td>
                                    <input class="inputKilometre" type="text" name="kilometre[]" placeholder="">
                                </td>
                                <td>
                                    <input type="text" name="repas[]" placeholder="">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="containeNbLigne">
                        <div>
                            <label class="labelLigne">Nombre de ligne: </label>
                            <select id="selectLigne">
                                <option value="" selected>4</option>
                                <option value="4">8</option>
                                <option value="8">16</option>
                                <option value="16">32</option>
                                <option value="32">64</option>
                                <option value="64">128</option>
                            </select>
                        </div>
                        
                        <button id="btnKilometre" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </main>

        <footer></footer>
        <script src="../assets/js/recupereVille.js"></script>
    </body>
</html>