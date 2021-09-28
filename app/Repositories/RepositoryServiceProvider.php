<?php
namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public  function register()
    {
        //user repository bind
        $this->app->bind(
            'App\Repositories\UserInterface',
            'App\Repositories\UserRepository'
        );
    }

}
