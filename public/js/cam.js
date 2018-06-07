// Parts for image generation
var video_section = document.querySelector("#video_section");
var canvas = document.querySelector("#canvas");
var context = canvas.getContext("2d");
var video = null;

// Inputs
var take_photo = null;
var publish = document.querySelector("#publish");
publish.disabled = true;

var montage_img = null;

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;



function select_montage_img() {
    console.log(event.target.value);
    montage_img = event.target.value;
    take_photo.disabled = false;
}

publish.onclick = function() {
    var xhttp = new XMLHttpRequest();
    var v = document.querySelector("#video");
    var img_data = canvas.toDataURL("image/jpeg");
    xhttp.open("POST", "../../controller/store_img.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("img=" + img_data + "&montage_img=" + montage_img);
}

/*
***  Start video capture
*/
if (navigator.getUserMedia) {       
    navigator.getUserMedia({video: true}, handleVideo, videoError);
}

function handleVideo(stream) {
    create_video_elem(stream);
    create_take_picture_elem();
}

function create_video_elem(stream) {
    let v = document.createElement('video');
    v.id = "video";
    v.setAttribute("width", "100%");
    v.setAttribute("height", "100%");
    v.autoplay = true;
    video_section.appendChild(v);
    v.srcObject = stream;
    video = v;
}

function create_take_picture_elem() {
    let section = document.querySelector("#take_picture_section");
    let input = document.createElement("input");
    input.setAttribute("class", "col-lg-4 offset-lg-4 menu_button");
    input.setAttribute("id", "take_picture");
    input.setAttribute("type", "submit");
    input.setAttribute("value", "TAKE");
    input.setAttribute("disabled", "true");
    input.onclick = function() {
        context.drawImage(video, 80, 0, 480, 480, 0, 0, 480, 480);
        publish.disabled = false;
    }
    section.appendChild(input);
    take_photo = input;
}

function videoError(e) {
    console.log(e);
}