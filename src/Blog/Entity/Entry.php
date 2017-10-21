<?php
declare(strict_types=1);

namespace Acme\Blog\Entity;

use ValueObjects\Identity\UUID;
use PHPMentors\DomainKata\Entity\EntityInterface;

/**
 * Class Entry
 */
final class Entry implements EntityInterface
{
    /** @var UUID */
    private $uuid;

    /** @var string */
    private $note;

    /**
     * Entry constructor.
     *
     * @param UUID   $uuid
     * @param string $note
     */
    public function __construct(UUID $uuid, string $note)
    {
        $this->uuid = $uuid;
        $this->note = $note;
    }

    /**
     * @return UUID
     */
    public function getUuid(): UUID
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }
}
