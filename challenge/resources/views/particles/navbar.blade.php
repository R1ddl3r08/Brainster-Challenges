<nav>
    <div class="wrap">
        <a href="{{ route('homepage') }}" class="logoDiv">
            <div class="logo">
                <img src="{{url('/images/logo_footer_black.png')}}" alt="">
            </div>
            <p>Brainster</p>
        </a>
        <div id="hamburgerMenuBtn">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul id="menu">
            <li><a href="https://brainster.co/full-stack/" target="_blank">Академија за програмирање</a></li>
            <li><a href="https://brainster.co/marketing/" target="_blank">Академија за маркетинг</a></li>
            <li><a href="https://brainster.co/graphic-design/" target="_blank">Академија за дизајн</a></li>
            <li><a href="https://blog.brainster.co/" target="_blank">Блог</a></li>
            <li><a href="" class="openModal">Вработи наш студент</a></li>
        </ul>
    </div>
</nav>

<div id="requestModal" class="modal">
    <div class="modalContent">
        <span class="closeModal">&times;</span>
        <!-- Add your modal content here -->
        <h2>Вработи наши студенти</h2>
        <hr>
        <p>Внесете Ваши информации за да стапиме во контакт</p>
        <form method="POST" action="{{ route('email.send') }}">
            @csrf
            <div class="form-group">
                <label for="email">Е-мејл</label>
                <input type="text" id="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="tel" id="phone" name="phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="company">Копманија</label>
                <input type="text" id="company" name="company" class="form-control">
            </div>
            <button type="submit">Испрати</button>
        </form>
    </div>
</div>