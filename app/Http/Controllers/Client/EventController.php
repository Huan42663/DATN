<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('client.event', compact('events'));
    }
    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)->first();
        if (empty($event)) {
            return redirect()->back()->with('error', "không tìm thấy sự kiện");
        }
        return view('client.event', compact('event'));
    }
}
