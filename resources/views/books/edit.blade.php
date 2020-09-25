@extends('layouts.app')

@section('content')

 <div class="container">
    <div class="row">
        <h3>Editar livro</h3>
    

        {!! Form::model($book, ['route' => ['books.update','book' => $book->id ], 'class' => 'form', 'method' => 'PUT']) !!}
   
            @include('books._form')
            
        <div class="form-group">
            {!! Form::submit('editar livro', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
 </div>

@endsection