@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Editar Perfil</h3>   
            
            {!! Form::open(['route' => 'user_settings.update','class' => 'form','method' => 'PUT']) !!}
            
                {!! Html::openFormGroup('password', $errors) !!}
                    {!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    {!! Form::error('password', $errors) !!}
                {!! Html::closeFormGroup() !!}

                {!! Html::openFormGroup() !!}
                    {!! Form::label('password_confirmation', 'Senha', ['class' => 'control-label']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                {!! Html::closeFormGroup() !!}

            <div class="form-group">
                {!! Button::primary('Salvar')->submit() !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection