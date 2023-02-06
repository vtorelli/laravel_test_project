<!DOCTYPE html>
  <html>
    <head>
      <title>@yield('title', 'my blog')</title>
    </head>

    <body>
      <header>
        <nav>
          <ul>
            <li><a href="/">home</a></li>
            <li><a href="/about">about me</a></li>
            <li><a href="/contact">contact</a></li>
          </ul>
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
