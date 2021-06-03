var deleteButtons = document.getElementsByClassName("delete_image");
var buttonLength = deleteButtons.length;

var clickedChat;
var chat;

function deleteChat(e){
    clickedChat = e.path[0].dataset.chat; // post_id
    chat = e.path[1]; // get full chat
    divider = e.path[1].nextElementSibling; // get full chat

    var formData = new FormData();

    formData.append("clickedChat", clickedChat);

    fetch("./ajax/deleteChat.php", {
        method: "POST",
        body:formData
    })
        .then(response => response.json())
        .then(result => {
            chat.className = "hidden"; // delete chat a
            if(divider == '<div class="divider"></div>') { // delete divider under a
                divider.className = "hidden";
            }
        })
        .catch(error => {
            console.error("Error:", error);
        })
    e.preventDefault();
}

for(i=0; i<buttonLength; i++){
    deleteButtons[i].onclick = deleteChat;
}