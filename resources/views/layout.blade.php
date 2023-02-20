<!DOCTYPE html>
  <html>
    <head>
      <title>@yield('title', 'my blog')</title>
      <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>

    <body>
      <header>
        <nav class="navbar">
          <a href="/" class="logo">B</a>
          <ul class="nav-links">
            <li><a href="/">home</a></li>
            <li><a href="/about">about me</a></li>
            <li><a href="/contact">contact</a></li>
          </ul>
          <div class="hamburger-menu">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
          </div>
        </nav>
      </header>

      <main>
          @yield('content')
      </main>

      <footer>
        <p>footer</p>
      </footer>
    </body>
  </html>
