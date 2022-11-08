<?php

namespace App\Domain\Ticket\Projectors;

use App\Domain\Ticket\Events\TicketPay;
use App\Domain\Ticket\Events\TicketRefund;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use App\Domain\Ticket\Events\TicketCreated;
use App\Models\Ticket;

class TicketProjector extends Projector
{
    public function onTicketCreated(TicketCreated $event)
    {
        Ticket::create([
            'uuid' => $event->aggregateRootUuid(),
            'ticket_type_id' => $event->ticketTypeId,
            'hash' => $event->hash,
            'status' => $event->status
        ]);
    }

    public function onTicketPay(TicketPay $event)
    {
        $ticket = Ticket::uuid($event->aggregateRootUuid());
        $ticket->status = Ticket::STATUSES['VALID'];
        $ticket->save();
    }

    public function onTicketRefund(TicketRefund $event)
    {
        $ticket = Ticket::uuid($event->aggregateRootUuid());
        $ticket->status = Ticket::STATUSES['REFUNDED'];
        $ticket->save();
    }

}
