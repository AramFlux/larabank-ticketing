<?php

namespace App\Http\Middleware;

use App\Models\Event;
use Closure;
use \Illuminate\Http\Request;

class EventPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Event $event */
        $event = Event::where('id', $request->route('eventId'))->first();

        if (!$event || $event->user_id != auth()->user()->id) {
            return redirect(route('events.index'));
        }

        return $next($request);
    }
}
