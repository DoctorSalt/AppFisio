"use strict"
console.log('HOls');
aniadirBotonesEliminar();
let botonAnadirForm = document.getElementById('botonAniadirForm');
botonAnadirForm.addEventListener('click',aniadirForm)
/*
function aniadirForm(){
    let selectDiaSemanaForm = document.getElementById('diaSemana');
    let diaSeleccionado = selectDiaSemanaForm.value;
    if(diaSeleccionado!="0"){
        console.log("Dia->"+diaSeleccionado);
        let tabla = document.getElementById('tablaForm');
        tabla.setAttribute('class', 'table');
        let lineaDiferente = document.getElementById('linea'+diaSeleccionado);
        lineaDiferente.setAttribute('class', 'lineas');
        let botonEnviarFormulario = document.getElementById('botonEnviarForm');
        botonEnviarFormulario.setAttribute('class','btn btn-primary');
    }
}
function aniadirBotonesEliminar(){
    let botonesEliminar = document.getElementsByClassName('botonesEliminar');    
    let botonesAniadir = document.getElementsByClassName('botonesAnadir');  
    for(let x=0; x<botonesEliminar.length;x++){
        let boton1=botonesEliminar[x];
        let boton2=botonesAniadir[x];
        boton1.addEventListener('click',function(){
            let numeroDia=boton1.getAttribute('data-code')
            console.log(numeroDia);
            let lineas=document.getElementById('linea'+numeroDia);
            let inputHora1=document.getElementById('dia'+numeroDia+"-m1");
            let inputHora2=document.getElementById('dia'+numeroDia+"-m2");
            let inputHora3=document.getElementById('dia'+numeroDia+"-t1");
            let inputHora4=document.getElementById('dia'+numeroDia+"-t2");
            inputHora1.value="";
            inputHora2.value="";
            inputHora3.value="";
            inputHora4.value="";
            inputHora3.setAttribute('class','d-none form-control');
            inputHora4.setAttribute('class','d-none form-control')
            botonesAniadir[x].setAttribute('class','btn btn-success botonesAnadir')
            lineas.setAttribute('class','lineas d-none');
       });
       boton2.addEventListener('click',function(){
            let numeroDia=boton2.getAttribute('data-code')
            console.log(numeroDia);
            boton2.setAttribute('class','d-none btn btn-success botonesAnadir');
            let inputHora13=document.getElementById('dia'+numeroDia+"-t1");
            let inputHora14=document.getElementById('dia'+numeroDia+"-t2");
            inputHora13.setAttribute('class','form-control');
            inputHora14.setAttribute('class','form-control');
        });
    }  
}
*/
function validateForm(){
    let valido=true;
    let fechaInicialInput = document.getElementById('fechaInicioInput').value;
    let fechaFinInput = document.getElementById('fechaFinInput').value;    
    let fechaActual = new Date();
    let fechaActualString= fechaActual.getFullYear() + "-" + (fechaActual.getMonth() + 1) + "-" + fechaActual.getDate()
    console.log("Entro en valido")
    for(let x=1;x<=5;x++){
        console.log('Dentro linea '+x)
        let linea = document.getElementById('linea'+x);
        let inputHoraParte21=document.getElementById('dia'+x+"-t1")
        let inputHoraParte22=document.getElementById('dia'+x+"-t2")
        let inputHoraParte11=document.getElementById('dia'+x+"-m1");
        let inputHoraParte12=document.getElementById('dia'+x+"-m2");
        if(linea.getAttribute('class')==="lineas"){
            //Comprobar primera parte
            if(
                (compararHoras(inputHoraParte12.value,inputHoraParte11.value,'<igual'))||
                (compararHoras(inputHoraParte11.getAttribute('min'),inputHoraParte11.value,'>'))||
                (compararHoras(inputHoraParte11.getAttribute('max'),inputHoraParte11.value,'<'))||
                (compararHoras(inputHoraParte12.getAttribute('min'),inputHoraParte12.value,'>'))||
                (compararHoras(inputHoraParte12.getAttribute('max'),inputHoraParte12.value,'<'))
            ){
                console.log('error 1');
                valido=false;
                //Error mañana hora
                mostrarErrorDia(x,"Mañana")
            }else if(
                ((inputHoraParte12.value=="")||(inputHoraParte11.value==""))
                &&
                ((inputHoraParte22.value=="")||(inputHoraParte21.value==""))
            ){
                console.log('error 2');
                valido=false;
                mostrarErrorDia(x,"Tarde y Mañana")
            }else{            
                if(inputHoraParte21.getAttribute('class')=='form-control'){
                    //Probar segunda parte
                    if(
                        (compararHoras(inputHoraParte22.value,inputHoraParte21.value,'<igual'))||
                        (compararHoras(inputHoraParte21.getAttribute('min'),inputHoraParte21.value,'>'))||
                        (compararHoras(inputHoraParte21.getAttribute('max'),inputHoraParte21.value,'<'))||
                        (compararHoras(inputHoraParte22.getAttribute('min'),inputHoraParte22.value,'>'))||
                        (compararHoras(inputHoraParte22.getAttribute('max'),inputHoraParte22.value,'<'))
                    ){
                        console.log('error 3');
                        valido=false;
                        mostrarErrorDia(x,"Tarde")
                        //Error tarde hora
                    }
                }
            }
        }
    }
    if(fechaInicialInput>fechaActualString){
        return false;
    }
    if(fechaInicialInput>fechaFinInput){
        return false;
    }
    return valido;
}
function mostrarErrorDia(numeroDia,franjaHoraria){
   // console.log("Mostrar error dia "+numeroDia+" en franja "+franjaHoraria)
   console.log("Error franjaHoraria "+franjaHoraria)
    let mensaje="Las horas escritas el día ";
    switch(numeroDia){
        case 1:
            mensaje+="Lunes";
            break;
        case 2:
            mensaje+="Martes";
            break;
        case 3:
            mensaje+="Miercoles";
            break;
        case 4:
            mensaje+="Jueves";
            break;
        case 5:
            mensaje+="Viernes";
            break;
    }
    mensaje+=" por la "+franjaHoraria;
    mostrarErrorDia(mensaje)
}
function mostrarErrorDia(mensaje){
    let divConteniente = document.getElementById('error');
    divConteniente.innerHTML='<div class="alert alert-danger alert-dismissible fade show" role="alert">'
    +mensaje
    +'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
    +'<span aria-hidden="true">&times;</span>'
    +'</button>'
    '</div>';
}
function compararHoras(parametro1,parametro2,condicional){
    let result=false;
    let horas1=parametro1.split(':');
    let hora1=horas1[0];
    let minutos1=horas1[1];
    let horas2=parametro2.split(':');
    let hora2=horas2[0];
    let minutos2=horas2[1];
    let date1 = new Date(2010,1,1,1,hora1,minutos1,0)
    let date2 = new Date(2010,1,1,1,hora2,minutos2,0)
    switch(condicional){
        case 'igual':
            if(date1==date2){
                result=true;
            }else{
                result=false;
            }
            break;
        case '<igual':
            if(date1<=date2){
                result=true;
            }else{
                result=false;
            }
            break;
        case '<':
            if(date1<date2){
                result=true;
            }else{
                result=false;
            }
            break;
        case '>':
            if(date1>date2){
                result=true;
            }else{
                result=false;
            }
            break;
    }
    return result;
}