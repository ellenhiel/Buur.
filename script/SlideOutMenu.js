var open = false;

document.querySelector("#menuButton").addEventListener("click", function(e){

    if(!open){
        e.preventDefault();
        document.querySelector("#navWrapper").style.left = "calc(100% - 150px)";

        document.querySelector(".menu:first-child").style.left = "8px";
        open = true;
    } else {
        e.preventDefault();
        document.querySelector("#navWrapper").style.left = "100%";

        document.querySelector(".menu:first-child").style.left = "-8px";
        open = false;
    }
    
});