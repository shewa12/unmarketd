<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Unmarketd  <?php if(!empty($title)){echo "- ".$title;}?></title>

    <!-- Styles -->
    <link href="{{url('public/css/app.css')}}" rel="stylesheet">
    <!--selectize css-->
    <link rel="stylesheet" href="{{url('public/selectize/selectize.bootstrap3.css')}}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{url('public/css/custom.css')}}">
<!--jquery box msg-->   
  
<link rel="stylesheet" id="theme" type="text/css" />
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{url('public/css/jquery.msgbox.css')}}">
<style type="text/css">
    .footer{position: fixed;bottom: 0;left: 0;right: 0;}
    img {width: 30%;}
</style>
 
  
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!--selectize js-->
    <script src="{{url('public/selectize/jquery.min.js')}}"></script>
    <script src="{{url('public/selectize/selectize.js')}}"></script>    
    <!--selectize js end-->
    <style type="text/css">
        .packages {
            padding-left:50px;
            font-weight: 500;
        }
        .star{
            font-size: 24px;
            color:#ff4f5d;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="http://bch-affiliate.com/shewa/unmarketd/">
                        <img src="{{url('public/img/logo.png')}}">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        
                            <li><a href="{{ url('') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register as an expert</a></li>
                            <li><a href="{{route('becomeClient')}}">Become a client</a></li>
                        
                        @else
                        <li>
                            <a href="{{route('home')}}">Dashboard</a>
                        </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                         <li>
                                    <a href="{{route('adminChangePassword')}}">Change Password</a>
                                    </li>                                    
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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

        <div class="container-fluid footer">
            <strong><center>&copy; All rights and reserved | unmarketd.com</center> </strong>
        </div>
    </div>

    <!-- Scripts -->
  
    <script src="{{url('public/js/2.1.4-jquery.js')}}"></script>
    <script src="{{url('public/js/app.js')}}"></script>

     <!--selectize js-->
    <script src="{{url('public/selectize/jquery.min.js')}}"></script>
    <script src="{{url('public/selectize/selectize.js')}}"></script>
    <!--selectize js end-->    
    <!--js area-->
    @yield('js');
    <!--js area end-->  
</body>

</html>
