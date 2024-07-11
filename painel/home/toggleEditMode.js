const btnEditMode = document.querySelector("i.editar");

const btnUpdate = document.querySelector("button.btn.atualizar-perfil");
const btnCancelar = document.querySelector("button.btn.close-edit-mode");

const emailLockIcon = document.querySelector("i.fa-lock");

const inFoto = document.querySelector("input.foto");
const lblFoto = document.querySelector("label.lbl-foto");



function editModeOn() {
    btnEditMode.classList.replace("fa-pen", "fa-pen-line");
    btnEditMode.classList.add("active");

    btnCancelar.style = "display: flex;";
    btnUpdate.style = "display: flex;";
    

    document.querySelectorAll("div.perfil div.field input").forEach(element => {
        element.classList.replace("desabilitado", "habilitado");
        element.attributes.removeNamedItem("disabled");
    });

    document.querySelector("div.email-field input").setAttribute("disabled", "");

    emailLockIcon.style = "display: unset;";
    inFoto.style = "display: unset;";
    lblFoto.style = "display: unset;";
}


function editModeOff() {
    btnEditMode.classList.replace("fa-pen-line", "fa-pen");
    btnEditMode.classList.remove("active");

    btnCancelar.style = "display: none;";
    btnUpdate.style = "display: none;";

    document.querySelectorAll("div.perfil div.field input").forEach(element => {
        element.classList.replace("habilitado", "desabilitado");
        element.setAttribute("disabled", "");
    });

    emailLockIcon.style = "display: none;";
    inFoto.style = "display: none;";
    lblFoto.style = "display: none;";
}



btnEditMode.onclick = () => {
    editModeOn();
}


btnCancelar.onclick = () => {
    editModeOff();
}


editModeOff();
