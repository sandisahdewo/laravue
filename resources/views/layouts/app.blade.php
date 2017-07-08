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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="/js/app.js"></script>
</head>
<body>
    <div>
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
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Master Data <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('master.items') }}">Items</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <div id="notification">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Pemberitahuan <span class="badge">@{{ countNotification }}</span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li v-for="unread in allNotification">
                                        <a href="#" title="Click to read this notification" v-on:click="markAsRead(unread.id)" v-if="unread.read_at == null">Item <b>@{{ unread.data.item_name }}</b> @{{ unread.data.status }}</a>
                                    </li>
                                    <li v-show="countNotification == 0">
                                        <a href="#">No unread notification.</a>
                                    </li>
                                    <li v-for="read in allNotification">
                                        <a href="#" title="Readed Notification" style="background-color:#b3b6bc" v-if="read.read_at !== null">Item <b>@{{ read.data.item_name }}</b> @{{ read.data.status }}</a>
                                    </li>
                                </ul>
                            </li>

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
            </div>
        </nav>
        <div id="app">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/vue/vue.min.js') }}"></script>
    <script src="{{ asset('js/vee-validate/vee-validate.min.js') }}"></script>
    <script src="{{ asset('js/axios/axios.min.js') }}"></script>
    <script>
        var apiUrl = 'http://localhost:8000/api/';
        var webUrl = 'http://localhost:8000/';

        var notif = new Vue({
            el: '#notification',
            data: {
                countNotification: 0,
                allNotification: []
            },
            created() {
                this.counting()
                this.getNotification()
            },
            methods: {
                counting: function() {
                    axios.get('{{ route('count.unread.notification') }}').then(
                        result => {
                            this.countNotification = result.data
                        }
                    );
                },
                getNotification: function() {
                    axios.get('{{ route('get.all.notification') }}').then(
                        result => {
                            this.allNotification = result.data
                        }
                    );
                },
                markAsRead: function(id) {
                    axios.get(webUrl+'mark-read-notification/'+id).then(
                        result => {
                            this.counting()
                            this.getNotification()
                        }
                    );
                }
            }

        });
    </script>
    @stack('vue')
</body>
</html>
