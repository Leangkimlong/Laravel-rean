<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\select;

Route::get('/', function () {
    // Use to show the welcome.blade.php file content
    // return view('welcome');

    // DB facades running sql quries

    // Select all user
    $users = DB::select("select * from users");

    // Select user by id
    // $users = FB::select("select * from users where id = 1");
    // $users = DB::select("select *from users where id = ?", [1]);

    // Select user by email
    // $users = DB::select("select * from users where email = 'kimlong@gmail.com'");
    // $users = DB::select("select * from users where email = ?", ['kimlong@gmail.com']);

    // Create new user 
    // $users = DB::insert("insert into users (id, name, email, password) values (?,?,?,?)", [1, 'Kimlong1','kimlong11@gmail.com', "123456789"]);

    // Update the user
    // $users = DB::update("update users set name = 'kimlong95' where email = ?", ['kimlong11@gmail.com']);
    // $users = DB::update("update users set email = ? where id = ?",
    // ['dara@gmail.com', 6]);

    // Delete user 
    // $users = DB::delete("delete from users where id = ?", [6]);

    // Show the sql quries
    dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
