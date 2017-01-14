@extends('admin.layouts.app')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="/css/admin/dataTables.bootstrap.css">
<link rel="stylesheet" href="/css/admin/jquery.dataTables.css">
@endsection

@section('breadcrumbs')
    <section class="content-header">
        <h1>{{ $titlePage }}</h1>
        {!! Breadcrumbs::render('admin.specialities') !!}
    </section>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="callout callout-info">
        <h4>About this page!</h4>
        {!! $about or "<p>This page has been created for control of all Prices & Services. You can create, delete and edit
        any Price or Service by clicking on buttons.</p>" !!}
    </div>

    <specialities title-page="{{ $titlePage }}"></specialities>
</section><!-- /.content -->
@endsection