var markButton = document.querySelector("#markAsSaved");

markButton.addEventListener("click", function(e){
    var senderId = e.path[0].attributes[3].nodeValue;
    var receiverId = e.path[0].attributes[4].nodeValue;
    
    var formData = new FormData();
    formData.append("sender", senderId);
    formData.append("receiver", receiverId);

    fetch("./ajax/markAsSaved.php", {
        method: "POST",
        body:formData
    })
    .then(response => response.json())
    .then(result => {
        console.log(result);
        window.location.replace("http://localhost:8888/buur/app/home.php");
    })
    .catch(error => {
        console.error("Error:", error);
    })

    e.preventDefault();
});