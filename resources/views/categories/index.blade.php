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
                        AÇões
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        {{$categories->links()}}
    </div>
 </div>

@endsection