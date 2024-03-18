<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/',function(){
    // How to fetch data 
    // how to fetch data by using emil
    // $user = DB::select("select * from users where email = ?",["mizterlong95@gmail.com"]);// how to fetch data by using emil
    // how to fetch data from users table using id
    // $user = DB::select("select * from users where id = 1");
    // fetch all users
    $user = DB::select("select * from users");

    // How to insert data into table
    // $user = DB::insert("insert into users (name, email, password) value (?,?,?)", ['Lay', 'mizterlay00@gmail.com', '12345678']);

    // How to update data
    // How to update the existing data using name
    // $user = DB::update(
    //     "update users set email = 'mizterlong00@gmail.com' where name = ?",
    //     ['Long']
    // );
    // $user = DB::update(
    //     "update users set email = ? where name = ?",
    //     ['mizterlong01@gmail.com', 'Long00']
    // );
    // How to update existing data using id
    // $user = DB::update(
    //     "update users set name = 'Long00' where id = 1"
    // );

    // How to delete data from table
    // $user = DB::delete("delete from users where id = ?",[1]);
    // $user = DB::delete("delete from users where id = 2");

    // display the data in user table in array formation
    dd($user);
});

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/home', function() {
    return view('home');
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
