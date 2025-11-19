<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    </head>
    <body>
        <header class="header">
            <nav class="navbar navbar-expand-lg" style="background-color: #537d5d;">
                <div class="container-fluid">
                    <a href="{{ route('customers.index') }}" class="nav-link" style="color: #fffdf6;">{{ config('app.name', 'WarmMart') }}</a>
                    <a href="{{ route('customers.create') }}" class="nav-link" style="color: #fffdf6;">Customers</a>
                    <a href="{{ route('customers.create') }}" class="nav-link" style="color: #fffdf6;">Products</a>
                </div>
            </nav>
        </header>

        <main style="background-color: #ecfae5; min-height: 80vh; padding: 1em;">
            @yield('content')
        </main>

        <footer style="background-color: #73946b;">
            <p style="color: #fffdf6;">&copy; {{ date('Y') }} {{ config('app.name', 'WarmMart') }}. All rights reserved.</p>
        </footer>
    </body>
</html>