<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User; 

class EventController extends Controller
{
    public function index() {

        $search = request('search');

        if($search) {
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();
        } else {
            $events = Event::all();
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {

        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->duration = $request->duration;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')). '.' . $requestImage->getClientOriginalExtension(); 

            $requestImage->move(public_path('/img/events'), $imageName);

            $event->image = $imageName;

        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');

    }

    public function show($id) {

        $event = Event::findOrFail($id);

        $event_owner = User::where('id', $event->user_id)->first()->toArray();

        $event_duration; $hour_text; $minutes_text;

        $hour_duration = intval($event->duration / 60);
        $minutes_duration = $event->duration % 60;

        if($hour_duration == 1) {
            $hour_text = $hour_duration . ' hora';
        } else {
            $hour_text = $hour_duration . ' horas';
        }

        if($minutes_duration == 1) {
            $minutes_text = $minutes_duration . ' minuto';
        } else {
            $minutes_text = $minutes_duration . ' minutos';
        }

        if($hour_duration > 0 && $minutes_duration > 0) {
            $event_duration = $hour_text . ' e ' . $minutes_text;
        } else if ($hour_duration > 0 && $minutes_duration <= 0) {
            $event_duration = $hour_text;
        } else {
            $event_duration = $minutes_text;
        }

        return view('events.show', ['event' => $event, 'event_owner' => $event_owner, 'event_duration' => $event_duration]);

    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        return view('events.dashboard', ['events' => $events]);

    }
    
}
