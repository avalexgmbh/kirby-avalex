<?php

/**
 * Class AvalexCache
 *
 * @package Avalex\Avalex
 */

namespace Avalex\Avalex;

use Kirby\Cache\FileCache;
use Kirby\Cache\Value;

class AvalexCache extends FileCache {
    /**
     * Returns the cached value (or $default if empty) but do NOT remove it if expired!
     *
     * @param string $key
     * @param mixed $default
     * @return mixed|null
     */
    public function get(string $key, $default = null) {
        // get the Value
        $value = $this->retrieve($key);

        // check for a valid cache value
        if ($value instanceof Value === false) {
            return $default;
        }

        // return the pure value
        return $value->value();
    }
}
