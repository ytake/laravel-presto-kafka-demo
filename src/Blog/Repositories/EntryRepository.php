<?php
declare(strict_types=1);

namespace Acme\Blog\Repositories;

use Acme\Blog\Entity\Entry;
use Acme\Blog\Entity\EntryCollection;
use Acme\Blog\Specification\ActiveEntrySpecification;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

/**
 * Class EntryRepository
 */
class EntryRepository
{
    /**
     * @param CriteriaBuilderInterface|ActiveEntrySpecification $criteriaBuilder
     *
     * @return Entry[]
     */
    public function queryAll(CriteriaBuilderInterface $criteriaBuilder): array
    {
        $entity = [];
        $criteria = $criteriaBuilder->build();
        $collection = (new EntryCollection($criteria->all()))->toArray();
        foreach ($collection as $entry) {
            if ($criteriaBuilder->isSatisfiedBy($entry)) {
                $entity[] = $entry;
            }
        }

        return $entity;
    }
}
