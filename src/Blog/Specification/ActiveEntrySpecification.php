<?php
declare(strict_types=1);

namespace Acme\Blog\Specification;

use Acme\Blog\Entity\Entry;
use Acme\Blog\Entity\EntryCriteria;
use PHPMentors\DomainKata\Entity\CriteriaInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;
use PHPMentors\DomainKata\Specification\SpecificationInterface;

/**
 * Class ActiveEntrySpecification
 */
class ActiveEntrySpecification implements SpecificationInterface, CriteriaBuilderInterface
{
    /** @var EntryCriteria */
    protected $criteria;

    /**
     * @param EntityInterface|Entry $entity
     *
     * @return bool
     */
    public function isSatisfiedBy(EntityInterface $entity): bool
    {
        if (empty($entity->getNote())) {
            return false;
        }

        return true;
    }

    /**
     * @return CriteriaInterface|EntryCriteria
     */
    public function build(): CriteriaInterface
    {
        return $this->criteria;
    }

    /**
     * @param EntryCriteria $criteria
     */
    public function criteria(EntryCriteria $criteria)
    {
        $this->criteria = $criteria;
    }
}