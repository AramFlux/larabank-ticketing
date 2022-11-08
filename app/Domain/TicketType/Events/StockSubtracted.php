<?php

namespace App\Domain\TicketType\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class StockSubtracted extends ShouldBeStored
{
    public function __construct(
        public $quantity,
        public $reason
    ) {}
}
