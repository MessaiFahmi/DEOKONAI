<?php

namespace Deokonai;

class Deokonai {

    /**
     * Get the current version of Deokonai CMS.
     *
     * @return string
     */
    public static function version() {

        return config('deokonai.update.version');

    }
}
