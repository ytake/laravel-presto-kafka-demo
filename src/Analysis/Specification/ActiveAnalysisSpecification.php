<?php
declare(strict_types=1);

namespace Acme\Analysis\Specification;

use Acme\Analysis\Entity\Analysis;
use Acme\Analysis\Entity\AnalysisCriteria;
use PHPMentors\DomainKata\Entity\CriteriaInterface;
use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;
use PHPMentors\DomainKata\Specification\SpecificationInterface;

/**
 * Class ActiveAnalysisSpecification
 */
final class ActiveAnalysisSpecification implements SpecificationInterface, CriteriaBuilderInterface
{
    /** @var AnalysisCriteria */
    private $criteria;

    /**
     * @param AnalysisCriteria $criteria
     */
    public function criteria(AnalysisCriteria $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * @return CriteriaInterface|AnalysisCriteria
     */
    public function build(): CriteriaInterface
    {
        return $this->criteria;
    }

    /**
     * @param EntityInterface|Analysis $entity
     *
     * @return bool
     */
    public function isSatisfiedBy(EntityInterface $entity): bool
    {
        // todo
        return true;
    }
}
