<?php
declare(strict_types=1);

namespace Acme\Blog\Entity;

use ValueObjects\Identity\UUID;

/**
 * Class EntryCollection
 */
final class EntryCollection
{
    /** @var array */
    protected $entries = [];

    /**
     * EntryCollection constructor.
     *
     * @param array $entries
     */
    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }

    /**
     * @return Entry[]
     */
    public function toArray(): array
    {
        $entities = [];
        foreach ($this->entries as $entry) {
            $entities[] = new Entry(new UUID($entry['uuid']), $entry['text']);
        }

        return $entities;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->entries);
    }
}
