<?php

namespace Deokonai\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at'
    ];

    public function post() {

        return $this->belongsTo(Post::class, 'post_id', 'id');

    }

    public function user() {

        return $this->belongsTo(User::class, 'user_uuid', 'uuid');

    } 
    
}
