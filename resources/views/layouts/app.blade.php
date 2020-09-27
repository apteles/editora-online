<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php

use Users\Facade\NavbarAuthorization;

echo \json_encode([
    'csrfToken' => csrf_token(),
]); ?>
    </script>

</head>
<body>
    <div id="app">
        <?php

            $navbar = Navbar::withBrand(config('app.name'), url('/'))->inverse();

            if (Auth::check()) {
                $arrayLinks = [
                    [
                        'link' => route('categories.index'),
                        'title' => 'Categorias',
                        'permission' => 'categories-admin/list'
                    ],
                    [
                        'Livro',
                        [
                            [
                                'link' => route('books.index'),
                                'title' => 'Listagem',
                                'permission' => 'book-admin/list'
                            ],
                            [
                                'link' => route('trashed.books.index'),
                                'title' => 'Lixeira',
                                'permission' => 'book-trashed-admin/list'
                            ]
                        ]
                    ],
                    [
                        'Usuários',
                        [
                            [
                                'link' => route('users.index'),
                                'title' => 'Usuários',
                                'permission' => 'users-admin/list'
                            ],
                            [
                                'link' => route('roles.index'),
                                'title' => 'Papel de usuários',
                                'permission' => 'roles-admin/list'
                            ]
                        ],
                    ]
                ];

                $links = Navigation::links(NavbarAuthorization::getLinksAuthorized($arrayLinks));

                $logout = Navigation::links([
                    [
                        Auth::user()->name,
                        [
                            [
                                'link' => url('/logout'),
                                'title' => 'Logout',
                                'linkAttributes' => [
                                    'onclick' => 'event.preventDefault();document.getElementById("logout-form").submit()'
                                ]
                            ]
                        ]
                    ]
                ])->right();

                $navbar->withContent($links)
                            ->withContent($logout);
            }

            if (Auth::guest()) {
                $loginOrRegister = Navigation::links([
                    [
                        'link' => url('/login'),
                        'title' => 'Login',
                    ],
                    [
                        'link' => url('/register'),
                        'title' => 'Cadastre-se'
                    ]
                ])->right();

                $navbar->withContent($loginOrRegister);
            }

        ?>

        {!! $navbar !!}

        {!! Form::open(['url' => url('/logout'),'id' => 'logout-form','style' => 'display:none']) !!}
        {!!Form::close() !!}
        
        @if(Session::has('message'))
            <div class="container">
              {!! Alert::success(Session::get('message'))->close() !!}
            </div>  
        @endif

         @if(Session::has('error'))
            <div class="container">
              {!! Alert::danger(Session::get('error'))->close() !!}
            </div>  
        @endif
        
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>