var btnShowMore = document.querySelector("#show_more_btn");
var currentlyShownPosts = 10; //Default amount of posts shown

var post_section = document.querySelector("#posts_section");

btnShowMore.addEventListener("click", function(e){

    var formData = new FormData();
    formData.append("postStart", currentlyShownPosts);
    currentlyShownPosts = currentlyShownPosts + 10; //Add 10 to increase the max (So next time it'll be 20 to 30)
    formData.append("postEnd", currentlyShownPosts);

    fetch("./ajax/loadMore.php", {
        method: "POST",
        body:formData
    })
        .then(response => response.json())
        .then(result => {
            for(var i = 0; i < result["result"].length; i++){
                var post = createPostDiv(result["result"][i]);

                post_section.append(post);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        })

    e.preventDefault();
});

function createPostDiv(item) {
    var post_wrapper = document.createElement("div");
    post_wrapper.classList.add("post_wrapper");
    post_wrapper.innerHTML = "<div class='image_wrapper'><img src='post_uploads/"+ item["listing_image"] +"'></div>" + 
    "<div class='info_wrapper'>"+
    "<h3>"+ item["title"] +"</h3>"+
    "<div class= 'location_wrapper'>"+
    "<img src='assets/location_dot.png'>"+
    "<p>0.5km</p>"+
    "</div>"+
    "<span style='width:"+ 150/100*item["freshness"] +"px;'></span>"+
    "</div>"+
    "<div class='user_wrapper'>"+
    "<img src='profile_pictures/"+ item[7] +"'>"+
    "</div>"+
    "</div>";
    return post_wrapper;
}