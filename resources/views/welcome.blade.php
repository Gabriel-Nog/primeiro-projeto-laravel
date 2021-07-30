@extends('layouts.main')

@section('title', 'HDC Events - Dashboard')

@section('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um Evento</h1>

    <form action="/" method="GET">
        <input 
            type="text" 
            id = "search" 
            name = "search" 
            class="form-control"
            placeholder="Procurar..."
        >
    </form>
</div>

<div id="events-container" class="col-md-12">

    @if($search)
        <h2>Buscando Por: {{ $search }}</h2>
    @else
        <h2>Próximos Eventos</h2>
        <p class="subtitle">Veja Os Eventos Dos Próximos Dias</p>
    @endif


    <div id="cards-container" class="row">
        
        @foreach ($events as $event)
            <div class="card col-md-3">
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
            
                <div class="card-body">
                    <div class="card-date">
                        {{ date('d/m/y', strtotime($event->date)) }}
                    </div>
    
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-participants">{{ count($event->users) }} Participantes</p>
                    <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber Mais</a>
                </div>
            </div>
        @endforeach
        
    </div>
    
    @if (count($events) === 0 && $search)
        <p>Não Foi Possível Encontrar Eventos Com {{ $search }}!</p>
        <a href="/">Ver Todos</a>
    @elseif(count($events) === 0)
        <p>Não Há Eventos Disponíveis</p>


    @endif

</div>

@endsection