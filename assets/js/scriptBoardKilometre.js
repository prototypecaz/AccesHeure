var selectAnnee = document.querySelector("#selectAnnee")
var selectMois = document.querySelector("#selectMois")
var tbody = document.querySelector('tbody')
var kilometreTotal = document.querySelector('#kilometreTotal')
var totalEuros = document.querySelector('#totalEuros')
var table = document.querySelector('table')
var btnImprime = document.querySelector('#btnImprime')
var moisChoisis  = document.querySelector('#moisChoisis')
var containeMoisFournis = document.querySelector(".containeMoisFournis")

function printSection(){
    let popupWinindow
    var table = document.querySelector('.containeTable')
    popupWinindow = window.open('', '_blank', 'top=0,left=0,height=100%,width=auto');
    popupWinindow.document.open();
    popupWinindow.document.write('<html><head><link href="../assets/css/styleBoardKm.css" rel="stylesheet"><link media="print" href="../assets/css/print.css" rel="stylesheet"/></head><body onload="window.print();">'+table.innerHTML+  '</html>');
    popupWinindow.document.close();
}

btnImprime.onclick = function(){
    printSection();
}

function recupereKm(){

    tbody.textContent = ""
    
    fetch("./recupereDonneeFetch.php?selectMois="+selectMois.value+"&selectAnnee="+selectAnnee.value)
    .then(function(response) { 
        response.json().then( 
            function(reponseJson) {

                if(reponseJson[0].length <= 0){
                    table.style.display="none"
                    containeMoisFournis.style.display="flex"
                    
                }else{
                    containeMoisFournis.style.display="none"
                    kilometreTotal.textContent=reponseJson[1]
                    totalEuros.textContent = (reponseJson[1]*0.574).toFixed(2) + "e"

                    var p = 0

                    reponseJson[0].forEach(element => {
                        var rowTr = document.createElement('tr')
                        var repDate = document.createElement('td')
                        repDate.textContent = element.date
                        var repClient = document.createElement('td')
                        repClient.textContent = element.client
                        var repLieu = document.createElement('td')
                        repLieu.textContent =element.lieu.toLowerCase()
                        var repFrais = document.createElement('td')
                        repFrais.textContent = element.frais
                        var repKilometre = document.createElement('td')
                        repKilometre.textContent = element.kilometre
                        var repRepas = document.createElement('td')
                        repRepas.textContent = element.repas

                        rowTr.appendChild(repDate)
                        rowTr.appendChild(repClient)
                        rowTr.appendChild(repLieu)
                        rowTr.appendChild(repFrais)
                        rowTr.appendChild(repKilometre)
                        rowTr.appendChild(repRepas)

                        tbody.appendChild(rowTr)

                        p++

                        if(p%2 == 1){
                            rowTr.style.backgroundColor="white"
                        }else{
                            rowTr.style.backgroundColor="#EAF8E6"
                        }
                    });

                    table.style.display="table"
                }
            }
        )
    })
}

selectMois.onchange = function(){
    table.style.display="none"
    recupereKm()
    moisChoisis.textContent = this.options[this.selectedIndex].text +" "+ selectAnnee.value
}

selectAnnee.onchange = function(){
    table.style.display="none"
    recupereKm()
    moisChoisis.textContent = selectMois.options[selectMois.selectedIndex].text +" "+ this.value
}



