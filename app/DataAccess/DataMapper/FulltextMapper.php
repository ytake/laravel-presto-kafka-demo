<?php
declare(strict_types=1);

namespace App\DataAccess\DataMapper;

/**
 * Class FulltextMapper
 */
final class FulltextMapper
{
    /** @var string */
    private $text;

    /** @var string */
    private $uuid;

    /**
     * FulltextMapper constructor.
     *
     * @param string $text
     * @param string $uuid
     */
    public function __construct(string $text, string $uuid)
    {
        $this->text = $text;
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
