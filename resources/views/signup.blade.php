<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')

    @section('message')
    @if ($errors)
    <div>
        Signup failed
    </div>
@endif
    @endsection

    @section('main-content')
        <div>
            <form method="POST" action="{{route('signup')}}">
                @csrf
                <div>
                    <input type="text" name="username" placeholder="Enter username">
                    <span>
                        @error('username')
                            {{$message}}
                        @enderror
                    </span>
                </div>
                <div>
                    <input type="email" name="email" placeholder="Enter email">
                    @error('email')
                            {{$message}}
                        @enderror
                </div>
                <div>
                    <input type="password" name="password" placeholder="Enter password">
                    @error('password')
                            {{$message}}
                        @enderror
                </div>
                <div>
                    <input type="submit" value="Signup">
                </div>
            </form>
        </div>
    @endsection
</body>
</html>