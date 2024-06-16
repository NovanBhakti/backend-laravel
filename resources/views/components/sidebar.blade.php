<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">POSESIF</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">POS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('home') }}">General Dashboard</a>
                    </li>
                    <li class="{{ Request::is('dashboard-ecommerce-dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('dashboard-ecommerce-dashboard') }}">Ecommerce Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('user') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('user.index') }}">All Users</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Product</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('product') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('product.index') }}">All Products</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Category</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('category') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('category.index') }}">All Categories</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Others</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('discount') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('discount.index') }}">Discount</a>
                    </li>
                    <li class='{{ Request::is('tax') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('tax.index') }}">Tax</a>
                    </li>
                    <li class='{{ Request::is('service') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ route('service.index') }}">Service Charge</a>
                    </li>
                </ul>
            </li>
    </aside>
</div>
