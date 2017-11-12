<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Repository\IVoucherRepository;
use \App\Repository\IOfferRepository;
use \App\Repository\IRecipientRepository;
use \App\Repository\VoucherRepository;
use \App\Repository\OfferRepository;
use \App\Repository\RecipientRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        
        $this->app->bind('App\Repository\IVoucherRepository', 'App\Repository\VoucherRepository');
        $this->app->bind('App\Repository\IOfferRepository', 'App\Repository\OfferRepository');
        $this->app->bind('App\Repository\IRecipientRepository', 'App\Repository\RecipientRepository');
        $this->app->bind('App\IVoucherService', 'App\VoucherService');
        
    }
}
