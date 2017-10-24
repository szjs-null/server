<?php

namespace App\Providers;

use Aliyun\Core\Config;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Core\Profile\DefaultProfile;
use Illuminate\Support\ServiceProvider;

class AlidayuSMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Config::load();
        $this->app->singleton('Aliyun\Core\DefaultAcsClient', function ($app) {
            $region = "cn-hangzhou";
            $product = "Dysmsapi";
            $domain = "dysmsapi.aliyuncs.com";

            $profile = DefaultProfile::getProfile(
                $region,
                env('ALISMS_KEY'),
                env('ALISMS_SECRETKEY')
            );
            DefaultProfile::addEndpoint(
                $region,
                $region,
                $product,
                $domain
            );
            return new DefaultAcsClient($profile);
        });
    }
}
