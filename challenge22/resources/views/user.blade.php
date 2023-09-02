<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body id="body">
    <div class="userContainer">
        <header>
            <h1 class="text-uppercase text-white text-center p-5 display-4">Business casual</h1>
        </header>
        <nav class="p-3 d-flex justify-content-center mb-5">
            <a href="/" class="text-white mr-5 font-weight-bold text-uppercase">Home</a>
            <a href="/login" class="text-white mr-5 font-weight-bold text-uppercase">Login</a>
            <a href="/userLogout" class="text-white mr-5 font-weight-bold text-uppercase">Logout</a>
        </nav>
        <div class="container w-50 mx-auto userInfo">
            <h4 class="text-white">You name is: {{ session('name') }} </h4>
            <h4 class="text-white">Your name is: {{ session('lastName') }} </h4>
            @if(session('email') != null)
                <h4 class="text-white">Your email is: {{ session('email') }} </h4>
            @endif
        </div>
        <footer class="text-white text-center p-4">
            <p class="m-0">Copyright &copy; Your Website 2023</p>
        </footer>
    </div>
</body>
</html>