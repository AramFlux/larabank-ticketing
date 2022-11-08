<?php

namespace App\Domain\TicketType\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TicketTypeUpdated extends ShouldBeStored
{
    public function __construct(
        public string $name,
        public int $stock,
    ) {}
}
