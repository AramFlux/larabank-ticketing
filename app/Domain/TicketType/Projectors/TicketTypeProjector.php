<?php

namespace App\Domain\TicketType\Projectors;

use App\Domain\TicketType\Events\StockAdded;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use App\Domain\TicketType\Events\TicketTypeCreated;
use App\Domain\TicketType\Events\TicketTypeUpdated;
use App\Domain\TicketType\Events\StockSubtracted;
use App\Domain\TicketType\Events\TicketTypeBuy;
use App\Models\TicketType;

class TicketTypeProjector extends Projector
{
    public function onStartingEventReplay()
    {
        TicketType::truncate();
    }

    public function onTicketTypeCreated(TicketTypeCreated $event)
    {
        TicketType::create([
            'uuid' => $event->aggregateRootUuid(),
            'name' => $event->name,
            'event_id' => $event->eventId,
            'stock' => $event->stock
        ]);
    }

    public function onTicketTypeUpdated(TicketTypeUpdated $event)
    {
        $ticketType = TicketType::uuid($event->aggregateRootUuid());
        $ticketType->name = $event->name;
        $ticketType->stock = $event->stock;
        $ticketType->save();
    }

    public function onTicketTypeBuy(TicketTypeBuy $event)
    {
        // nothing yet
    }

    public function onStockSubtracted(StockSubtracted $event)
    {
        $ticketType = TicketType::uuid($event->aggregateRootUuid());
        $ticketType->stock -= $event->quantity;
        $ticketType->save();
    }

    public function onStockAdded(StockAdded $event)
    {
        $ticketType = TicketType::uuid($event->aggregateRootUuid());
        $ticketType->stock += $event->quantity;
        $ticketType->save();
    }

}
