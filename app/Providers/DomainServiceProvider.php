<?php
declare(strict_types=1);

namespace App\Providers;

use Acme\Analysis\Specification\ActiveAnalysisSpecification;
use Acme\Blog\Specification\ActiveEntrySpecification;
use App\DataAccess\FulltextIndex;
use App\DataAccess\LogIndex;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Class DomainServiceProvider
 */
final class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->extend(
            ActiveEntrySpecification::class,
            function (ActiveEntrySpecification $specification, Application $application) {
                $specification->criteria($application->make(FulltextIndex::class));

                return $specification;
            });
        $this->app->extend(
            ActiveAnalysisSpecification::class,
            function (ActiveAnalysisSpecification $specification, Application $application) {
                $specification->criteria($application->make(LogIndex::class));

                return $specification;
            });
    }
}
