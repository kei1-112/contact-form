<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    @livewireStyles
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                FashionablyLate
            </div>
            @yield('button')
        </div>
    </header>
    <main class="main">
        <div class="main__inner">
            <div class="main__title">
                @yield('title')
            </div>
            <div class="main__content">
                @yield('content')
            </div>
        </div>
    </main>
    @livewireScripts
</body>
</html>