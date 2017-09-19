<?php
declare(strict_types=1);

namespace App\Usecase;

use App\Repository\AnalysisRepository;

/**
 * Class UserAnalysisUsecase
 */
class UserAnalysisUsecase
{
    /** @var AnalysisRepository */
    protected $repository;

    /**
     * UserAnalysisUsecase constructor.
     *
     * @param AnalysisRepository $repository
     */
    public function __construct(AnalysisRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \App\Foundation\Presto\AnalysisMapper[]|array
     */
    public function run(): array
    {
        return $this->repository->findAll();
    }
}
