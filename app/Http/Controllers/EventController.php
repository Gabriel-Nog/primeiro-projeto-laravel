<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    public function index() {

        $search = request('search');

        if ($search){

            $events = Event::where([
                [ 'title', 'like', '%' . $search . '%' ]
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
        if(substr($request->image->getMimeType(), 0, 5) === 'image') {

            $event = new Event;
    
            $event->title = $request->title;
            $event->city = $request->city;
            $event->private = $request->private;
            $event->description = $request->description;
            $event->items = $request->items;
            $event->date = $request->date;
    
            if($request->hasFile('image') && $request->file('image')->isValid()){
    
                $requestImage = $request->image;
    
                $extension = $requestImage->extension();
    
                $imageName = md5($requestImage->getClientOriginalName() . strtotime('now') . '.' . $extension);
    
                $requestImage->move(public_path('/img/events'), $imageName);
            
                $event->image = $imageName;
    
            }

            $user = auth()->user();
            $event->user_id = $user->id;
    
            $event->save();
    
            return redirect('/')->with('msg', 'Evento Criado Com Sucesso');
        } else {
            return redirect('/')->with('msg', 'Não É Imagem');
        }
    }

    public function show($id) {

        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', [
            'event' => $event, 
            'eventOwner' => $eventOwner,
            'hasUserJoined' => $hasUserJoined
        ]);
    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', [
            'events' => $events,
            'eventasparticipant' => $eventsAsParticipant
        ]);

    }

    public function destroy($id) {
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento Excluído');
    }

    public function edit($id) {
        $event = Event::findOrFail($id);

        $user = auth()->user();

        if($user->id !== $event->user_id){
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request) {

        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            
            if(substr($request->image->getMimeType(), 0, 5) === 'image') {

                $requestImage = $request->image;
    
                $extension = $requestImage->extension();
    
                $imageName = md5($requestImage->getClientOriginalName() . strtotime('now') . '.' . $extension);
            
                $requestImage->move(public_path('/img/events'), $imageName);
    
                $data['image'] = $imageName;
    
            }
            
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento Editado Com Sucesso');

    }

    public function joinEvent($id) {

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença foi confirmada no evento ' . $event->title);
    }

    public function leaveEvent($id) {
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Você saiu com sucesso do evento ' . $event->title);
    }
}