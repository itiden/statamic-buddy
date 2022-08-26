<?php

namespace Itiden\StatamicBuddy;

use Statamic\Providers\AddonServiceProvider;
use Statamic\Facades\CP\Nav;

class ServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
    ];

    protected $scripts = [
        __DIR__.'/../dist/js/index.js',
    ];

    public function bootAddon()
    {
        Nav::extend(function ($nav) {
            $nav->create('Deploy')
                ->section('Tools')
                ->icon('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0.25 0.25 13.5 13.5" height="600" width="600" stroke-width="0.5"><g><circle cx="7" cy="7" r="6.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></circle><line x1="0.5" y1="7" x2="13.5" y2="7" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></line><path d="M9.5,7A11.22,11.22,0,0,1,7,13.5,11.22,11.22,0,0,1,4.5,7,11.22,11.22,0,0,1,7,.5,11.22,11.22,0,0,1,9.5,7Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>')
                ->route('buddy.log');
        });
    }
}
