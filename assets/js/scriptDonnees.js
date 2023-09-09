function trColor(){
    var trAll = document.querySelectorAll('tr')

    for(var n =1 ; n < trAll.length-3; n++){
        if(n%2 == 0){
            trAll[n].style.backgroundColor="#EAF8E6"
        }else{
            trAll[n].style.backgroundColor="white"
        }
    }
}

trColor()