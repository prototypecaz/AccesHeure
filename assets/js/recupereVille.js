var inputVille = document.querySelectorAll(".inputVille")
var containerCity = document.createElement("div")
var ul = document.createElement("ul")
var inputKm = ""

containerCity.style.position="absolute"
containerCity.className="containerCity"
containerCity.appendChild(ul)

function envoieVille(element){
    if(element.value == ""){
        element.parentElement.nextElementSibling.nextElementSibling.firstElementChild.value = ""
        containerCity.style.display="none"
    }else{
        fetch("../admin/recupereVille.php?searchCity="+element.value)
        .then(function(response) { 
            response.json().then( 
                function(reponseJson) {
                    
                    containerCity.style.display="block"
                    ul.textContent=""
                    element.parentElement.style.position="relative"
                    element.parentElement.appendChild(containerCity)
                
                    reponseJson.forEach(element => {
                        var listeCity = document.createElement("li")
                        listeCity.className="listeCity"
                        listeCity.setAttribute('data-latLng',element.ville_latitude_deg+","+element.ville_longitude_deg)
                        listeCity.textContent=element.ville_nom +" ("+element.ville_code_postal+")"
                        ul.appendChild(listeCity)
                    });

                    
                    var liUnique = document.querySelectorAll('.listeCity')

                    liUnique.forEach(unique => {
                        unique.onclick =  function(){
                                element.value = this.textContent
                                containerCity.style.display="none"
                                inputKm = containerCity.parentElement.parentElement.children[4].firstElementChild
                                fetch("https://www.mapquestapi.com/directions/v2/route?key=3WbfE30wsXVZNG7FTOyxWw8JqdyOwmwM&from=652%20chemin%20de%20villemade,montauban,%20FR,82000&to="+unique.getAttribute('data-latLng')+"&locale=fr_FR&unit=k")
                                .then(function(response) { 
                                    response.json().then( 
                                        function(json) {
                                            
                                                inputKm.value= Math.round(json.route.distance) * 2
                                    
                                        }
                                    )
                                })
                               
                            
                        }
                    });
                }
            )
        })
    }
}

inputVille.forEach(element => {
    
    element.addEventListener("keyup", (event) => {
        envoieVille(element);  
    })
});

var selectLigne = document.querySelector("#selectLigne")
var tbody = document.querySelector('tbody')

selectLigne.onchange = function(){
   
    for(var i = 0; i < this.value;i++){
        var tr = document.createElement("tr")
        for(var t =0; t < 6; t++){

            var td = document.createElement("td")
            
            var newInput = document.createElement('input')
            if(t == 0){
                newInput.type="date"
            }else{
                newInput.type="text"
            }

            switch (t) {
                case 0:
                    newInput.name="date[]"
                    newInput.className="inputDate"
                    break;
                case 1:
                    newInput.name="client[]"
                    newInput.className="inputClient"
                    break
                case 2:
                    newInput.name="lieu[]"
                    newInput.className="inputVille"
                    newInput.addEventListener("keyup", (event) => {
                        envoieVille(event.target)
                    })
                break;
                case 3:
                    newInput.name="frais[]"
                break;
                case 4:
                    newInput.name="kilometre[]"
                    newInput.className="inputKilometre"
                break;
                case 5:
                    newInput.name="repas[]"
                break;
                default:
                  
            }
              
            td.appendChild(newInput)
            tr.appendChild(td)
        }

        tbody.appendChild(tr)
    }

    trColor()
}

var formKilometre = document.querySelector("#formKilometre")

formKilometre.onsubmit = function(e){
    e.preventDefault();
    var rowTable = document.querySelectorAll('tr')
    var inputTable = document.querySelectorAll('input')

    inputTable.forEach(element => {
        element.style.outline="1px solid grey"
        console.log(element.style.outline)
    });

    for(var i = 1; i < rowTable.length; i++){
    
        for(var t=0; t < rowTable[i].children.length; t++){
            
            if(rowTable[i].children[t].children[0].value !== ""){
                
                for(var y=0; y < rowTable[i].children.length; y++){
                
                    if(rowTable[i].children[y].children[0].value == "" &&  rowTable[i].children[y].children[0].className !== ""){
                        rowTable[i].children[y].children[0].style.outline="2px solid red" 
                    }
                }
            }
        }
    }

    var test = [...inputTable]

    if(test.filter(word => word.style.outline == "red solid 2px").length == 0 && test.filter(word => word.value !== "").length > 0){
        formKilometre.submit()
    }
}

function trColor(){
    var trAll = document.querySelectorAll('tr')

    for(var n =1 ; n < trAll.length; n++){
        if(n%2 == 0){
            trAll[n].style.backgroundColor="#e6f4f8"
        }else{
            trAll[n].style.backgroundColor="white"
        }
    }
}

trColor()




//http://www.mapquestapi.com/directions/v2/route?key=3WbfE30wsXVZNG7FTOyxWw8JqdyOwmwM&from=652%20chemin%20de%20villemade,montauban,%20FR,82000&to=CAUSSADE&locale=fr_FR&unit=k