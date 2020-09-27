@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Editar Role</h3>

            {!! Form::model($role, ['route' => ['roles.update', 'role' => $role->id], 'class' => 'form', 'method' => 'PUT']) !!}

                @include('users::roles._form')

                {!! Html::openFormGroup('name', $errors) !!}
                    {{--{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}--}}
                    {!! Button::primary('Salvar')->submit() !!}
                {!! Html::closeFormGroup() !!}
            {!! Form::close() !!}

        </div>
    </div>
@endsection