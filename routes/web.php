<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile\AvatarController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use OpenAI\Laravel\Facades\OpenAI;

use function Laravel\Prompts\select;

Route::get('/', function () {
    // Use to show the welcome.blade.php file content
    return view('welcome');

    // DB facades running sql quries

    // Select all user
    // $users = DB::select("select * from users");

    // Select user by id
    // $users = FB::select("select * from users where id = 1");
    // $users = DB::select("select *from users where id = ?", [1]);

    // Select user by email
    // $users = DB::select("select * from users where email = 'kimlong@gmail.com'");
    // $users = DB::select("select * from users where email = ?", ['kimlong@gmail.com']);

    // Create new user 
    // $users = DB::insert("insert into users (id, name, email, password) values (?,?,?,?)", [
    //     1, 
    //     'Kimlong1',
    //     'kimlong1@gmail.com', 
    //     "12345678"
    // ]);

    // Update the user
    // $users = DB::update("update users set name = 'kimlong95' where email = ?", ['kimlong11@gmail.com']);
    // $users = DB::update("update users set email = ? where id = ?",
    // ['dara@gmail.com', 6]);
    // $users = DB::update("update users set password = ? where id = ?", [bcrypt('12345678'), 1]);

    // Delete user 
    // $users = DB::delete("delete from users where id = ?", [6]);

    // Select all user  using builder query 
    // will show a collection of array abit different from all array
    // $users = DB::table('users')->get();

    // Select specific users using query builder
    // $users = DB::table('users')->where('id',4)->get();
    // $users = DB::table('users')->find(1);

    // Select first user from the table
    // $users = DB::table('users')->first();

    // Insert new user using query builder
    // $users = DB::table('users')->insert([
    //     'id' => 2,
    //     'name' => 'Kimlong2',
    //     'email' => 'kimlong2@gmail.com',
    //     'password' => "12345678"
    // ]);

    // Update the user using quert builder
    // $users = DB::table('users')->where('id',2)->update(['email' => 'kimlay@gmail.com']);

    // Delete a user using query builder
    // $users = DB::table('users')->where('id',4)->delete();

    // Show all data using eloquent 
    // $users = User::get();

    // Show specific data using eloquent (ORM)
    // $users = User::where('id',1)->first();

    // Create using eloquent 
    // $users = User::create([
    //     'name' => 'KimLong4',
    //     'email' => 'mizterlong4@gmail.com',
    //     'password' => bcrypt('12345678')
    // ]);

    // Update user using eloquent
    // $users = User::find(9);
    // $users->update([
    //     'name' => 'long',
    //     'email' => 'long@gmail.com'
    // ]);
    // $users = User::find(2);
    // $users->update([
    //     'password' => bcrypt('12345678')
    // ]);
    
    // Delete using eloquent
    // $users = User::find(9);
    // $users->delete();

    // Die Dump for dd
    // Show the sql quries
    // dd($users);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/openai',function() {
    $result = OpenAI::chat()->create([
        'model' => 'gpt-3.5-turbo',
        'messages' => [
            ['role' => 'user', 'content' => 'Hello!'],
        ],
    ]);
    
    echo $result->choices[0]->message->content; // Hello! How can I assist you today?
    
});

Route::get('/auth/redirect',function() {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
 
    // $user->token
});
