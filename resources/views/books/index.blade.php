@extends('layouts.app')

@section('content')

 <div class="container">
    <div class="row">
        <h3>Listagem de livros</h3>
        <a href="{{route('books.create')}}" class="btn btn-primary" >novo livro</a>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Subtítulo</th>
                <th>Preço</th>
                </tr>
            </thead>

            <tbody>
            
            @foreach($books as $book)

                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->subtitle }}</td>
                    <td>{{ $book->price }}</td>
                    <td>
                    <ul>
                        <li>
                            <a href="{{route('books.edit',['book' => $book->id])}}" class="btn btn-primary">editar</a>
                        </li>

                        <li>
                            <?php $deleteFormID = "delete-form-{$loop->index}" ?>
                        <a href="{{route('books.destroy',['book' => $book->id])}}" class="btn btn-danger" onclick="event.preventDefault();document.getElementById('{{$deleteFormID}}').submit();" >remover</a>
                        {!! Form::open(['route' => ['books.destroy', 'book' => $book->id ], 'method' => 'DELETE', 'id' => "$deleteFormID", 'style' => 'display:none']) !!}
                      
                        {!! Form::close() !!}
                        </li>
                    </ul>
                       
                       
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
        {{$books->links()}}
    </div>
 </div>

@endsection