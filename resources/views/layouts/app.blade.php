<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
