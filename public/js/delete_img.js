let msg_container = document.querySelector('#msg');

function delete_img(event) {
    let img = event.target;
    if (confirm("Are you sure you want to delete this pic ?")) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                if (xhr.response) {
                    create_msg(false, 'Picture succesfully deleted');
                    img.parentNode.removeChild(img);
                }
                else {
                    create_msg(true, 'Error occured');
                    return ;
                }
            }
        }
        xhr.open("GET", "../../controller/delete_img.php?pic_id=" + img.id, true);
        xhr.send();
    }
}

function create_msg(err, msg) {
    if (msg_container.firstChild)
        msg_container.removeChild(msg_container.firstChild);
    let msg_box = document.createElement('p');
    if (err)
        msg_box.setAttribute('class', 'error col-lg-10 offset-lg-1');
    else
        msg_box.setAttribute('class', 'success col-lg-10 offset-lg-1');
    let msg_node = document.createTextNode(msg);
    msg_box.appendChild(msg_node);
    msg_container.appendChild(msg_box);
}