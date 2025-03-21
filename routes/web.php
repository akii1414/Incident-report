<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\IncidentController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/dashboard', function () {
//     return view('auth.login');
// });

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [IncidentController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

});

Route::get('/incident/download-pdf/{id}',[IncidentController::class,'downloadPDF'])->name('incident.downloadPDF');
Route::post('/incident/download-pdf/{id}', [IncidentController::class, 'downloadPDF'])->name('incident.downloadPDF');

Route::resource('dashboard',IncidentController::class);
Route::get('/audit', [AuditLogController::class, 'index'])->middleware('auth');


require __DIR__.'/auth.php';
