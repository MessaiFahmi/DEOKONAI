<?php

use Carbon\Carbon;
use Deokonai\Http\Controllers\InstallController;
use Deokonai\Models\Setting;
use Deokonai\Support\SettingsRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

if (! function_exists('add_active')) {
    function add_active(string ...$patterns)
    {
        return Route::currentRouteNamed(...$patterns) ? 'active' : '';
    }
}

if (! function_exists('color_contrast')) {
    function color_contrast(string $hex)
    {
        $r = hexdec(substr($hex, 1, 2));
        $g = hexdec(substr($hex, 3, 2));
        $b = hexdec(substr($hex, 5, 2));
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

        return ($yiq >= 128) ? 'black' : 'white';
    }
}


if (! function_exists('is_installed')) {
    function is_installed() {
        $key = config('app.key');
        return ! empty($key) && $key !== InstallController::TEMP_KEY && config('deokonai.is_deokonai_installed');
    }
}

/*
 * Translation related helpers
 */

if (! function_exists('format_date')) {
    function format_date(Carbon $date, bool $fullTime = false)
    {
        return $date->translatedFormat(trans('messages.date'.($fullTime ? '-full' : '')));
    }
}

if (! function_exists('format_date_compact')) {
    function format_date_compact(Carbon $date)
    {
        return $date->format(trans('messages.date-compact'));
    }
}

if (! function_exists('trans_bool')) {
    function trans_bool(bool $bool)
    {
        return trans('messages.'.($bool ? 'yes' : 'no'));
    }
}

/*
 * Settings/Config helpers
 */
if (! function_exists('setting')) {
    function setting(string $name = null, $default = null) {

        if($name === null) {
            return app(SettingsRepository::class);
        }

        return Setting::get($name, $default);

    }
}

if (! function_exists('favicon')) {
    function favicon()
    {
        $icon = setting('icon');

        return $icon !== null ? image_url($icon) : asset('img/deokonai.png');
    }
}

if (! function_exists('site_logo')) {
    function site_logo()
    {
        $logo = setting('logo');

        return $logo !== null ? image_url($logo) : asset('img/deokonai.png');
    }
}

if (! function_exists('site_name')) {
    function site_name()
    {
        return setting('name', config('app.name'));
    }
}

if (! function_exists('image_url')) {
    function image_url(string $name = '/')
    {
        return url(Storage::disk('public')->url('img/'.$name));
    }
}

if (! function_exists('dark_theme')) {
    function dark_theme()
    {
        return request()->cookie('theme') === 'dark';
    }
}
