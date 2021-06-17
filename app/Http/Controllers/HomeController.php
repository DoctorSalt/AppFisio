<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\fisioterapeuta;
use \App\Models\cliente;
use \App\Models\disponible;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //Escribir sobre hacer tablas con texto alert con liseners click
    function paginaLogin(){
        return view('login');
    }
    function paginaCalendario(){
        return view('calendario');
    }
    
  

    function verificacionLogin(request $request){             
        if(session('Nombre')!==null){
            $nombre=session('Nombre');
            $idActual=session('id');
            $tipoUsuario=session('tipo');
            session()->flash('id',$idActual);
            session()->flash('tipo',$tipo);
            session()->flash('Nombre',$nombre);
            if($tipoUsuario==="fisio"){
               //return view('fisioInicio')->with('Arreglo',$arreglo);
                return redirect()->route('fisioInicio');
            }else if($tipoUsuario=="cliente"){
                //return view('clienteInicio')->with('Arreglo',$arreglo);
                return redirect()->route('clienteInicio');
            }else{
                $error="No hay sesion tipo usuario";
                session()->flash('error',$error);
                return redirect()->route('inicioLogin');
            }
        }else{
            $login=$request->input('log');
            $password=$request->input('pass');
            $password=md5($password);
            $result=cliente::select('idCliente', 'nombreCliente', 'apellidoCliente')->where([['correoCliente','=',$login],['passwordCliente','=', $password]])->get();
            if(count($result)==0){
                $result2=fisioterapeuta::select('idFisioterapeuta', 'nombreFisioterapeuta', 'apellidoFisioterapeuta')->where([['correoFisioterapeuta','=',$login],['passwordFisioterapeuta','=', $password]])->get();
                if(count($result2)!=0){
                    $nombre=$result2[0]['nombreFisioterapeuta']." ".$result2[0]['apellidoFisioterapeuta'];
                    $idActual=$result2[0]['idFisioterapeuta'];
                    session()->flash('id',$idActual);
                    session()->flash('tipo','fisio');
                    session()->flash('Nombre',$nombre);
                    //$arreglo=array('idActual'=>$idActual,'nombre'=>$nombre);
                    //return view('fisioInicio')->with('Arreglo',$arreglo);
                    return redirect()->route('fisioInicio');
                }else{
                    $error="No existe ese usuario";
                    session()->flash('error',$error);
                    return redirect()->route('inicioLogin');
                }
                
            }else{
                $nombre=$result[0]['nombreCliente']." ".$result[0]['apellidoCliente'];
                $idActual=$result[0]['idCliente'];                
                session()->flash('id',$idActual);
                session()->flash('tipo','cliente');
                session()->flash('Nombre',$nombre);
                /* $arreglo=array('idActual'=>$idActual,'nombre'=>$nombre); */
                //return view('clienteInicio')->with('Arreglo',$arreglo);
                return redirect()->route('clienteInicio');
            }
        }       
    }
    function paginaTabla(){
        $fisioterapeutas=fisioterapeuta::get();       
        return view('tablaFisioterapeutas')->with('listaFisio',$fisioterapeutas);
    }
    function paginaRegistroCliente(){
        $tipoUsuario="cliente";
        return view('registrase')->with('tipoUsuario',$tipoUsuario);
    }
    function paginaRegistroFisio(){
        $tipoUsuario="fisio";
        return view('registrase')->with('tipoUsuario',$tipoUsuario);
    }
    function registrarseInsert(Request $request){
        $tipoUsuario=$request->input('tipoUsuario');
        $nombre=$request->input('nombre');
        $apellido=$request->input('apellido');
        $email=$request->input('email');
        $pass=md5($request->input('password'));
        $existe=$this->existeCorreo($email,$pass);
        if($existe==true){
            if($tipoUsuario=="cliente"){
                session()->flash('error','Existe un correo, por favor use otro');
                return redirect()->route('registroCliente');
            }else if($tipoUsuario=="fisio"){
                session()->flash('error','Existe un correo, por favor use otro');
                return redirect()->route('registroFisio');
            }else{
                session()->flash('error','Direccionado mal');
                return redirect()->route('inicioLogin');
            }
        }else{
            switch($tipoUsuario){
                case "cliente":
                    $dni=$request->input('dni');
                    return $this->insertarCliente($nombre,$apellido,$dni,$email,$pass);
                    break;
                case "fisio":
                    $especialidad=$request->input('especialidad');
                    $tiempo=$request->input('tiempo');
                    $precio=$request->input('precio');
                    $descripcion=$request->input('descripcion');
                    $provincia=$request->input('provincia');
                    return $this->insertarFisio($nombre,$apellido,$email,$pass,$especialidad,$tiempo,$precio,$descripcion,$provincia);
                    break;
            }    
        }           
    }
    function horarioModificar(Request $request){
        //$id=session('idFisio');
        $idFisio=$request->input('idFisio');
        return view('horario')->with('idFisio',$idFisio);
    }
    function deslogarse(){
        $this->borrarSesionesUsuario();
        return redirect()->route('inicioLogin');
    }
    private function insertarFisio($nombre,$apellido,$email,$pass,$especialidad,$tiempo,$precio,$descripcion,$provincia){
        try{
            $fisio=new fisioterapeuta();
            $fisio->nombreFisioterapeuta=$nombre;
            $fisio->apellidoFisioterapeuta=$apellido;
            $fisio->especialidadFisioterapeuta=$especialidad;
            $fisio->tiempoFisioterapeuta=$tiempo;
            $fisio->precioFisioterapeuta=$precio;
            $fisio->correoFisioterapeuta=$email;
            $fisio->passwordFisioterapeuta=$pass;
            $fisio->descripcionFisioterapeuta=$descripcion;
            $fisio->provinciaFisioterapeuta=$provincia;
            $fisio->save();
            $exito = "Insertado fisio";
            session()->flash('exito',$exito);
            return redirect()->route('inicioLogin');;
        }
        catch(ExceptionsException $e){
            $error = "Error insertando fisio";
            session()->flash('error',$error);
            return redirect()->route('registroCliente');;
        } 
    }
    private function insertarCliente($nombre,$apellido,$dni,$email,$pass){
        try{
            $cliente = new cliente();
            $cliente->nombreCliente = $nombre;
            $cliente->apellidoCliente = $apellido;
            $cliente->dniCliente=$dni;
            $cliente->correoCliente=$email;
            $cliente->passwordCliente=$pass;
            $cliente->save();
            session()->flash('exito','Insertado Cliente');
            return redirect()->route('inicioLogin');;
            }
            catch(ExceptionsException $e){
                $error ="Se ha producido una excepcion al insertar los campos";
                session()->flash('error',$error);
                return redirect()->route('registroCliente');;
            } 
    }
    private function borrarSesionesUsuario(){
        session()->forget('id');
        session()->forget('Nombre');
        session()->forget('tipo');
    }
    private function existeCorreo($correoString,$pass){
        $result=cliente::select('idCliente')->where([['correoCliente','=',$correoString],['passwordCliente','=', $pass]])->get();
        if(count($result)==0){
            $result2=fisioterapeuta::select('idFisioterapeuta')->where([['correoFisioterapeuta','=',$correoString],['passwordFisioterapeuta','=', $pass]])->get();
            if(count($result2)==0){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }
}