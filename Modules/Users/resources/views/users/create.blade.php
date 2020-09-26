@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Novo Usuário</h3>   
            
            {!! Form::open(['route' => 'users.store','class' => 'form']) !!}
                
                {!! Form::hidden('redirect_to',URL::previous()) !!}

                @include('users::users._form')

            <div class="form-group">
                <!-- {!! Form::submit('Cria categoria',['class' => 'btn btn-primary']) !!} -->
                {!! Button::primary('Criar')->submit() !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection