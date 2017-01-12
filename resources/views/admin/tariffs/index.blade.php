@extends('admin.layouts.app')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="/css/admin/dataTables.bootstrap.css">
<link rel="stylesheet" href="/css/admin/jquery.dataTables.css">
@endsection

@section('breadcrumbs')
    <section class="content-header">
        <h1>{{ $titlePage }}</h1>
        {!! Breadcrumbs::render('admin.tariffs') !!}
    </section>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="callout callout-info">
        <h4>About this page!</h4>
        {!! $about or "<p>This page has been created for control of all tariffs. You can create, delete and edit
        any tariff by clicking on buttons.</p>" !!}
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('error') }}
        </div>
    @endif
    <div class="col-xs-12" style="margin-bottom: 15px;">
        <div class="row">
            <div class="col-xs-2">
                <div class="row">
                    <a href="{{ route('admin.tariffs.create') }}">
                        <button type="button" class="btn btn-block btn-primary">New tariff</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box no-margin">
                <div class="box-header">
                    <h3 class="box-title">{{ $titlePage }}</h3>
                    @if(count($tariffs) > 0)
                        <div class="box-tools">
                            <div class="input-group" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control input-sm pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div><!-- /.box-header -->
                    <div class="box-body table-responsive @if(count($tariffs) > 0) no-padding no-margin @endif">
                        @if(count($tariffs) > 0)
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Top</th>
                                <th>Created at</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tariffs as $tariff)
                                @include('admin.tariffs.show')
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <h4>Тарифов пока нет.</h4>
                        @endif
                    </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-sm-6">
            {!! $tariffs->links() !!}
        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->
@endsection