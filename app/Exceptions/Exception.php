<?php 

namespace Deokonai\Exceptions;

class Exception extends \Exception {

    public function __construct($message = "", $code = 0, \Exception $previous = null) {

        // parent::__construct($message, $code, $previous);
        return view('errors.500', [
            'message' => $message,
            'code' => $code,
            'previous' => $previous
        ]);

    }

}