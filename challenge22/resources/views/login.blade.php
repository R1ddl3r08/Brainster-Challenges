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
    <div class="loginContainer">
        <header>
            <h1 class="text-uppercase text-white text-center p-5 display-4">Business casual</h1>
        </header>
        <nav class="p-3 d-flex justify-content-center mb-5">
            <a href="/" class="text-white mr-5 font-weight-bold text-uppercase">Home</a>
            <a href="/login" class="text-white mr-5 font-weight-bold text-uppercase">Login</a>
        </nav>
        <div class="container mb-5 formContainer">
            <form method="POST" action="{{ url('userLogin') }}" class="w-50 mx-auto">
                @csrf
                <div class="form-group">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="name" class="text-white font-weight-bold text-uppercase">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    @error('lastName')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="lastName" class="text-white font-weight-bold text-uppercase">Last name</label>
                    <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName" value="{{ old('lastName') }}">
                </div>
                <div class="form-group">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="email" class="text-white font-weight-bold text-uppercase">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                </div>
                <button class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
        <footer class="text-white text-center p-4">
            <p class="m-0">Copyright &copy; Your Website 2023</p>
        </footer>
    </div>
</body>
</html>