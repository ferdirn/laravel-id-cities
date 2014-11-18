<?php

namespace Ferdirn\Cities;

use Illuminate\Support\Facades\Facade;

/**
 * Cities Facade
 *
 */
class CitiesFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'cities'; }

}