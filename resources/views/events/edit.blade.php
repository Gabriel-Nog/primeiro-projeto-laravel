@extends('layouts.main')

@section('title', 'Editando ' . $event->title)

@section('content')

   <div id="event-create-container" class="col-md-6 offset-md-3">
   
      <h1>Editando {{ $event->title }}</h1>
      
      <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
         
         @csrf
         @method('PUT')
         
         <div class="form-group">
            <label for="image">Imagem do evento</label>
            <input 
               type="file" 
               name="image" 
               id="image" 
               class="form-control-file"
            >
            <img 
               src="/img/events/{{ $event->image }}" 
               class="img-preview"
               alt="{{ $event->title }}"
            >
         </div>

         <div class="form-group">
            <label for="title">Nome do evento</label>
            <input 
               type="text" 
               class="form-control"
               name = "title"
               id="title"
               placeholder="Nome do evento"  
               value="{{ $event->title }}" 
            >
         </div>

         <div class="form-group">
            <label for="date">Data do evento</label>
            <input 
               type="date" 
               class="form-control"
               name = "date"
               id="date"
               value="{{ $event->date->format('Y-m-d') }}" 
            >
         </div>
   
         <div class="form-group">
            <label for="city">Local do evento</label>
            <input 
               type="text" 
               class="form-control"
               name = "city"
               id="city"
               placeholder="Local do evento"   
               value="{{ $event->city }}"
            >
         </div>
   
         <div class="form-group">
            <label for="private">O Evento será privado</label>
            <select name="private" id="private" class="form-control">
               <option value="0">Não</option>
               <option value="1" {{ $event->private === 1 ? "selected" : "" }}>Sim</option>
            </select>
         </div>
   
         <div class="form-group">
            <label for="description">Descrição do evento</label>
            <textarea 
               name="description" 
               id="description" 
               class="form-control"
               placeholder="Descrição do evento"
            >{{ $event->description }}</textarea>
         </div>

         <div class="form-group">
            <label for="description">Adicione Itens De Infraestrutura</label>
            
            <div class="form-group">
               <input 
                  type="checkbox" 
                  id="cadeiras" 
                  name="items[]" 
                  value="Cadeiras"
               >
               <label for="cadeiras">Cadeiras</label>
            </div>
            
            <div class="form-group">
               <input 
                  type="checkbox"
                  id="palco" 
                  name="items[]" 
                  value="Palco"
               >

               <label for="palco">Palco</label>
            </div>

            <div class="form-group">
               <input 
                  type="checkbox" 
                  id="cerveja"
                  name="items[]" 
                  value="Cerveja Grátis"
               >

               <label for="cerveja">Cerveja Grátis</label>
            </div>

            <div class="form-group">
               <input 
                  type="checkbox" 
                  id="openFood"
                  name="items[]"
                  value="Open Food"
               >

               <label for="openFood">Open Food</label>
            </div>

            <div class="form-group">
               <input 
                  type="checkbox" 
                  id="brindes"
                  name="items[]" 
                  value="Brindes"
               >

               <label for="brindes">Brindes</label>
            </div>
         </div>

         <input type="submit" class="btn btn-primary" value="Editar Evento">
   
      </form>
   </div>

@endsection