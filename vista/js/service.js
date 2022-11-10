'use strict';

class Service {
    constructor() {
        this.data = new FormData();
        this.inputElement = document.querySelector('input[type=file]');
        this.inputElement.addEventListener("change", this.handleFiles.bind(this), false);
        this.isValid = false;
    }

    request() {
        // msgSending();
        let request = new XMLHttpRequest();
        request.open('POST', '/form');
        // upload progress event
        request.upload.addEventListener('progress', function (e) {
            let percent_complete = (e.loaded / e.total) * 100;

            // percentage of upload completed
            console.log(percent_complete);
        });
        // AJAX request finished event
        request.addEventListener('load', function (e) {
            // HTTP status message
            // msgSendingReset();
            const res = JSON.parse(request.response);
            if (request.status !== 200 && request.status !== 201) {
                console.log(`ocurrió un error: ${request.status}`, res, (typeof request.status));
                // this.showErrorFetch(res.error);
                //Message
                return;
            }

            // showSuccess("Datos enviados con éxito");
            console.log(request.status, res);
            // setTimeout(() => {
            //   location.replace("https://nutramerican.com");
            // }, 5000);
            // request.response will hold the response from the server

        });
        // send POST request to server side script
        request.send(this.data);
    }

    handleFiles() {
        var fileList = this.inputElement.files;
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
    forceFocus() { inputs.forEach(i => i.focus()); btnSend.focus(); }
    checkValues() {
        const listValues = [];
        //Obligatorios
        listValues.push(form.nombre_legal.value);
        listValues.push(form.documento_nit.value);
        listValues.push(form.nombre_establecimiento.value);
        listValues.push(form.direccion_comercial.value);
        listValues.push(form.direccion_residencia.value);
        listValues.push(form.contacto.celular.value);
        listValues.push(form.correo.value);
        listValues.push(form.responsable_pagos.value);
        return listValues.every(value => !isEmpty(value));
    }
    sendFiles() {
        //#region file selected by the user
        // in case of multiple files append each of them
        // inputElements[4].files.forEach(file => {
        //   data.append('file', file );
        // });
        //#endregion
        let isFileValidate = true;
        this.inputElements.forEach(input => {
            isFileValidate = (input.files.length > 0);
            this.showError(isFileValidate, input.id)
            input.files.forEach(file => data.append('file', file));
        });
        if (this.validateJson() && isFileValidate) {
            data.append('form', JSON.stringify(form));
            data.append('asunto', 'prueba');
            this.request(data);
            // console.log(JSON.stringify(form));
        } else this.showErrorFetch("Datos incompletos");
    }

    showSuccess(title) {
        Swal.fire({
            icon: 'success',
            title: title,
            showConfirmButton: false,
            timer: 1500
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

new Service();