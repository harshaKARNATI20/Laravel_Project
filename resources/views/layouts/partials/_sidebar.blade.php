<nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              @auth
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('tickets.index') }}">
                    <span data-feather="home"></span>
                    Tickets
                  </a>
                </li>
                @if(!auth()->user()->isAdmin())
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('tickets.my-purchases') }}">
                    <span data-feather="shopping-cart"></span>
                    My Purchases
                  </a>
                </li>
                @endif
              @endauth
            </ul>

          </div>
        </nav>
