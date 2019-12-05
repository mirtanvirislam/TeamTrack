<nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
  <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
    <div class="input-group input-group-seamless ml-3">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <!-- <i class="fas fa-search"></i> -->
        </div>
      </div>
      <input class="navbar-search form-control" type="text" placeholder="." aria-label="Search"> </div>
  </form>

  <!-- <div class="btn "> <a href="/empty_data">Empty Data</a> </div>
  <div class="btn "> <a href="/import_data">Import Data</a> </div>
   -->
  <ul class="navbar-nav border-left flex-row ">

    <li class="nav-item border-right dropdown notifications">
      <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="nav-link dropdown-toggle text-nowrap px-3">
          <b>
            {{Auth::user()->getCurrentTeamName()}}
          </b>
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
        @foreach( App\Member::teamList(Auth::id()) as $team)
          <a class="dropdown-item" href="/teams/{{$team->id}}">
            <b>{{$team->name}}</b>
          </a>
        @endforeach
          <a class="dropdown-item" data-toggle="modal" data-target="#newTeamModal">
            <b>+ Add Team</b>
          </a>
      </div>
    </li>          

    @guest
            <li class="nav-item">
                <a class="nav-link text-nowrap px-3" href="{{ route('login') }}" >
                    <span class="d-none d-md-inline-block">{{ __('Login') }}</span>
                </a>
            </li>
        @if (Route::has('register'))
            <li class="nav-item ">
                <a class="nav-link text-nowrap px-3" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif

        @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle mr-2" src="{{ asset('template/images/avatars/0.jpg') }}" alt="User Avatar">
                    <span class="d-none d-md-inline-block">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">                                        
                        <i class="material-icons text-danger">&#xE879;</i> {{ __('Logout') }} 
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
    @endguest                                  
  </ul>



  <nav class="nav">
    <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left" data-toggle="collapse" data-target=".header-navbar" aria-expanded="false" aria-controls="header-navbar">
      <i class="material-icons">&#xE5D2;</i>
    </a>
  </nav>
</nav>


