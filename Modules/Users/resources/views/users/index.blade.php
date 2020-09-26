@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Listagem de usuários</h3>   
            {!! Button::primary('Novo Usuário')->asLinkTo(route('users.create'))!!}
          
        </div>
        <br>
        <div class="row">
            {!! Form::model(compact('search'),['class' =>'form-inline','method' => 'GET']) !!}
                {!! Form::label('search','Pesquisar por nome',['class' => 'control-label']) !!}
                {!! Form::text('search',null,['class' => 'form-control']) !!}
                {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <br>
        <div class="row">

            {!! 
                Table::withContents($users->items())
                                    ->striped()
                                        ->callback('Ações', function($field,$user){
                                            
                                            $linkEdit = route('users.edit',['user' => $user->id]);
                                            $linkDestroy = route('users.destroy',['user' => $user->id]);
                                            $deleteForm = "delete-form-{$user->id}";

                                            $form = Form::open(['route' =>
                                                            ['users.destroy','user' => $user->id],
                                                            'method' => 'DELETE','id' => $deleteForm,'style' => 'display:none']).
                                                            Form::close();
                                            $anchorDestroy = Button::link('Delete')
                                                                    ->asLinkTo($linkDestroy)->addAttributes([
                                                                        'onclick' => "event.preventDefault();document.getElementById(\"{$deleteForm}\").submit();"    
                                                                    ]);
                                            $anchor = $user->id === \Auth::user()->id ?$anchorDestroy->disable() : $anchorDestroy;

                                            return "<ul class='list-inline'> 
                                                                        <li>". Button::link('Editar')->asLinkTo($linkEdit) ."</li>
                                                                        <li>". $anchor ."</li>
                                                    </ul>" . $form;  
                                        })
            !!}
           
            {{ $users->links() }}
        </div>
    </div>

@endsection