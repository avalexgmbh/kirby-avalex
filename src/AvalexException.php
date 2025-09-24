<?php

/**
 * Class AvalexException
 *
 * @package Avalex\Avalex
 */

namespace Avalex\Avalex;

class AvalexException extends \Exception {
    /**
     * AvalexException constructor
     *
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = "", int $code = 0) {
        $message = 'AVALEX: ' . $message;

        parent::__construct($message, $code);
    }
}
