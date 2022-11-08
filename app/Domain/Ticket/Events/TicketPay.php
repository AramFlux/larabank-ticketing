<?php

namespace App\Domain\Ticket\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class TicketPay extends ShouldBeStored
{
    public function __construct() {}
}
