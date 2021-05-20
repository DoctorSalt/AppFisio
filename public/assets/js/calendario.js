console.log('hola');
let fechaInicial = '2021-05-17';
let fechaFinal = '2021-05-21';
let fechaBackground =sumarFecha(fechaFinal)
console.log(fechaBackground)
document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {        
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek'
      },
      initialView: 'dayGridMonth',
      locale:'es',
      dateClick: function(info) {
        if(compararFechas(info.dateStr,fechaInicial,"mayor igual")
        &&(compararFechas(info.dateStr,fechaFinal,"menor igual"))){
          alert('Date: ' + info.dateStr);
          
          //alert('Resource ID: ' + info.resource.id);
        }        
      },
      events: [
        {
          start: fechaInicial,
          end: fechaBackground,
          display: 'background',
          color: 'green'
        }
      ]
    });
    calendar.render();    
  });

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