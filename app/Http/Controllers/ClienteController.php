<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\cliente;
use \App\Models\fisioterapeuta;
use \App\Models\disponible;
use \App\Models\cita;

class ClienteController extends Controller
{
    //
    public function rutaCliente(){
        $arreglo=$this->sesionDevolverArreglo();
        $citasPorConfirmar=$this->busquedaSinCita($arreglo['idActual']);
        $citasConfirmadas=$this->busquedaConfirmadaCita($arreglo['idActual']);
        return view('clienteInicio')->with('Arreglo',$arreglo)
        ->with('citasPorConfirmar',$citasPorConfirmar)
        ->with('citasConfirmadas',$citasConfirmadas);
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
   public function realizarCitas(){
    $arreglo=$this->sesionDevolverArreglo();
    return view('clienteCalendarioCitas')->with('Arreglo',$arreglo);

   }
    public function fisioterapeutasDeUnaProvincia(Request $request){
        $arreglo=$this->sesionDevolverArreglo();
        $provincia=$request->input('provincia');
        $arrayDisponibles= fisioterapeuta::select(
        'idFisioterapeuta as Id',
        'nombreFisioterapeuta as nombre',
        'apellidoFisioterapeuta as apellidos',
        'especialidadFisioterapeuta as especialidad',
        'tiempoFisioterapeuta as tiempo','precioFisioterapeuta as precio',
        'provinciaFisioterapeuta as provincia')
        ->where('provinciaFisioterapeuta','=',$provincia)->get();
        if(sizeOf($arrayDisponibles)==0){
            return $arrayResultante=array("respuesta"=>"No");
        }else{
            return $arrayResultante=array("respuesta"=>"Si","ArrayResultado"=>$arrayDisponibles);
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
        $citasPorConfirmar=$this->busquedaSinCita($arreglo['idActual']);
        $citasConfirmadas=$this->busquedaConfirmadaCita($arreglo['idActual']);
        return view('clienteCita')
        ->with('Arreglo',$arreglo)->with('citasPorConfirmar',$citasPorConfirmar)
        ->with('citasConfirmadas',$citasConfirmadas);
    }
    function buscarDisponiblesPorFecha(Request $request){
        $arreglo=$this->sesionDevolverArreglo();
        $idFisio=$request->input("idFisio");
        $fechaElegida=$request->input("fechaResultante");
       // $request->input("idCliente");
        return $arrayDiasDisponible=disponible::select('horaDisponible','idDisponible')
        ->where("diaDisponible","=",$fechaElegida)
        ->where("idFisioterapeutaFK3",'=',$idFisio)->get();
    }
    function buscarDisponibles(Request $request){
        $arreglo=$this->sesionDevolverArreglo();
        $idFisio=$request->input("idFisio");
       // $request->input("idCliente");
        return $arrayDiasDisponible=disponible::selectRaw('DISTINCT diaDisponible')->where("idFisioterapeutaFK3",'=',$idFisio)->get();
    }
    public function busquedaSinCita($idCliente){
        $this->sesionDevolverArreglo();
        $arrayCitas=cita::select('horaCita','diaCita','tiempoCita','nombreFisioterapeuta')
        ->where('idClienteFK','=',$idCliente)
        ->join('fisioterapeutas','idFisioterapeuta','=','IdFisioterapeutaFK2')
        ->where("confirmadaCita","=",0)->get();
        return $arrayCitas;
    }
    public function busquedaConfirmadaCita($idCliente){
        //Añadir flashes
        $this->sesionDevolverArreglo();
        $arrayCitas=cita::select('horaCita','diaCita','tiempoCita','nombreFisioterapeuta','direccionCita')
        ->where('idClienteFK','=',$idCliente)
        ->join('fisioterapeutas','idFisioterapeuta','=','IdFisioterapeutaFK2')
        ->where("confirmadaCita","=",1)->get();
        return $arrayCitas;
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
    public function aniadirCita(Request $request){
        $this->sesionDevolverArreglo();
        $idCliente=$request->input('idCliente');
        $idDisponible=$request->input('idDisponible');
        $disponible=disponible::find($idDisponible);
        $diaCita=$disponible['diaDisponible'];
        $horaCita=$disponible['horaDisponible'];
        $idFisioterapeutaFK2=$disponible['idFisioterapeutaFK3'];
        $fisio=fisioterapeuta::find($idFisioterapeutaFK3);
        $tiempoFisio=$fisio['tiempoFisioterapeuta'];        
        $resultado=$this->insertarCita($idCliente,$idDisponible,$diaCita,$horaCita,$idFisioterapeutaFK2,$tiempoFisio);
        if($resultado){
            return "Si";
        }else{
            return "No";
        }
    }
    private function insertarCita($idCliente,$idDisponible,$diaCita,$horaCita,$idFisioterapeutaFK2,$tiempoFisio){
        $cita=new cita();
        $cita->horaCita=$horaCita;
        $cita->diaCita=$diaCita;
        $cita->tiempoCita=$tiempoFisio;
        $cita->realizadoCita=0;
        $cita->confirmadaCita=0;
        $cita->idClienteFK=$idCliente;
        $cita->idFisioterapeutaFK2=$idFisioterapeutaFK2;
        //Falta Precio
        $resultado=$cita->save();
        return $resultado;

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
        $this->sesionDevolverArreglo();
        $idFisioterapeutaFK3=$request->input('idFisio');
        return disponible::selectRaw('distinct disponibles.diaDisponible')->
        where('idFisioterapeutaFK3','=',$idFisioterapeutaFK3)->get();
    }
    public function devolverCitasPosiblesFechaFisio(Request $request){
        $this->sesionDevolverArreglo();
        $idFisioterapeutaFK3=$request->input('idFisio');
        $fechaElegida=$request->input('fecha');
        return disponible::select('diaDisponible','horaDisponible')->
        where('diaDisponible','=',$fechaElegida)->
        where('idFisioterapeutaFK3','=',$idFisioterapeutaFK3)->get();
    }
  
}
