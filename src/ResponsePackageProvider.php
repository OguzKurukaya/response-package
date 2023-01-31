<?php
namespace Oguz\ResponsePackage;
use Illuminate\Support\ServiceProvider;
use Oguz\ResponsePackage\Services\ErrorResponder;

class ResponsePackageProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
    public function register()
    {
        $this->app->bind('ErrorResponder', function () {
            return new ErrorResponder();
        });
    }

}
