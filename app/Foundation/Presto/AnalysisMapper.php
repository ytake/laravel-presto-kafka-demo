<?php
declare(strict_types=1);

namespace App\Foundation\Presto;

/**
 * Class AnalysisMapper
 */
class AnalysisMapper
{
    /** @var string */
    private $_key;

    /** @var string */
    private $_value;

    /** @var int */
    private $test_id;

    /** @var string */
    private $test_name;

    /** @var string */
    private $created_at;

    /** @var string */
    private $uri;

    /** @var string */
    private $uuid;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->_key;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->_value;
    }

    /**
     * @return int
     */
    public function getTestId(): int
    {
        return $this->test_id;
    }

    /**
     * @return string
     */
    public function getTestName(): string
    {
        return $this->test_name;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
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
