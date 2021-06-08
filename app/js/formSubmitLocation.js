var uploadForm = document.querySelector("#uploadForm");
var submitBtn = document.querySelector("#btn_submit");
var userLonInput = document.querySelector("#userLon");
var userLatInput = document.querySelector("#userLat");

var locationError = document.querySelector("#locationError");

var userLat;
var userLon;

function submitPost(e) {
    var geolocation = navigator.geolocation;
    geolocation.getCurrentPosition(getLocation, errorHandler);
    e.preventDefault();
}

function errorHandler() {
    locationError.style.visibility = "visible";
}

function getLocation(position){
    userLat = position.coords.latitude;
    userLon = position.coords.longitude;
    
    setLocation(userLat, userLon);
}

function setLocation(lat, lon){
    userLatInput.setAttribute("value", lat);
    userLonInput.setAttribute("value", lon);

    uploadForm.submit();
}