<?php
session_start();
if(empty($_SESSION['user'])){
    http_response_code(302);
    header('Location: ./index.html');
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
    <link href="./assets/css/styleHeure.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header></header>

    <main style="position: relative;overflow:hidden">
        <div class="containeReponse">
            <div id="reponse">
                <i id="icone"></i>
                <span id="rep"></span>
            </div>
        </div>
        <div class="containeForm">
            <form id="formInscript" method="POST" action="./entreHeure.php">
                <div id="formulaire"> 
                    <label for="date">Date </label>
                    <input id="date" class="inputVerif" type="date" name="date">
                    <label for="date">Chantier/Ville</label>
                    <input id="ville" type="text" name="chantier">
                    <label for="firstHeureMatin">Heure Matin 1</label>
                    <input id="firstHeureMatin" class="inputVerif" type="time" name="firstHeureMatin">
                    <label for="secondHeureMatin">Heure Matin 2</label>
                    <input id="secondHeureMatin" class="inputVerif" type="time" name="secondHeureMatin">
                    <label for="firstHeureAprem">Heure Aprem 1</label>
                    <input id="firstHeureAprem" class="inputVerif" type="time" name="firstHeureAprem">
                    <label for="secondHeureAprem">Heure Aprem 2</label>
                    <input id="secondHeureAprem" class="inputVerif" type="time" name="secondHeureAprem">
                    <button type="submit">Valider</button>
                </div>
                <div id="facultatif">
                    <label for="information" style="display:block">Information supplémentaire (facultatif)</label>
                    <textarea name="information" id="information" cols="40" ></textarea>
                </div>
            </form>   
        </div>
    </main>

    <footer></footer>

    <script>
        var hash = window.location.hash
        var reponse = document.querySelector("#rep")
        var icone = document.querySelector("#icone")
        var containeReponse = document.querySelector(".containeReponse")
        var formInscript = document.querySelector("#formInscript")
        var inputVerif = document.querySelectorAll(".inputVerif")

        formInscript.onsubmit = function(e){
            e.preventDefault()
            var t = true
            inputVerif.forEach(element => {
                if(element.value == ""){
                    element.style.border="1px solid red"
                    t = false
                }else{
                    element.style.border="1px solid #DDDFE2"
                }
            });

            if(t){this.submit()}
        }


        switch(true){
            case hash == "#success" :
                reponse.innerHTML="Votre formulaire à était <br> envoyer avec success"
                reponse.style.color="#93CE24"
                icone.className="fa-solid fa-circle-check"
                icone.style.color="#93CE24"
                containeReponse.style.transform="translateY(0)"
                containeReponse.style.display="block"
                setTimeout(()=>{
                    containeReponse.style.transform="translateY(140%)"
                },5000)
                containeReponse.style.transition="transform 0.5s linear"
                break;
            case hash =="#erreur" :
                reponse.textContent = "Une erreur est survenue"
                reponse.style.color="red"
                icone.className="fa-solid fa-circle-exclamation"
                icone.style.color="red"
                containeReponse.style.transform="translateY(0)"
                containeReponse.style.display="block"
                setTimeout(()=>{
                    containeReponse.style.transform="translateY(140%)"
                },5000)
                containeReponse.style.transition="transform 0.5s linear"
                break;
            default:
                reponse.textContent = ""
                icone.className=""
                containeReponse.style.display="none"
            }
    </script>
</body>
</html>