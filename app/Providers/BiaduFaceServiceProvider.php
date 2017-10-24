<?php

namespace App\Providers;

use ApiFace\AipFace;
use Illuminate\Support\ServiceProvider;

class BiaduFaceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->instance('ApiFace\AipFace', function () {
            return new AipFace(
                env('BAIDU_FACE_APPID'),
                env('BAIDU_FACE_KEY'),
                env('BAIDU_FACE_SECRETKEY')
            );
        });
    }
}
