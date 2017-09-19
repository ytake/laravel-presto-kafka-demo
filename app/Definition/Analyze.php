<?php
declare(strict_types=1);

namespace App\Definition;

use App\Foundation\Producer\AbstractProduceDefinition;

/**
 * Class Analyze
 */
final class Analyze extends AbstractProduceDefinition
{
    /** @var string */
    private $uuid;

    /** @var string */
    private $uri;

    /** @var string */
    private $name;

    /**
     * Analyze constructor.
     *
     * @param string $uuid
     * @param string $uri
     * @param string $name
     */
    public function __construct(string $uuid, string $uri, string $name)
    {
        $this->uuid = $uuid;
        $this->uri = $uri;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function payload(): string
    {
        return json_encode([
                'uuid' => $this->uuid,
                'uri'  => $this->uri,
                'name' => $this->name,
            ]
        );
    }
}
