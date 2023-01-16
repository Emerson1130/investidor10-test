<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\DomainModel;

class Book extends Model implements DomainModel
{

    use SoftDeletes,
        HasFactory;

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
    protected $hidden = [
        'deleted_at'
    ];

    public function getUserId()
    {
        return $this->getAttribute('user_id');
    }

    public function belongsToUser(int $userId)
    {
        return ($this->getUserId() == $userId);
    }

}
