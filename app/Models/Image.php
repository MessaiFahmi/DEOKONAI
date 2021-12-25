<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    use HasFactory;

    public $fillable = [
        'name', 'file', 'type',
    ];

    public function getSlug() {

        return pathinfo($this->file, PATHINFO_FILENAME);
        
    }

    public function getExtension() {

        return pathinfo($this->file, PATHINFO_EXTENSION);
        
    }

    public function url() {

        return image_url($this->file);
        
    }
    
}
