<?php

namespace Deokonai\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property int $id
 * @property string $name
 * @property string $value
 */
class Setting extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value',
    ];

    /**
     * Set a given settings values.
     *
     * @param  array|string  $key
     * @param  mixed  $value
     * @return void
     */
    public static function updateSettings($name, $value = null)
    {
        $names = is_array($name) ? $name : [$name => $value];

        foreach ($names as $name => $value) {
            if ($value !== null) {
                self::updateOrCreate(['name' => $name], ['value' => $value]);
            } else {
                self::where('name', $name)->delete();
            }
            
        }

        Cache::forget('settings');
    }

    public static function get($name, $default = null){

        return self::where('name', $name)->first()->value ?? $default;

    }

    public static function has($name){

        return self::where('name', $name)->exists();

    }

    public function set($name, $value = null) {

        $names = is_array($name) ? $name : [$name => $value];

        foreach ($names as $name => $value) {
            Setting::updateOrCreate(['name' => $name], ['value' => $value]);
        }
    }
}
