@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        <h1>Meus Eventos</h1>

        @if(count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome do Evento</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td scope="row">
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                <a href="/events/{{ $event->id }}">
                                    {{ $event->title }}
                                </a>
                            </td>

                            <td>
                                {{ count($event->users) }}
                            </td>

                            <td>
                                <a href="/events/edit/{{ $event->id }}" class="btn btn-info edit-btn">
                                    <ion-icon name="create-outline"></ion-icon>
                                    Editar
                                </a>
                                
                                <form action="/events/delete/{{ $event->id }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-delete">
                                        <ion-icon name="trash-outline"></ion-icon>
                                        Deletar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não possui nenhum evento!</p>
            <a href="/events/create">Crie Um Evento</a>
        @endif
    </div>

    <div class="col-md-10 offset-md-1 dashboard-events-container">
        <h1>Eventos Que Estou Participando</h1>

        @if(count($eventasparticipant) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome do Evento</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($eventasparticipant as $event)
                        <tr>
                            <td scope="row">
                                {{ $loop->index + 1 }}
                            </td>

                            <td>
                                <a href="/events/{{ $event->id }}">
                                    {{ $event->title }}
                                </a>
                            </td>

                            <td>
                                {{ count($event->users) }}
                            </td>

                            <td>
                                <form action="/events/leave/{{ $event->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon>
                                        Sair Do Evento
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você Não Participa De Nenhum Evento</p>
            <a href="/">Veja Todos Os Eventos</a>
        @endif
    </div>
@endsection