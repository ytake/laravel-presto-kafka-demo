<?php
declare(strict_types=1);

namespace Acme\Analysis\Entity;

use PHPMentors\DomainKata\Entity\CriteriaInterface;

/**
 * Interface AnalysisCriteria
 */
interface AnalysisCriteria extends CriteriaInterface
{
    /**
     * @return array
     */
    public function all(): array;
}
