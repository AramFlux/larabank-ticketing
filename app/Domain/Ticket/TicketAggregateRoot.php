<?php

namespace App\Domain\Ticket;

use App\Domain\Ticket\Events\TicketRefund;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use App\Domain\Ticket\Events\TicketCreated;
use App\Domain\Ticket\Events\TicketPay;

class TicketAggregateRoot extends AggregateRoot
{

    public function createTicket(int $ticketTypeId, string $hash, string $status)
    {
        $this->recordThat(new TicketCreated($ticketTypeId, $hash, $status));

        return $this;
    }

    public function payTicket()
    {
        $this->recordThat(new TicketPay());

        return $this;
    }

    public function refundTicket()
    {
        $this->recordThat(new TicketRefund());

        return $this;
    }

}
