var imageInput = document.querySelector("#image_input");

var uploadedImage = document.querySelector("#imagePreview");

imageInput.addEventListener("change", function(event){
    uploadedImage.src = URL.createObjectURL(event.target.files[0]);
})