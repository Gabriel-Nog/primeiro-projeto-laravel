@extends('layouts.main')

@section('title', 'Sobre O Evento')

@section('content')
   <div class="col-md-10 offset-md-1">
      <div class="row">
         <div id="image-container" class="col-md-6">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-fluid">
         </div>

         <div id="info-container" class="col-md-6">
            <h1>{{ $event->title }}</h1>
            <p class="event-city">
               <ion-icon name="location-outline"></ion-icon>
               {{ $event->city }}
            </p>

            <p class="events-participants">
               <ion-icon name = "people-outline"></ion-icon>
               {{ count($event->users) }} Participantes
            </p>

            <p class="event-owner">
               <ion-icon name="star-outline"></ion-icon>
               {{ $eventOwner['name'] }}
            </p>

            @if(!$hasUserJoined)

               <form action="/events/join/{{ $event->id }}" method="post">
                  @csrf
                  <a 
                     href="#" 
                     class="btn btn-primary" 
                     id="event-submit"
                     onclick="
                        event.preventDefault();
                        this.closest('form').submit();
                     "
                  >
                     Confirmar Presença
                  </a>
               </form>
            
            @else
               <p class="already-joined-msg">Você já está participando</p>
            @endif

            <h3>O Evento Conta Com: </h3>
            <ul id="items-list">
               @foreach ($event->items as $item)
                  <li>
                     <ion-icon name = 'play-outline'></ion-icon> 
                     <span>
                        {{ $item }}
                     </span> 
                  </li>
               @endforeach
            </ul>
         </div>

         <div id="description-container" class="col-md-12">
            <h3>Sobre O Evento: </h3>
            <p class="event-description">
               {{ $event->description }}
            </p>
         </div>
      </div>
   </div>
@endsection