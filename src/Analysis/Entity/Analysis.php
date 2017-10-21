<?php
declare(strict_types=1);

namespace Acme\Analysis\Entity;

use PHPMentors\DomainKata\Entity\EntityInterface;

/**
 * Class Analysis
 */
final class Analysis implements EntityInterface
{
    /** @var string */
    private $key;

    /** @var string */
    private $value;

    /** @var int */
    private $testId;

    /** @var string */
    private $testName;

    /** @var string */
    private $createdAt;

    /** @var string */
    private $uri;

    /** @var string */
    private $uuid;

    /**
     * Analysis constructor.
     *
     * @param string $key
     * @param string $value
     * @param int    $testId
     * @param string $testName
     * @param string $uri
     * @param string $uuid
     * @param string $createdAt
     */
    public function __construct(
        string $key,
        string $value,
        int $testId,
        string $testName,
        string $uri,
        string $uuid,
        string $createdAt
    ) {
        $this->key = $key;
        $this->value = $value;
        $this->testId = $testId;
        $this->testName = $testName;
        $this->uri = $uri;
        $this->uuid = $uuid;
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getTestId(): int
    {
        return $this->testId;
    }

    /**
     * @return string
     */
    public function getTestName(): string
    {
        return $this->testName;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
