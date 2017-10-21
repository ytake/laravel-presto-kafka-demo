<?php
declare(strict_types=1);

namespace App\Events;

/**
 * Class SinkConnect
 */
final class SinkConnect
{
    /** @var string */
    private $note;

    /**
     * SinkConnect constructor.
     *
     * @param string $note
     */
    public function __construct(string $note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function note(): string
    {
        return $this->note;
    }
}
