<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Foundation\Elasticsearch\ElasticseachClient;

/**
 * Class ElasticsearchServiceProvider
 */
final class ElasticsearchServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ElasticseachClient::class, function (Application $app) {
            $config = $app['config']->get('elasticsearch');
            return new ElasticseachClient($config['hosts']);
        });
    }
}
