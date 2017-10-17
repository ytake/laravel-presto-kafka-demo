<?php
declare(strict_types=1);

namespace App\Definition;

use App\Foundation\Producer\AbstractProduceDefinition;

/**
 * Class FulltextDefinition
 */
final class FulltextDefinition extends AbstractProduceDefinition
{
    /** @var string */
    private $uuid;

    /** @var string */
    private $text;

    /**
     * AnalysisDefinition constructor.
     *
     * @param string $uuid
     * @param string $text
     */
    public function __construct(string $uuid, string $text)
    {
        $this->uuid = $uuid;
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function payload(): string
    {
        return json_encode([
                'uuid' => $this->uuid,
                'text' => $this->text,
            ]
        );
    }
}
