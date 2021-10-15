<?php
namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public  function register()
    {
        $models = [
            'User',
            'Package'
        ];

        foreach ($models as $model) {
            $this->app->bind("App\Repositories\\{$model}\\{$model}Interface", "App\Repositories\\{$model}\\{$model}Repository");
        }
    }

}
