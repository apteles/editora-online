{!! Html::openFormGroup('name', $errors) !!}
    {!! Form::hidden('redirect_to', URL::previous()) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! Form::error('name', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('description', $errors) !!}
    {!! Form::hidden('redirect_to', URL::previous()) !!}
    {!! Form::label('description', 'Descrição', ['class' => 'control-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
    {!! Form::error('description', $errors) !!}
{!! Html::closeFormGroup() !!}