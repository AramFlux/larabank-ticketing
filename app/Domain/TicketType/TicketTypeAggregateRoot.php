<?php

namespace App\Domain\TicketType;

use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use App\Domain\TicketType\Events\TicketTypeCreated;
use App\Domain\TicketType\Events\TicketTypeUpdated;
use App\Domain\TicketType\Events\StockSubtracted;
use App\Domain\TicketType\Events\TicketTypeBuy;
use App\Domain\TicketType\Events\StockAdded;
use App\Models\TicketType;
use Spatie\EventSourcing\StoredEvents\StoredEvent;

class TicketTypeAggregateRoot extends AggregateRoot
{
    protected static bool $allowConcurrency = true;

    public function createTicketType(string $name, string $userId, int $stock)
    {
        $this->recordThat(new TicketTypeCreated($name, $userId, $stock));

        return $this;
    }

    public function editTicketType(string $name, int $stock)
    {
        $this->recordThat(new TicketTypeUpdated($name, $stock));

        return $this;
    }

    public function buyTicket()
    {
        $this->recordThat(new TicketTypeBuy());

        return $this;
    }

    public function stockSubtracted(int $quantity, string $reason)
    {
        $this->recordThat(new StockSubtracted($quantity, $reason));

        return $this;
    }

    public function stockadded(int $quantity, string $reason)
    {
        $this->recordThat(new StockAdded($quantity, $reason));

        return $this;
    }

}
