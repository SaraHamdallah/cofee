<div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/dash/images/img.jpg') }}" alt="">{{ session('name') }}
                  </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="javascript:;"> Profile</a>
                        <a class="dropdown-item"  href="javascript:;">
                          <span class="badge bg-red pull-right">50%</span>
                          <span>Settings</span>
                        </a>
                    <a class="dropdown-item"  href="javascript:;">Help</a>

                      <a class="dropdown-item"  href="login.html" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                        </form>
                    </div>
                  </li>
  
                  <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-envelope-o"></i>
                      <span class="badge bg-green">{{ $nMessages->count() }}</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                    @foreach ($nMessages->take(3) as $message)
                      <li class="nav-item">
                        <a class="dropdown-item" href="{{ route('showMessage', $message->id) }}"> <!-- Link to view the message -->
                          <span class="image"><img src="{{ asset('assets/dash/images/img.jpg') }}" alt="Profile Image" /></span>
                          <span>
                            <span>{{ $message->name }}</span>
                            <span class="time">{{ $message->created_at_diff_for_humans }}</span><!-- Display human-readable time -->
                          </span>
                          <span class="message">
                          {{ Str::limit($message->message, 30) }} <!-- Limit message preview to 30 characters -->
                          </span>
                        </a>
                      </li>
                      @endforeach
                    
                      <li class="nav-item">
                        <div class="text-center">
                          <a class="dropdown-item" href="{{ route('messages') }}">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>