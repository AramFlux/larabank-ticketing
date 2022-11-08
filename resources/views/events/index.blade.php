@extends('layouts.app')

@section('content')
    @if($events->count())
        <ul>
            @foreach($events as $event)
                <li class="mb-2 leading-none flex items-stretch">
                    <div class="flex-1 flex flex-col justify-center p-4 rounded-sm bg-grey-darkest border-grey-darker mr-2">
                        <h1 class="text-grey-light text-sm uppercase font-bold mb-1">
                            ♫♪.ılılıll|̲̅̅○̲̅̅|̲̅̅=̲̅̅|̲̅̅○̲̅̅|llılılı.♫♪ {{ strtoupper($event->name) }}
                        </h1>
                        @foreach($event->ticketTypes as $ticketType)
                            <strong class="text-xl text-green">
                                <a href="{{ route('ticketType.get', ['eventId' => $event->id, 'ticketTypeId' => $ticketType->id]) }}">
                                    {{ $ticketType->name }}
                                </a>
                            </strong>
                        @endforeach
                    </div>
                    <div class="w-1/3">
                        <form action="{{ route('ticketTypes.create', $event->id) }}" method="post">
                            @csrf
                            <div class="flex flex-wrap">
                                <input
                                    name="name"
                                    placeholder="Ticket name"
                                    class="rounded-sm px-2 h-10 w-full mb-2"
                                    autocomplete="off"
                                >
                                <input
                                    type="number"
                                    name="stock"
                                    placeholder="Stock"
                                    class="rounded-sm px-2 h-10 w-full mb-2"
                                    autocomplete="off"
                                >
                                <button
                                    type="submit"
                                    class="px-3 h-10 rounded-sm bg-green-gradient text-white font-medium flex-1"
                                >
                                    Add
                                </button>
                            </div>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="py-8 mb-2 flex items-center justify-center rounded-sm bg-grey-darkest border-grey-darker text-grey-light">
            Nothing here yet!
        </div>
    @endif
    @include('events.partials.create-form')
@endsection
