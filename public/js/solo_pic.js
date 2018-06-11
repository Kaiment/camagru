like_btn = document.querySelector("#like_btn");

like_btn.onclick = () => {
    if (like_btn.className[2] == 'r')
        like_btn.className = 'fas fa-heart';
    else
        like_btn.className = 'far fa-heart';
}
