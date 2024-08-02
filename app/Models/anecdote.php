<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anecdote extends Model
{
    use HasFactory;

    protected $table = 'anecdotes';

    protected $fillable = ['nom', 'prenom', 'relation', 'ville', 'pays', 'anecdote','date'];
}
