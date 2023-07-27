
text = "to unity scheduling"
let i=0;
counter = 0

function textAnimator(){

    document.getElementById('to_be_animated').innerText = text.slice(0,i)
    i++;
   

    if(i > text.length){
        i=0;
        counter++;
    }
    


}