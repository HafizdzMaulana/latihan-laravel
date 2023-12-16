<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
              <svg class="bi"><use xlink:href="#house-fill"/></svg>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/post*') ? 'active' : '' }}" href="/dashboard/post">
              <svg class="bi"><use xlink:href="#file-earmark"/></svg>
              My Post
            </a>
          </li>
        </ul>
        <hr class="my-3">
        @can('admin')    
        <h6 class="sidebar-heading d-flex justify-content-between align-items center px-3 py3 text-primary">
          <span>ADMINISTRATOR</span>
        </h6>
        <ul class="nav flex-column border-bottom">
          <li class="nav-item">
            <a href="/dashboard/catagories" class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/catagories*')? 'active' : '' }}">
              <i class="fa-solid fa-layer-group"></i>
              Post Catagory
            </a>
          </li>
        </ul>
        @endcan
        <ul class="nav flex-column mb-auto">
          <li class="nav-item">
            <form action="/logout" method="post">
              @csrf
              <button type="submit" class="btn text-primary d-flex align-items-center gap-2">
                <svg class="bi"><use xlink:href="#door-closed"/></svg>
                Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>