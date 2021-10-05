<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Pago;


use Illuminate\Foundation\Auth\EmailVerificationRequest;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Route::post('/guardar-info', [UserController::class, 'guardarInfo'])->name('guardarInfo');


Route::get('/prueba', function () {
   return App\Models\Step::all();

});


Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    //return back()->with('message', 'Verification link sent!');
    return redirect()->route('login')->with('success', 'Te hemos enviado un correo electornico para validar tu registró y que puedas acceder a nuestro sistema.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');






Auth::routes();




Route::post('/process_payment', [App\Http\Controllers\PaymentController::class, 'ProcessPayment'])->name('processPayment');




Route::prefix('/sistema')->middleware(['auth','verified'])->group(function () {

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    });


    Route::get('/dashboard', function () {

        $s = App\Models\Step::where('user_id', Auth::user()->id)->get();

        return view('layouts.dashboard', compact('s'));
    })->name('dashboard');

    //Usuario

    Route::get('/completar-datos', function () {

        return view('layouts.datos');
    })->name('completarDatos');

    Route::get('/peril', function () {
        $t = App\Models\Tiket::where('user_id' , Auth::user()->id)->get();
        $upago = Pago::where('user_id', Auth::user()->id)->latest('fechaVencimiento')->get();
        return view('layouts.perfil', compact('t', 'upago'));
    })->name('perfil');

    Route::get('/pagos', function () {

        // SDK de Mercado Pago
        require base_path('/vendor/autoload.php');
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = 'Mi producto';
        $item->quantity = 1;
        $item->unit_price = 75.56;
        $preference->items = array($item);
        $preference->save();

        $upago = Pago::where('user_id', Auth::user()->id)->latest('fechaVencimiento')->get();
        $pago = Pago::where('user_id', Auth::user()->id)->get();


        // if ($pago == null) {
        //     $pago = 'nada';
        // }

        // return $pago;


        return view('layouts.pagos', compact('preference', 'pago', 'upago'));
    })->name('pagos');

    Route::get('/pagos/status', function (Request $request) {

        $payment_id = $request->payment_id;
        $status = $request->status;
        $payment_type = $request->payment_type;
        $u = App\Models\User::find(Auth::user()->id);

        $fecha = Carbon::now()->addMonths(1);
        $fecha2 = Carbon::now()->subDays(1);


        if ($status == "approved") {
            DB::select('CALL updatePagoStep(?)', array($u->id));

            $d = new App\Models\Pago;
            $d->user_id = $u->id;
            $d->fechaVencimiento = $fecha;
            $d->status = $status;
            $d->payment_type = $payment_type;
            $d->payment_id = $payment_id;
            $d->save();
            return redirect()->route('dashboard')->with('successPago', '');
        }else if ($status == "pending") {

            $d = new App\Models\Pago;

            $d->user_id = $u->id;
            $d->fechaVencimiento = $fecha2;
            $d->status = $status;
            $d->payment_type = $payment_type;
            $d->payment_id = $payment_id;
            $d->save();
            return redirect()->back()->with('pending', '');
        }else if ($status == "failure") {

            $d = new App\Models\Pago;
            $d->user_id = $u->id;
            $d->fechaVencimiento = $fecha2;
            $d->status = $status;
            $d->payment_type = $payment_type;
            $d->payment_id = $payment_id;
            $d->save();
            return redirect()->back()->with('failure', '');
        }
    });

    Route::get('/soporte', function () {

        $tu = App\Models\Tiket::where('user_id' , Auth::user()->id)->get();
        $t = App\Models\Tiket::all();
        // $t = App\Models\User::all();
        return view('layouts.soporte', compact('t', 'tu'));
    })->name('soporte');


    //Admin
    Route::get('/usuarios-registrados', function () {
        $u = App\Models\User::role('User')->get();
        return view('layouts.usuarios', compact('u'));
    })->name('usuariosRegistrados');

    Route::get('/pagos-usuarios', function () {
        $p = App\Models\Pago::find(1);
        $u = App\Models\User::role('User')->get();
        return view('layouts.usuariosRegistrados', compact('u'));
    })->name('pagoUsuarios');

    Route::get('/alta-usuarios', function () {
        return view('layouts.altausuarios');
    })->name('altausuarios');


    Route::post('/alta-usuario/save', function (Request $request) {


        $password = Str::random(8);
        $pass = Hash::make($password);



        $u = new App\Models\User;

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

        // Mail::to($request->get('email'))->send(new App\Mail\RegisterEmail($details));

        //dd("Correo enviado");

        $datos = [
            'body' => 'Te has registrado en Programa Seguro de forma exitosa, tu contraseña es la siguiente: <b>'. $password .'</b>. Guárdala en un lugar seguro',
            'actionText' => 'Da clic para iniciar sesión',
            'url' => env('APP_URL').'login',
            'thankyou' => 'No olvides contactarnos para cualquier duda.',
            'subject' => 'Bienvenido a Programa Seguro'
        ];

        $u->notify(new App\Notifications\EmailWelcome($datos));



        DB::select('CALL createStepsRoutine(?)', array($u->id));

        $u->assignRole('user');

        return redirect()->back()->with('success', '');


    })->name('saveuser');


    Route::get('ticket/{id}', function ($id) {
        $t = App\Models\Tiket::find($id);

        $t->status = 'cerrado';
        $t->save();

        return redirect()->back()->with('succes', '');
    })->name('cerrarTicket');

    Route::get('/alta-usuario-sistema', function () {

        // $u = App\Models\User::all();
        $u = App\Models\User::role(['Administrator', 'Agent'])->get();
        return view('layouts.altausurio', compact('u'));
    })->name('altaUsuarioSistema');


    Route::get('/editar-usuario-del-sistema/{user}', function (App\Models\User $user) {
        return view('layouts.editarUsuarioSistema', compact('user'));
    })->name('editarUsuarioSistema');

    Route::get('/editar-usuario/{user}', function (App\Models\User $user) {
        return view('layouts.editarUsuario', compact('user'));
    })->name('editarUsuario');









    //Metodos POST
    Route::post('/completar-datos/save', [UserController::class, 'completarDatos'])->name('completarInfo');
    Route::post('/actualizar-datos/save', [UserController::class, 'actualizarDatos'])->name('actualizarInfo');
    Route::post('/soporte/guardar', function (Request $request) {


        $n = new App\Models\Tiket();
        $n->user_id = Auth::user()->id;
        $n->asunto = $request->get('asunto');
        $n->mensaje = $request->get('mensaje');
        $n->save();



        // $data = [
        //     'body' => 'Se ha generado un nuevo ticket en el sistema de Programa Seguro',
        //     'actionText' => 'Da clic para iniciar sesión',
        //     'url' => env('APP_URL').'/sistema/soporte',
        //     'thankyou' => 'Saludos.',
        //     'subject' => 'Ticket Programa Seguro'
        // ];

        // $users->notify(new App\Notifications\TicketNotify($data))->to('victor.zambrano@belhaus.mx');

        Mail::to('victor.zambrano@belhaus.mx')->send(new \App\Mail\RegisterEmail());

        return redirect()->back()->with('successMessage', '');


    })->name('guardar.tiket');

    Route::post('/save-user-sistema', function (Request $request) {


        $request->validate([
            'name' => 'required',
            'middleName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:5'
        ]);

        $password = $request->get('password');
        $pass = Hash::make($password);



        $u = new App\Models\User;

        $u->name = $request->get('name');
        $u->middleName = $request->get('middleName');
        $u->lastName = $request->get('lastName');
        $u->email = $request->get('email');
        $u->phone = '444444';

        $u->password = $pass;
        $u->save();

        $datos = [
            'body' => 'Te has registrado en Programa Seguro de forma exitosa, tu contraseña es la siguiente: <b>'. $password .'</b>. Guárdala en un lugar seguro',
            'actionText' => 'Da clic para iniciar sesión',
            'url' => env('APP_URL').'login',
            'thankyou' => 'No olvides contactarnos para cualquier duda.',
            'subject' => 'Acceso al sistema Programa Seguro'
        ];

        $u->notify(new App\Notifications\EmailWelcome($datos));

        //dd("Correo enviado");

        // DB::select('CALL createStepsRoutine(?)', array($u->id));

        $u->assignRole($request->get('rol'));

        return redirect()->back()->with('success', '');
    })->name('saveusersistema');

    Route::get('/eliminar-usuario/{id}', function ($id) {
        $u = App\Models\User::find($id);
        $u->delete();
        return redirect()->back()->with('successDel');
    })->name('eliminarUsuario');


    Route::post('/actualizar-datos-usuario-sistema/{user}', function (App\Models\User $user, Request $request) {
        $u = $user;

        $u->name = $request->get('name');
        $u->middleName = $request->get('middleName');
        $u->lastName = $request->get('lastName');
        $u->email = $request->get('email');
        $u->save();

        return redirect()->route('altaUsuarioSistema')->with('successEdit', '');
    })->name('actualizarInfoUsuarioSistema');

    Route::post('/actualizar-datos-usuario/{user}', function (App\Models\User $user, Request $request) {
        $u = $user;

        $u->name = $request->get('name');
        $u->middleName = $request->get('middleName');
        $u->lastName = $request->get('lastName');
        $u->email = $request->get('email');
        $u->phone = $request->get('phone');
        $u->birthday = $request->get('birthday');
        $u->RFC = $request->get('RFC');
        $u->NSS = $request->get('NSS');
        $u->CURP = $request->get('CURP');
        $u->save();

        return redirect()->route('usuariosRegistrados')->with('successEdit', '');
    })->name('actualizarInfoUsuario');

});
