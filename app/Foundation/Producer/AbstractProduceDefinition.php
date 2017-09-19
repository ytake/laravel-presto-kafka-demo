<?php
declare(strict_types=1);

namespace App\Foundation\Producer;

/**
 * Class AbstractProduceDefinition
 */
abstract class AbstractProduceDefinition
{
    /**
     * @return string
     */
    abstract public function payload(): string;
}
