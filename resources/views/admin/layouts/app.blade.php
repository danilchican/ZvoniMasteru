@include('admin.partials.head')

<!-- Сайдбар -->
@include('admin.partials.sidebar')

<!-- Область контента -->
@yield('content')

<!-- Подвал админ-панели-->
@include('admin.partials.footer')

