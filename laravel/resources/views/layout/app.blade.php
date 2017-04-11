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
              <li><a href="{{ route('book.index') }}">Books</a></li>
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

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', '{{ env('GOOGLE_ANALYTICS_TRACKING_ID') }}', 'auto');
        ga('send', 'pageview');
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    @hasSection('script')
      <script>
        @yield('script')
      </script>
    @endif
  </body>
</html>