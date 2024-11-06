<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
})->name('/');;

Auth::routes();
Route::middleware(['2fa'])->group(function () {
   
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/2fa', function () {
        return redirect(route('home'));
    })->name('2fa');
});


Route::get('/client/dashboard', [App\Http\Controllers\ClientController::class, 'DashboardClient'])->middleware('auth','is_active');

Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->middleware('auth','admin');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'Statistique'])->name('admin.dashboard')->middleware('auth','admin');

Route::get('/admin/profile', [App\Http\Controllers\AdminController::class, 'profile'])->middleware('auth','admin');
Route::post('/admin/profile/update', [App\Http\Controllers\AdminController::class, 'MajProfile'])->middleware('auth','admin');


Route::get('/admin/bbes', [App\Http\Controllers\BbeController::class, 'AfficherBbes'])->middleware('auth','admin');
Route::post('/admin/bbes/store', [App\Http\Controllers\BbeController::class, 'AjouterBbes'])->middleware('auth','admin');
Route::get('/admin/bbes/{id}/delete', [App\Http\Controllers\BbeController::class, 'SupprimerBbes'])->middleware('auth','admin');
Route::post('/admin/bbes/update', [App\Http\Controllers\BbeController::class, 'MajBbes'])->middleware('auth','admin');


//route de SICAV
Route::get('/admin/sicav', [App\Http\Controllers\SicavController::class, 'AfficherSicav'])->middleware('auth','admin');
Route::post('/admin/sicav/store', [App\Http\Controllers\SicavController::class, 'AjouterSicav'])->middleware('auth','admin');
Route::get('/admin/sicav/{id}/delete', [App\Http\Controllers\SicavController::class, 'SupprimerSicav'])->middleware('auth','admin');
Route::post('/admin/sicav/update', [App\Http\Controllers\SicavController::class, 'MajSicav'])->middleware('auth','admin');


//route de Compte
Route::get('/client/compte', [App\Http\Controllers\CompteController::class, 'AfficherCompte'])->middleware('auth','is_active');
Route::post('/client/compte/store', [App\Http\Controllers\CompteController::class, 'AjouterCompte'])->middleware('auth','is_active');
Route::get('/admin/compte/approve/{id}',[App\Http\Controllers\AdminController::class, 'ApproverCompte'])->name('admin.approver_compte')->middleware('auth','admin');
Route::get('/admin/comptes',[App\Http\Controllers\AdminController::class, 'AfficherCompte'])->name('admin.compte.index')->middleware('auth','admin');




//route de gérer le client
Route::get('/admin/client', [App\Http\Controllers\AdminController::class, 'AfficherClient'])->middleware('auth','admin');
Route::post('/admin/client/store', [App\Http\Controllers\AdminController::class, 'AjouterClient'])->middleware('auth','admin');
Route::get('/admin/client/{id}/delete', [App\Http\Controllers\AdminController::class, 'SupprimerClient'])->middleware('auth','admin');
Route::post('/admin/client/update', [App\Http\Controllers\AdminController::class, 'MajClient'])->middleware('auth','admin');
Route::get('/admin/client/{id}/bloquer', [App\Http\Controllers\AdminController::class, 'BloquerClient'])->middleware('auth','admin');
Route::get('/admin/client/{id}/activer', [App\Http\Controllers\AdminController::class, 'ActiverClient'])->middleware('auth','admin');
Route::get('/client/bloquer', [App\Http\Controllers\ClientController::class, 'afficherMessageBlocker'])->middleware('auth');
Route::post('/admin/client', [App\Http\Controllers\AdminController::class, 'ChercherUser'])->middleware('auth','admin');




Route::get('/client/simulation', [SimulationController::class, 'AfficherSimulation'])->name('simulation')->middleware('auth','is_active');
Route::post('/simulate', [SimulationController::class, 'Simulation'])->name('simulate')->middleware('auth','is_active');






Route::get('/client/transfer', [App\Http\Controllers\TransferController::class, 'AfficherTransfer'])->middleware('auth','is_active');
Route::post('/client/transfer', [App\Http\Controllers\TransferController::class, 'Transfer'])->middleware('auth','is_active');
Route::get('/client/transactions', [App\Http\Controllers\TransferController::class, 'AfficherTransactions'])->name('transactions')->middleware('auth','is_active');


Route::get('/demande-credit', [App\Http\Controllers\CreditController::class, 'AfficherDemandeCredit'])->name('demandeCredit')->middleware('auth','is_active');
Route::post('/demande-credit', [App\Http\Controllers\CreditController::class, 'AjouterDemandeCredit'])->name('storeCredit')->middleware('auth','is_active');
Route::get('/espace-demande-credit', [App\Http\Controllers\CreditController::class, 'AfficherEspaceCredit'])->name('showRequests')->middleware('auth','is_active');

Route::get('/admin/credit', [App\Http\Controllers\AdminController::class, 'AfficherCreditAdmin'])->name('admin.index1')->middleware('auth','admin');
Route::put('/admin/approve/{creditDemande}', [App\Http\Controllers\AdminController::class, 'ApproverCredit'])->name('admin.approve')->middleware('auth','admin');
Route::get('/admin/chercherStatus', [App\Http\Controllers\AdminController::class, 'ChercherStatus'])->name('admin.chercherStatus')->middleware('auth','admin');




Route::get('/admin/transactions', [App\Http\Controllers\AdminController::class, 'AfficherTransactions'])->name('admin.transactions')->middleware('auth','admin');
Route::get('/admin/chercher_transactions', [App\Http\Controllers\AdminController::class,'ChercherTransactions'])->name('chercher_transactions');


Route::get('/client/sicav', [App\Http\Controllers\SicavController::class, 'AfficageClientSicav'])->middleware('auth','is_active');
Route::get('/client/bbe', [App\Http\Controllers\BbeController::class, 'AfficageClientBbes'])->middleware('auth','is_active');

Route::post('/user/deposer', [App\Http\Controllers\CompteController::class, 'deposer'])->name('client.deposer')->middleware('auth','is_active');
Route::post('/user/retirer', [App\Http\Controllers\CompteController::class, 'retirer'])->name('client.retirer')->middleware('auth','is_active');
Route::get('/client/balance', function () {
    return view('client.balance');
})->name('client.balance')->middleware('auth','is_active');



Route::get('/operations/{compte_id}/operations', [App\Http\Controllers\CompteController::class, 'MouvementCompte'])->name('compte.operations')->middleware('auth','is_active');
Route::get('/complete-registration', [RegisterController::class, 'completeRegistration'])->name('complete.registration');





















