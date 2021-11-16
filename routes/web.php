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

        // // SDK de Mercado Pago
        // require base_path('/vendor/autoload.php');
        // // Agrega credenciales
        // MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

        // // Crea un objeto de preferencia
        // $preference = new MercadoPago\Preference();

        // // Crea un ítem en la preferencia
        // $item = new MercadoPago\Item();
        // $item->title = 'Mi producto';
        // $item->quantity = 1;
        // $item->unit_price = 75.56;
        // $preference->items = array($item);
        // $preference->save();

        $upago = Pago::where('user_id', Auth::user()->id)->latest('fechaVencimiento')->get();
        $pago = Pago::where('user_id', Auth::user()->id)->get();

        return view('layouts.pagos', compact('pago', 'upago'));
    })->name('pagos');

    Route::get('/pagos/status', function (Request $request) {


        $payment_id = $request->payment_id;
        $status = $request->status;
        $payment_type = $request->payment_type;
        $u = App\Models\User::find(Auth::user()->id);

        $costoPago = 1500.00;





        $fecha = Carbon::now()->addMonths(1);
        $fecha2 = Carbon::now()->subDays(1);

        //Periodo gracia inicial
        $periodoGracia = Carbon::parse($fecha)->addDays(5);






        $us = App\Models\User::role('User')->where('id', $u->id)
                    ->with('pago', function($q){
                        return $q->latest('created_at')
                        //where('created_at', '>=', Carbon::now())
                        // ->where('status', '=', 'approved')
                        ->orderBy('created_at', 'asc')
                        ->groupBy('user_id');
                    })->get();


        $pago = App\Models\Pago::where('user_id', $u->id)
                    ->where('status', 'approved')
                    ->latest('created_at')
                    ->orderBy('created_at', 'asc')
                    ->groupBy('user_id')
                    ->first();

        // return Carbon::parse($pago->fechaVencimiento)->addMonths(1)->format('M d Y');

        //Si no existe registro pondra la fecha de creación como base
        //Si existe entonces tomará la fecha de vencimiento
        if ($pago == null) {
            if ($status == "approved") {
                DB::select('CALL updatePagoStep(?)', array($u->id));

                $d = new App\Models\Pago;
                $d->user_id = $u->id;
                $d->fechaVencimiento = $fecha;
                $d->periodoGracia = $periodoGracia;
                $d->fechaPago = Carbon::now();
                $d->status = $status;
                $d->payment_type = $payment_type;
                $d->payment_id = $payment_id;
                $d->costoPago = $costoPago;
                $d->save();


                Mail::to($u->email)->send(new \App\Mail\pagoEmail());




                return redirect()->route('dashboard')->with('successPago', '');
            }else if ($status == "pending") {

                $d = new App\Models\Pago;

                $d->user_id = $u->id;
                // $d->fechaVencimiento = $fecha2;
                $d->status = $status;
                $d->payment_type = $payment_type;
                $d->payment_id = $payment_id;
                $d->costoPago = $costoPago;
                $d->save();
                return redirect()->back()->with('pending', '');
            }else if ($status == "failure") {

                $d = new App\Models\Pago;
                $d->user_id = $u->id;
                // $d->fechaVencimiento = $fecha2;
                $d->status = $status;
                $d->payment_type = $payment_type;
                $d->payment_id = $payment_id;
                $d->costoPago = $costoPago;
                $d->save();
                return redirect()->back()->with('failure', '');
            }
        }else{

            if ($status == "approved") {
                DB::select('CALL updatePagoStep(?)', array($u->id));


                $fechaRecurrente = Carbon::parse($pago->fechaVencimiento)->addMonths(1);
                $periodoGraciaRecurrente = Carbon::parse($fechaRecurrente)->addDays(5);



                $d = new App\Models\Pago;
                $d->user_id = $u->id;
                $d->fechaVencimiento = $fechaRecurrente;
                $d->periodoGracia = $periodoGraciaRecurrente;
                $d->fechaPago = Carbon::now();
                $d->status = $status;
                $d->payment_type = $payment_type;
                $d->payment_id = $payment_id;
                $d->costoPago = $costoPago;
                $d->save();

                Mail::to($u->email)->send(new \App\Mail\pagoEmail());



                return redirect()->route('dashboard')->with('successPago', '');
            }else if ($status == "pending") {

                $d = new App\Models\Pago;

                $d->user_id = $u->id;
                // $d->fechaVencimiento = $fecha2;
                $d->status = $status;
                $d->payment_type = $payment_type;
                $d->payment_id = $payment_id;
                $d->costoPago = $costoPago;
                $d->save();
                return redirect()->back()->with('pending', '');
            }else if ($status == "failure") {

                $d = new App\Models\Pago;
                $d->user_id = $u->id;
                // $d->fechaVencimiento = $fecha2;
                $d->status = $status;
                $d->payment_type = $payment_type;
                $d->payment_id = $payment_id;
                $d->costoPago = $costoPago;
                $d->save();
                return redirect()->back()->with('failure', '');
            }


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

        $u = App\Models\User::role('User')
                            ->with('pago', function($q){
                                return $q->orderBy('created_at', 'desc')
                                ->where('status', '=', 'approved')
                                // ->orWhere('status', '=', 'pending')
                                // ->orWhere('status', '=', 'faiuler')
                                //->latest('created_at')
                                //where('created_at', '>=', Carbon::now())
                                // ->where('status', '=', 'approved')
                                ->orderBy('created_at', 'desc')
                                // ->groupBy('user_id')
                                ->get();
                            })->get();

        return view('layouts.usuarios', compact('u'));
    })->name('usuariosRegistrados');

    Route::get('/pagos-usuarios', function () {
        $p = App\Models\Pago::with('user')->orderBy('fechaVencimiento', 'asc')->get();
        $u = App\Models\User::role('User')->with('pago')->get();

        // return $p;
        return view('layouts.usuariosRegistrados', compact('p'));
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
        $u->email_verified_at = Carbon::now();
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
        DB::select('CALL updateDatoStep(?)', array($u->id));


        $u->assignRole('user');

        return redirect()->back()->with('success', '');


    })->name('saveuser');


    Route::post('ticket/{id}', function ($id, Request $request) {
        $t = App\Models\Tiket::find($id);

        $t->status = 'cerrado';
        $t->notaMensaje = $request->get('mensaje');
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

        $user = App\Models\User::find(Auth::user());

        $data = [
            'asunto' => $n->asunto,
            'mensaje' => $n->mensaje,
            'usuario' => $user[0]->name.' '. $user[0]->middleName.' '.$user[0]->lastName,
            'correo' => $user[0]->email,
            'telefono' => $user[0]->phone
        ];

        // $correo = $user[0]->email;





        // $data = [
        //     'body' => 'Se ha generado un nuevo ticket en el sistema de Programa Seguro',
        //     'actionText' => 'Da clic para iniciar sesión',
        //     'url' => env('APP_URL').'/sistema/soporte',
        //     'thankyou' => 'Saludos.',
        //     'subject' => 'Ticket Programa Seguro'
        // ];

        // $users->notify(new App\Notifications\TicketNotify($data))->to('victor.zambrano@belhaus.mx');

        Mail::to('victor.zambrano@belhaus.mx')->send(new \App\Mail\RegisterEmail($data));

        // Mail::to('alfredogalvan.91@gmail.com')->send(new \App\Mail\RegisterEmail($data));

        // Mail::send('emails.ticketEmail', $data, function ($message) use ($datos) {
        //     $message->to('victor.zambrano@belhaus.mx');
        //     $message->replyTo($datos[0]->correo);
        //     $message->subject('Ticket de soporte | Programa Seguro');;
        // });

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
        $u->email_verified_at = Carbon::now();
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


    //Cancelar o aprobar pagos
    Route::get('/modificar-pago/{status}/{pago}', function ($status, App\Models\Pago $pago) {


        $pag = App\Models\Pago::where('user_id', $pago->user_id)
                    ->where('status', 'approved')
                    // ->latest('fechavencimiento')
                    ->orderBy('created_at', 'desc')
                    // ->groupBy('user_id')
                    ->first();

        $user = App\Models\User::find($pago->user);








        if ($pag == null) {

            if ($status == 'aprobar') {

                $fechaVencimiento = Carbon::now()->addMonths(1);
                $periodoGracia = Carbon::parse($fechaVencimiento)->addDays(5);


                $p = $pago;
                $p->status = 'approved';
                $p->fechaVencimiento = $fechaVencimiento;
                $p->periodoGracia = $periodoGracia;
                $p->fechaPago = Carbon::now();
                $p->save();

                DB::select('CALL updatePagoStep(?)', array($pago->user->id));

                Mail::to($pago->user->email)->send(new \App\Mail\pagoEmail());

                return redirect()->back()->with('modify', 'Se modificó el registro de <b>'.$pago->user->name.' '.$pago->user->middleName.' '.$pago->user->lastName.'</b> con el id de pago <b>'.$pago->payment_id.'</b> a <b>aprobado</b> de forma exitosa.');
            }else if($status == 'cancelar'){


                $p = $pago;
                $p->status = 'failure';
                $p->save();

                return redirect()->back()->with('modify', 'Se modifico el registro de <b>'.$pago->user->name.' '.$pago->user->middleName.' '.$pago->user->lastName.'</b> con el id de pago <b>'.$pago->payment_id.'</b> a <b>cancelado</b> de forma exitosa.');
            }

        }else{

            if ($status == 'aprobar') {

                $fechaVen = Carbon::parse($pag->fechaVencimiento)->addMonths(1);
                $periodoGrac = Carbon::parse($fechaVen)->addDays(5);

                $p = $pago;
                $p->status = 'approved';
                $p->fechaVencimiento = $fechaVen;
                $p->periodoGracia = $periodoGrac;
                $p->fechaPago = Carbon::now();
                $p->save();



                DB::select('CALL updatePagoStep(?)', array($pago->user->id));

                Mail::to($pago->user->email)->send(new \App\Mail\pagoEmail());

                return redirect()->back()->with('modify', 'Se modifico el registro de <b>'.$pago->user->name.' '.$pago->user->middleName.' '.$pago->user->lastName.'</b> con el id de pago <b>'.$pago->payment_id.'</b> a <b>aprobado</b> de forma exitosa.');
            }else if($status == 'cancelar'){


                $p = $pago;
                $p->status = 'failure';
                $p->save();

                return redirect()->back()->with('modify', 'Se modifico el registro de <b>'.$pago->user->name.' '.$pago->user->middleName.' '.$pago->user->lastName.'</b> con el id de pago <b>'.$pago->payment_id.'</b> a <b>cancelado</b> de forma exitosa.');
            }

        }

        // return $pag;



        // if ($status == 'aprobar') {


        //     $p = $pago;
        //     $p->status = 'approved';
        //     $p->fechaVencimiento = Carbon::now()->addMonths(1);
        //     $p->fechaPago = Carbon::now();
        //     $p->save();

        //     DB::select('CALL updatePagoStep(?)', array($pago->user->id));

        //     return redirect()->back()->with('modify', 'Se modifico el registro de <b>'.$pago->user->name.' '.$pago->user->middleName.' '.$pago->user->lastName.'</b> con el id de pago <b>'.$pago->payment_id.'</b> a <b>aprobado</b> de forma exitosa.');
        // }else if($status == 'cancelar'){


        //     $p = $pago;
        //     $p->status = 'failure';
        //     $p->save();

        //     return redirect()->back()->with('modify', 'Se modifico el registro de <b>'.$pago->user->name.' '.$pago->user->middleName.' '.$pago->user->lastName.'</b> con el id de pago <b>'.$pago->payment_id.'</b> a <b>cancelado</b> de forma exitosa.');
        // }


    })->name('modificarPago');


    //Ver pagos independientes
    Route::get('/pagos-de-usuarios/{user}', function (App\Models\User $user) {


        $pagos = App\Models\Pago::where('user_id', $user->id)->get();



        return view('layouts.verPagosUsuarios', compact('user', 'pagos'));
    })->name('verPagosUsuarios');



    //Reportes
    Route::get('/lista-vigentes', function () {

        $pagos = App\Models\Pago::with('user')
                    ->where('fechaVencimiento', '>=', Carbon::now())
                    ->where('status', '=', 'approved')
                    ->orderBy('fechaVencimiento', 'asc')
                    ->groupBy('user_id')
                    ->get();


        // $u = App\Models\User::role('User')
        //             ->with('pago', function($q){
        //                 return $q->latest('created_at')
        //                 //where('created_at', '>=', Carbon::now())
        //                 // ->where('status', '=', 'approved')
        //                 ->orderBy('created_at', 'asc');
        //                 // ->groupBy('user_id');
        //             })->get();

        $u = App\Models\User::role('User')
                    ->with('pago', function($q){
                        return $q->latest('created_at')
                        //where('created_at', '>=', Carbon::now())
                        ->where('status', '=', 'approved')
                        ->orWhere('status', '=', 'pending')
                        ->orderBy('created_at', 'asc');
                        // ->groupBy('user_id');
                    })->get();

        // return $u;

        // if ($u[0]->pago[0]->periodoGracia >= \Carbon\Carbon::now()->format('Y-m-d')) {
        //     if ($u[0]->pago->count() >= 1 && isset($u[0]->pago[1]->count()) >= 1) {

        //         $etiqueta = 'Recurrente';

        //     }else if($u[0]->pago->count() >= 1 && isset($u[0]->pago[1]->count()) < 1){

        //         $etiqueta = 'Alta';

        //     }
        // }else if ($u[0]->pago[0]->periodoGracia < \Carbon\Carbon::now()->format('Y-m-d')) {
        //     if ($u[0]->pago->count() > 1 && $u[0]->pago[1]->count() == 0) {

        //         $etiqueta = 'Vencido Recurrente';

        //     }else if ($u[0]->pago->count() < 1 && $u[0]->pago[1]->count() > 1) {
        //         $etiqueta = 'Vencido';
        //     }
        // }





        // return $etiqueta;


        foreach ($u as $u) {


            if (isset($u->pago[0]->status) == 'approved' && isset($u->pago[0]->periodoGracia) >= \Carbon\Carbon::now()) {
                $estadoPago = 'Vigente';
                $estadoPago = isset($u->pago[0]->status) ? $u->pago[0]->status : ' ';
                $fechaUltimoPago = isset($u->pago[0]->fechaPago) ? $u->pago[0]->fechaPago->format('d/m/Y') : '';
                $horaUltimoPago = isset($u->pago[0]->fechaPago) ? $u->pago[0]->fechaPago->format('H:s') : '';
                $fechaVencimiento = isset($u->pago[0]->fechaVencimiento) ?  $u->pago[0]->fechaVencimiento->format('d/m/Y') : '';

                if ($u->pago[0]->periodoGracia >= \Carbon\Carbon::now()->format('Y-m-d')) {
                    if ($u->pago->count() > 1) {
                        $etiqueta = 'Recurrente';
                    }else if($u->pago->count() == 1 ){
                        $etiqueta = 'Alta';
                    }
                }else if ($u->pago[0]->periodoGracia < \Carbon\Carbon::now()->format('Y-m-d')) {
                    if ($u->pago->count() > 1) {
                        $etiqueta = 'Vencido Recurrente';
                    }else if ($u->pago->count() == 1) {
                        $etiqueta = 'Vencido';
                    }
                }

            }else if(isset($u->pago[0]->status) == 'failure' && isset($u->pago[0]->periodoGracia) < \Carbon\Carbon::now() || isset($u->pago[0]->status) == 'failure'){
                $estadoPago = 'Vencido';
                $estadoPago = isset($u->pago[0]->status) ? $u->pago[0]->status : ' ';
                $fechaUltimoPago = isset($u->pago[0]->fechaPago) ? $u->pago[0]->fechaPago->format('d/m/Y') : '';
                $horaUltimoPago = isset($u->pago[0]->fechaPago) ? $u->pago[0]->fechaPago->format('H:s') : '';
                $fechaVencimiento = isset($u->pago[0]->fechaVencimiento) ?  $u->pago[0]->fechaVencimiento->format('d/m/Y') : '';

                if ($u->pago[0]->periodoGracia >= \Carbon\Carbon::now()->format('Y-m-d')) {
                    if ($u->pago[0]->count() > 1) {
                        $etiqueta = 'Recurrente';
                    }else if($u->pago[0]->count() == 1 ){
                        $etiqueta = 'Alta';
                    }
                }else if ($u->pago[0]->periodoGracia < \Carbon\Carbon::now()->format('Y-m-d')) {
                    if ($u->pago[0]->count() > 1) {
                        $etiqueta = 'Vencido Recurrente';
                    }else if ($u->pago[0]->count() == 1) {
                        $etiqueta = 'Vencido';
                    }
                }


            }else{
                $estadoPago = 'Pendeinte';
                $estadoPago = isset($u->pago[0]->status) ? $u->pago[0]->status : ' ';
                $fechaUltimoPago = isset($u->pago[0]->fechaPago) ? $u->pago[0]->fechaPago->format('d/m/Y') : '';
                $horaUltimoPago = isset($u->pago[0]->fechaPago) ? $u->pago[0]->fechaPago->format('H:s') : '';
                $fechaVencimiento = isset($u->pago[0]->fechaVencimiento) ?  $u->pago[0]->fechaVencimiento->format('d/m/Y') : '';

                $etiqueta = '';
            }
            $data[] = [

                'id' => $u->id,
                'nombre' => $u->name,
                'paterno' => $u->middleName,
                'materno' => $u->lastName,
                'email' => $u->email,
                'phone' => $u->phone,
                'birthday' => $u->birthday,
                'CURP' => $u->CURP,
                'NSS' => $u->NSS,
                'RFC' => $u->RFC,
                'estadoPago' => $estadoPago,
                'estadoSuscripcion' => $estadoPago,
                'fechaUltimoPago' => $fechaUltimoPago,
                'horaUltimoPago' => $horaUltimoPago,
                'fechaVencimiento' => $fechaVencimiento,
                'filtro' => $etiqueta,


            ];
        }




        // foreach ($pagos as $p) {
        //     $data[] = [
        //         'id' => $p->id,
        //         'nombre' => $p->user->name.' '.$p->user->middleName.' '.$p->user->lastName,
        //         'email' => $p->user->email,
        //         'phone' => $p->user->phone,
        //         'birthday' => $p->user->birthday,
        //         'CURP' => $p->user->CURP,
        //         'NSS' => $p->user->NSS,
        //         'RFC' => $p->user->RFC,
        //         'fechaVencimiento' => $p->fechaVencimiento
        //     ];
        // }

        if (empty($data)) {
            return redirect()->back()->with("emptyData", "No hay datos para exportar.");
        }else{
            $export = new App\Exports\PagosExport($data);

            return Excel::download($export, 'Lista-de-suscripciones.xlsx');
        }



    })->name('listaVigentes');

    Route::get('/lista-de-pagos', function () {
        /*
            Nombre
            Email
            N° Imss
            Fecha de pago
            Hora de pago
            Tipo de pago
            Monto
            Estatus del pago
            ID del pago
        */

        $pagos = App\Models\Pago::with('user')->get();

        foreach ($pagos as  $p) {

            if ($p->status == 'approved') {
                $estadoPago = 'Aprobado';
                $fechaPago = isset($p->fechaPago) ? $p->fechaPago->format('d/m/Y') : '';
                $horaPago = isset($p->fechaPago) ? $p->fechaPago->format('H:s') : '';
            }else if($p->status == 'failure'){
                $estadoPago = 'Vencido';
                $fechaPago = isset($p->fechaPago) ? $p->fechaPago->format('d/m/Y') : '';
                $horaPago = isset($p->fechaPago) ? $p->fechaPago->format('H:s') : '';
            }else{
                $estadoPago = 'Pendeinte';
                $fechaPago = isset($p->fechaPago) ? $p->fechaPago->format('d/m/Y') : '';
                $horaPago = isset($p->fechaPago) ? $p->fechaPago->format('H:s') : '';
            }
            $data[] = [
                'Nombre' => $p->user->name,
                'Paterno' => $p->user->middleName,
                'Materno' => $p->user->lastName,
                'Email' => $p->user->email,
                'NImss' => $p->user->NSS,
                'FechaDePago' => $fechaPago,
                'HoraDePago' => $horaPago,
                'TipoDePago' => $p->payment_type,
                'Monto' => $p->costoPago,
                'EstatusDelPago' => $estadoPago,
                'IDDelPago' => $p->payment_id,

            ];
        }


        if (empty($data)) {
            return redirect()->back()->with("emptyData", "No hay datos para exportar.");
        }else{
            $export = new App\Exports\PagosDescargaExport($data);

            return Excel::download($export, 'Lista-de-pagos.xlsx');
        }


    })->name('listaDePagos');

});
