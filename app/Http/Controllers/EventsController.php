<?php

namespace App\Http\Controllers;

use App\Domain\Event\EventAggregateRoot;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class EventsController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::user()->id)->get();

        return view('events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $newUuid = Str::uuid()->toString();

        EventAggregateRoot::retrieve($newUuid)
            ->createEvent($request->name, auth()->user()->id)
            ->persist();

        return back();
    }

    public function update(Event $event)
    {

    }

    public function destroy(Event $event)
    {

    }
}
