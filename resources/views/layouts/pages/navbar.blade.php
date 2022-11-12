<nav class="navbar navbar-expand-sm bg-light navbar-light sticky-top" style="border-bottom: 1px solid #D3D3D3;">
        <div class="container-fluid">
          <a class="navbar-brand">
            <img src="{{asset('assets/images/admin.png')}}" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
            <span class="text-center">jhgh</span>
          </a>
          <a class="navbar-brand" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </div>
      </nav>