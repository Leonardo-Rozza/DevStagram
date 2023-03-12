import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,
})

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
    console.log(response);
})
