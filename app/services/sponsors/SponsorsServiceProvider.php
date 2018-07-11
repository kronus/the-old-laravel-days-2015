<?php

/**
 * Created by PhpStorm.
 * User: kronus
 * Date: 7/16/15
 * Time: 14:35 PM
 */

namespace services\sponsors;

use Illuminate\Support\ServiceProvider;

class SponsorsServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->app->bind(
            'repositories\SponsorsInterface','repositories\SponsorsRepository'
        );
    }
}