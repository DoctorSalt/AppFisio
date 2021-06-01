<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\fisioterapeuta;
use \App\Models\horario;
use \App\Models\disponible;
use \App\Models\cita;

use DateTime;
use DateInterval;
use localtime;

class FisioController extends Controller
{
    //
    function asignarHorario(Request $request){        
        $arreglo=$this->sesionDevolverArreglo();
        $diaLuM1=$request->input('diaLunesManana1');
        $diaLuM2=$request->input('diaLunesManana2');
        $diaLuT1=$request->input('diaLunesTarde1');
        $diaLuT2=$request->input('diaLunesTarde2');

        $diaMaM1=$request->input('diaMartesManana1');
        $diaMaM2=$request->input('diaMartesManana2');
        $diaMaT1=$request->input('diaMartesTarde1');
        $diaMaT2=$request->input('diaMartesTarde2');

        $diaMiM1=$request->input('diaMiercolesManana1');
        $diaMiM2=$request->input('diaMiercolesManana2');
        $diaMiT1=$request->input('diaMiercolesTarde1');
        $diaMiT2=$request->input('diaMiercolesTarde2');
        
        $diaJuM1=$request->input('diaJuevesManana1');
        $diaJuM2=$request->input('diaJuevesManana2');
        $diaJuT1=$request->input('diaJuevesTarde1');
        $diaJuT2=$request->input('diaJuevesTarde2');

        $diaViM1=$request->input('diaViernesManana1');
        $diaViM2=$request->input('diaViernesManana2');
        $diaViT1=$request->input('diaViernesTarde1');
        $diaViT2=$request->input('diaViernesTarde2');

        $idFisioterapeuta=$request->input('idUsuario');
        
        $fechaActivoInicio=$request->input('fechaInico');
        $fechaActivoFin=$request->input('fechaFin');
        $booleanSeHaCreado=false;
        if(
            (($diaLuM1!="")&&($diaLuM1!=null)&&($diaLuM2!="")&&($diaLuM2!=null))||
            (($diaLuT1!="")&&($diaLuT1!=null)&&($diaLuT2!="")&&($diaLuT2!=null))
        ){
            $resultado=$this->crearHorario($diaLuM1,$diaLuM2,$diaLuT1,$diaLuT2,1,$idFisioterapeuta,$fechaActivoInicio,$fechaActivoFin);
            if($resultado){
                $booleanSeHaCreado=true;
            }
        }
        if(           
            (($diaMaM1!="")&&($diaMaM1!=null)&&($diaMaM2!="")&&($diaMaM2!=null))||
            (($diaMaT1!="")&&($diaMaT1!=null)&&($diaMaT2!="")&&($diaMaT2!=null))      
        )      
        {
            $resultado=$this->crearHorario($diaMaM1,$diaMaM2,$diaMaT1,$diaMaT2,2,$idFisioterapeuta,$fechaActivoInicio,$fechaActivoFin);
            if($resultado){
                $booleanSeHaCreado=true;
            }
        }  
        if(           
            (($diaMiM1!="")&&($diaMiM1!=null)&&($diaMiM2!="")&&($diaMiM2!=null))||
            (($diaMiT1!="")&&($diaMiT1!=null)&&($diaMiT2!="")&&($diaMiT2!=null)) 
        )           
        {
            $resultado=$this->crearHorario($diaMiM1,$diaMiM2,$diaMiT1,$diaMiT2,3,$idFisioterapeuta,$fechaActivoInicio,$fechaActivoFin);
            if($resultado){
                $booleanSeHaCreado=true;
            }
        }        
        if(           
            (($diaJuM1!="")&&($diaJuM1!=null)&&($diaJuM2!="")&&($diaJuM2!=null))||
            (($diaJuT1!="")&&($diaJuT1!=null)&&($diaJuT2!="")&&($diaJuT2!=null)) 
        )           
        {
            $resultado=$this->crearHorario($diaJuM1,$diaJuM2,$diaJuT1,$diaJuT2,4,$idFisioterapeuta,$fechaActivoInicio,$fechaActivoFin);
            if($resultado){
                $booleanSeHaCreado=true;
            }
        }
        if(           
            (($diaViM1!="")&&($diaViM1!=null)&&($diaViM2!="")&&($diaViM2!=null))||
            (($diaViT1!="")&&($diaViT1!=null)&&($diaViT2!="")&&($diaViT2!=null)) 
        )           
        {
            $resultado=$this->crearHorario($diaViM1,$diaViM2,$diaViT1,$diaViT2,5,$idFisioterapeuta,$fechaActivoInicio,$fechaActivoFin);
            if($resultado){
                $booleanSeHaCreado=true;
            }
        }  
        if($booleanSeHaCreado){
            //Realizar inserts usando campo fecha
            $resultadoFinal=$this->realizandoBusquedaInsertCalendario($idFisioterapeuta,$fechaActivoInicio,$fechaActivoFin);
            return $resultadoFinal;
        }else{
            //error
            session()->flash('Exito','Se han producido errores');
            return redirect()->route('fisioInicio');
        }        
    }
    private function realizandoBusquedaInsertCalendario($idFisioterapeuta,$fechaActivoInicio,$fechaActivoFin){
        $arrayTiempoFisio=fisioterapeuta::select('tiempoFisioterapeuta')
        ->where('idFisioterapeuta','=',$idFisioterapeuta)->first();
        $tiempoFisio=(int)$arrayTiempoFisio['tiempoFisioterapeuta'];
        $datosHorarios=horario::select('diaSemanaHorario','hora1Horario','hora2Horario','hora3Horario','hora4Horario')
        ->where('fechaInicioHorario','=',$fechaActivoInicio)
        ->where('fechaFinHorario','=',$fechaActivoFin)
        ->where('idFisioterpeutaFK','=',$idFisioterapeuta)->get();
        $fechasDiferentes=$this->devolverFechasResultantesUnicas($datosHorarios, $fechaActivoInicio,$fechaActivoFin);
        var_dump($fechasDiferentes);
        foreach($fechasDiferentes as $fecha){
            $numeroDia=$fecha['num'];
            $fechaActual=$fecha['fecha'];
            $horarioIndividual=horario::select('diaSemanaHorario','hora1Horario','hora2Horario','hora3Horario','hora4Horario')
            ->where('diaSemanaHorario','=',$numeroDia)
            ->where('fechaInicioHorario','=',$fechaActivoInicio)
            ->where('fechaFinHorario','=',$fechaActivoFin)
            ->where('idFisioterpeutaFK','=',$idFisioterapeuta)->get();
            $hora1=$horarioIndividual[0]['hora1Horario'];
            $hora2=$horarioIndividual[0]['hora2Horario'];
            $hora3=$horarioIndividual[0]['hora3Horario'];
            $hora4=$horarioIndividual[0]['hora4Horario'];           
            $horaDate1 = strtotime("2020-1-1 ".$hora1);
            $horaDate2 = strtotime("2020-1-1 ".$hora2);
            $diferenciaMin = $horaDate2 - $horaDate1;
            $vecesNecesarias=($diferenciaMin/60)/$tiempoFisio;
            $horaActual=0;
            for($contador=0;$contador<$vecesNecesarias;$contador++){
                if($contador==0){
                    $horaActual=$hora1;
                    $this->insertarDisponibles($fechaActual,$horaActual,$idFisioterapeuta);
                }else{                   
                    $mifecha = new DateTime("2020-1-1 ".$horaActual); 
                    $mifecha->modify('+'.$tiempoFisio.' minute');                    
                    $horaActual=$mifecha->format('H:i:s');
                    $this->insertarDisponibles($fechaActual,$horaActual,$idFisioterapeuta);
                }
            }
            $horaDate1 = strtotime("2020-1-1 ".$hora3);
            $horaDate2 = strtotime("2020-1-1 ".$hora4);
            $diferenciaMin = $horaDate2 - $horaDate1;
            $vecesNecesarias=($diferenciaMin/60)/$tiempoFisio;
            $horaActual=0;
            for($contador=0;$contador<$vecesNecesarias;$contador++){
                if($contador==0){
                    $horaActual=$hora3;
                    $this->insertarDisponibles($fechaActual,$horaActual,$idFisioterapeuta);
                }else{                   
                    $mifecha = new DateTime("2020-1-1 ".$horaActual); 
                    $mifecha->modify('+'.$tiempoFisio.' minute');                    
                    $horaActual=$mifecha->format('H:i:s');
                    $this->insertarDisponibles($fechaActual,$horaActual,$idFisioterapeuta);
                }
            }
        }
        session()->flash('Exito','Se ha incorporado el horario correctamente');
        return redirect()->route('fisioInicio');                 
    }
    private function pasarAint($hora){
        $valor=(string)$hora;
        $valorArray=explode(":",$valor);
        $valorStringFinal=$valorArray[0].$valorArray[1].$valorArray[2];
        return (int)$valorStringFinal;
        //return intval($hora);
    }
    private function insertarDisponibles($fechaActual,$horaActual,$idFisioterapeuta){
        $disponible=new disponible();
        $disponible->diaDisponible=$fechaActual;
        $disponible->horaDisponible=$horaActual;
        $disponible->idFisioFK=$idFisioterapeuta;
        $disponible->save();
    }
    private function diasSemanaArray($datosHorarios){
        $arraySemana=[];
        foreach($datosHorarios as $datoHorario){
            $arraySemana[]=$datoHorario['diaSemanaHorario'];
        }
        return $arraySemana;
    }
    private function devolverFechasResultantesUnicas($datosHorarios,$fechaActivoInicio,$fechaActivoFin){
        $fechas=[];
        $fechaInicioString=$fechaActivoInicio;
        $fechaFinString=$fechaActivoFin;        
        $arraySemana=$this->diasSemanaArray($datosHorarios);
        $dateTime1=new Datetime($fechaInicioString);       
        $dateTime2=new Datetime($fechaFinString);    
        $encontrado=false;
        $diaEncontrado="";
        $localTime1=localtime($dateTime1->getTimestamp(),TRUE);
        foreach($arraySemana as $diaSemana){
            if($localTime1==$diaSemana){
                $encontrado=true;
                $diaEncontrado=$diaSemana;
            }
        }
        if($encontrado){
            $fechas[0]['fecha']=$fechaInicioString;
            $fechas[0]['num']=$diaEncontrado;
            $arrayResultante=$this->devuelveArray($fechaInicioString,$fechas,$arraySemana,$fechaFinString);
          //  var_dump($arrayResultante);//$this->cambiarFecha()
        }else{
            $fechaResultante=$this->encontrarFecha($fechaInicioString,$fechaFinString,$arraySemana);
            $dateTimeResultante=new Datetime($fechaResultante);     
            
            $diaResultante=$dateTimeResultante->format('w');
            $fechas[0]['fecha']=$fechaResultante;
            $fechas[0]['num']=$diaResultante;
            //echo $fechaResultante." ";
            //echo $diaResultante;           
           $arrayResultante=$this->devuelveArray($fechaResultante,$fechas,$arraySemana,$fechaFinString);
        }    
           return $arrayResultante;       
        
    }
    private function devolverArrayInt($datoHorarios){
        $arrayResultante=[];
        foreach($datosHorarios as $datoHorario){
           $arrayResultante[]=$datoHorario['diaSemanaHorario'];
        }
        return $arrayResultante;
    }
    private function encontrarFecha($stringFechaInicio,$fechaFinString,$arraySemana){
        $dateTime=new Datetime($stringFechaInicio); 
        $fechaBreak=$fechaFinString;
        $igual=false;
        $fechaResultante="";
        while($igual==false){
            //echo $dateTime->format('Y-m-d')."</br>";
            $localTime1=localtime($dateTime->getTimestamp(),TRUE);
            $localTimeDia=$localTime1['tm_wday'];
            foreach($arraySemana as $diaSemana){
                //echo "DiaSemana->".$diaSemana."<br>";
                //echo "LocalTime->".$localTimeDia."<br>";
                if($localTimeDia==$diaSemana){
                    $igual=true;
                    $fechaResultante=$dateTime->format('Y-m-d');
                }
            }
            date_add($dateTime, date_interval_create_from_date_string('1 days'));
        }
        return $fechaResultante;
    }

    private function devuelveArray($fechaResultante,$fechas,$arraySemana,$stringFechaFinal){
        $dateTime2=date_create($stringFechaFinal." 1:00:00");   
        $fin=false;
        $counter=1;
        $contador=1;
        $stringFechaInicio=$fechaResultante;
        while($fin==false){
            $dateTime1=date_create($stringFechaInicio." 1:00:00");
            $interval = $dateTime1->diff($dateTime2);
            if($interval->format('%R%a días')<=0){
                $fin=true;
                echo "<br>Fin";
                break;
            }
            date_add($dateTime1, date_interval_create_from_date_string('1 day'));
            $stringFechaInicio=$dateTime1->format('Y-m-d');
            $dia=$dateTime1->format('w');
            foreach($arraySemana as $diaSemana){
                if($diaSemana==$dia){
                    $stringFechaInicio=$dateTime1->format('Y-m-d');
                    $fechas[$contador]['fecha']=$stringFechaInicio;
                    $fechas[$contador]['num']=$dia;
                    $contador++;
                    break;
                }
            } 
            $counter++;
        }
        return $fechas;
    }

    private function cambiarFecha($dia,$stringFechaInicio){
        $dateActual=new DateTime($stringFechaInicio);
        switch($dia){
            case 1:
                $dateActual->modify('next monday');
                break;
            case 2:
                $dateActual->modify('next tuesday');
                break;
            case 3:
                $dateActual->modify('next wednesday');
                break;
            case 4:
                $dateActual->modify('next thursday');
                break;
            case 5:
                $dateActual->modify('next friday');
                break;
        }
        return $dateActual->format('Y-m-d');
    }
    private function esDiaActual($diaSemana,$diaInicial){
        $diaInicialNum=0;
        switch($diaSemana){
            case "Monday":
                $diaInicialNum=1;
                break;
            case "Tuesday":
                $diaInicialNum=2;
                break;
            case "Wednesday":
                $diaInicialNum=3;
                break;
            case "Thursday":
                $diaInicialNum=4;
                break;
            case "Friday":
                $diaInicialNum=5;
                break;
            case "Saturday":
                $diaInicialNum=6;
                break;
            case "Sunday":
                $diaInicialNum=7;
                break;
        }
        if($diaInicial==$diaInicialNum){
            return true;
        }else{
            return false;
        }
    }
    public function crearHorario($diaHora1,$diaHora2,$diaHora3,$diaHora4,$dia,$idFisioterapeuta,$fechaActivoInicio,$fechaActivoFin){
        try{
            $horario=new horario();
            $horario->diaSemanaHorario=$dia;
            $horario->hora1Horario=$diaHora1;
            $horario->hora2Horario=$diaHora2;
            $horario->hora3Horario=$diaHora3;
            $horario->hora4Horario=$diaHora4;
            $horario->idFisioterpeutaFK=$idFisioterapeuta;
            $horario->fechaInicioHorario=$fechaActivoInicio;
            $horario->fechaFinHorario=$fechaActivoFin;
            return $resultado=$horario->save();
        }
        catch(ExceptionsException $e){
            $error = "Error insertando fisio";
            session()->flash('error',$error);
            return redirect()->route('registroFisio');
        }     
    }

    public function rutaFisioterapeuta(){
        $sessionConfirmada="";
        if(!empty(session('Exito'))){
            $sessionConfirmada=session('Exito');
        }
        $arreglo=$this->sesionDevolverArreglo();
        $citasPorConfirmar=$this->busquedaSinCita($arreglo['idActual']);
        $citasConfirmadas=$this->busquedaConfirmadaCita($arreglo['idActual']);
        //var_dump($sessionConfirmada);
        return view('fisioInicio')
        ->with('Arreglo',$arreglo)
        ->with('Exito',$sessionConfirmada)
        ->with('citasPorConfirmar',$citasPorConfirmar)
        ->with('citasConfirmadas',$citasConfirmadas);
    }
    public function routeMisCitas(){
        $sessionConfirmada="";
        if(!empty(session('Exito'))){
            $sessionConfirmada=session('Exito');
        }
        $arreglo=$this->sesionDevolverArreglo();
        $citasPorConfirmar=$this->busquedaSinCita($arreglo['idActual']);
        $citasConfirmadas=$this->busquedaConfirmadaCita($arreglo['idActual']);
        $datosFisio=$this->devolverDatosFisio($arreglo['idActual']);

        //var_dump($sessionConfirmada);
        return view('citaFisio')
        ->with('Arreglo',$arreglo)
        ->with('Exito',$sessionConfirmada)
        ->with('datosFisio',$datosFisio)
        ->with('citasPorConfirmar',$citasPorConfirmar)
        ->with('citasConfirmadas',$citasConfirmadas);
    }

    public function misDatosFisioterapeuta(){
        $arreglo=$this->sesionDevolverArreglo();
        $exitoDetalles=session('exito');
        $errorDetalles=session('error');
        $datosFisio=$this->devolverDatosFisio($arreglo['idActual']);
        if($errorDetalles!=null){
            return view('datosfisioterapeuta')->with('Arreglo',$arreglo)->with('datosFisio',$datosFisio[0])->with('detallesError',$errorDetalles);
        }else if($exitoDetalles!=null){
            return view('datosfisioterapeuta')->with('Arreglo',$arreglo)->with('datosFisio',$datosFisio[0])->with('detallesExito',$exitoDetalles);
        }else{
            return view('datosfisioterapeuta')->with('Arreglo',$arreglo)->with('datosFisio',$datosFisio[0]);
        }
    }
    public function routeMisClientes(){
        $arreglo=$this->sesionDevolverArreglo();
        return view('clienteFisio')->with('Arreglo',$arreglo);
    }
    public function actualizarFisio(Request $request){
        $arreglo=$this->sesionDevolverArreglo();
        $idFisio=$arreglo['idActual'];
        $nombre=$request->input("nombre");
        $apellido=$request->input("apellido");
        $email=$request->input("email");
        $pass=$request->input("contrasenia");
        $especialidad=$request->input("especialidad");
        $tiempo=$request->input("tiempo");
        $precio=$request->input("precio");
        $descripcion=$request->input("descripcion");
        $provincia=$request->input("provincia");
        $resultado=$this->updateFisio($idFisio,$nombre,$apellido,$email,$pass,$especialidad,$tiempo,$precio,$descripcion,$provincia);
        if($resultado==1){
            $exito="Se ha realizado una actualizacion con exito";
            session()->flash('exito',$exito);
            return redirect()->route('fisioDatos');
        }else{
            $error="No se realizado la actualizacion por un error";
            session()->flash('error',$error);
            return redirect()->route('fisioDatos');
        }
    }
    private function updateFisio($idFisio,$nombre,$apellido,$email,$pass,$especialidad,$tiempo,$precio,$descripcion,$provincia){
        $fisio = fisioterapeuta::find($idFisio);
        $fisio->nombreFisioterapeuta=$nombre;
        $fisio->apellidoFisioterapeuta=$apellido;
        $fisio->especialidadFisioterapeuta=$especialidad;
        $fisio->tiempoFisioterapeuta=$tiempo;
        $fisio->correoFisioterapeuta=$email;
        if($pass!=null){
            $fisio->passwordFisioterapeuta=md5($pass);
        }
        $fisio->precioFisioterapeuta=$precio;
        $fisio->descripcionFisioterapeuta=$descripcion;
        $fisio->provinciaFisioterapeuta=$provincia;
        return $fisio->save();
    }
    private function sesionDevolverArreglo(){
        $nombre=session('Nombre');
        $idActual=session('id');
        $tipo=session('tipo');
        if($tipo=="cliente"){
            $error="Incorrecto tipo Usuario";
            session()->flash('error',$error);
            return redirect()->route('inicioLogin');
        }else if($tipo=="fisio"){
            session()->flash('Nombre',$nombre);
            session()->flash('id',$idActual);
            session()->flash('tipo',$tipo);
            return $arreglo=array('idActual'=>$idActual,'nombre'=>$nombre);
        }else{
            $error="Sin sesión";
            session()->flash('error',$error);
            return redirect()->route('inicioLogin');
        }
    }
    public function confirmarCita(Request $request){
        //Añadir flash de datos
        $this->sesionDevolverArreglo();
        $idCita=$request->input('idCita');
        $localizacion=$request->input('localizacion');
        $descripcion=$request->input('descripcion');
        $precio=$request->input('precio');
        $cita=cita::find($idCita);
        $cita->direccionCita=$localizacion;
        $cita->descripcionCita=$descripcion;
        $cita->precioCita=$precio;
        $cita->confirmadaCita=1;
        $resultado=$cita->save();
        if($resultado){
            $diaDisponible=$cita['diaCita'];
            $horaDisponible=$cita['horaCita'];
            $idFisio=$cita['IdFisioterapeutaFK'];         
            $arrayCita=disponible::select('idDisponible')->where('diaDisponible','=',$diaDisponible)
            ->where('horaDisponible','=',$horaDisponible)
            ->where('idFisioFK','=',$idFisio)
            ->first();
            $disponible=disponible::find($arrayCita['idDisponible']);
            $resultado2=$disponible->delete();
            if($resultado2){
                session()->flash('Exito','Se ha incorporado confirmada la cita correctamente');
                return redirect()->route('citaFisio');
            }else{
                //Lanzar error
                session()->flash('Exito','Se producido un error borrando la disponibilidad');
                return redirect()->route('fisioCitas');
            }
        }else{
            session()->flash('Exito','Se producido un error modificando la cita');
            return redirect()->route('citaFisio');
        }
    }
    public function realizadoCita(Request $request){     
        $this->sesionDevolverArreglo();

        $idCita=$request->input('idCita');
        $cita=cita::find($idCita);
        $cita->realizadoCita=1;
        $resultado=$cita->save();
        if($resultado){
            return "Si";
        }else{
            return "No";
        }
    }   
    public function busquedaSinCita($idFisio){
        //Añadir flashes
        $this->sesionDevolverArreglo();
        $arrayCitas=cita::select('idCita','horaCita','diaCita','tiempoCita','nombreCliente')
        ->where('IdFisioterapeutaFK','=',$idFisio)
        ->join('clientes','idCliente','=','idClienteFK5')
        ->where("confirmadaCita","=",0)->get();
        return $arrayCitas;
    }
    public function busquedaConfirmadaCita($idFisio){
        //Añadir flashes
        $this->sesionDevolverArreglo();       
        $arrayCitas=cita::select('idCita','horaCita','diaCita','tiempoCita','nombreCliente','direccionCita')
        ->where('IdFisioterapeutaFK','=',$idFisio)
        ->join('clientes','idCliente','=','idClienteFK5')
        ->where("confirmadaCita","=",1)->get();
        return $arrayCitas;
    }

    private function devolverDatosFisio($idFisio){
        // cliente::get();
        return fisioterapeuta::select('nombreFisioterapeuta','apellidoFisioterapeuta','especialidadFisioterapeuta','tiempoFisioterapeuta', 'precioFisioterapeuta','correoFisioterapeuta','descripcionFisioterapeuta','provinciaFisioterapeuta')->where('idFisioterapeuta','=',$idFisio)->get();
    }
}
