@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <h3>Lixeira de Livros</h3>

        </div>
        <br>
        <div class="row">
            {!! Form::model(compact('search'),['class' =>'form-inline','method' => 'GET']) !!}
                {!! Form::label('search','Pesquisar por título',['class' => 'control-label']) !!}
                {!! Form::text('search',null,['class' => 'form-control']) !!}
                {!! Button::primary('Buscar')->submit() !!}
            {!! Form::close() !!}
        </div>
        <br>
        <div class="row">

    @if($books->count() > 0)



        {!!
                Table::withContents($books->items())
                                    ->striped()
                                        ->callback('Ações', function($field,$book){
                                        $linkView = route('trashed.books.show',['book' => $book->id]);
                                        $linkDestroy = route('books.destroy',['book' => $book->id]);
                                        $restoreForm = "restore-form-{$book->id}";

                                        $form = Form::open(['route' =>
                                                            ['trashed.books.update','book' => $book->id],
                                                            'method' => 'PUT','id' => $restoreForm,'style' => 'display:none']).
                                                            Form::hidden('redirect_to',URL::previous()) .
                                                            Form::close();
                                            $anchorRestore = Button::link('Restaurar')
                                                                    ->asLinkTo($linkDestroy)->addAttributes([
                                                                        'onclick' => "event.preventDefault();document.getElementById(\"{$restoreForm}\").submit();"
                                                                    ]);
                                            return "<ul class='list-inline'>
                                                                        <li>". Button::link('Detalhes')->asLinkTo($linkView) ."</li>
                                                                        <li>". $anchorRestore ."</li>
                                                    </ul>" . $form;
                                        })


        !!}

            {{ $books->links() }}

      @else

        <div class="well well-lg text-center">

          <p><strong>Lixeira está vazia</strong></p>

        </div>

      @endif

        </div>
    </div>

@endsection