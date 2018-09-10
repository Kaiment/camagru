var pass1 = document.querySelector("#password1");
var pass2 = document.querySelector("#confirm_password");
var submit = document.querySelector("#submit_register");

submit.disabled = true;

if (pass1) {
    pass1.onkeyup = function (event) {
        let submit = document.querySelector("#submit_register");
        e = event || window.event;
        if (e.target.value.length >= 6 && e.target.value.match("[0-9]") !== null || e.target.value === "") {
            delete_warning();
            submit.disabled = false;
        }
        else {
            create_warning();
            submit.disabled = true;
        }
    }

    function create_warning() {
        if (document.querySelector("#warning_pw") !== null)
            return;
        let elem = document.createElement("p");
        let text = document.createTextNode("Password needs to be at least 6 characters long and containing at least one digit");
        elem.appendChild(text);
        elem.setAttribute("id", "warning_pw");
        elem.setAttribute("class", "col-lg-12 warning")
        let form = document.querySelector("#auth_form");
        form.appendChild(elem);
    }
}

function delete_warning() {
    let warning = document.querySelector("#warning_pw");
    if (warning === null)
        return;
    warning.parentNode.removeChild(warning);
}