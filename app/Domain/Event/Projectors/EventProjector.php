<?php

namespace App\Domain\Event\Projectors;

use App\Models\Event;
use App\Domain\Event\Events\EventCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class EventProjector extends Projector
{
    public function onEventCreated(EventCreated $event)
    {
        Event::create([
            'uuid' => $event->aggregateRootUuid(),
            'name' => $event->name,
            'user_id' => $event->userId,
        ]);
    }

}
