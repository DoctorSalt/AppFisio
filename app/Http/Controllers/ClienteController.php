<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\cliente;
use \App\Models\fisioterapeuta;
use \App\Models\disponible;

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
    public function devolverFechasDisponibles(Request $request){
        $idFisio=$request->input('idFisio');
        return disponible::selectRaw('distinct disponibles.diaDisponible')->
        where('idFisioFK','=',$idFisio)->get();
    }
    public function devolverCitasPosiblesFechaFisio(Request $request){
        $idFisio=$request->input('idFisio');
        $fechaElegida=$request->input('fecha');
        return disponible::select('diaDisponible','horaDisponible')->
        where('diaDisponible','=',$fechaElegida)->
        where('idFisioFK','=',$idFisio)->get();
    }
    public function crearCita(Request $request){
        $hora=$request->input('hora');
        $dia=$request->input('dia');
        $tiempo=$request->input('tiempo');
        $direccion=$request->input('direccion');
        $precio=$request->input('precio');
        $idCliente=$request->input('idCliente');
        $idFisio=$request->input('idFisio');
        $this->crearCitaSinConfirmar($hora,$dia,$tiempo,$direccion,$precio,$idCliente,$idFisio);
    }
    public function confirmacionCita(Request $request){
        $idFisio=$request->input('idFisio');
        $descripcion=$request->input('descripcion');
        $this->confirmarCita($idFisio,$descripcion);
    }
    private function crearCitaSinConfirmar($hora,$dia,$tiempo,$direccion,$precio,$idCliente,$idFisio){
        $cita=new cita();
        $cita->horaCita=$hora;
        $cita->diaCita=$dia;
        $cita->tiempoCita=$tiempo;
        $cita->direccionCita=$direccion;
        $cita->precioCita=$precio;
        $cita->idClienteFK5=$idCliente;
        $cita->IdFisioterapeutaFK=$idFisio;
        $cita->save();
    }
    private function confirmarCita($idFisio,$descripcion){
        $cita=cita::find($idFisio);
        $cita->descripcionCita=$descripcion;
        $cita->confirmadaCita=1;
        $cita->save();
    }
}
