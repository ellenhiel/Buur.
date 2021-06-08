var imageInput = document.querySelector("#pfp_input");

var uploadedImage = document.querySelector("#pfp_preview");

imageInput.addEventListener("change", function(event){
    uploadedImage.src = URL.createObjectURL(event.target.files[0]);
})