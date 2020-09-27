@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Listagem de roles</h3>   
            {!! Button::primary('Nova role')->asLinkTo(route('roles.create'))!!}
          
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
                Table::withContents($roles->items())
                                    ->striped()
                                        ->callback('Ações', function($field,$role){
                                            
                                            $linkEdit = route('roles.edit',['role' => $role->id]);
                                            $linkDestroy = route('roles.destroy',['role' => $role->id]);
                                            $anchorPermissions = route('roles.permissions.edit',['role' => $role->id]);
                                            $deleteForm = "delete-form-{$role->id}";
                                            $form = Form::open(['route' =>
                                                            ['roles.destroy','role' => $role->id],
                                                            'method' => 'DELETE','id' => $deleteForm,'style' => 'display:none']).
                                                            Form::close();
                                            $anchorDestroy = Button::link('Delete')
                                                                    ->asLinkTo($linkDestroy)->addAttributes([
                                                                        'onclick' => "event.preventDefault();document.getElementById(\"{$deleteForm}\").submit();"    
                                                                    ]);
                                            return "<ul class='list-inline'> 
                                                                        <li>". Button::link('Editar')->asLinkTo($linkEdit) ."</li>
                                                                        <li>". $anchorDestroy  ."</li>
                                                                        <li>". Button::link('Permissões')->asLinkTo($anchorPermissions)  ."</li>
                                                    </ul>" . $form;  
                                        })
            !!}
           
            {{ $roles->links() }}
        </div>
    </div>

@endsection