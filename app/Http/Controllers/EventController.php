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

        $event->image = $this-> image_upload($request);

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');

    }

    public function show($id) {

        $event = Event::findOrFail($id);

        $event_owner = User::where('id', $event->user_id)->first()->toArray();

        $event_duration = $this->event_duration($event);

        return view('events.show', ['event' => $event, 'event_owner' => $event_owner, 'event_duration' => $event_duration]);

    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        return view('events.dashboard', ['events' => $events]);

    }

    public function destroy($id) {

        $event = Event::findOrFail($id);

        if($event->image) {
            unlink(public_path('img/events/' . $event->image));
        }

        $event->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');

    }

    public function edit($id) {

        $event = Event::findOrFail($id);

        $event_duration = $this->event_duration($event);

        return view('events.edit', ['event' => $event, 'event_duration' => $event_duration]);

    }

    public function update(Request $request) {

        $data = $request->all();

        $data['image'] = $this-> image_upload($request);

        $event = Event::findOrFail($request->id);
        
        if($event->image) {
            unlink(public_path('img/events/' . $event->image));
        }

        $event->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');

    }
    

    public function image_upload($request) {

        // Image Upload
        $imageName = '';

        if($request->hasFile('image')) {

            $requestImage = $request->image;

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')). '.' . $requestImage->getClientOriginalExtension(); 

            $requestImage->move(public_path('/img/events'), $imageName);

        }

        return $imageName;

    }


    public function event_duration($event) {

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

        return $event_duration;

    }

    public function joinEvent($id) {

        $user = auth()->user();

        $user->eventAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Você se inscreveu no evento. ' . $event->title);

    }

}
