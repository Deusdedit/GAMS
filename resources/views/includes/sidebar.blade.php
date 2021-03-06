<!-- Brand Logo -->

<a href="#" class="brand-link">
      <img src="{{asset('assets/dist/img/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><b>AMS</b></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div> -->
      <!-- Sidebar Menu -->
      
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{route('home')}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home
                
              </p>
            </a>
          </li>
         
         
          @if ( Auth::user()->role_id == '1') 
          <!-- Admin -->

          <li class="nav-item has-treeview">
            <a href=" {{ route('user.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users Management
              </p>
            </a>
          </li>
         

          @elseif ( Auth::user()->role_id == '2')
          <!-- TO -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Asset Management
                  <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('vehicle.index') }}" class="nav-link">
                   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Vehicle</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('generator.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Generator</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('driver.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Drivers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('fuel.index')}}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Fuels</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('service.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Services</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('maintenance.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Maintenance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('accident.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Accidents</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Reports
                  <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('fuelReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Fuel</p>
                </a>
              </li>
          <li class="nav-item">
                <a href="{{ route('serviceReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('maintenanceReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Maintenance</p>
                </a>
              </li>
              </ul>
              </li>

          
          @elseif ( Auth::user()->role_id == '3')
          <!-- PMU -->
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Asset Management
                  <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('receiving.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Receiving</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('asset.index') }}" class="nav-link">
                   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Assets</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('disposal.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Disposal</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Reports
                  <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('receivingReport') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Receiving</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="{{ route('assetReport.index') }}" class="nav-link">
                   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Assets</p>
                </a>
              </li>
            <li class="nav-item">
                <a href="{{ route('fuelReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Fuel</p>
                </a>
              </li>
            
            <li class="nav-item">
                <a href="{{ route('serviceReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('maintenanceReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Maintenance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('disposalReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Disposal</p>
                </a>
              </li>
              </ul>
          
          @elseif ( Auth::user()->role_id == '4')
          <!-- Manager -->

            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Management Reports
                  <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('receivingReport') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Receiving</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('assetReport.index') }}" class="nav-link">
                   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Assets</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('fuelReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Fuel</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('serviceReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Service</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('maintenanceReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Maintenance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('disposalReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Disposal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('accidentReport.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Accident</p>
                </a>
              </li>
            </ul>
          </li>

          @elseif ( Auth::user()->role_id == '5')
          <!-- PMU DATA ENTRY -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Asset Management
                  <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{ route('receiving.index') }}" class="nav-link">
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Receiving</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('asset.index') }}" class="nav-link">
                   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i class="far fa-circle nav-icon"></i>
                  <p>Assets</p>
                </a>
              </li>
              </li>
            </ul>
          </li>
          
          
          @endif

          <li class="nav-item has-treeview">
            <a href=" {{ route('change') }}" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                change Password
              </p>
            </a>
          </li>

          

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                {{ __('Logout') }}
              </p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
             </form>
          </li>          

          
        </ul>
      </nav>
      
    </div>
    <!-- /.sidebar -->
  