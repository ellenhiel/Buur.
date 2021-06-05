var jaarlijks_radio = document.getElementById("jaarlijks");
var maandelijks_radio = document.getElementById("maandelijks");

var jaarlijks_btn = document.getElementById("jaarlijks_btn");
var maandelijks_btn = document.getElementById("maandelijks_btn");

jaarlijks_btn.addEventListener("click", function(){
    if(!jaarlijks_radio.checked){
        jaarlijks_btn.classList.add("selected");
        maandelijks_btn.classList.remove("selected");
    }
});

maandelijks_btn.addEventListener("click", function(){
    if(!maandelijks_radio.checked){
        jaarlijks_btn.classList.remove("selected");
        maandelijks_btn.classList.add("selected");
    }
});