<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cliente;
use App\Http\Requests\LoginFormRequest;
use Error;
use Illuminate\Support\Facades\Console;

class LoginController extends Controller
{
    public function index(){
        return view::make('index');
    }

    public function ShowMenu(){
        
        return view('menu');
    }

    public function ShowNegocio(){
        return view('aquafix2');
    }

    public function CrearCliente(Request $request){
        
        $clienteNuevo = new Cliente;
        $clienteNuevo->nombre = $request->nombre;
        $clienteNuevo->apellidos = $request->apellido;
        $clienteNuevo->noTel = $request->telefono;
        $clienteNuevo->correo = $request->correo;
        $clienteNuevo->domicilio = $request->domicilio;
        $clienteNuevo->save();
        
        return Redirect::to('negocio')
                    ->with('mensaje', 'Tus datos han sido registrados, te contactaremos');
    
    }
    public function FormCliente(){
         return view('clientes');
    }
    
    public function ShowClientes(){
        //
        $alumnos = Cliente::all();

        return view('listadoalumnos', compact('alumnos'));
   }

    public function logout(){
        Auth::logout();
          
        return Redirect::to('login')
                    ->with('mensaje_error', 'Tu sesión ha sido cerrada.');
                   
                    
    
                }


    public function authenticate(LoginFormRequest $request){
        
       //return $request;
       
         $credentials = $request->only('usuario', 'password');
        
            if (Auth::attempt($credentials))
            
            {
                return view('menu');
            }
            else
            {
                
                //return response()->json([
                    //'status' => 'Ocurrio un error!',
                    //'msg' => 'Usuario no autorizado.',
                //],401);
                //return Redirect::to('login')
                //->withErrors('mensaje_error', 'Tus datos son incorrectos')
                //->withInput();
            return response()->json(['errors' => ['login' => ['Los datos son incorrectos']]], 422);    
            
            
            }
        }
}
