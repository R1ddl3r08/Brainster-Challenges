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
    <header>
        <h1 class="text-uppercase text-white text-center p-5 display-4">Business casual</h1>
    </header>
    <nav class="p-3 d-flex justify-content-center mb-5">
        <a href="/" class="text-white mr-5 font-weight-bold text-uppercase">Home</a>
        <a href="/login" class="text-white mr-5 font-weight-bold text-uppercase">Login</a>
        @if(session('loggedIn') == true)
            <a href="/userLogout" class="text-white mr-5 font-weight-bold text-uppercase">Logout</a>
        @endif
    </nav>
    <div class="position-relative mb-5">
        <div class="catalyst-img">
            <img src="{{url('/images/catalyst.jpg')}}" alt="catalyst"/>
        </div>
        <div class="w-25 p-3 rounded text-center position-absolute" id="content">
            <h4 class="text-uppercase">lorem ipsum</h4>
            <h2 class="text-uppercase">lorem ipsum</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias illum nobis minus, assumenda eum provident doloribus expedita dignissimos dicta, sequi perferendis libero atque cumque obcaecati incidunt? Ipsa odio sit consequuntur?</p>
            <a href="" class="btn btn-warning position-absolute">Visit us today</a>
        </div>
    </div>
    <div class="bg-warning p-5 mb-5">
        <div class="w-75 mx-auto text-center p-3" id="promise">
            <h6 class="text-uppercase">Our promise</h6>
            @if(session('loggedIn') == true)
                <h3 class="text-uppercase">{{ session('name') }} {{ session('lastName') }}</h3>
            @else
                <h3 class="text-uppercase">To You</h3>
            @endif
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta doloremque rem dolore est numquam recusandae doloribus, quod reiciendis laborum voluptates ullam nobis quis libero veritatis suscipit quos, tempora aut temporibus! Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti iste id adipisci commodi neque esse officiis itaque quo! Culpa minus debitis aspernatur quo dolorem enim facilis. Mollitia qui autem reiciendis.</p>
        </div>
    </div>
    <footer class="text-white text-center p-4">
        <p class="m-0">Copyright &copy; Your Website 2023</p>
    </footer>
</body>
</html>