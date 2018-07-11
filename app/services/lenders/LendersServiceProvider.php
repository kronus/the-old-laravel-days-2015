<?php

/**
 * Created by PhpStorm.
 * User: kronus
 * Date: 7/16/15
 * Time: 14:35 PM
 */

namespace services\lenders;

use Illuminate\Support\ServiceProvider;

class LendersServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->app->bind(
            'repositories\LendersInterface','repositories\LendersRepository'
        );
    }
}