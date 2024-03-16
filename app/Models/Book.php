<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Allow to interact with Book table (CRUD)
class Book extends Model
{
    // Use my_books table instead of Book table 
    protected $table = 'my_books';
}

?>