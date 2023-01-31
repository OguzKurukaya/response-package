<?php
namespace Oguz\ResponsePackage;
use Illuminate\Support\ServiceProvider;

class ResponsePackageProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

}
