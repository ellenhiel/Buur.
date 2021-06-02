var deleteButtons = document.getElementsByClassName("verwijder_button");
var buttonLength = deleteButtons.length;

var clickedListing;
var listing;

function deleteListing(e){
    clickedListing = e.path[1].dataset.listing; // post_id
    listing = e.path[2]; // get full listing

    console.log(listing);

    var formData = new FormData();

    formData.append("clickedListing", clickedListing);

    fetch("./ajax/deleteListing.php", {
        method: "POST",
        body:formData
    })
        .then(response => response.json())
        .then(result => {
            listing.className = "hidden"; // delete listing div
        })
        .catch(error => {
            console.error("Error:", error);
        })
    e.preventDefault();
}

for(i=0; i<buttonLength; i++){
    deleteButtons[i].onclick = deleteListing;
}