var video_section = document.querySelector("#video_section");
var canvas = document.querySelector("#canvas");
var take_photo = document.querySelector("#take_picture");
var publish = document.querySelector("#publish");
var context = canvas.getContext("2d");


navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

publish.disabled = true;
if (navigator.getUserMedia) {       
    navigator.getUserMedia({video: true}, handleVideo, videoError);
}

take_photo.onclick = function() {
    context.drawImage(video, 75, 0, 500, 500, 0, 0, 400, 400);
    publish.disabled = false;
}

publish.onclick = function() {
    var xhttp = new XMLHttpRequest();
    var v = document.querySelector("#video");
    var img_data = canvas.toDataURL("image/jpeg");
    xhttp.open("POST", "../../controller/store_img.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("img=" + img_data);
    //var img = new Image();
    //img.src = img_data;
    //img.setAttribute("class", "col-lg-3");
    //var add_panel = document.querySelector("#add_panel");
    //add_panel.appendChild(img);
}
 
function handleVideo(stream) {
    var video = document.createElement('video');
    video.id = "video";
    video.setAttribute("width", "100%");
    video.autoplay = true;
    video_section.appendChild(video);
    video.srcObject = stream;
}

function videoError(e) {
    console.log(e);
}