var pass2 = document.querySelector("#confirm_password");
var submit = document.querySelector("#submit_register");

submit.disabled = true;


function delete_warning() {
    let warning = document.querySelector("#warning_pw");
    if (warning === null)
        return;
    warning.parentNode.removeChild(warning);
}