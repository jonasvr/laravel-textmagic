<?php

namespace js0nvr\Textmagic\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Onwwward\Textmagic\TextmagicServiceProvider
 */
class Textmagic extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'textmagic';
    }
}
