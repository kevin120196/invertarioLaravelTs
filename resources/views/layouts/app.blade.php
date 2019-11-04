<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                        <a class="navbar-brand" href="{{route('Post.index')}}">Post</a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
    <!-- Scripts -->
    <script type="text/javascript">
        $(document).on('click','.create-modal',function(){
            $('#create').modal('show');
            $('.form-horizontal').show();
            $('modal-title').text('Add Post');

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'post',
            url:'addPost',
            data:{
                    '_token':$('input[name=_token]').val(),
                    'title':$('input[name=title]').val(),
                    'body':$('input[name=body]').val(),
                    
                    
            },
                success:function(data){
                    
                    if ((data.errors)){
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.title);
                        $('.error').text(data.errors.body);
                    }else{
                        $('.error').remove();
                        $('#table').append("<tr class='post"+ data.id +"'>"+
                        "<td>"+data.id+"</td>"+
                        "<td>"+data.title+"</td>"+
                        "<td>"+data.body+"</td>"+
                        "<td>"+data.created_at+"</td>"+
                        "<td><a class='show-modal btn btn-info btn-sm' data-id='"+data.id+"' data-title='"+data.title+"' data-body='"+data.body+"'>"+
                        "<i class='fa fa-eye'></i></a>"+
                        "<a class='edit-modal btn btn-warning btn-sm' data-id='"+data.id+"' data-title='"+data.title+"' data-body='"+data.body+"'>"+
                        "<i class='fa fa-pencil'></i></a>"+
                        "<a class='delete-modal btn btn-warning btn-sm' data-id='"+data.id+"' data-title='"+data.title+"' data-body='"+data.body+"'>"+
                        "<i class='fa fa-trash'></i></a>"+
                        "</td>"+
                        "</tr>");
                    }
                },

        });
    </script>
</body>
</html>