<?php

namespace App\Domain\TicketType\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class StockAdded extends ShouldBeStored
{
    public function __construct(
        public $quantity,
        public $reason
    ) {}
}
