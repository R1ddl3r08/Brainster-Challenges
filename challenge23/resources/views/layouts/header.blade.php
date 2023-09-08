<header class="@yield('background')">
    <nav>
        <div class="wrapper">
            <a class="logo" href="/">Blog</a>
            <ul>
                <li><a href="/" class="@yield('home-link')">Home</a></li>
                <li><a href="/aboutMe" class="@yield('about-link')">About</a></li>
                <li><a href="/post" class="@yield('post-link')">sample post</a></li>
                <li><a href="/contact" class="@yield('contact-link')">contact</a></li>
            </ul>
        </div>
    </nav>
    <div class="titleCont">
        <h1 class="@yield('titleStyle')">@yield('pageTitle')</h1>
        <p class="@yield('subtitleStyle')">@yield('pageSubtitle')</p>
        <div class="message">
            <span>@yield('message')</span>
        </div>
    </div>
</header>