<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @param Router $router
     */
    public function map(Router $router)
    {
        //
        $router->group(['middleware' => 'web'], function (Router $router) {
            $router->get('/', [
                'uses' => 'App\Http\Controllers\IndexAction',
                'as'   => 'index',
            ]);
            $router->get('/analysis', [
                'uses' => 'App\Http\Controllers\AnalyzeAction',
                'as'   => 'analysis',
            ]);
            $router->get('/fulltext/form', [
                'uses' => 'App\Http\Controllers\Fulltext\FormAction',
                'as'    => 'fulltext.form',
            ]);
            $router->post('/fulltext/register', [
                'uses' => 'App\Http\Controllers\Fulltext\RegisterAction',
                'as'    => 'fulltext.register',
            ]);
        });
    }
}
