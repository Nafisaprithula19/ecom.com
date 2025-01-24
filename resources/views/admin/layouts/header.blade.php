<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      
      
   
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{url('public/assets/dist/img/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">IB-CODE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('public/assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" >
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
          <li class="nav-item ">
            <a href="{{url('admin/admin/list')}}" class="nav-link @if(Request::segment(2)=='admin') active @endif ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Admin 
               
              </p>
            </a>
    
          </li>
          <li class="nav-item ">
            <a href="{{url('admin/orders/list')}}" class="nav-link @if(Request::segment(2)=='orders') active @endif ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Orders
               
              </p>
            </a>
    
          </li>
          <li class="nav-item ">
            <a href="{{url('admin/category/list')}}" class="nav-link @if(Request::segment(2)=='category') active @endif ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Category
               
              </p>
            </a>
    
          </li>
          <li class="nav-item ">
            <a href="{{url('admin/sub_category/list')}}" class="nav-link @if(Request::segment(2)=='sub_category') active @endif ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Sub-Category
               
              </p>
            </a>
    
          </li>
          <li class="nav-item ">
            <a href="{{url('admin/brand/list')}}" class="nav-link @if(Request::segment(2)=='brand') active @endif ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Brand
               
              </p>
            </a>
    
          </li>

          <li class="nav-item ">
            <a href="{{url('admin/color/list')}}" class="nav-link @if(Request::segment(2)=='color') active @endif ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Color
               
              </p>
            </a>
    
          </li>
          <li class="nav-item ">
            <a href="{{url('admin/product/list')}}" class="nav-link @if(Request::segment(2)=='product') active @endif ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Products
               
              </p>
            </a>
    
          </li>
          <li class="nav-item ">
            <a href="{{url('admin/discount_code/list')}}" class="nav-link @if(Request::segment(2)=='discount_code') active @endif ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
               Discount Code
               
              </p>
            </a>
    
          </li>
          <li class="nav-item ">
            <a href="{{url('admin/shipping_charge/list')}}" class="nav-link @if(Request::segment(2)=='shipping_charge') active @endif ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
              shipping Charge
               
              </p>
            </a>
    
          </li>

          <li class="nav-item ">
            <a href="{{url('admin/Slider/list')}}" class="nav-link @if(Request::segment(2)=='shipping_charge') active @endif ">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
              Slider
               
              </p>
            </a>
    
          </li>

          <li class="nav-item ">
            <a href="{{url('admin/logout')}}" class="nav-link ">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
               
              </p>
            </a>
    
          </li>



          
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>