@extends('layouts.app')

@section('content')

 <div class="container">
    <div class="row">
    
        <h3>Editar capítulo - Livro: {{$book->title}} </h3>

        {!! Form::model($chapter, ['route' => ['chapters.update','book' => $book->id , 'chapter' => $chapter->id], 'class' => 'form', 'method' => 'PUT']) !!}
   
            @include('codeedubook::chapters._form')
            
        <div class="form-group">
            {!! Form::submit('salvar capítulo', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
 </div>

@endsection