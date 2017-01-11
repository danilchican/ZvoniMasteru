@extends('adminpanel.layouts.app')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="/css/admin/dataTables.bootstrap.css">
<link rel="stylesheet" href="/css/admin/jquery.dataTables.css">
@endsection

@section('breadcrumbs')
    <section class="content-header">
        <h1>{{ $titlePage }}</h1>
        {!! Breadcrumbs::render('admin.companies.index') !!}
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

    <div class="row">
        <div class="col-xs-6">
            <div class="box no-margin">
                <div class="box-header">
                    <h3 class="box-title">{{ $titlePage }}</h3>
                </div><!-- /.box-header -->
                    <div class="box-body table-responsive @if(count($services) > 0) no-padding no-margin @endif">
                        @if(count($services) > 0)
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                @include('admin.tariffs.additionals.show')
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <h4>Услуг пока нет.</h4>
                        @endif
                    </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-xs-6">
            @include('adminpanel.tariffs.additionals.create')
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-sm-6">
            {!! $services->links() !!}
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->
@endsection