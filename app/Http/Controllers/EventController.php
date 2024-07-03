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

        return view('index', ['events' => $events, 'search' => $search]);
    }

    public function create() {
        $text = 'Crie o seu evento';
        return view('events.create', ['title_form' => $text]);
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

        $event->image = $this->image_upload($request);

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/dashboard')->with('msg', 'Evento criado com sucesso!');

    }

    public function show($id) {

        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent) {
                if($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }

        $event_owner = User::where('id', $event->user_id)->first()->toArray();

        $event_duration = $this->event_duration($event);

        return view('events.show', ['event' => $event, 'event_owner' => $event_owner, 
        'event_duration' => $event_duration, 'hasUserJoined' => $hasUserJoined]);

    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events' => $events, 
        'eventsAsParticipant' => $eventsAsParticipant]);

    }

    public function destroy($id) {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user_id) {
            return redirect('/dashboard');
        }

        if($event->image) {
            unlink(public_path('img/events/' . $event->image));
        }

        $event->delete();

        $previousUrl = url()->previous();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');

    }

    public function edit($id) {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user_id) {
            return redirect('/dashboard');
        }

        $event_duration = $this->event_duration($event);
        $text = 'Editando o evento';

        return view('events.edit', ['event' => $event, 
        'event_duration' => $event_duration, 'title_form' => $text]);

    }

    public function update(Request $request) {

        $data = $request->all();

        $data['image'] = $this->image_upload($request);

        $event = Event::findOrFail($request->id);
        
        if($event->image) {
            unlink(public_path('img/events/' . $event->image));
        }

        $event->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');

    }


    public function joinEvent($id) {

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect()->back();

        // return redirect()->back()->with('msg', 'Você se inscreveu no evento ' . $event->title);

    }

    public function leaveEvent($id) {

        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);    

        $previousUrl = url()->previous();

        if(str_contains($previousUrl, '/dashboard')) {
            return redirect('/dashboard')->with('msg', 
            'Você saiu com sucesso do evento: ' . $event->title);
        } else {
            return redirect()->back();
        }

    }
    

    # Support Functions

    public function image_upload($request) {

        // Image Upload
        $imageName = '';

        if($request->hasFile('image')) {

            $requestImage = $request->image;

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')). '.' . $requestImage->getClientOriginalExtension(); 

            $requestImage->move(public_path('img/events/', $imageName));

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


}
