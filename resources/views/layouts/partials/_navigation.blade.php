<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"></a>
      <ul class="navbar-nav px-3">
        @auth
        <li class="nav-item text-nowrap">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link" style="color: white; text-decoration: none; padding: 0;">Sign out</button>
          </form>
        </li>
        @endauth
      </ul>
    </nav>
