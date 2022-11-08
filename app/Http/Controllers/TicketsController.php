<?php

namespace App\Http\Controllers;

use App\Domain\TicketType\TicketTypeAggregateRoot;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Http\Request;
use App\Domain\Ticket\TicketAggregateRoot;

class TicketsController extends Controller
{
    public function pay(Request $request, $eventId, $ticketId)
    {
        /** @var Ticket $ticket */
        $ticket = Ticket::where('id', $ticketId)->first();
        $aggregateRoot = TicketAggregateRoot::retrieve($ticket->uuid);
        $aggregateRoot->payTicket()->persist();

        /** @var TicketType $ticketType */
        $ticketType = $ticket->ticketType;
        $ticketTypeAggregateRoot = TicketTypeAggregateRoot::retrieve($ticketType->uuid);
        // todo handle reasons list with constants
        $ticketTypeAggregateRoot->stockSubtracted(1, 'Ticket bought')->persist();

        return back();
    }

    public function refund(Request $request, $eventId, $ticketId)
    {
        /** @var Ticket $ticket */
        $ticket = Ticket::where('id', $ticketId)->first();
        $aggregateRoot = TicketAggregateRoot::retrieve($ticket->uuid);
        $aggregateRoot->refundTicket()->persist();

        /** @var TicketType $ticketType */
        $ticketType = $ticket->ticketType;
        $ticketTypeAggregateRoot = TicketTypeAggregateRoot::retrieve($ticketType->uuid);
        // todo handle reasons list with constants
        $ticketTypeAggregateRoot->stockadded(1, 'Ticket Refunded')->persist();

        return back();
    }
}
