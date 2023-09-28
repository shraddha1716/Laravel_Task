<html>
    <head>

    </head>
    <body>
        <form method="POST" action="{{ route('custom.login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
        </form>
    </body>
</html>