<?php

namespace App\Domain\Event\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class EventCreated extends ShouldBeStored
{
    public function __construct(
        public string $name,
        public int $userId,
    ) {}
}
