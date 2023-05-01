<?php
namespace App\Exceptions;

use Exception;

class DIDNumberAllocatedException extends Exception {
    function __construct( $did_number, $msg ) {
        $this->did_number = $did_number;
        parent::__construct( $msg );
    }
    public function getDIDNumber() {
        return $this->did_number;

    }
}

