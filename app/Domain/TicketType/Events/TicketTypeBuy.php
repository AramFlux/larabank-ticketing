<?php

namespace App\Domain\TicketType\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TicketTypeBuy extends ShouldBeStored
{
    public function __construct() {}
}
