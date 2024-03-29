<?php

namespace Deokonai\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at'
    ];

    public $fillable = [
        'title',
        'body',
        'slug',
        'user_uuid',
        'category_id',
    ]; 

    public function comments() {

        return $this->hasMany(Comment::class, 'post_id', 'id');

    }

    public function user() {

        return $this->belongsTo(User::class, 'user_uuid', 'uuid');

    }
    
}
