//Overlay stuff
var filter_overlay = document.querySelector("#filter_overlay");
var filter_open_btn = document.querySelector("#filter_icon");
var filter_close_btn = document.querySelector("#filter_close_icon");

filter_open_btn.addEventListener("click", function(){
    filter_overlay.style.height = "100%";
});

filter_close_btn.addEventListener("click", function(){
    filter_overlay.style.height = "0";
});

//Range slider showing
var range_slider = document.querySelector("#range_slider");
var range_slider_output = document.querySelector("#range_output");

range_slider.addEventListener("input", function(){
    range_slider_output.innerHTML = range_slider.value;
});