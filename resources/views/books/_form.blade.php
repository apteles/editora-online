 <div class="form-group">
    {!! Form::label('title', 'Título') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
 </div>
 
 <div class="form-group">
    {!! Form::label('subtitle', 'Subtítulo') !!}
    {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
 </div>
 
 <div class="form-group">
    {!! Form::label('price', 'Preço') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
 </div>
 

{!! Form::hidden('redirect_to', URL::previous()) !!}