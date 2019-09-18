<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-light">
    <div id="app">
        <nav class="bg-white">

            <div class="container mx-auto">
               <div class="flex justify-between items-center py-3">
                <a class="navbar-brand" href="{{ url('/projects') }}">
                    <img src="/images/freelancer.svg" class="logo" />
                </a>

                <div>
           

             
                        <!-- Authentication Links -->
                        @guest
                         <span class="links">
                                <a class="nav-link " style="color: #0ed3cf;" href="{{ route('login') }}">{{ __('Login') }}</a>
                         
                            @if (Route::has('register'))
                              
                                    <a class="nav-link" style="color: #0ed3cf;" href="{{ route('register') }}">{{ __('Register') }}</a>
                             
                            @endif
                        </span>
                        @else
                    
                                
                                <headerdropdown width="150px">

                                    <template v-slot:trigger>
                                         <button        
                                            class="flex items-center text-default no-underline text-sm focus:outline-none">
                                            
                                            {{ Auth::user()->name }} 
                                            
                                            <img src="/images/{{ Auth::user()->name }}.jpg" 
                                                    alt="{{ Auth::user()->name }}" 
                                                    class="w-8 h-8 mr-2 rounded-full ml-4"/>

                                        </button>
                                        
                                    </template>
                                    <template v-slot:default>
                                      
                                           <a href="/projects" class="block text-default px-4 no-underline hover:underline text-sm leading-loose">Projects</a> 

                                            <a class="block text-default px-4 no-underline hover:underline text-sm leading-loose" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">

                                                  Logout

                                       <!--            <svg class="mr-2 fill-current text-teal-500 inline-block h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 7H2v6h8v5l8-8-8-8v5z"/></svg> -->
             
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </a>
                                    </template>

                                </headerdropdown>

                          
                        @endguest
                 
                    </div>
                </div>
            </div>
        </nav>

        <main class="container h-screen mx-auto py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
