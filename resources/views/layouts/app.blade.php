<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- Navigation -->
    <div>
        <nav>
            <ul>
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('about')}}">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact us</a></li>
                <li><a href="">Login</a></li>
                <li><a href="{{route('signup')}}">Signup</a></i>
            </ul>
        </nav>
    </div>
    @yield('message')
    @yield('main-content')

    <!-- Footer -->
    <div>
        <h1>&copy; 2023</h1>
    </div>

</body>
</html>