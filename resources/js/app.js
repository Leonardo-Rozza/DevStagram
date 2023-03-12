import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`)

            imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
        }
    }


});


//Eventos útiles de Dropzone

/*
dropzone.on('sending',(file, xhr, fromData) => {
    console.log(file);
})

dropzone.on('success', (file, response) =>{
    console.log(response);
})

dropzone.on('error', (file, message) =>{
    console.log(message);
})

dropzone.on('removedfile', ()=> {
    console.log('Archivo eliminado');
})
*/

dropzone.on('success', (file, response) =>{
    document.querySelector('[name="imagen"]').value = response.imagen;
    //console.log(response);
})

dropzone.on('removedfile', ()=> {
    document.querySelector('[name="imagen"]').value = "";
})
