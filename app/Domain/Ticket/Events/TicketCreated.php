<?php

namespace App\Domain\Ticket\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TicketCreated extends ShouldBeStored
{
    public function __construct(
        public int $ticketTypeId,
        public string $hash,
        public string $status,
    ) {}
}
