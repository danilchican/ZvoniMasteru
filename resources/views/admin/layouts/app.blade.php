<!-- Header -->
@include('admin.partials.head')

<!-- Sidebar -->
@include('admin.partials.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('breadcrumbs')
    @yield('content')
</div><!-- /.content-wrapper -->

<!-- Footer -->
@include('admin.partials.footer')