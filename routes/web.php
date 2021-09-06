<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;






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







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::post('/process_payment', [App\Http\Controllers\PaymentController::class, 'ProcessPayment'])->name('processPayment');




Route::prefix('/sistema')->middleware(['auth'])->group(function () {



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
        return view('layouts.perfil', compact('t'));
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


        return view('layouts.pagos', compact('preference'));
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

        Mail::to($request->get('email'))->send(new App\Mail\RegisterEmail($details));

        //dd("Correo enviado");

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

        $u = App\Models\User::all();
        return view('layouts.altausurio', compact('u'));
    })->name('altaUsuarioSistema');








    //Metodos POST
    Route::post('/completar-datos/save', [UserController::class, 'completarDatos'])->name('completarInfo');
    Route::post('/actualizar-datos/save', [UserController::class, 'actualizarDatos'])->name('actualizarInfo');
    Route::post('/soporte/guardar', function (Request $request) {


        $n = new App\Models\Tiket();
        $n->user_id = Auth::user()->id;
        $n->asunto = $request->get('asunto');
        $n->mensaje = $request->get('mensaje');
        $n->save();

        return redirect()->back()->with('success', '');


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

        $details = [
            'nombre' => $request->get('name'),
            'password' => $password
        ];

        Mail::to($request->get('email'))->send(new App\Mail\RegisterEmail($details));

        //dd("Correo enviado");

        DB::select('CALL createStepsRoutine(?)', array($u->id));

        $u->assignRole($request->get('rol'));

        return redirect()->back()->with('success', '');
    })->name('saveusersistema');

    Route::get('/eliminar-usuario/{id}', function ($id) {
        $u = App\Models\User::find($id);
        $u->delete();
        return redirect()->back()->with('successDel');
    })->name('eliminarUsuario');

});
