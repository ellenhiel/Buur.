var commentBtns = document.getElementsByClassName("sendBtn");
var buttonLength = commentBtns.length;
var message;
var receiverId;

function message(e){
    message1 = e.path[1][0].value; // text comment
    message2 = e.path[1][0]; // text comment
    receiver = e.path[0].dataset.receiver;
    div = e.path[3].children[1];

    var formData = new FormData();

    formData.append("message", message1);
    formData.append("receiver", receiver);

    fetch("./ajax/sendMessage.php", {
        method: "POST",
        body:formData
    })
        .then(response => response.json())
        .then(result => {

            // empty input
            message2.value = "";
            
            // new div
            var newDiv = document.createElement('div');
            newDiv.setAttribute('data-origin', 'outgoing');
            div.appendChild(newDiv);

            // p in div
            var newP = document.createElement('p');
            newP.innerHTML = result.input;
            newDiv.appendChild(newP);
        })
        .catch(error => {
            console.error("Error:", error);
        });
    e.preventDefault();
}

for(i=0; i<buttonLength; i++){
    commentBtns[i].onclick = message;
}