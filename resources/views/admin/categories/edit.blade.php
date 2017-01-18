@extends('admin.layouts.app')

@section('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="/css/admin/dataTables.bootstrap.css">
    <link rel="stylesheet" href="/css/admin/jquery.dataTables.css">
    <link rel="stylesheet" href="/css/admin/pace.min.css">
    <link rel="stylesheet" href="/css/admin/select2.min.css">
    <style>
        .select2-container--default
        .select2-selection--multiple
        .select2-selection__choice {
            color: #000;
        }
    </style>
@endsection

@section('breadcrumbs')
    <section class="content-header">
        <h1>{{ $titlePage }}</h1>
        {!! Breadcrumbs::render('admin.categories.edit') !!}
    </section>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="callout callout-info">
            <h4>About this page!</h4>
            {!! $about or "<p>This page has been created for edit category.</p>" !!}
        </div>

        @include('admin.partials.errors')

        <div class="col-xs-12">
            <div class="row">
                {!! Form::open(['route' => ['admin.categories.update', $category->id], 'method' => 'put', 'files' => 'true']) !!}
                <div class="box box-primary edit-category">
                    <div class="box-header with-border">
                        <i class="fa fa-edit"></i>
                        <h3 class="box-title">{{ $titlePage }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="name">Название категории</label>
                                        <input type="text" value="{{ ($old = old('name')) ? $old : $category->getName() }}" class="form-control" name="name" placeholder="Введите название категории">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="slug">Ссылка</label>
                                        <input type="text" value="{{ ($old = old('slug')) ? $old : $category->getSlug() }}" class="form-control" name="slug" placeholder="Название на латинице">
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="parent">Дочерняя категория</label>
                                        <select name="parent" class="form-control select2 select2-hidden-accessible parent-category-select" data-placeholder="Select a Сategory" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option></option>
                                            @foreach($parentCategories as $cat)
                                                <option value="{{ $cat->id }}" {{ ($category->getParentCategoryID() == $cat->id) ? 'selected' :'' }}>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="desc">Описание категории</label>
                                        <textarea class="form-control" value="{{ ($old = old('desc')) ? $old : $category->getDescription() }}" name="desc" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    @if($category->hasThumbnail())
                                    <div class="form-group">
                                        <img alt="{{ $category->getName() }}" src="{{ $category->getThumbnailURL() }}" class="img-circle" style="width: 140px; height: 140px;">
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="thumbnail">
                                            @if($category->hasThumbnail())
                                                Обновить изображение категории
                                            @else
                                                Изображение категории
                                            @endif
                                        </label>
                                        {!! Form::file('thumbnail') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-primary save-button">Save</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section><!-- /.content -->
@endsection

@section('javascripts')
    <script src="/js/admin/select2.min.js"></script>
    <script>
        $('document').ready(function() {
            $(".parent-category-select").select2({
                allowClear: true
            });
        });
    </script>
@endsection