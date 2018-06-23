like_btn = document.querySelector("#like_btn");
comment_input = document.querySelector("#comment_input");
nb_likes = document.querySelector("#likes");

function send_like() {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4) {
            res = xhr.response;
            if (res < 2)
                nb_likes.innerHTML = res + " like";
            else
                nb_likes.innerHTML = res + " likes";
        }
    };
    xhr.open("POST", "../controller/liking.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("pic_id=" + pic_id + "&user_id=" + user_id);
}

like_btn.onclick = () => {
    if (like_btn.className[2] == 'r')
        like_btn.className = 'fas fa-heart';
    else
        like_btn.className = 'far fa-heart';
    send_like();
}

comment_input.onkeypress = (keycode) => {
    if (keycode.keyCode == 13) {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4) {
                if (!xhr.response)
                    return false;
                let res = JSON.parse(xhr.response);
                let author = document.createElement('b');
                author.appendChild(document.createTextNode(res.user_login + " "));
                let comment_section = document.querySelector("#comment_section");
                let comment_text = document.createElement('p');
                comment_text.setAttribute('class', 'col-lg-12 comment');
                let comment_content = document.createTextNode(res.comment);
                comment_text.appendChild(author);
                comment_text.appendChild(comment_content);
                comment_section.insertBefore(comment_text, comment_input);
                comment_input.value = '';
            }
        }
        xhr.open("POST", "../controller/commenting.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("comment=" + comment_input.value + "&user_id=" + user_id + "&pic_id=" + pic_id);
    }
}