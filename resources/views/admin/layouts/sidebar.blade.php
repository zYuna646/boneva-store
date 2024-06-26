<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="text-nowrap">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/front/img/favicon.png') }}" width="50">
                    <h4 class="mb-0 px-2 fw-bolder">ADMIN PANEL</h4>
                </div>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav border-top">
            <ul id="sidebarnav" class="nav flex-column">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'dashboard') active @endif"
                        href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Master Data</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'account') active @endif"
                        href="{{ route('admin.account') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">account</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'category') active @endif"
                        href="{{ route('admin.category') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-category-2"></i>
                        </span>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'bahan') active @endif"
                        href="{{ route('admin.bahan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-news"></i>
                        </span>
                        <span class="hide-menu">Bahan Baku</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'catalog') active @endif"
                        href="{{ route('admin.catalog') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-brand-appgallery"></i>
                        </span>
                        <span class="hide-menu">Products</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'produksi_bahan') active @endif"
                        href="{{ route('admin.produksi_bahan') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-brand-appgallery"></i>
                        </span>
                        <span class="hide-menu">Produksi Bahan Baku</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'produksi') active @endif"
                        href="{{ route('admin.produksi') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-brand-appgallery"></i>
                        </span>
                        <span class="hide-menu">Produksi Products</span>
                    </a>
                </li>
               
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Order</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'bank') active @endif"
                        href="{{ route('admin.order', 'bank') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-news"></i>
                        </span>
                        <span class="hide-menu">Bank</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'cash') active @endif"
                        href="{{ route('admin.order', 'cash') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-news"></i>
                        </span>
                        <span class="hide-menu">Cash</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'cod') active @endif"
                        href="{{ route('admin.order', 'cod') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-news"></i>
                        </span>
                        <span class="hide-menu">COD</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'information') active @endif"
                        href="{{ route('admin.history_order') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-news"></i>
                        </span>
                        <span class="hide-menu">History Order</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Settings</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'about-us') active @endif"
                        href="{{ route('admin.about-us') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-info-hexagon"></i>
                        </span>
                        <span class="hide-menu">About Us</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'main-slider') active @endif"
                        href="{{ route('admin.main-slider') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-slideshow"></i>
                        </span>
                        <span class="hide-menu">Main Slider</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'review-slider') active @endif"
                        href="{{ route('admin.review-slider') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-slideshow"></i>
                        </span>
                        <span class="hide-menu">Review Slider</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link @if ($active == 'account-setting') active @endif"
                        href="{{ route('admin.account-setting') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-cog"></i>
                        </span>
                        <span class="hide-menu">Account Setting</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
