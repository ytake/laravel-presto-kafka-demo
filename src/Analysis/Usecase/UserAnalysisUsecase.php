<?php
declare(strict_types=1);

namespace Acme\Analysis\Usecase;

use Acme\Analysis\Repositories\AnalysisRepository;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Usecase\QueryUsecaseInterface;

/**
 * Class UserAnalysisUsecase
 */
class UserAnalysisUsecase implements QueryUsecaseInterface
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
     * @param EntityInterface $entity
     *
     * @return array
     */
    public function run(EntityInterface $entity): array
    {
        return $this->repository->queryAll($entity);
    }
}
