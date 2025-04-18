<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Event;
use App\Models\User; 
use Carbon\Carbon;

class EventController extends Controller
{
    public $search = '';

    public function index() {

        $this->search = request('search');

        $next_events = $this->getEvents('>', '=', '>', 'asc', 'next-events-page');
        $last_events = $this->getEvents('<', '=', '<', 'desc', 'last-events-page');

        return view('index', compact('next_events', 'last_events'), ['search' => $this->search]);
        
    }


    public function create() {
        $text = 'Crie o seu evento';
        return view('events.create', ['title_form' => $text]);
    }


    public function store(Request $request) {

        // Performs validation using the validator method
        $redirect = $this->validator($request);

        // If the validator method fails, it will return a redirect that returns to the previous page.
        if($redirect) { return $redirect; }

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

        return redirect('/my-events/belongs-to-me')->with('msg', 'Evento criado com sucesso!');

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

        $event_duration = $this->event_duration($event->duration);

        $event_time = Carbon::parse($event->time);
        $event_end_time = $event_time->copy()->addMinutes($event->duration);

        $event_conclude = $this->eventConclude($event);      

        return view('events.show', ['event' => $event, 'event_owner' => $event_owner, 
        'event_duration' => $event_duration, 'event_conclude' => $event_conclude, 'hasUserJoined' => $hasUserJoined]);

    }
    

    public function myEvents() {

        $user = auth()->user();
        $events = $user->events()->orderBy('title', 'asc')->paginate(6);

        $events_conclude = [];

        foreach ($events as $event) {
            $events_conclude[$event->id] = $this->eventConclude($event);
        } 

        return view('events.my-events', [
            'events' => $events, 'events_conclude' => $events_conclude
        ]);

    }


    public function asParticipant() {

        $user = auth()->user();
        $eventsAsParticipant = $user->eventsAsParticipant()->orderBy('title', 'asc')->paginate(6);

        $events_conclude = [];

        foreach ($eventsAsParticipant as $event) {
            $events_conclude[$event->id] = $this->eventConclude($event);
        } 

        return view('events.as-participant', [
            'eventsAsParticipant' => $eventsAsParticipant, 
            'events_conclude' => $events_conclude
        ]);
    }


    public function destroy($id) {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user_id) {
            return redirect('/my-events/belongs-to-me');
        }

        $this->delete_image($event);

        $event->delete();

        $previousUrl = url()->previous();

        return redirect('/my-events/belongs-to-me');

    }


    public function edit($id) {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user_id) {
            return redirect('/my-events/belongs-to-me');
        }

        $event_duration = $this->event_duration($event->duration);
        $text = 'Editar evento';

        return view('events.edit', ['event' => $event, 
        'event_duration' => $event_duration, 'title_form' => $text]);

    }


    public function update(Request $request) {

        $data = $request->all();

        $event = Event::findOrFail($request->id);

        $redirect = $this->validator($request);
        
        if($redirect) { 
            return $redirect->with('msg_fail', 'Falha na edição do evento por algum campo obrigatório ter sido enviado vazio.'); 
        }

        $newImage = $this->image_upload($request);

        if($newImage) {

            $data['image'] = $newImage;
            
            $this->delete_image($event);

        }

        $event->update($data);

        return redirect('/my-events/belongs-to-me')->with('msg', 'Evento editado com sucesso!');

    }


    public function joinEvent($id) {

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect()->back();

    }


    public function leaveEvent($id) {

        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);    

        $previousUrl = url()->previous();

        if(str_contains($previousUrl, '/my-events/as-participant')) {
            return redirect('/my-events/as-participant')->with('msg', 
            'Você saiu com sucesso do evento: ' . $event->title);
        } else {
            return redirect()->back();
        }

    }
    

    /* --------------------  Support Methods -------------------- */

    public function image_upload($request) {

        // Image Upload
        $imageName = '';

        if($request->hasFile('image')) {

            $requestImage = $request->image;

            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')). '.' . $requestImage->getClientOriginalExtension(); 

            $requestImage->move(public_path('img/events'), $imageName);

        }

        return $imageName;

    }


    public function delete_image($event) {

        $path = public_path('img/events/' . $event->image);

        if ($event->image && file_exists($path)) {
            unlink($path);
        }

    }


    public function event_duration($duration) {

        $event_duration; $hour_text; $minutes_text;

        $hour_duration = intval($duration / 60);
        $minutes_duration = $duration % 60;

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


    public function validator(Request $request) {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
            'duration' => 'required',
            'city' => 'required',
        ], [
            'title.required' => 'Insira um título para o evento.',
            'date.required' => 'Defina uma data para o evento.',
            'time.required' => 'Defina o horário do evento.',
            'duration.required' => 'Adicione a duração do evento.',
            'city.required' => 'Informe a cidade onde o evento ocorrerá.',
        ]);

        if($validator->fails()) {
            $duration = $this->event_duration($request->duration);
            return redirect()->back()->withErrors($validator)->withInput()->with('duration', $duration);
        }

    }


    public function getEvents($sinal1, $sinal2, $sinal3, $order, $pageName) {
        $current_date = Carbon::today()->toDateString(); 
        $current_time = Carbon::now()->format('H:i:s'); 

        $query = Event::where(function ($query) use ($current_date, $current_time, $sinal1, $sinal2, $sinal3) {
            $query->where('date', $sinal1, $current_date)
                ->orWhere(function ($query) use ($current_date, $current_time, $sinal2, $sinal3) {
                    $query->where('date', $sinal2, $current_date)
                            ->where('time', $sinal3, $current_time);
                });
        });

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        $events = $query->orderBy('date', $order)->orderBy('time', $order)->paginate(6, ['*'], $pageName);

        return $events;

    }


    public function eventConclude($event) {
        $current_date = Carbon::today()->toDateString(); 
        $current_time = Carbon::now()->format('H:i:s'); 

        $event_time = Carbon::parse($event->time);
        $event_end_time = $event_time->copy()->addMinutes($event->duration);

        $event_conclude = false;

        if ($event->date < $current_date || ($event->date == $current_date && $event_end_time <= $current_time)) {
            $event_conclude = true;
        }

        return $event_conclude;
    }

}
