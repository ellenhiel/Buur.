var btnShowMore = document.querySelector("#show_more_btn");
var currentlyShownPosts = 10; //Default amount of posts shown

var post_section = document.querySelector("#posts_section");

var link = window.location.href;

var GET = getUrlVariables(link);

btnShowMore.addEventListener("click", function(e){

    var formData = new FormData();
    formData.append("postStart", currentlyShownPosts);
    currentlyShownPosts = currentlyShownPosts + 10; //Add 10 to increase the max (So next time it'll be 20 to 30)
    formData.append("postEnd", currentlyShownPosts);
    if(GET){
        formData.append("filters", GET);
    } else {
        formData.append("filters", "0");
    }

    console.log(GET);

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

            if(result["result"].length == 0){
                btnShowMore.innerHTML = "Er zijn geen resultaten meer!";
            }

        })
        .catch(error => {
            console.error("Error:", error);
        })

    e.preventDefault();
});

function createPostDiv(item) {
    var a_post_wrapper = document.createElement("a");
    a_post_wrapper.setAttribute('href', 'individualListing.php?q=' + item["id"]);
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
    a_post_wrapper.append(post_wrapper);
    console.log(a_post_wrapper);
    return a_post_wrapper;
}

function getUrlVariables(link) {
    var GETArray = [];
    var isThereGET = false;
    var typeArray = [];

    if(link.includes("recent")){
        GETArray.push("recent")
        isThereGET = true;
    } else if(link.includes("versheid")) {
        GETArray.push("versheid");
    }

    if(link.includes("fruit")){
        typeArray.push("fruit");
        isThereGET = true;
    }

    if(link.includes("groenten")){
        typeArray.push("groenten");
        isThereGET = true;
    }

    if(link.includes("andere")){
        typeArray.push("andere");
        isThereGET = true;
    }

    if(link.includes("distance")){
        var distance = link.slice(-2);
        if(distance.includes("=")){
            distance = distance.slice(-1);
        }
        GETArray.push(distance);
        isThereGET = true;
    }

    GETArray.push(typeArray);
    
    if(isThereGET){
        return GETArray;
    } else {
        return false;
    }
}