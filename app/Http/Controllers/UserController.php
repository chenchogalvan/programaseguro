<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RegisterEmail;
use Mail;
use Illuminate\Http\Request;

use Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;


use Illuminate\Auth\Events\Registered;







class UserController extends Controller
{
    public function guardarInfo(Request $request)
    {

        $validacion = $request->validate([
            'name' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|numeric',
            'password' => 'required|confirmed|string|min:5'
        ]);

        $password = $request->get('password');
        $pass = Hash::make($password);



        $u = new User;

        $u->name = $request->get('name');
        $u->middleName = $request->get('middleName');
        $u->lastName = $request->get('lastName');
        $u->email = $request->get('email');
        $u->phone = $request->get('phone');
        $u->birthday = $request->get('birthday');
        $u->CURP = $request->get('CURP');
        $u->NSS = $request->get('NSS');
        $u->RFC = $request->get('RFC');

        $u->password = $pass;
        $u->save();

        $details = [
            'nombre' => $request->get('name'),
            'password' => $password
        ];

        //Mail::to($request->get('email'))->send(new RegisterEmail($details));


        event(new Registered($u));

        //dd("Correo enviado");

        DB::select('CALL createStepsRoutine(?)', array($u->id));

        $u->assignRole('user');

        return redirect()->route('login')->with('success', 'Te has registrado de forma correcta en nuestro sistema de Programa Seguro. Te hemos enviado un correo electrónico para validar tu registro y que puedas acceder a nuestro sistema.');

    }



    public function completarDatos(Request $request)
    {

        $u = User::find(Auth::user()->id);

        $u->birthday = $request->get('birthday');
        $u->RFC = $request->get('RFC');
        $u->NSS = $request->get('NSS');
        $u->CURP = $request->get('CURP');
        $u->save();

        DB::select('CALL updateDatoStep(?)', array($u->id));

        return redirect()->route('dashboard')->with('successDatos', '');
    }


    public function actualizarDatos(Request $request)
    {

        // return $request->all();

        $u = User::find(Auth::user()->id);

        if ($request->get('pagoAprobado') == 1) {
            // $u->email = $request->get('email');
            $u->phone = $request->get('phone');
            $u->birthday = $request->get('birthday');
            $u->RFC = $request->get('RFC');
            $u->NSS = $request->get('NSS');
            $u->CURP = $request->get('CURP');
            $u->save();

            $datos = 'uno';
        }else if($request->get('pagoAprobado') == 2){

            $u->phone = $request->get('phone');
            $u->save();

            $datos = '2';
        }

        // return $datos;






        return redirect()->route('perfil')->with('successDatos', '');
    }
}
