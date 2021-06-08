var buttons = document.getElementsByClassName("reactie_button");
var buttonLength = buttons.length;

var clickedListing;
var listing;

function getChats(e){
    clickedListing = e.path[1].dataset.listing; // post_id

    if(clickedListing != undefined) {
        window.location.href = "chats.php?listingId="  + clickedListing;
    }
    
    e.preventDefault();
}

for(i=0; i<buttonLength; i++){
    buttons[i].onclick = getChats;
}