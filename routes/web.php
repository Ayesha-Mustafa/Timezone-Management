<?php
use App\Http\Controllers\RecordController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
// Add Authorization to the routes
Auth::routes();

// Home Page to show all the records
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//show records of that user
Route::get('/records', [RecordController::class, 'index'])->name('records.index');

// To show create record page
Route::get('/records/create', [RecordController::class, 'create'])->name('records.create');

//To save the record to the database
Route::post('/records', [RecordController::class, 'store'])->name('records.store');

//To change the timezone according to the user timezone
Route::post('/user/timezone', function (Request $request) {
    $user = Auth::user();
    $user->timezone = $request->timezone;
    $user->save();
    return response()->json(['message' => 'Timezone updated']);
});
