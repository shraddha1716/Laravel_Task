<html>
    <head>

    </head>
    <body>
        <h1>Home page</h1>
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
</form>
    </body>
</html>