@extends('layouts.app')

@section('content')

 <div class="container">
    <div class="row">
        <h3>Listagem de categorias</h3>
        <a href="{{route('categories.create')}}" class="btn btn-primary" >nova categoria</a>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                <th>ID</th>
                <th>Nome</th>
                </tr>
            </thead>

            <tbody>
            
            @foreach($categories as $category)

                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                    <ul>
                        <li>
                            <a href="{{route('categories.edit',['category' => $category->id])}}" class="btn btn-primary">editar</a>
                        </li>

                        <li>
                            <?php $deleteFormID = "delete-form-{$loop->index}" ?>
                        <a href="{{route('categories.destroy',['category' => $category->id])}}" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('{{$deleteFormID}}').submit();" >remover</a>
                        {!! Form::open(['route' => ['categories.destroy', 'category' => $category->id ], 'method' => 'DELETE', 'id' => "$deleteFormID", 'style' => 'display:none']) !!}
                      
                        {!! Form::close() !!}
                        </li>
                    </ul>
                       
                       
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        {{$categories->links()}}
    </div>
 </div>

@endsection