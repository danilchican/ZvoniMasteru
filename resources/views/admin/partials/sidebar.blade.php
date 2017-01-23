<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->company->getLogo() }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->getName() }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li @if(Request::is('admin')) class="active" @endif>
                <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li @if(Request::is('admin/companies')) class="active" @endif>
                <a href="{{ route('admin.companies.index') }}"><i class="fa fa-user"></i><span>Companies</span>
                    <!-- If having a new companies today that it will be display as 'new' -->
                    <small class="label pull-right bg-red" data-toggle="tooltip" data-original-title="Today">new</small>
                </a>
            </li>
            {{--
            <li @if(Request::is('adminpanel/orders')) class="active" @endif>
                <a href="/adminpanel/orders">
                    <i class="fa fa-share"></i> <span>Orders</span>
                    <!-- If having a new orders today that it will be display as 'new' -->
                    <small class="label pull-right bg-green"
                           data-toggle="tooltip" data-original-title="Today">new</small>
                </a>
            </li>
            <li>
                <a href="/adminpanel/reviews">
                    <i class="fa fa-comments"></i> <span>Reviews</span>
                    <!-- If having a new reviews today that it will be display as 'new' -->
                    <small class="label pull-right bg-yellow"
                           data-toggle="tooltip" data-original-title="Today">new</small>
                </a>
            </li>
            --}}
            <li class="treeview @if(Request::is('dashboard/tariffs*') || Request::is('dashboard/services*')) active @endif">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>Tariffs</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li @if(Request::is('dashboard/tariffs*')) class="active" @endif><a href="{{ route('admin.tariffs.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
                    <li @if(Request::is('dashboard/services*')) class="active" @endif><a href="{{ route('admin.services.index') }}"><i class="fa fa-circle-o"></i> Services</a></li>
                </ul>
            </li>
            <li class="treeview @if(Request::is('dashboard/categories*')) active @endif">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>Categories</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li @if(Request::is('dashboard/categories')) class="active" @endif><a href="{{ route('admin.categories.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
                    <li @if(Request::is('dashboard/categories/create')) class="active" @endif><a href="{{ route('admin.categories.create') }}"><i class="fa fa-circle-o"></i> Create</a></li>
                </ul>
            </li>
            <li @if(Request::is('dashboard/specialities')) class="active" @endif>
                <a href="{{ route('admin.specialities.index') }}"><i class="fa fa-list-ul"></i> <span>Specialities</span></a>
            </li>
            {{--
            <li>
                <a href="/adminpanel/menus"><i class="fa fa-th"></i> <span>Menus</span></a>
            </li>
            <li>
                <a href="/adminpanel/galleries"><i class="fa fa-picture-o"></i> <span>Galleries</span></a>
            </li>
            --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>