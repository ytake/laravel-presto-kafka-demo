<?php
declare(strict_types=1);

namespace Acme\Blog\Usecase;

use Acme\Blog\Repositories\EntryRepository;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Usecase\QueryUsecaseInterface;

/**
 * Class RetrieveEntryUsecase
 */
class RetrieveEntryUsecase implements QueryUsecaseInterface
{
    /** @var EntryRepository */
    protected $repository;

    /**
     * RetrieveEntryUsecase constructor.
     *
     * @param EntryRepository $repository
     */
    public function __construct(EntryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param EntityInterface $entity
     *
     * @return \Acme\Blog\Entity\Entry[]|array
     */
    public function run(EntityInterface $entity)
    {
        return $this->repository->queryAll($entity);
    }
}
