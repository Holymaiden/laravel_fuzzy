<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $models = array(
            'Classes',
            'Evaluation',
            'Himpunan',
            'Role',
            'SchoolYear',
            'Student',
            'StudentEvaluation',
            'User',
            'Value',
        );

        foreach ($models as $model) {
            $this->app->bind("App\Repositories\Contracts\\{$model}Contract", "App\Repositories\\{$model}Repository");
        }
    }
}
