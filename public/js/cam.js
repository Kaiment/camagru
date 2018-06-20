// Parts for image generation
var video_section = document.querySelector("#video_section");
var save_section = document.querySelector("#saved_pics");
var preview = document.querySelector("#preview");
//var context = canvas.getContext("2d");
var video = null;
var canvas = document.createElement('canvas');
canvas.setAttribute('width', 480);
canvas.setAttribute('height', 480);
var context = canvas.getContext('2d');

// Inputs
var take_photo = null;
var publish = document.querySelector("#publish");
var choose_file = document.querySelector("#choose_file");
var submit_file = document.querySelector("#submit_file");
publish.disabled = true;

choose_file.disabled = true;
submit_file.disabled = true;
// Data to send to server
var img_data = null;
var montage_img = null;
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

function send_pic() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
            preview.src = xhr.response;
        }
    };
    xhr.open("POST", "../../controller/create_img.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("img=" + img_data + "&montage_img=" + montage_img);
}

function enable_publish() {
    publish.disabled = false;
    publish.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4) {
                let saved = document.createElement("img");
                saved.setAttribute('class', 'col-lg-3');
                saved.src = xhr.response;
                save_section.appendChild(saved);
                publish.disabled = true;
            }
        };
        xhr.open("GET", "../../controller/store_img.php", true);
        xhr.send();
    }
}

function select_montage_img() {
    montage_img = event.target.value;
    take_photo.disabled = false;
    choose_file.disabled = false;
    submit_file.disabled = false;
}

// UPLOAD IMG
submit_file.onclick = function() {
    if (!choose_file.files[0])
        return;
    file = choose_file.files[0];
    publish.disabled = false;
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.addEventListener("load", () => {
        img_data = reader.result;
    });
    console.log(img_data);
    //send_pic();
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
        img_data = canvas.toDataURL('image/jpeg');
        send_pic();
        enable_publish();
    }
    section.appendChild(input);
    take_photo = input;
}

function videoError(e) {
    console.log(e);
}