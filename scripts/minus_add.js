var q=100;
var quanity;
console.log(q);
function minus(){
    q=document.getElementById('quanity').value;
    quanity=parseInt(q);
    //console.log(q);
    if(quanity>1){
        quanity=quanity-1;
    }
    console.log(quanity);
    document.getElementById("quanity").value=quanity.toString();
}

function plus(){

    q=document.getElementById('quanity').value;
    quanity=parseInt(q);
    //console.log(q);
    if(quanity<100)
    {
        quanity=quanity+1;
    }
    console.log(quanity);
    document.getElementById("quanity").value=quanity.toString();
}
