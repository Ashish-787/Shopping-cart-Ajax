<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item sidebar-category">
      <p>Admin Panel</p>
      <span></span>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="mdi mdi-view-dashboard menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('createProduct') }}">
        <i class="mdi mdi-plus-box menu-icon"></i>
        <span class="menu-title">Add Product</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('productView') }}">
        <i class="mdi mdi-eye menu-icon"></i>
        <span class="menu-title">All Products</span>
      </a>
    </li>
    <!-- kkhkuuhkujl -->

    <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.cart') }}">
        <i class="mdi mdi-cart menu-icon"></i>
        <span class="menu-title">Cart</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('checkout') }}">
        <i class="mdi mdi-credit-card menu-icon"></i>
        <span class="menu-title">Checkout</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('order.success') }}">
        <i class="mdi mdi-check-circle menu-icon"></i>
        <span class="menu-title">Order Success</span>
      </a>
    </li>

  </ul>
</nav>
