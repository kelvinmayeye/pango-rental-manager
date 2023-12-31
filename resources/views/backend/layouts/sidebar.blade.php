<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <span class="brand-text font-weight-light pl-4">Pango Manager</span>
    </a>
  
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('backend/dist/img/user2-160x160.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="" class="d-block">{{ auth()->user()->first_name }}</a>
        </div>
      </div>
  
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-fighter-jet"></i>
              <p>
                Properties
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="{{ route('properties.index') }}" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Property</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-ticket-alt"></i>
              <p>
                Tenants
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('tenants.index') }}" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Tenants</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('tenantProperties.index') }}" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Tenants Property</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('leases.index') }}" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Lease</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-cog"></i>
              <p>
                Payments
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('payments.index') }}" class="nav-link">
                  <i class="fas fa-caret-right nav-icon"></i>
                  <p>Payment</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>