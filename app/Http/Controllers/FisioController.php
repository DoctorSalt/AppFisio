<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\fisioterapeuta;
use \App\Models\horario;


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

        try{
            $horario=new horario();
            
            $horario->lunesmiHorario=$diaLuM1;
            $horario->lunesmfHorario=$diaLuM2;
            $horario->lunestiHorario=$diaLuT1;
            $horario->lunestfHorario=$diaLuT2;

            $horario->martesmiHorario=$diaMaM1;
            $horario->martesmfHorario=$diaMaM2;
            $horario->martestiHorario=$diaMaT1;
            $horario->martestfHorario=$diaMaT2;
            
            $horario->miercolesmiHorario=$diaMiM1;
            $horario->miercolesmfHorario=$diaMiM2;
            $horario->miercolestiHorario=$diaMiT1;
            $horario->miercolestfHorario=$diaMiT2;
            
            $horario->juevesmiHorario=$diaJuM1;
            $horario->juevesmfHorario=$diaJuM2;
            $horario->juevestiHorario=$diaJuT1;
            $horario->juevestfHorario=$diaJuT2;
            
            $horario->viernesmiHorario=$diaViM1;
            $horario->viernesmfHorario=$diaViM2;
            $horario->viernestiHorario=$diaViT1;
            $horario->viernestfHorario=$diaViT2;
            $horario->save();
            $idInsertado=$horario->idHorario;
            $result=fisioterapeuta::where('idFisioterapeuta','=',$idFisioterapeuta)->update(['idHorarioFK'=>$idInsertado]);           
        } catch(ExceptionsException $e){
            $error = "Error insertando fisio";
            session()->flash('error',$error);
            return redirect()->route('registroFisio');
        } 
        return redirect()->route('registroFisio');
    }
    public function rutaFisioterapeuta(){
        $arreglo=$this->sesionDevolverArreglo();
        return view('fisioInicio')->with('Arreglo',$arreglo);
    }
    public function misDatosFisioterapeuta(){
        $arreglo=$this->sesionDevolverArreglo();
        return view('datosfisioterapeuta')->with('Arreglo',$arreglo);
    }
    public function routeMisClientes(){
        $arreglo=$this->sesionDevolverArreglo();
        return view('clienteFisio')->with('Arreglo',$arreglo);
    }
    private function sesionDevolverArreglo(){
        $nombre=session('Nombre');
        $idActual=session('id');
        $tipo=session('tipo');
        if($tipo=="cliente"){
            $error="Incorrecto tipo Usuatio";
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
}
