<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\cliente;

class ClienteController extends Controller
{
    //
    public function rutaCliente(){
        $arreglo=$this->sesionDevolverArreglo();
        return view('clienteInicio')->with('Arreglo',$arreglo);
    }
    public function misDatosCliente(){
       $arreglo=$this->sesionDevolverArreglo();
       $datosCliente=$this->devolverDatosClientes($arreglo['idActual']);
       $exitoDetalles=session('exito');
       $errorDetalles=session('error');
        if($errorDetalles!=null){
            return view('datoscliente')->with('Arreglo',$arreglo)->with('datosCliente',$datosCliente[0])->with('detallesError',$errorDetalles);
        }else if($exitoDetalles!=null){
            return view('datoscliente')->with('Arreglo',$arreglo)->with('datosCliente',$datosCliente[0])->with('detallesExito',$exitoDetalles);
        }else{
            return view('datoscliente')->with('Arreglo',$arreglo)->with('datosCliente',$datosCliente[0]);
        }
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
    public function actualizarCliente(Request $request){
        $arreglo=$this->sesionDevolverArreglo();
        $idCliente=$arreglo['idActual'];
        $nombre=$request->input("nombre");
        $apellido=$request->input("apellido");
        $email=$request->input("email");
        $pass=$request->input("contrasenia");
        $dni=$request->input("dni");
        $resultado=$this->updateCliente($idCliente,$nombre,$apellido,$email,$dni);
        if($resultado==1){
            $exito="Se ha realizado una actualizacion con exito";
            session()->flash('exito',$exito);
            return redirect()->route('clienteDatos');
        }else{
            $error="No se realizado la actualizacion por un error";
            session()->flash('error',$error);
            return redirect()->route('clienteDatos');
        }
    }
    private function updateCliente($idCliente,$nombre,$apellido,$email,$dni){
        $cliente = cliente::find($idCliente);
        $cliente->nombreCliente=$nombre;
        $cliente->apellidoCliente=$apellido;
        $cliente->dniCliente=$dni;
        $cliente->correoCliente=$email;
        if($pass!=null){
            $cliente->passwordCliente=md5($pass);
        }
        return $cliente->save();
    }
    private function devolverDatosClientes($idCliente){
        // cliente::get();
        return cliente::select('nombreCliente','apellidoCliente','dniCliente','correoCliente')->where('idCliente','=',$idCliente)->get();
    }
}
