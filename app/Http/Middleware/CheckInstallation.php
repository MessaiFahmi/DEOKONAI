<?php

namespace Deokonai\Http\Middleware;

use Closure;
use Deokonai\Http\Controllers\InstallController;
use Illuminate\Http\Request;

class CheckInstallation {

    public function handle(Request $request, Closure $next) {

        return $next($request);

        if (config('app.key') !== InstallController::TEMP_KEY || ! $this->hasRequirements) {
            return redirect()->home();
        }

        return $next($request);

    }
}
