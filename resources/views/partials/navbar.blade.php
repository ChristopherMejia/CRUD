<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('index') }}">
      <!-- <img class="navbar-brand-full" src="svg/Continental_(Orange).svg" width="150" height="25" alt="Continental"> -->
      <img class="navbar-brand-full" src="img/print-logo.jpg" height="100" alt="Continental" style="
      margin-left: 45px;
      margin-top: 40px;
      width: 200px;
  ">
      <img class="navbar-brand-minimized" src="svg/Continental_Horse_(Orange).svg" width="30" height="30" alt="Continental_Horse">
    </a>
    <!-- <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <ul class="nav navbar-nav ml-auto"> 
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        &nbsp;&nbsp; 
        {{ Auth::user()->getCommonName() }}
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong>Configuración</strong>
          </div>
                <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  <i class="fa fa-lock"></i> {{ __('Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </header>
  
          <!-- {{ Auth::user()['attributes']['cn'][0] }} -->