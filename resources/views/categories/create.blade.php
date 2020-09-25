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
            
            @include('categories._form')

            {!! Html::openFormGroup() !!}
                {!! Button::primary('criar categoria')->submit() !!}
            {!! Html::closeFormGroup() !!}
        {!! Form::close() !!}
    </div>
 </div>

@endsection