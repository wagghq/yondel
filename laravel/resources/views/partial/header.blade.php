<div class="title-bar">
  <div class="title-bar-left">
    <span class="title-bar-title"><a href="{{ route('home') }}">Journal Club</a></span>
  </div>
  <div class="title-bar-right">
    <button class="menu-icon" type="button"></button>
  </div>
</div>

<nav>
  <ul>
    @if (Auth::check())
      <li><a href="{{ route('book.create') }}">Recommend a book</a></li>
      <li><a href="{{ route('auth.logout') }}">Logout</a>/li>
    @else
      <li><a href="{{ route('auth.login') }}">Login</a></li>
      <li><a href="{{ route('auth.register') }}">Register</a></li>
    @endif
  </ul>
</nav>
