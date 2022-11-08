<?php

namespace App\Domain\TicketType\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TicketTypeCreated extends ShouldBeStored
{
    public function __construct(
        public string $name,
        public int $eventId,
        public int $stock,
    ) {}
}
