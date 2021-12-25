<?php

namespace Deokonai\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model {

    use HasFactory;

    public $fillable = [
        'name',
        'value',
    ];

    public static function updateSettings($key, $value = null) {

        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            if ($value !== null) {
                self::updateOrCreate(['name' => $key], ['value' => $value]);
            } else {
                self::where('name', $key)->delete();
            }

            setting()->set($key, $value);
        }

        Cache::forget('settings');
        
    }

}
