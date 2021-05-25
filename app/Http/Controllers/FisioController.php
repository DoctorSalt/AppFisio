<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\fisioterapeuta;
use \App\Models\horario;
use \App\Models\disponible;
use DateTime;
use DateInterval;

class FisioController extends Controller
{
    //
    function asignarHorario(Request $request){
        /*
        array(21) 
        { ["diaLunesManana1"]=> string(5) "12:00" ["diaLunesManana2"]=> string(5) "13:00" 
                ["diaLunesTarde1"]=> NULL ["diaLunesTarde2"]=> NULL 
        ["diaMartesManana1"]=> string(5) "12:00" ["diaMartesManana2"]=> string(5) "13:00" 
                ["diaMartesTarde1"]=> string(5) "19:00" ["diaMartesTarde2"]=> string(5) "20:00" 
        ["diaMiercolesManana1"]=> NULL ["diaMiercolesManana2"]=> NULL 
            ["diaMiercolesTarde1"]=> NULL ["diaMiercolesTarde2"]=> NULL 
        ["diaJuevesManana1"]=> NULL ["diaJueveslManana2"]=> NULL 
            ["diaJuevesTarde1"]=> NULL ["diaJuevesTarde2"]=> NULL 
        ["diaViernesManana1"]=> NULL ["diaVierneslManana2"]=> NULL 
            ["diaViernesTarde1"]=> NULL ["diaViernesTarde2"]=> NULL ["idUsuario"]=> string(1) "1" } 
        */
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
            (
                ($diaViM1!="")&&($diaViM1!=null)&&($diaViM2!="")&&($diaViM2!=null))||
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
            //var_dump($hora2);
            //$horaDate1 = new DateTime($hora1);
            //$horaDate2 = new DateTime($hora2);
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
            /*
            $diferenciaHorasTarde=($hora4-$hora3)/$tiempoFisio;
            for($contador=0;$contador<$diferenciaHorasTarde;$contador++){
                if($contador==0){
                    $horaActual=$hora3;
                    $this->insertarDisponibles($fechaActual,$horaActual,$idFisioterapeuta);
                }else{
                    $horaActual=$horaActual*$tiempoFisio;
                    $this->insertarDisponibles($fechaActual,$horaActual,$idFisioterapeuta);
                }
            }
            */            
        }
        return "Nice";

        //return $fechasDiferentes;
        // Para devolver la fecha especifica del siguiente lunes o martes se usa:
            //$date=new DateTime();
            //$date->modify('next monday'); ]


        //Lo suyo seria siempre usar la misma date asi podrá ciclear bien y parar al llegar al dia mencionado    
        //Presuponiendo el dia de hoy cada semana crear campos disponibilidad con:
        //$tiempoFisio para hacer las citas el rango y hora
        //$diaSemana para localizar el dia que se reflejará
        //$horario los rangos del for each de registros
        //$fechaInicio y fin para saber hasta cuando
        //$idFisio para sea el calendario

    }
    private function pasarAint($hora){
        $valor=(string)$hora;
        $valorArray=explode(":",$valor);
        $valorStringFinal=$valorArray[0].$valorArray[1].$valorArray[2];
        var_dump($valorStringFinal);
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
        $fin=false;
        $dateInicial=new DateTime($fechaActivoInicio);
        $dateFinal=new DateTime($fechaActivoFin);
        $fechaInt=strtotime($fechaActivoFin);
        $dateFinalR=date('Y-m-d',strtotime('-1 day',$fechaInt));
        $stringFechaInicio=$dateInicial->format('Y-m-d');
        $stringFechaFinal=$dateFinalR;
        $contador=0;
        $arraySemana=$this->diasSemanaArray($datosHorarios);
        while($fin==false){
            foreach($arraySemana as $diaSemana){
                if($contador==0){
                    $diaInicial=$dateInicial->format('l');
                    $resultado=$this->esDiaActual($diaSemana,$diaInicial);
                    if($resultado){                        
                        $fechas[$contador]['fecha']=$stringFechaInicio;
                        $fechas[$contador]['num']=$diaSemana;
                    }else{
                        $stringFechaInicio=$this->cambiarFecha($diaSemana,$stringFechaInicio);
                        if($stringFechaInicio>$stringFechaFinal){

                        }else{
                        $fechas[$contador]['fecha']=$stringFechaInicio;
                        $fechas[$contador]['num']=$diaSemana;
                        }
                    }
                    $contador++;
                }else{
                    $stringFechaInicio=$this->cambiarFecha($diaSemana,$stringFechaInicio);
                    if($stringFechaInicio>$stringFechaFinal){

                    }else{
                        $fechas[$contador]['fecha']=$stringFechaInicio;
                        $fechas[$contador]['num']=$diaSemana;
                    }
                    $contador++;                             
                }
                if($stringFechaInicio>=$stringFechaFinal){
                    $fin=true;
                    break;
                }
            }
        }
        return $fechas;
        /*
        while($fin==false){
            //Modificar esto no funciona
            if($contador==0){
                $dia=$datosHorarios[$contador]['diaSemanaHorario'];
                $diaInical=$dateInicial->format('l');
                $resultado=$this->esDiaActual($dia,$diaInical);
                if($resultado){
                    $fechas['fecha']=$stringFechaInicio;
                    $fechas['num']=$dia;
                }
            }else{
                $dia=$datosHorarios[$contador]['diaSemanaHorario'];
                $stringFechaInicio=$this->cambiarFecha($dia,$stringFechaInicio);               
                $fecha['fecha']=$stringFechaInicio;
                $fechas['num']=$dia;
            }            
            var_dump($stringFechaInicio);
            if($stringFechaInicio==$stringFechaFinal){
                //Hacer ultima insert
                $fin=true;
            }            
            ++$contador;
        }
        return $fechas;
        */
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
        $arreglo=$this->sesionDevolverArreglo();
        return view('fisioInicio')->with('Arreglo',$arreglo);
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
        $resultado=$this->updateFisio($idFisio,$nombre,$apellido,$email,$pass,$especialidad,$tiempo,$precio,$descripcion);
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
    private function updateFisio($idFisio,$nombre,$apellido,$email,$pass,$especialidad,$tiempo,$precio,$descripcion){
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
    private function devolverDatosFisio($idFisio){
        // cliente::get();
        return fisioterapeuta::select('nombreFisioterapeuta','apellidoFisioterapeuta','especialidadFisioterapeuta','tiempoFisioterapeuta', 'precioFisioterapeuta','correoFisioterapeuta','precioFisioterapeuta','descripcionFisioterapeuta')->where('idFisioterapeuta','=',$idFisio)->get();
    }
}
