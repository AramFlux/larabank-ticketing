<?php

namespace App\Http\Controllers;

use App\Domain\Ticket\TicketAggregateRoot;
use App\Domain\TicketType\TicketTypeAggregateRoot;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketTypesController extends Controller
{
    public function get(Request $request, $eventId, $ticketTypeId)
    {
        $ticketType = TicketType::where('id', $ticketTypeId)->where('event_id', $eventId)->first();

        return view('ticketTypes.index', compact('ticketType'));
    }

    public function create(Request $request, $eventId)
    {
        $newUuid = Str::uuid()->toString();

        TicketTypeAggregateRoot::retrieve($newUuid)
            ->createTicketType(
                $request->name,
                $eventId,
                $request->stock
            )
            ->persist();

        return back();
    }

    public function update(Request $request, $eventId, $ticketTypeId)
    {
        $ticketType = TicketType::where('id', $ticketTypeId)->first();

        $aggregateRoot = TicketTypeAggregateRoot::retrieve($ticketType->uuid);
        $aggregateRoot->editTicketType($request->name, $request->stock)->persist();

        return back();
    }

    public function buy(Request $request, $eventId, $ticketTypeId)
    {
        $ticketType = TicketType::where('id', $ticketTypeId)->first();
        $aggregateRoot = TicketTypeAggregateRoot::retrieve($ticketType->uuid);
        $aggregateRoot->buyTicket()->persist();

        $newUuid = Str::uuid()->toString();
        $hash = md5($newUuid);

        TicketAggregateRoot::retrieve($newUuid)
            ->createTicket($ticketTypeId, $hash, Ticket::STATUSES['UNPAID'])
            ->persist();

        return back();
    }

}
