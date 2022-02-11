<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('Backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Pannel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('Backend') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">@auth
              {{ auth()->user()->name }}
          @endauth</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> --}}
          {{-- <li class="nav-item">
            <a href="@route('category.index')" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Category</p>
            </a>
          </li>

        </li>
        <li class="nav-item">
            <a href="@route('cache')" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Cache</p>
            </a>
          </li>
        <li class="nav-item">
          <a href="@route('skill.index')" class="nav-link">
            <i class="nav-icon far fa-circle text-warning"></i>
            <p>Skill</p>
          </a>
        </li> --}}

        <li class="nav-item ">
            <a class="nav-link @if ($navItem === 'dashboard')
            active
            @endif" href="{{ route('admin.dashboard') }}">
                <i class=" nav-icon fa fa-home text-warning"></i>
              <p>Dashboard</p>
            </a>
          </li>
        <li class="nav-item">
            <a class="nav-link @if ($navItem === 'slider')
            active
            @endif" href="{{ route('admin.slider.index') }}">
                <i class="nav-icon fas fa-sliders-h text-warning"></i>
              <p>Slider</p>
            </a>
          </li>
        <li class="nav-item">
            <a class="nav-link @if ($navItem === 'category')
            active
            @endif" href="{{ route('admin.category.index') }}">
              <i class="nav-icon fas fa-sitemap text-warning"></i>
              <p>Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'sub_cat')
            active
            @endif" href="{{ route('admin.sub-category.index') }}">
              <i class="nav-icon fas fa-sitemap text-warning"></i>
              <p>Sub Category</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'size')
            active
            @endif" href="{{ route('admin.size.index') }}">
              <i class="nav-icon far fa-window-maximize text-warning"></i>
              <p>Size</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'color')
            active
            @endif" href="{{ route('admin.color.index') }}">
              <i class="nav-icon fas fa-palette text-warning"></i>
              <p>Color</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'product')
            active
            @endif" href="{{ route('admin.product.index') }}">
              <i class="nav-icon fab fa-product-hunt text-warning"></i>
              <p>Product</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'coupon')
            active
            @endif" href="{{ route('admin.coupon.index') }}">
              <i class="nav-icon fas fa-ad text-warning"></i>
              <p>Coupon</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'website')
            active
            @endif" href="{{ route('admin.website.index') }}">
              <i class="nav-icon fas fa-globe-asia text-warning"></i>
              <p>Website</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'order')
            active
            @endif" href="{{ route('admin.orders') }}">
              <i class="nav-icon fas fa-th text-warning"></i>
              <p>Orders</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($navItem === 'message')
            active
            @endif" href="{{ route('admin.message.index') }}">
              <i class="nav-icon fa fa-envelope text-warning"></i>
              <p>Message</p>
            </a>
          </li>
          @auth('admin')
          <li class="nav-item">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button class="btn btn-success btn-block">Logout</button>
            </form>
          </li>
          @endauth
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
