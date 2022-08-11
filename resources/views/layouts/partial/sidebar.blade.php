 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
            <div class="image">
                <img src="{{asset('backend/file/images/logo.png')}}" class="img-circle elevation-2" alt="User Image" width="auto" height="20">
            </div>
        </a>
        <div class=" dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <div class="dropdown-divider"></div>
          <div class="dropdown-divider"></div>
          <a href="{{route('logout')}}" class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fas fa-users mr-2"></i> Log Out
          </a>
        </div>
      </li>

     
    </ul>
  </nav>
  <!-- /.navbar -->