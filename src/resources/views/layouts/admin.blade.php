<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">FashionablyLate</a>
        </div>
        <div class="logout__link">
            <form method="post" action="/logout">
                @csrf
                <button class="logout__button-submit">logout</button>
            </form>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
@yield('script')
</html>