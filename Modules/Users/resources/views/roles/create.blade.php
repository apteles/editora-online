@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Nova Role</h3>   
            
            {!! Form::open(['route' => 'roles.store','class' => 'form']) !!}
                
                {!! Form::hidden('redirect_to',URL::previous()) !!}

                @include('users::roles._form')

            <div class="form-group">
                {!! Button::primary('Criar')->submit() !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection