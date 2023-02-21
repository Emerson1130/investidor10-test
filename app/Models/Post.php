<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\DomainModel;
use App\Models\User;

class Post extends Model implements DomainModel
{
    use SoftDeletes,
        HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];
    protected $hidden = [
        'deleted_at'
    ];

    public function getUserId()
    {
        return $this->getAttribute('user_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function belongsToUser(int $userId)
    {
        return ($this->getUserId() == $userId);
    }
}
