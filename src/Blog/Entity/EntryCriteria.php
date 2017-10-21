<?php
declare(strict_types=1);

namespace Acme\Blog\Entity;

use PHPMentors\DomainKata\Entity\CriteriaInterface;

/**
 * Interface EntryCriteria
 */
interface EntryCriteria extends CriteriaInterface
{
    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param string $string
     *
     * @return mixed
     */
    public function queryBy(string $string);
}
