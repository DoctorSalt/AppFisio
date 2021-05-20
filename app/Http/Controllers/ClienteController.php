<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //

    public function rutaCliente(){
        $arreglo=$this->sesionDevolverArreglo();
        return view('clienteInicio')->with('Arreglo',$arreglo);
    }
    public function misDatosCliente(){
        $arreglo=$this->sesionDevolverArreglo();
        return view('datoscliente')->with('Arreglo',$arreglo);
    }
    private function sesionDevolverArreglo(){
        $nombre=session('Nombre');
        $idActual=session('id');
        $tipo=session('tipo');
        session()->flash('id',$idActual);
        session()->flash('tipo',$tipo);
        session()->flash('Nombre',$nombre);
        return $arreglo=array('idActual'=>$idActual,'nombre'=>$nombre);
    }
    public function rutaCitasClientes(){
        $arreglo=$this->sesionDevolverArreglo();
        return view('clienteCita')->with('Arreglo',$arreglo);
    }
}
