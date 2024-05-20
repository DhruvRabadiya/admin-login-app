<nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav"> 
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{Route('profile')}}" class="nav-link">Profile</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{Route("allUsers")}}" class="nav-link">See All Users</a>
                </li>
                
                <li class="nav-item d-none d-sm-inline-block">
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary bg-red">Logout</button>
                </form>
                </li>
            </ul>

        </nav>