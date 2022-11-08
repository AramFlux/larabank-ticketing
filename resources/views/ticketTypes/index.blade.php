@extends('layouts.app')

@section('content')
    @if($ticketType)
        <ul>
            <li class="mb-2 leading-none flex items-stretch">
                <div class="flex-1 flex flex-col justify-center p-4 rounded-sm bg-grey-darkest border-grey-darker mr-2">
                    <h1 class="text-grey-light text-sm uppercase font-bold mb-1">
                        {{ strtoupper($ticketType->name) }}
                    </h1>
                    <strong class="text-xl text-green">
                        Stock: {{ $ticketType->stock }}
                    </strong>
                </div>
                <div class="w-1/3">
                    <form action="{{ route('ticketTypes.update', ['eventId' => $ticketType->event->id, 'ticketTypeId' => $ticketType->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="flex flex-wrap">
                            <input
                                type="text"
                                name="name"
                                placeholder="Name"
                                class="rounded-sm px-2 h-10 w-full mb-2"
                                autocomplete="off"
                                value="{{ $ticketType->name }}"
                            >
                            <input
                                type="number"
                                name="stock"
                                placeholder="Stock"
                                class="rounded-sm px-2 h-10 w-full mb-2"
                                autocomplete="off"
                                value="{{ $ticketType->stock }}"
                            >
                            <button
                                name="add"
                                type="submit"
                                class="px-3 h-10 rounded-sm bg-green-gradient text-white font-medium flex-1"
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
        <form action="{{ route('ticketTypes.buy', ['eventId' => $ticketType->event->id, 'ticketTypeId' => $ticketType->id]) }}" method="post">
            @csrf
            <div class="flex flex-wrap">
                <button
                    name="buy"
                    type="submit"
                    class="px-3 h-10 rounded-sm bg-green-gradient text-white font-medium"
                >
                    Buy One
                </button>
            </div>
        </form>
    @else
        <div class="py-8 mb-2 flex items-center justify-center rounded-sm bg-grey-darkest border-grey-darker text-grey-light">
            Nothing here yet!
        </div>
    @endif
    <div class="flex-1 flex flex-col justify-center p-4 rounded-sm bg-grey-darkest border-grey-darker mr-2">
        <h1 class="text-grey-light text-sm uppercase font-bold mb-1">
            Tickets
        </h1>
        @foreach($ticketType->tickets as $ticket)
            <strong class="text-xl text-green">
                {{ $ticket->hash }}: {{ $ticket->status }}
            </strong>
            @if($ticket->status == \App\Models\Ticket::STATUSES['UNPAID'])
                <form action="{{ route('ticket.pay', ['eventId' => $ticketType->event->id, 'ticketId' => $ticket->id]) }}" method="post">
                    @csrf
                    <div class="flex flex-wrap">
                        <button
                            name="pay"
                            type="submit"
                            class="px-3 h-10 rounded-sm bg-green-gradient text-white font-medium"
                        >
                            Pay
                        </button>
                    </div>
                </form>
            @endif
            @if($ticket->status == \App\Models\Ticket::STATUSES['VALID'])
                <form action="{{ route('ticket.refund', ['eventId' => $ticketType->event->id, 'ticketId' => $ticket->id]) }}" method="post">
                    @csrf
                    <div class="flex flex-wrap">
                        <button
                            name="refund"
                            type="submit"
                            class="px-3 h-10 rounded-sm bg-green-gradient text-white font-medium"
                        >
                            Refund
                        </button>
                    </div>
                </form>
            @endif
        @endforeach
    </div>
@endsection
