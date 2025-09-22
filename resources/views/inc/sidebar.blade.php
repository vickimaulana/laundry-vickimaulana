<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('dashboard.index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      @if (auth()->user()->id_level == 1 || auth()->user()->id_level == 2)
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('customer.index') }}">
              <i class="bi bi-circle"></i><span>Customer</span>
            </a>
          </li>
          @if (auth()->user()->id_level == 1)
          <li>
            <a href="{{ route('service.index') }}">
              <i class="bi bi-circle"></i><span>Service</span>
            </a>
          </li>
          <li>
            <a href="{{ route('level.index') }}">
              <i class="bi bi-circle"></i><span>Level</span>
            </a>
          </li>
          <li>
            <a href="{{ route('user.index') }}">
              <i class="bi bi-circle"></i><span>User</span>
            </a>
          </li>
          @endif
        </ul>
      </li><!-- End Components Nav -->
      @endif

      @if (auth()->user()->id_level == 3)
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('report') }}">
          <i class="bi bi-receipt"></i>
          <span>Report</span>
        </a>
      </li>
      @endif

      @if (auth()->user()->id_level == 2)
      <li class="nav-heading">Transaction</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('order.index') }}">
          <i class="bi bi-book"></i>
          <span>Order</span>
        </a>
      </li><!-- End Profile Page Nav -->
      @endif

    </ul>

  </aside>
