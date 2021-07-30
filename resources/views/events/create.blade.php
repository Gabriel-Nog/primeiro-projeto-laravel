@extends('layouts.main')

@section('title', 'Criar Eventos')

@section('content')

   <div id="event-create-container" class="col-md-6 offset-md-3">
   
      <h1>Crie Seu Evento</h1>

      
      <form action="/events" method="POST" enctype="multipart/form-data">
         
         @csrf
         
         <div class="form-group">
            <label for="image">Imagem do evento</label>
            <input 
               type="file" 
               name="image" 
               id="image" 
               class="form-control-file"
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
            >
         </div>

         <div class="form-group">
            <label for="date">Data do evento</label>
            <input 
               type="date" 
               class="form-control"
               name = "date"
               id="date"
               placeholder="Data do evento"   
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
            >
         </div>
   
         <div class="form-group">
            <label for="private">O Evento será privado</label>
            <select name="private" id="private" class="form-control">
               <option value="0">Não</option>
               <option value="1">Sim</option>
            </select>
         </div>
   
         <div class="form-group">
            <label for="description">Descrição do evento</label>
            <textarea 
               name="description" 
               id="description" 
               class="form-control"
               placeholder="Descrição do evento"
            ></textarea>
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

         <input type="submit" class="btn btn-primary" value="Criar Evento">
   
      </form>
   </div>

@endsection