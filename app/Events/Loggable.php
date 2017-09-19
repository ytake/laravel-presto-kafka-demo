<?php
declare(strict_types=1);

namespace App\Events;

/**
 * Class Loggable
 */
final class Loggable
{
    /** @var string */
    private $uri;

    /** @var string[] */
    private $names = [
        'presto',
        'kafka',
    ];

    /**
     * Loggable constructor.
     *
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->names[array_rand($this->names)];
    }
}
