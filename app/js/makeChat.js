
var receiver;

function makeChat(e) {
    receiver = e.path[0].dataset.receiver; // first make dataset

    var formData = new FormData();

    formData.append("receiver", receiver);

    fetch("./ajax/makeChat.php", {
        method: "POST",
        body:formData
    })
        .then(response => response.json())
        .then(result => {
            console.log(result);
            window.location.href = "chat.php?q="  + result.chatId + "?&b=" + result.sender;
        })
        .catch(error => {
            console.error("Error:", error);
        });
    e.preventDefault();
}