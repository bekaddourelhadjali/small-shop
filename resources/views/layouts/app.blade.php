<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>

   <link  href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href=" {{asset('css/font-awesome.min.css')}} " rel="stylesheet" type="text/css">
    <style>

        .nav-item{
            display: inline-block;
            list-style: none;
            font-size: 150%;


        }

        .nav-ul{
            position: absolute;
            right : -9%;
            top : 35%;
        }
        .header_main{
            top:-60px;

        }

    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('css/shop_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">
    @yield('style')
</head>
<body>


    <div id="app">
        <main class="py-4">
            <div class="header_main">
                <div class="container">
                    <div class="row">

                        <!-- Logo -->
                        <div class="col-lg-2 col-sm-3 col-3 order-1">
                            <div class="logo_container">
                                <div class="logo"><a href="{{url('/home')}}">ELECTRO</a></div>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">
                                        <form action="{{route('search')}}" class="header_search_form clearfix">
                                            <input type="search" name="search" required="required" class="header_search_input" placeholder="Search for products...">
                                            <div class="custom_dropdown">
                                                <div class="custom_dropdown_list">
                                                    <span class="custom_dropdown_placeholder clc">@if(isset($category_s)){{$category_s->name}} @else All Categories @endif</span>
                                                    <i class="fa fa-chevron-down"></i>
                                                    <ul class="custom_list clc">
                                                        @if(isset($category_s)) <li><a class="clc" href="{{route('home' )}}"> All Categories </a></li>@endif
                                                    @foreach (App\category::all() as $category)
                                                        <li><a class="clc" href="{{route('store.category',['id'=>$category->id])}}"> {{$category->name}}</a></li>
                                                    @endforeach
                                              </ul>
                                                </div>
                                            </div>
                                            <button type="submit" class="header_search_button trans_300" value="Submit">
                                                <img src="{{asset('img/search.png')}}" alt=""></button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <ul class="nav-ul">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('forum') }}">{{ __('Forum') }}</a>
                            </li>
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @else
                                @if(Auth::user()->type==='admin')
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ __('Dashboard') }} <span class="caret"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{route('category.index')}}">Categories</a>
                                            <a class="dropdown-item" href="{{route('products.index')}}">Products</a>
                                        </div>
                                    </li>



                                @endif


                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{route('settings')}}">Settings</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>


                                    </div>
                                </li>
                            @endguest
                        </ul>

                    </div>
                </div>
            </div>
            @yield('content')
        </main>
    </div><script src="{{asset('js/jquery.min.js')}}"></script>

    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('js/shop_custom.js')}}"></script>
    @yield('script')
</body>
</html>
