const divAlterB = document.querySelector('div.alter-b');
const bttDelB = document.querySelector("div.alter-b button");
const inputB = document.querySelector("div.alter-b input");
const optB = document.querySelector("div.gabarito select option#b_id");

const divAlterC = document.querySelector('div.alter-c');
const bttDelC = document.querySelector("div.alter-c button");
const inputC = document.querySelector("div.alter-c input");
const optC = document.querySelector("div.gabarito select option#c_id");

const divAlterD = document.querySelector('div.alter-d');
const bttDelD = document.querySelector("div.alter-d button");
const inputD = document.querySelector("div.alter-d input");
const optD = document.querySelector("div.gabarito select option#d_id");

const divAlterE = document.querySelector('div.alter-e');
const bttDelE = document.querySelector("div.alter-e button");
const inputE = document.querySelector("div.alter-e input");
const optE = document.querySelector("div.gabarito select option#e_id");

const bttNovaAlt = document.querySelector("button.nova-alt");

const bttDelAlt = document.querySelectorAll("div.field button");

let i = 0;

function novaAlternativa() {
    i++;

    switch (i) {
        case 1:              
            // divAlterB.style = "display: block;";
            divAlterB.classList.remove("inactive-alt");
            divAlterB.classList.add("default-alt");

            inputB.removeAttribute('disabled');
            optB.removeAttribute('disabled');
            break;

        case 2:
            // divAlterC.style = "display: block;";
            divAlterC.classList.remove("inactive-alt");
            divAlterC.classList.add("default-alt");

            bttDelB.style = "display: none;";
            inputC.removeAttribute('disabled');
            optC.removeAttribute('disabled');
            break;

        case 3:
            // divAlterD.style = "display: block;";
            divAlterD.classList.remove("inactive-alt");
            divAlterD.classList.add("default-alt");

            bttDelC.style = "display: none;";
            inputD.removeAttribute('disabled');
            optD.removeAttribute('disabled');
            break;

        case 4:
            // divAlterE.style = "display: block;";
            divAlterE.classList.remove("inactive-alt");
            divAlterE.classList.add("default-alt");

            bttDelD.style = "display: none;";
            inputE.removeAttribute('disabled');
            optE.removeAttribute('disabled');
            break;

        default:
            break;
    }

    if (i == 4)
        bttNovaAlt.style = "display: none";
}



function delAlternativa() {
    if (i <= 4)
        bttNovaAlt.style = "display: unset";

    switch (i) {
        case 1:              
            // divAlterB.style = "display: none;";
            divAlterB.classList.add("inactive-alt");
            divAlterB.classList.remove("default-alt");

            inputB.setAttribute('disabled', '');
            optB.setAttribute('disabled', '');
            i--;

            break;

        case 2:
            // divAlterC.style = "display: none;";
            divAlterC.classList.add("inactive-alt");
            divAlterC.classList.remove("default-alt");

            inputC.setAttribute('disabled', '');
            optC.setAttribute('disabled', '');
            bttDelB.style = "display: unset;";
            i--;

            break;

        case 3:
            // divAlterD.style = "display: none;";
            divAlterD.classList.add("inactive-alt");
            divAlterD.classList.remove("default-alt");
            
            inputD.setAttribute('disabled', '');
            optD.setAttribute('disabled', '');
            bttDelC.style = "display: unset;";
            i--;

            break;

        case 4:
            // divAlterE.style = "display: none;";
            divAlterE.classList.add("inactive-alt");
            divAlterE.classList.remove("default-alt");

            inputE.setAttribute('disabled', '');
            optE.setAttribute('disabled', '');
            bttDelD.style = "display: unset;";
            i--;

            break;

        default:
            break;
    }

    if (i == 4) {
        bttNovaAlt.style = "display: none";
    }
}



function initAlternativasJaFeitas() {
    if (inputB.value != "")
        novaAlternativa();

    if (inputC.value != "")
        novaAlternativa();

    if (inputD.value != "")
        novaAlternativa();

    if (inputE.value != "")
        novaAlternativa();
}



initAlternativasJaFeitas();



bttNovaAlt.onclick = () => {
    novaAlternativa();
}

bttDelAlt.forEach(element => {
    element.onclick = () => {
        delAlternativa();
    }
});
