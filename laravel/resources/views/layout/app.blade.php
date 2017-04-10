<html>
  <head>
    <title>YONDEL</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
  </head>
  <body>
    <div class="row">
      <div class="columns">
        <header class="site-header">
          <h1 class="site-title"><a href="{{ route('facade') }}">YONDEL</a></h1>
        </header>
      </div>
    </div>

    <hr />

    <div class="row">
      <div class="columns">
        <nav>
          <ul class="vertical medium-horizontal menu centering-flex">
            @if (Auth::check())
              <li><a href="{{ route('book.create') }}">Add a book</a></li>
              <li><a href="{{ route('auth.logout') }}">Logout</a></li>
            @else
              <li><a href="{{ route('auth.login') }}">Login</a></li>
              <li><a href="{{ route('auth.register') }}">Register</a></li>
            @endif
          </ul>
        </nav>
      </div>
    </div>

    <hr />

    @yield('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    @hasSection('script')
      <script>
        @yield('script')
      </script>
    @endif
  </body>
</html>