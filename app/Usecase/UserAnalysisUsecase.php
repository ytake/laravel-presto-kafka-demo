<?php
declare(strict_types=1);

namespace App\Usecase;

use App\DataAccess\Analysis;

/**
 * Class UserAnalysisUsecase
 */
class UserAnalysisUsecase
{
    /** @var Analysis */
    protected $source;

    /**
     * UserAnalysisUsecase constructor.
     *
     * @param Analysis $source
     */
    public function __construct(Analysis $source)
    {
        $this->source = $source;
    }

    /**
     * @return \App\Foundation\Presto\AnalysisMapper[]\array
     */
    public function run(): array
    {
        return $this->source->findAll();
    }
}
