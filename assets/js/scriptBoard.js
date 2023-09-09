var blockInfo = document.querySelector("#blockInfo")
var blockTable = document.querySelector(".blockTable")
var titreGraph = document.querySelector(".titreGraph")
var supplement = document.querySelector("#supplement")
var containeSup = document.querySelector("#containeSup")
var moisDeLannee = [0,"Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"]

function envoieInfo (element,select,stackedLine) {
    fetch("../recupereJour.php?dateMois="+select.value+"&employeId="+element.getAttribute("data-value")+"&annee="+selectAnnee.value)
    .then(function(response) { 
        response.json().then( 
            function(reponseJson) {
                var nombreJour = [31,28,31,30,31,30,31,31,30,31,30,31]
                var tableauJour = []
                var tableauHeureJour = []
                 
                for(var i=0; i <= nombreJour[selectMois.value-1];i++){
                    tableauJour.push(i)

                    if(i-1 < nombreJour[selectMois.value-1]){
                        tableauHeureJour.push(0)
                    }
                    
                }



                if(reponseJson[1].length > 0){
                    blockInfo.style.display="flex"
                    blockTable.style.display="flex"
                    supplement.style.display="block"
                    var t = 10 / 60
              
                    var heureExplode = reponseJson[1][0].heureTotalMois.split(':')

                    var paiementHeure = parseInt(heureExplode[0]*10)
                    var paiementMinute = parseFloat(heureExplode[1]*t)

                    var chaine = paiementMinute.toString() ;
                    var position = chaine.search(/[.,]\d+$/) ;

                    if(chaine.substring(position+1).length == 1){
                        paiementMinute = parseFloat(chaine.replace('.','.0'))
                    }

                    var totalAPayer = document.querySelector("#totalAPayer")
                    totalAPayer.textContent = (paiementHeure + paiementMinute).toFixed(2)+"e"
                
                    var heureEffectuer = document.querySelector("#heureEffectuer")
                    heureEffectuer.textContent=reponseJson[1][0].heureTotalMois.replace(":","h")
                
                    var tBodyTable = document.querySelector("#tBodyTable")
                    containeSup.textContent=""
                    tBodyTable.textContent = ""
                    var p = 0

                    reponseJson[0].forEach(element => {
                        var test = new Date(element.date)
                        tableauHeureJour[test.getDate()] = parseFloat(element.totalHeure.replace(":","."))

                        if(element.information !== ""){
                            var informationSup = document.createElement('span')
                            informationSup.textContent = element.information
                            informationSup.className="informationSup"
                            containeSup.appendChild(informationSup)
                        }
                        var tr = document.createElement('tr')
                        var dateHtml = document.createElement("td")
                        var dateDeTravail = new Date(element.date)
                        dateHtml.textContent = dateDeTravail.toLocaleDateString()
                        dateHtml.setAttribute("data-label","Date")
                        var chantier = document.createElement("td")
                        chantier.setAttribute("data-label","Chantier")

                        if(element.chantier == ""){
                            chantier.textContent="indéfini"
                        }else{
                            chantier.textContent=element.chantier
                        }
                        
                        var heureMatin = document.createElement("td")
                        heureMatin.setAttribute("data-label","Heure Matin")
                        heureMatin.textContent = element.heureMatin.replaceAll(":","h")
                        var heureAprem = document.createElement("td")
                        heureAprem.setAttribute("data-label","Heure Aprem")
                        heureAprem.textContent = element.heureAprem.replaceAll(":","h")
                        var totalHeureTable = document.createElement("td")
                        totalHeureTable.setAttribute("data-label","Total Heure")
                        totalHeureTable.textContent = element.totalHeure.replace(":","h")

                        if(p%2 > 0){
                            tr.style.backgroundColor="#EAF8E6"
                        }else{
                            tr.style.backgroundColor="white"
                        }

                        p++

                        tr.appendChild(dateHtml)
                        tr.appendChild(chantier)
                        tr.appendChild(heureMatin)
                        tr.appendChild(heureAprem)
                        tr.appendChild(totalHeureTable)
                        tBodyTable.appendChild(tr)
                    }); 
                    stackedLine.data.datasets[0].data = tableauHeureJour
                    titreGraph.textContent = "Heure du mois de " + moisDeLannee[select.value]+" "+ selectAnnee.value;
                    stackedLine.data.labels = tableauJour
                    stackedLine.update();
                }
                else{
                    supplement.style.display="none"
                    blockInfo.style.display="none"
                    blockTable.style.display="none"
                    titreGraph.textContent = "Heure du mois de " + moisDeLannee[select.value]+" "+ selectAnnee.value;
                    stackedLine.data.datasets[0].data = []
                    stackedLine.data.labels = tableauJour
                    
                    stackedLine.update();
                }

                if(containeSup.textContent == ""){
                    var infoSupNone = document.createElement("span")
                    infoSupNone.textContent="Aucune information supplémentaire"
                    infoSupNone.className="infoSupNone"
                    containeSup.appendChild(infoSupNone)
                }
            }
        )
    })
}

function differenceSalaire(input){
    var totalAPayerDifference = document.querySelector("#totalAPayer")
    var difference = parseFloat(totalAPayerDifference.textContent) - parseFloat(input)
    var afficheDifference = document.querySelector("#afficheDifference")
    afficheDifference.textContent = difference.toFixed(2).toString().replace("-","")+"e"
    var personnePayer = document.querySelector("#personnePayer")

    if(difference < 0){
    personnePayer.textContent = "Guillaume doit:"
    }else{
        personnePayer.textContent = "Acces Habitat doit:"
    }
    return difference
}


function envoieSalaire(mois,employe,annee,divAjoutSalaire,divAfficheSalaire,afficheSalaire){

    fetch("../salaire.php?choixMois="+mois+"&choixEmploye="+employe+"&choixAnnee="+annee)
    .then(function(response) { 
        response.json().then( 
            function(reponseSalaire) {
                var afficheDifference = document.querySelector("#afficheDifference")
                var personnePayer = document.querySelector("#personnePayer")

                if(reponseSalaire.length > 0){
        
                    if(reponseSalaire[0].differenceSalaire > 0){
                        personnePayer.textContent = "Acces Habitat doit:"
                    }else{
                        personnePayer.textContent = "Guillaume doit:"
                    }

                    var diffSalaire = parseFloat(reponseSalaire[0].differenceSalaire).toFixed(2)
                    afficheDifference.textContent = diffSalaire.toString().replace('-',"")+"e"
                    divAjoutSalaire.style.display="none"
                    divAfficheSalaire.style.display="block"
                    afficheSalaire.textContent = reponseSalaire[0].salaire+"e"
                    afficheSalaire.setAttribute("data-id",reponseSalaire[0].id)
                }else{
                    personnePayer.textContent = ""
                    divAjoutSalaire.style.display="block"
                    divAfficheSalaire.style.display="none"
                    afficheSalaire.textContent = ""
                    afficheDifference.textContent = ""
                }
            }
        )
    })
}

var utilisateurId 

function modifieSalaire(boutton,salaire){
    var inputSalaire = document.querySelector("#inputSalaire")
    var envoieNewSalaire = document.querySelector("#envoieNewSalaire")
    
    envoieNewSalaire.style.display="inline"
    salaire.style.display="none"
    inputSalaire.style.display="inline"
    inputSalaire.value=salaire.textContent.replace("e","")
    boutton.style.display="none"
    
    envoieNewSalaire.onclick = function(){
        fetch("../salaire.php?idSalaire="+salaire.getAttribute("data-id")+"&salaireMois="+inputSalaire.value+"&changeDifference="+differenceSalaire(inputSalaire.value))
        .then(function(response) { 
            response.text().then( 
                function(reponse) {
                    inputSalaire.style.display="none"
                    salaire.style.display = "inline"
                    salaire.textContent = inputSalaire.value+"e"
                    envoieNewSalaire.style.display="none"
                    boutton.style.display="inline"
                    console.log('testeee')
                    differenceSalaire(inputSalaire.value)


                    salaireComplet(utilisateurId)
                }
            )
        })
    }
}

function salaireComplet(element){
    var totalComplet = 0
    var salaireConfondu = document.querySelector('#salaireConfondu')
    fetch("../salaire.php?employeId="+element)
    .then(function(response) { 
        response.json().then( 
            function(differenceSalaireJson) {
                
                differenceSalaireJson.forEach(element => {
                   totalComplet += parseFloat(element.differenceSalaire)
                });

                if(differenceSalaireJson.length > 0){
                    if(totalComplet < 0){
                        salaireConfondu.textContent = "Guillaume doit: "+totalComplet.toFixed(2).toString().replace("-","")+"e"
                    }else{
                        salaireConfondu.textContent = "Acces Habitat doit: "+totalComplet.toFixed(2)+"e"
                    }
                }else{
                    salaireConfondu.textContent = ""
                }
            }
        )
    })
}

var stackedLine 
var tableauInfoEmploye = []
var tableauHeureEmploye = []
var tableauHeure =  [{}]
var detail = []
var donneeGraphiqueBase = []

function tableauAccueil(){
    fetch("../recupereHeure.php")
    .then(function(response) { 
        response.json().then( 
            function(reponse) {
                tableauInfoEmploye.push(reponse[1])
                
                var borderCouleur = ["#E41A1C", "#13C636","#84BDFF","#E1C62F"]

                for(var i = 1; i < reponse[1].length+1; i++){
                    var heureEmployes = reponse[0].filter(word => word.employe_id == i)
                    tableauHeureEmploye.push(heureEmployes)
                }

                for(var i = 0; i < reponse[1].length; i++){
                
                    if(stackedLine == undefined){
                        var spanEmployes = document.querySelector('.spanEmployes')
                        var employeSpan = document.createElement('span')
                        employeSpan.className="employe"
                        employeSpan.setAttribute("data-value",reponse[1][i].id)
                        employeSpan.textContent = reponse[1][i].employe
                        spanEmployes.appendChild(employeSpan)
                    }
               
                    tableauHeure[0][i] = [0,0,0,0,0,0,0,0,0,0,0,0,0]
                
                    for(var y = 0; y < tableauHeureEmploye[i].length; y++){
                    
                        tableauHeure[0][i][tableauHeureEmploye[i][y].mois_id] = parseFloat(tableauHeureEmploye[i][y].heureTotalMois.replace(':','.'))
                    
                    }

                    detail[i] = { 
                                  data: tableauHeure[0][i],
                                  label: reponse[1][i].employe,
                                  borderColor: borderCouleur[i],
                                  backgroundColor: borderCouleur[i],
                                  fill: false,
                                  pointStyle: 'circle',
                                  pointRadius: 6,
                                  pointHoverRadius: 12,
                                  borderWidth: 2
                                }
                 
                    donneeGraphiqueBase[i] = { 
                                  data: tableauHeure[0][i],
                                  label: reponse[1][i].employe,
                                  borderColor: borderCouleur[i],
                                  backgroundColor: borderCouleur[i],
                                  fill: false,
                                  pointStyle: 'circle',
                                  pointRadius: 4,
                                  pointHoverRadius: 8,
                                  borderWidth: 2
                                }
                }
  
                var ladate = new Date()
                titreGraph.textContent = 'Tableau heure effectuer en ' + ladate.getFullYear()
                const legendMarginRight = {
                    id:'legendMarginRight',
                    afterInit(chart,args,option){
                        const fitValue = chart.legend.fit;
                        chart.legend.fit = function fit(){
                            fitValue.bind(chart.legend)();
                            let width = this.width += 50
                            return width
                            }
                        },
                }

                const ctx = document.getElementById('myChart').getContext('2d');
                stackedLine = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: moisDeLannee,
                                    datasets: detail
                                },
                                options: {
                                    hover: {
                                        mode: 'nearest',
                                        intersect: false
                                    },
                                    responsive:true,
                                    maintainAspectRatio: false,
                                    layout: {
                                        padding: {
                                            left:40,
                                            bottom:50
                                        }
                                    },
                                    plugins: {
                                        legend: {
                                            labels: {
                                                font: {
                                                    size: 14,
                                                    family:'vazir',
                                                },
                                                textAlign:'left',
                                                padding:20,
                                                boxWidth:30,
                                                boxHeight:3
                                            },
                                            rtl:true,
                                            position:'right',
                                            align:'start',
                                        }
                                    },
                                    scales: {
                                        x: {
                                            ticks: {
                                                font: {
                                                    size: 13,
                                                    family:'vazir'
                                                }
                                            }
                                        },
                                        y: {
                                            ticks: {
                                                font: {
                                                    size: 14,
                                                    family:'vazir'
                                                }
                                            }
                                        }                       
                                    }
                                },
                                plugins:[legendMarginRight]
                });
            }
        )
    })
}

tableauAccueil()
              
function informationEmployes(tableau,btn,stackedLine){
 
    var containerInfoEmploye = document.querySelector("#containerInfoEmploye")
    containerInfoEmploye.style.transform = "translateX(0%)"
    containerInfoEmploye.style.transition = "transform 0.1s linear"
    var identifiantEmploye = document.querySelector("#identifiantEmploye")
    var villeEmploye = document.querySelector("#villeEmploye")
    var dateDeNaissance = document.querySelector("#dateDeNaissance")
    var dateEntrer = document.querySelector("#dateEntrer")
    var telephoneEmploye = document.querySelector('#telephoneEmploye')
    var fermeEmploye = document.querySelector("#fermeEmploye")
    identifiantEmploye.textContent = tableauInfoEmploye[0][btn].employe +" "+tableauInfoEmploye[0][btn].nomEmploye
    villeEmploye.textContent = tableauInfoEmploye[0][btn].ville
    dateDeNaissance.textContent = tableauInfoEmploye[0][btn].naissance
    dateEntrer.textContent = tableauInfoEmploye[0][btn].dateEntrer
    telephoneEmploye.textContent = tableauInfoEmploye[0][btn].telephone

    fermeEmploye.onclick = function(){
        containerInfoEmploye.style.transform = "translateX(-100%)"
        containerInfoEmploye.style.transition = "transform 0.1s linear"
        blockInfo.style.display="none"
        blockTable.style.display="none"
        supplement.style.display="none"
        var containerSelect = document.querySelector("#containerSelect")
        containerSelect.style.display="none"
        stackedLine.data.datasets = donneeGraphiqueBase
        stackedLine.data.labels=moisDeLannee
        stackedLine.update();
    }
}

window.onload = function(){

    setTimeout(() => {
        var employe = document.querySelectorAll(".employe")
        var copieStack = [...stackedLine.data.datasets]
  
        if(window.innerWidth <= 1024){
            stackedLine.options.plugins.legend.position = "top"
            stackedLine.options.layout.padding.left = 0
            stackedLine.data.datasets
            stackedLine.options.layout.padding.bottom = 100
            stackedLine.data.datasets.forEach(element => {
                element.pointRadius = 3
                element.pointHoverRadius = 6
            });
            stackedLine.update();
        }
               
        employe.forEach(element => {
            element.onclick = function(){

                if(window.innerWidth <= 1200){
                    var statistique = document.querySelector(".statistique")
                    statistique.style.display="block"
                    if(window.innerWidth <= 428){
                        statistique.animate([
                            { transform: 'translateX(-100%)' },
                            { transform: 'translateX(0)' }
                        ],{
                            duration: 200,
                            fill:'forwards'
                        });
                    }
               
                    var enfantStatistique = document.querySelector("#enfantStatistique")
                    enfantStatistique.appendChild(blockInfo)
                    var fermeGraph = document.querySelector("#fermeGraph")

                    fermeGraph.onclick = function(){

                        if(window.innerWidth <= 428){
                            statistique.animate([
                                { transform: 'translateX(0)' },     
                                { transform: 'translateX(-100%)' }
                            ],{
                                duration: 200,
                                fill:'forwards'
                            });
            
                            setTimeout(()=>{
                                statistique.style.display="none"
                            },300)
                        }else{
                            statistique.style.display="none"
                        }
                    }
                }

                utilisateurId = this.getAttribute('data-value')
                blockInfo.style.display="none"
                blockTable.style.display="none"
                var selectMois = document.querySelector("#selectMois")
                var containerSelect = document.querySelector("#containerSelect")
                var selectAnnee = document.querySelector("#selectAnnee")
                containerSelect.style.display="block"
                var divAjoutSalaire = document.querySelector("#divAjoutSalaire")
                var divAfficheSalaire = document.querySelector("#divAfficheSalaire")
                var afficheSalaire = document.querySelector("#afficheSalaire")
                var modifierSalaire = document.querySelector("#modifierSalaire");
                 var choixPersonne = copieStack[this.getAttribute('data-value')-1]
                stackedLine.data.datasets = [choixPersonne]
                stackedLine.update();
           
                informationEmployes(tableauInfoEmploye,this.getAttribute('data-value')-1,stackedLine);
                salaireComplet(this.getAttribute('data-value'));

                selectMois.onchange = function(){
                    envoieInfo(element,this,stackedLine);
                    envoieSalaire(this.value,element.getAttribute('data-value'),selectAnnee.value,divAjoutSalaire,divAfficheSalaire,afficheSalaire)
                }

                selectAnnee.onchange = function(){
                    envoieInfo(element,selectMois,stackedLine);
                    envoieSalaire(selectMois.value,element.getAttribute('data-value'),this.value,divAjoutSalaire,divAfficheSalaire,afficheSalaire)
                }

                modifierSalaire.onclick = function(){
                    modifieSalaire(this,afficheSalaire)
                }

                if(selectMois.value == "null" ){
                   
                }else{
                    var chartCache = document.getElementById('myChart')
                    var gif = document.getElementById('gif')
                    chartCache.style.display="none"
                    gif.style.display="flex"
                    setTimeout(()=>{
                        chartCache.style.display="block"
                        gif.style.display="none"
                    },1500)
                    envoieInfo(element,selectMois,stackedLine);
                    envoieSalaire(selectMois.value,element.getAttribute('data-value'),selectAnnee.value,divAjoutSalaire,divAfficheSalaire,afficheSalaire)
                }
           
                var btnSalaire = document.querySelector("#btnSalaire")
                var salaireNet = document.querySelector("#salaireNet")

                btnSalaire.onclick = function(){
                    var idEmploye = element.getAttribute('data-value')
                    var idMois = selectMois.value
                    var idAnnee = selectAnnee.value

                    fetch("../salaire.php?salaire="+salaireNet.value+"&differenceSalaire="+differenceSalaire(salaireNet.value)+"&annee="+idAnnee+"&mois="+idMois+"&employe="+idEmploye)
                    .then(function(response) { 
                        response.json().then( 
                            function(reponse) {
                                afficheSalaire.setAttribute("data-id",reponse[0].id)
                                salaireComplet(idEmploye)
                            }
                        )
                    })
                    
                    divAjoutSalaire.style.display="none"
                    divAfficheSalaire.style.display="block"
                    afficheSalaire.textContent = salaireNet.value+"e"
                }
            }
        });
    },1000)
}