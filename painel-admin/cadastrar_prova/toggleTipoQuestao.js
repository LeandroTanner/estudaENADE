const inputTipo = document.getElementById("tipo_id");
const bttTipoAlt = document.querySelector("button.btt-a");
const bttTipoDis = document.querySelector("button.btt-d");

const bttTipoQuestao = document.querySelectorAll("button.tipo-questao");

const divGabarito = document.querySelector("div.field.gabarito");
const inputGabarito = document.querySelector("div.field.gabarito select");

const divComentario = document.querySelector("div.field.comentario");
const inputComentario = document.querySelector("div.field.comentario textarea");



function toggleAlternativa() {
    divComentario.style = "display: none;";
    inputComentario.setAttribute('disabled', '');

    divGabarito.style = "display: unset;";
    inputGabarito.removeAttribute('disabled');
    inputTipo.value = 'A';
}



function toggleDissertativa() {
    divComentario.style = "display: unset;";
    inputComentario.removeAttribute('disabled');

    divGabarito.style = "display: none;";
    inputGabarito.setAttribute('disabled', '');
    inputTipo.value = 'D';
}



function initTipoQuestao() {
    if (bttTipoAlt.classList.contains('active')) {
        toggleAlternativa();
    } else {
        toggleDissertativa();
    }
}



bttTipoQuestao.forEach(element => {
    element.onclick = () => {
        if (element.value == "alternativa") {
            element.classList.add("active");
            bttTipoDis.classList.remove("active");

            toggleAlternativa();
        } else {
            element.classList.add("active");
            bttTipoAlt.classList.remove("active");

            toggleDissertativa();
        }
    }
});



initTipoQuestao();
