funcionalidadBusquedaProvinicia();

function funcionalidadBusquedaProvinicia(){
  let botonBusqueda = document.getElementById('botonCrearCalendario');
  botonBusqueda.addEventListener('click',function(){
    let provinciaSelect = document.getElementById('provinciaSelect').value;
    $.ajax({
      url: '/BuscarPorProvinciaFisioterapeutas',
      type: 'GET',
      data: {
          'provincia': provinciaSelect
      },
      success: function (response) {
          console.log("Nice: ");
          console.log("Enviado=> /BuscarPorProvinciaFisioterapeutas?" + "provincia" + "=" + provinciaSelect);
          mostrarTablaFisioterapeutas(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
          console.log("Error: " + errorThrown);
          mostrarError("No se ha podido encontrar la disponibilidad de este fisio")
      }
    });
  }); 
}
function mostrarTablaFisioterapeutas(resultado){
  let tablaBusqueda = document.getElementById('tablaBusqueda');
  if(resultado['resultado']=="No"){
    mostrarError("No hay campos o se ha sucedido otro error");
  }else{
      let stringTabla =
      '<table class="table table-responsive">'+
      '<thead class="tablaHeader">'+
      '<tr>'+             
          '<th scope="col">Nombre</th>'+
          '<th scope="col">Apellido</th>'+
          '<th scope="col">Especialidad</th>'+           
          '<th scope="col">Tiempo Minimo</th>'+   
          '<th scope="col">Precio por Minuto</th>'+           
          '<th scope="col">Provincia</th>'+       
          '<th scope="col"></th>'+            
      '</tr> </thead> <tbody class="tablaBody">';       
      resultado['ArrayResultado'].forEach(function(item){
          stringTabla+='<tr>';
          stringTabla+='<td>'+item.nombre+'</td>';
          stringTabla+='<td>'+item.apellidos+'</td>';
          stringTabla+='<td>'+item.especialidad+'</td>';
          stringTabla+='<td>'+item.tiempo+'</td>';
          stringTabla+='<td>'+item.precio+'</td>';
          stringTabla+='<td>'+item.provincia+'</td>';
          stringTabla+='<td>'+
              '<button class="btn btn-primary botonSeleccionar" data-code="'+item.Id+'">Seleccionar'
              +'</button>'+        
          '</td>'
          stringTabla+='</tr>';        
      });
      stringTabla+="</tbody></table>";
      console.log(stringTabla);
      tablaBusqueda.innerHTML=stringTabla;      
      botonLiseneres();
  }
}
function botonLiseneres(){
  let botonesEditar =document.getElementsByClassName('botonSeleccionar');
  for (let i = 0; i < botonesEditar.length; i++) {
      botonesEditar[i].addEventListener("click",function(event){
          let target = event.toElement || event.relatedTarget || event.target || function () { throw "Failed to attach an event target!"; }
          realizarBusqueda(target.getAttribute('data-code'));                
      });
  }
}
function realizarBusqueda(idFisioElegido){
  $.ajax({
    url: '/BuscarDisponibilidadFisio',
    type: 'GET',
    data: {
        'idFisio': idFisioElegido
    },
    success: function (response) {
        console.log("Nice: ");
        console.log("Enviado=> /BuscarDisponibilidadFisio?" + "idFisio" + "=" + idFisioElegido);
        procesarRespuesta(response);
    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
        mostrarError("No se ha podido encontrar la disponibilidad de este fisio")
    }
});
}

function procesarRespuesta(respuesta){
  let fechas=respuesta;
  let cantidadFechasDiferentes=fechas.length;
  console.log(fechas.length);
  if(cantidadFechasDiferentes==1){
    let fechasInicial=fechas[0]['diaDisponible'];
    let fechaFinal=sumarFecha(fechas[0]['diaDisponible']);
    funcionalidadCalendarioDiaIndividual(fechasInicial,fechasInicial,fechaFinal);
  }else{
    funcionalidadCalendarioDiaVariosDias(fechas);
  }  
}
function funcionalidadCalendarioDiaVariosDias(fechas){
  console.log('llego')
  console.log(fechas)
  let calendarEl = document.getElementById('calendar');
  let fechasArray=[];
  let eventos="";
  eventos+='[';
  let contador=1;
  fechas.forEach(element => {
    eventos+='{';
    eventos+='"start":'+'"'+element['diaDisponible']+'"',
    eventos+=',"end":'+ '"'+ sumarFecha(element['diaDisponible'])+'"',
    fechasArray.push(element['diaDisponible'])
    eventos+=',"display":'+'"' +"background"+'"';
    eventos+=',"color":'+'"'+"#99b898"+'"';
    eventos+='}';
    if(fechas.length!=contador){
      eventos+=',';
      contador++;
    }
  });  
  eventos+=']';
  console.log(eventos)
  let eventosJson=JSON.parse(eventos)
  let calendar = new FullCalendar.Calendar(calendarEl, {        
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth'
    },
    initialView: 'dayGridMonth',
    locale:'es',
    dateClick: function(info) {
      if(fechasArray.includes(info.dateStr)){
        alert('Seleccionó la fecha ' + fechaAmericanaEuropa(info.dateStr));
        realizarBusqueda2(info.dateStr);
      }        
    },    
    events: eventosJson
  });
  console.log('llego')
  calendar.render(); 
}

function funcionalidadCalendarioDiaIndividual(fechas1,fechas2,fechas3){
  let fechaInicial = fechas1;
  let fechaFinal = fechas2;
  let fechaBackground =fechas3;
  console.log('llego')
      let calendarEl = document.getElementById('calendar');
      let calendar = new FullCalendar.Calendar(calendarEl, {        
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth'
        },
        initialView: 'dayGridMonth',
        locale:'es',
        dateClick: function(info) {
          if(compararFechas(info.dateStr,fechaInicial,"mayor igual")
          &&(compararFechas(info.dateStr,fechaFinal,"menor igual"))){
            alert('Seleccionó la fecha ' + fechaAmericanaEuropa(info.dateStr));
            realizarBusqueda2(info.dateStr);
          }        
        },
        events: [
          {
            start: fechaInicial,
            end: fechaBackground,
            display: 'background',
            color: '#99b898'
          }
        ]
      });
      calendar.render();    
}
function realizarBusqueda2(fechaResultante){
  let idFisio=1;
  $.ajax({
    url: '/BuscarDisposEnFecha',
    type: 'GET',
    data: {
        'idFisio': idFisio,
        'fechaResultante':fechaResultante
    },
    success: function (response) {
        console.log("Nice: ");
        console.log("Enviado=> /BuscarDisposEnFecha?" + "idFisio" + "=" + idFisio+"&fechaResultante="+fechaResultante);
        procesarRespuesta2(response,fechaResultante);
    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error: " + errorThrown);
    }
});

}
function procesarRespuesta2(response,fechaResultante){
  let resultados = document.getElementById('fechasResultantes');
  let stringFinal="";
  console.log(response)
  console.log('fECHAS->'+fechaResultante)
  stringFinal+='<div class="row text-center">';
  stringFinal+='<div class="col-12">'
    +'<h2 id="fechaElegida">'+
    fechaAmericanaEuropa(fechaResultante)+
    '</h2>'+
  '</div>';  
  stringFinal+='</div>';
  stringFinal+='<div class="row mt-2 text-center">';
  response.forEach(element => {
      let horaDispo = element['horaDisponible'];
      let idDisponible = element['idDisponible'];
      stringFinal+='<div class="col-6 mt-2">';
      stringFinal+='<button data-code='+idDisponible+' class="botonCita btn btn-primary">'+horaDispo+'</button>';
      stringFinal+='</div>';
      //stringFinal+="Id->"+idDisponible+" Hora->"+horaDispo+"</br>";
  });
  stringFinal+='</div>';
  resultados.innerHTML=stringFinal;
  AniadirLisenersBotones();
}
function AniadirLisenersBotones(){
  let botonesCitas = document.getElementsByClassName('botonCita');
  let fechaElegidaValor =document.getElementById('fechaElegida').textContent
  Array.from(botonesCitas).forEach(boton => {    
    boton.addEventListener('click',function(evento){
      console.log(boton.getAttribute('data-code'))
      let idDisponible=boton.getAttribute('data-code');
      console.log('El id selecicionado '+idDisponible)
      let hora=boton.childNodes[0].textContent;
      let clienteInput=document.getElementById('clienteInput').value;
      let confirmacion=confirm("¿ Está seguro de pedir una cita el día "+fechaElegidaValor+" a las "+hora+" ?");
      if(confirmacion){
        //Busqueda
        console.log("Nice")
        $.ajax({
          url: '/InsertarCitaUsuario',
          type: 'GET',
          data: {
              'idCliente': clienteInput,
              'idDisponible':idDisponible
          },
          success: function (response) {
              console.log("Nice: ");
              console.log("Enviado=> /InsertarCitaUsuario?" + "idCliente" + "=" + clienteInput+"&idDisponible="+idDisponible);
              if(response=="Si"){
                mostrarExito("Se ha realizado la cita correctamente");
                let resultados = document.getElementById('fechasResultantes');
                resultados.innerHTML="";
              }else{
                //Se han cometido errores
                mostrarError("Se han producido problemas al realizar la cita intentelo más tarde");
              }
          },
          error: function (jqXHR, textStatus, errorThrown) {
              console.log("Error: " + errorThrown);
          }
      });
      }
    });
  })
}
function fechaAmericanaEuropa(fechaAmericana){
  let arrayFechas=fechaAmericana.split('-');
  let stringFechaEuropea=arrayFechas[2]+'/'+arrayFechas[1]+'/'+arrayFechas[0];
  return stringFechaEuropea;
}
function fechaEuropaAmerica(fechaEuropa){
  let arrayFechas=fechaEuropa.split('/');
  let stringfechaAmericanaa=arrayFechas[2]+'/'+arrayFechas[1]+'/'+arrayFechas[0];
  return stringfechaAmericanaa;
}
function compararFechas(strdate1,strdate2,signos){
  let date1 = new Date(strdate1);
  let date2 = new Date(strdate2);   
  switch(signos){
    case "mayor igual":
      if(date1>=date2){
        return true;
      }else{
        return false;
      }
      break;
    case "menor igual":
      if(date1<=date2){
        return true;
      }else{
        return false;
      }
    break;
    case "igual":
      if(date1==date2){
        return true;
      }else{
        return false;
      }
    break;
    case "mayor":
      if(date1>date2){
        return true;
      }else{
        return false;
      }
    break;
    case "menor":
      if(date1<date2){
        return true;
      }else{
        return false;
      }
    break;
  }
}
function sumarFecha(fechaString){
  let fecha = new Date(fechaString);
  let stringFechaFinal;
  fecha.setDate(fecha.getDate()+1);
  if(parseInt(fecha.getMonth())>=9){
    stringFechaFinal =fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
  }else{
    stringFechaFinal =fecha.getFullYear()+'-0'+(fecha.getMonth()+1)+'-'+fecha.getDate();
  }
  return stringFechaFinal;
}
function mostrarExito(cadenaExito){
  let exitoDiv =document.getElementById('exitoJavascript');
  const botonExito = '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="botonAlert2"> <span aria-hidden="true">&times;</span> </button>';
  if(exitoDiv==null){
    let divRecipiente = document.getElementById('mensajeExito');
    divRecipiente.innerHTML = '<div class="text-center alert alert-success alert-dismissible fade show" role="alert" id="exitoJavascript"> '+
    '</div>';
    let divRecipiente2= document.getElementById('exitoJavascript');
    divRecipiente2.innerHTML=cadenaExito+botonExito;
    divRecipiente2.setAttribute('class','text-center alert alert-success alert-dismissible fade show')
  }else{
    console.log(exitoDiv.innerHTML)
    exitoDiv.innerHTML=cadenaExito+botonExito;           
    exitoDiv.setAttribute('class','text-center alert alert-success alert-dismissible fade show')
  }    
}
function mostrarError(error){
  let erroresDiv =document.getElementById('errorJavascript');
  const botonError = '<button type="button" class="close" data-dismiss="alert" aria-label="Close" id="botonAlert"> <span aria-hidden="true">&times;</span> </button>'
  if(erroresDiv==null){
        let divRecipiente = document.getElementById('mensajeFallo');
        divRecipiente.innerHTML = '<div class="" role="alert" id="errorJavascript"> <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="botonAlert">'+
        +    '<span aria-hidden="true">&times;</span>'+
        '</button> </div>';
        erroresDiv=document.getElementById('errorJavascript');
        erroresDiv.innerHTML=error+botonError;
        erroresDiv.setAttribute('class','text-center alert alert-danger alert-dismissible fade show')
    }else{
        console.log(erroresDiv.innerHTML);
        erroresDiv.innerHTML=error+botonError;          
        erroresDiv.setAttribute('class','text-center alert alert-danger alert-dismissible fade show')
    } 
}
