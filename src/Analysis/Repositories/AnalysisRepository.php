<?php
declare(strict_types=1);

namespace Acme\Analysis\Repositories;

use Acme\Analysis\Entity\AnalysisCollection;
use Acme\Analysis\Specification\ActiveAnalysisSpecification;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

/**
 * Class AnalysisRepository
 */
final class AnalysisRepository
{
    /**
     * @param CriteriaBuilderInterface|ActiveAnalysisSpecification $criteriaBuilder
     *
     * @return array
     */
    public function queryAll(CriteriaBuilderInterface $criteriaBuilder): array
    {
        $entity = [];
        $criteria = $criteriaBuilder->build();
        $collection = (new AnalysisCollection($criteria->all()))->toArray();
        foreach ($collection as $entry) {
            if ($criteriaBuilder->isSatisfiedBy($entry)) {
                $entity[] = $entry;
            }
        }

        return $entity;
    }
}
