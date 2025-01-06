<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Laravel</title>
    <style>
        header {
            background-color: #f8f9fa;
            padding: 10px;
            position: relative;
        }
        nav {
            display: flex;
            justify-content: flex-end;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            display: inline-block;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                @guest
                    <!-- Jeśli użytkownik nie jest zalogowany -->
                    <li><a href="{{ route('login') }}">Zaloguj</a></li>
                    <!-- <li><a href="{{ route('register') }}">Zarejestruj</a></li> -->
                @else
                    <!-- Jeśli użytkownik jest zalogowany -->
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Wyloguj</a></li>
                @endguest
                <!-- Jeśli użytkownik jest adminem -->
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.index') }}">Panel Admina</a></li>
                        <li><a href="{{ route('admin.showGroups') }}">Lista Klas</a></li>
                    @endif
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Formularz wylogowania -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
