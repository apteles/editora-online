@extends('layouts.app')

@section('content')

 <div class="container">
    <div class="row">
        <h3>Nova categoria</h3>
    
        @if($errors->any())
          <ul class="alert alert-danger list-inline">
              @foreach($errors->all() as $error)
                {{$error}}
              @endforeach
          </ul>  
        @endif


        {!! Form::open(['route' => 'categories.store', 'class' => 'form']) !!}
   

            <div class="form-group {{$errors->first('name') ? 'has-error': '' }}">
                {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                {!! Form::error('name', $errors) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('criar categoria', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
 </div>

@endsection