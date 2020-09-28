{!! Html::openFormGroup('title', $errors) !!} 
    {!! Form::label('title', 'Título') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! Form::error('title', $errors) !!}
{!! Html::closeFormGroup() !!} 

{!! Html::openFormGroup('subtitle', $errors) !!} 
    {!! Form::label('subtitle', 'Subtítulo') !!}
    {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
    {!! Form::error('subtitle', $errors) !!}
{!! Html::closeFormGroup() !!} 
 
{!! Html::openFormGroup('price', $errors) !!} 
    {!! Form::label('price', 'Preço') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
    {!! Form::error('price', $errors) !!}
{!! Html::closeFormGroup() !!} 

{!! Html::openFormGroup('categories', $errors) !!} 
    {!! Form::label('categories[]', 'Categorias') !!}
    {!! Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple' => true]) !!}
    {!! Form::error('categories.*', $errors) !!}
    {!! Form::error('categories', $errors) !!}
{!! Html::closeFormGroup() !!} 

{!! Html::openFormGroup('dedication', $errors) !!} 
    {!! Form::label('dedication', 'Dedicação') !!}
    {!! Form::textarea('dedication', null, ['class' => 'form-control']) !!}
    {!! Form::error('dedication', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('description', $errors) !!} 
    {!! Form::label('description', 'Descrição') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    {!! Form::error('description', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('website', $errors) !!} 
    {!! Form::label('website', 'Website') !!}
    {!! Form::text('website', null, ['class' => 'form-control']) !!}
    {!! Form::error('website', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('percent_complete', $errors) !!} 
    {!! Form::label('percent_complete', 'Concluído (%)') !!}
    {!! Form::text('percent_complete', null, ['class' => 'form-control']) !!}
    {!! Form::error('percent_complete', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup() !!} 

<label>
{!! Form::checkbox('published') !!} Publicado?
</label>

{!! Html::closeFormGroup() !!}

{!! Form::hidden('redirect_to', URL::previous()) !!}