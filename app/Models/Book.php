<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Contracts\DomainModel;

class Book extends Model implements DomainModel
{

    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'isbn',
        'value',
        'user_id'
    ];
    
    protected $cast = [
        'isbn' => 'integer',
        'value' => 'decimal'
    ];

}
