import "./bootstrap";

import "~resources/scss/app.scss";

import.meta.glob(["../img/**"]);

import * as bootstrap from "bootstrap";

const confirmDelete = document.querySelector("#confirm-delete");
document.querySelectorAll(".js-delete").forEach((btn) => {
    btn.addEventListener("click", function () {
        console.log('hai cliccato il bottone con id ' + this.dataset.id);
        confirmDelete.action = confirmDelete.dataset.template.replace(
            "*****",
            this.dataset.id
        );
    });
});
