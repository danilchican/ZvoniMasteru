@extends('admin.layouts.app')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="/css/admin/dataTables.bootstrap.css">
    <link rel="stylesheet" href="/css/admin/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/admin/pace.min.css">
    <link rel="stylesheet" href="/css/admin/select2.min.css">
    <style>
        .category {
            padding: 5px 12px;
            margin: 3px 10px;
            border-radius: 2px;
            cursor: pointer;
            border: 1px solid #d2d6de;
        }
        .pull-right {
            float: right;
        }
        .categories-table {
            padding-bottom: 6px!important;
        }
    </style>
@endsection

@section('breadcrumbs')
    <section class="content-header">
        <h1>{{ $titlePage }}</h1>
        {!! Breadcrumbs::render('admin.categories') !!}
    </section>
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="callout callout-info">
        <h4>About this page!</h4>
        {!! $about or "<p>This page has been created for manipulation of all categories. You can create, delete and edit
        any category by clicking for buttons.</p>" !!}
    </div>

    @include('admin.partials.errors')

    <div class="col-xs-12" style="margin-bottom: 15px;">
        <div class="row">
            <div class="col-xs-2">
                <div class="row">
                    <a href="{{ route('admin.categories.create') }}">
                        <button type="button" class="btn btn-block btn-primary">New category</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $titlePage }}</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding categories-table">
                    @if(count($categories) < 1)
                        <h4 style="padding-left: 8px">Категорий пока нет.</h4>
                    @else
                        @foreach ($categories as $category)
                            @include('admin.categories.show', ['category' => $category, 'dep' => '-'])
                        @endforeach
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    @include('admin.categories.edit')

</section><!-- /.content -->
@endsection

@section('javascripts')
    <script src="/js/admin/jquery.spoiler.min.js"></script>
    <script src="/js/admin/select2.min.js"></script>
    <script>
        $('document').ready(function() {
            $(".spoiler").spoiler();
            $(".parent-select").select2({
                placeholder: "Выберите категорию...",
                allowClear: true
            });
            $('#edit-cat-modal').modal({
                show : false
            });
        });
    </script>
@endsection