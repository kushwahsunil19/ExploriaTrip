<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Cookie;
use App\Models\Countries;
use View;
use Request;

class HeaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Request $request): void
    {
      
       View::composer('*', function($view)
        {
            $country = Countries::get();
            $locationIP = Request::ip();      
            $currentUserInfo = Location::get($locationIP);
            $currentCountryCode = $currentUserInfo->countryCode;
            $CurrentCurrency = $currentUserInfo->countryCode;
            $CurrentCountry = $currentUserInfo->countryName;
            $cookie = Cookie::get();
             if (array_key_exists("CurrentCountry",$cookie)) {
              $view->with([
                            'country' => $country, 
                            'CurrentCountry' => $CurrentCountry,
                            'currentCountryCode' => $currentCountryCode,
                            'CurrentCurrency' => $CurrentCurrency                          
                           
                       ]);
            } else {

              setcookie("CurrentCurrency", $currentUserInfo->countryCode, time() + 3600);
              setcookie("CurrentCountry", $currentUserInfo->countryName, time() + 3600);
             $view->with([
                            'country' => $country, 
                            'CurrentCountry' => $CurrentCountry,
                            'currentCountryCode' => $currentCountryCode,
                            'CurrentCurrency' => $CurrentCurrency                          
                           
                       ]);
                   }
           
        });
    }
}
