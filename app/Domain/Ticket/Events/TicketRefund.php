<?php

namespace App\Domain\Ticket\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TicketRefund extends ShouldBeStored
{
    public function __construct() {}
}
