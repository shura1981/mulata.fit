'use strict';
class Service {
    constructor(url) {
        this.url = url;
        this.data = new FormData();
        this.inputElement = document.querySelector('input[type=file]');
        this.button = document.getElementById("custom-validation-button");
        this.inputElement.addEventListener("change", this.handleFiles.bind(this), false);
        // this.button.addEventListener("click", this.sendFiles.bind(this));
        this.form = document.getElementById("form");
        this.isValid = false;
        this.s = null;

        this.notiScroll= document.querySelector(".scrollDown");

        this.form.addEventListener("submit", e => {
            e.preventDefault();
            this.sendFiles();
        });

        console.log(this.notiScroll);

        // window.onscroll = function(ev) {
        //     if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        //        console.log("bottom");
        //     }
        // };


const loadElements = () => {
const options = {
rootMargin: '0px 0px -200px 0px'
}

const observer = new IntersectionObserver((entries, observer) => {
entries.forEach(entry => {
if (entry.isIntersecting) {
 entry.target.classList.add("d-none");
observer.unobserve(entry.target);
} else {
return;
}
})
}, options);
observer.observe(this.notiScroll);
}


loadElements();
    }
    msgSending() {
        if (this.s) {
            this.s.close();
            this.s = null;
        }
        else {
            this.s = Swal.fire({
                title: '¡Ya casi está listo!',
                html: 'Enviando comprobante de pago',
                // timer: 2000,
                backdrop: false,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
        }

    }
    request() {
        this.msgSending();
        let request = new XMLHttpRequest();
        request.open('POST', this.url);
        // upload progress event
        request.upload.addEventListener('progress', function (e) {
            let percent_complete = (e.loaded / e.total) * 100;

            // percentage of upload completed
            console.log(percent_complete);
        });
        // AJAX request finished event
        request.addEventListener('load', (function (e) {
            // HTTP status message
            this.msgSending();
            console.log(request.response);
            const res = JSON.parse(request.response);
            if (request.status !== 200 && request.status !== 201) {
                // console.log(`ocurrió un error: ${request.status}`, res, (typeof request.status));
                this.showErrorFetch("Ocurrió un error al enviar el formulario");
                //Message
                return;
            }

            this.form.reset();
            this.showSuccess("Datos enviados con éxito");
            // console.log(request.status, res);
            // setTimeout(() => {
            //   location.replace("https://nutramerican.com");
            // }, 5000);
            // request.response will hold the response from the server

        }).bind(this));
        // send POST request to server side script
        request.send(this.data);
    }

    handleFiles() {
        const fileList = this.inputElement.files;
        this.isValid = (fileList.length > 0);
        this.showError(this.isValid)
        this.assingFiles(this.inputElement.id, fileList);

    }
    showError(validate) {
        const label = document.querySelector(`#vanexos`);
        if (!validate) label.classList.remove("d-none");
        else label.classList.add("d-none");
    }

    assingFiles(id, values) {
        console.log(id, values);
        // const item = this.form.anexos_links[id];
        // if (id == "extractos_bancarios") {
        //     item.value = (values.length > 0) ? Array.from(values).map(f => f.name) : [];
        // } else item.value = (values.length > 0) ? values[0].name : '';
    }
    validateJson() {
        this.forceFocus();
        return this.checkValues()
    }
    isEmpty = str => !str.trim().length;
    isEmail = value => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    validar(value, type) {
        if (type === "text") return !this.isEmpty(value);
        if (type === "email") return (!this.isEmpty(value) && this.isEmail(value));
        if (type === "number") return (Number(value) > 0)
        return false;
    }

    checkValues(inputs) {
        return inputs.every(input => this.validar(input.value, input.type));
    }

    getKeysForm(form) {
        const formEntries = new FormData(form).entries();
        return Object.assign(...Array.from(formEntries, ([name, value]) => ({ [name]: value })));
    }
    sendFiles() {
        // .querySelectorAll('input:not([type="hidden"]):not([value=""])')
        const label = document.getElementById("vanexos");
        const inputs = this.form.querySelectorAll('input:not([type="file"])')
        let isFileValidate = true;
        this.inputElement.files.forEach(file => {
            this.data.append('file[]', file);
        });
        if (this.inputElement.files.length < 1 || !this.checkValues(Array.from(inputs))) isFileValidate = false;

        if (this.inputElement.files.length < 1) label.classList.remove("d-none")
        else label.classList.add("d-none")

        if (isFileValidate) {
            const f = this.getKeysForm(this.form);
            this.data.append('nombre', f.name);
            this.data.append('correo', f.email);
            this.data.append('celular', parseInt(f.celular));
            this.data.append('dias',plan.dia);
            this.request();
        } else this.showErrorFetch("Datos incompletos");
    }

    showSuccess(title) {
        Swal.fire({
            icon: 'success',
            title: title,
            showConfirmButton: false,
            footer: '<a href="https://mulata.fit">Volver</a>'
        })
    }
    showErrorFetch(text, status) {
        Swal.fire({
            icon: 'error',
            title: 'Oops... Ocurrió un error',
            text: text,
            footer: '<a href="#">Por favor revisa el formulario</a>'
        })
    }

}
new Service('../api/registrocomprobante');





