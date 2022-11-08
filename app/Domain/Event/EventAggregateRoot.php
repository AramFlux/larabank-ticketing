<?php

namespace App\Domain\Event;

use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use App\Domain\Event\Events\EventCreated;

class EventAggregateRoot extends AggregateRoot
{

    public function createEvent(string $name, string $userId)
    {
        $this->recordThat(new EventCreated($name, $userId));

        return $this;
    }

}
